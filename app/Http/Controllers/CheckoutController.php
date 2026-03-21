<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Form;
use App\Models\Order;

class CheckoutController extends Controller
{
    /**
     * Initiate the Chapa Payment
     */
    public function pay(Request $request, Form $form)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
        ]);

        $tx_ref = 'TX-' . uniqid();

        // Create a pending order
        $order = Order::create([
            'form_id' => $form->id,
            'user_id' => auth()->id() ?? null,
            'amount' => $form->price,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'guest_phone' => null, // Phone no longer required before checkout page
            'transaction_id' => $tx_ref,
            'status' => 'pending',
        ]);

        $chapaKey = env('CHAPA_SECRET_KEY');

        // ==== DEVELOPMENT MOCK BYPASS ====
        if (empty($chapaKey) || str_contains($chapaKey, 'xxxxxxxx') || $chapaKey === 'CHASECK_TEST-your-chapa-secret-key-goes-here') {
            return redirect()->route('checkout.pending', ['tx_ref' => $tx_ref]);
        }
        
        // Standard Chapa Hosted Payment Portal (Bank Transfers, Cards, Telebirr, CBE Birr, etc.)
        $response = Http::withToken($chapaKey)
            ->post('https://api.chapa.co/v1/transaction/initialize', [
                'amount' => $form->price,
                'currency' => 'ETB',
                'email' => $request->guest_email,
                'first_name' => explode(' ', $request->guest_name)[0],
                'last_name' => explode(' ', $request->guest_name)[1] ?? '',
                'tx_ref' => $tx_ref,
                'callback_url' => route('checkout.callback', ['tx_ref' => $tx_ref]),
                'return_url' => route('checkout.callback', ['tx_ref' => $tx_ref]),
                'customization' => [
                    'title' => 'Alebe Advocate',
                    'description' => 'Payment for ' . $form->title
                ]
            ]);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['status']) && $data['status'] == 'success') {
                // Redirect directly to Chapa standard secure page
                return redirect($data['data']['checkout_url']);
            }
            $errorDesc = $data['message'] ?? json_encode($data);
        } else {
            $errorDesc = $response->body();
        }

        return back()->with('error', 'Payment initialization failed: ' . $errorDesc);
    }

    /**
     * Pending Telebirr Push Screen
     */
    public function pending($tx_ref)
    {
        $order = Order::where('transaction_id', $tx_ref)->firstOrFail();
        
        return view('checkout.pending', compact('order', 'tx_ref'));
    }

    /**
     * Handle the Chapa Callback / Verification
     */
    public function callback(Request $request)
    {
        $tx_ref = $request->query('tx_ref');

        if (!$tx_ref) {
            return redirect()->route('legal-forms.index')->with('error', 'Invalid Transaction Reference.');
        }

        $order = Order::where('transaction_id', $tx_ref)->firstOrFail();

        $chapaKey = env('CHAPA_SECRET_KEY');
        
        // ==== DEVELOPMENT MOCK BYPASS ====
        if (empty($chapaKey) || str_contains($chapaKey, 'xxxxxxxx') || $chapaKey === 'CHASECK_TEST-your-chapa-secret-key-goes-here') {
            $order->update(['status' => 'completed']);
            return redirect()->route('checkout.success', ['order' => $order->id])
                ->with('success', 'Payment successful! (Development Mode Simulation). You can now download your document.');
        }

        // Verify with Chapa
        $response = Http::withToken($chapaKey)
            ->get("https://api.chapa.co/v1/transaction/verify/{$tx_ref}");

        if ($response->successful()) {
            $data = $response->json();
            if ($data['status'] == 'success' && $data['data']['status'] == 'success') {
                // Payment was completely confirmed
                $order->update(['status' => 'completed']);
                
                return redirect()->route('checkout.success', ['order' => $order->id])
                    ->with('success', 'Payment successful! You can now download your document.');
            }
        }

        $order->update(['status' => 'failed']);
        return redirect()->route('legal-forms.show', $order->form_id)
            ->with('error', 'Payment verification failed. Please try again.');
    }

    /**
     * Show success page / Display Download Link
     */
    public function success(Order $order)
    {
        if ($order->status !== 'completed') {
            abort(403, 'Unauthorized. Payment not completed.');
        }

        return view('checkout.success', compact('order'));
    }

    /**
     * Secure Download Method
     */
    public function download(Order $order)
    {
        if ($order->status !== 'completed') {
            abort(403, 'Unauthorized.');
        }
        
        // This is a basic download stream, assumes file_url holds a path inside storage or direct link
        // You might need to adjust this depending on how FormController saves files
        $fileUrl = $order->form->file_url;
        if(filter_var($fileUrl, FILTER_VALIDATE_URL)) {
             return redirect($fileUrl); // Redirect to S3/Cloud
        }
        
        $path = storage_path('app/public/' . str_replace('/storage/', '', $fileUrl));
        if (file_exists($path)) {
            return response()->download($path);
        }
        
        return back()->with('error', 'File not found on server.');
    }

    /**
     * Chapa Webhook Listener
     * Listens for async transaction updates to ensure payments are always marked as completed
     * even if the user drops off the pending page.
     */
    public function webhook(Request $request)
    {
        $payload = $request->all();
        $tx_ref = $payload['tx_ref'] ?? null;

        // If a transaction reference is pushed to our webhook, ensure it's verified securely!
        if ($tx_ref) {
            $order = Order::where('transaction_id', $tx_ref)->first();
            
            if ($order && $order->status !== 'completed') {
                // Manually verify with Chapa to ensure the webhook payload wasn't spoofed
                $response = Http::withToken(env('CHAPA_SECRET_KEY'))
                    ->get("https://api.chapa.co/v1/transaction/verify/{$tx_ref}");

                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['status']) && $data['status'] == 'success' && isset($data['data']['status']) && $data['data']['status'] == 'success') {
                        $order->update(['status' => 'completed']);
                    } else {
                        $order->update(['status' => 'failed']);
                    }
                }
            }
        }

        return response()->json(['status' => 'success']);
    }
}
