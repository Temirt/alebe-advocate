<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PurchaseController extends Controller
{
    public function __construct()
    {
        // Authorization is handled within each method to support both user and guest orders
    }

    public function buy(Form $form)
    {
        return view('forms.buy', compact('form'));
    }

    public function purchase(Request $request, Form $form)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to purchase.');
        }

        $amount = $form->price ?? 0;

        // Authenticated user purchase
        $order = Order::create([
            'user_id' => $user->id,
            'form_id' => $form->id,
            'amount' => $amount,
            'status' => 'paid',
            'transaction_id' => 'tx_'.uniqid()
        ]);

        Log::info('Order created', ['order_id' => $order->id, 'user' => $user->id]);

        return redirect()->route('forms.receipt', [$form, 'tx' => $order->transaction_id]);
    }

    public function receipt(Form $form, Request $request)
    {
        $tx = $request->query('tx');
        $order = Order::where('transaction_id', $tx)->where('form_id', $form->id)->firstOrFail();
        
        // Strictly require authentication and ownership
        $this->authorizeDownload($order);
        
        return view('forms.receipt', compact('order', 'form'));
    }

    public function download(Form $form, Request $request)
    {
        $tx = $request->query('tx');
        $order = Order::where('transaction_id', $tx)->where('form_id', $form->id)->firstOrFail();
        
        // Strictly require authentication and ownership
        $this->authorizeDownload($order);

        if (!$form->file_url) {
            abort(404, 'No attachment available');
        }

        // convert public url (/storage/...) to storage path
        $path = parse_url($form->file_url, PHP_URL_PATH);
        $relative = ltrim(preg_replace('#^/storage/#', '', $path), '/');
        $disk = Storage::disk('public');
        if (!$disk->exists($relative)) {
            abort(404, 'File not found');
        }

        $storagePath = $disk->path($relative);

        // If FPDI is available, try to watermark the PDF with purchaser name/tx
        if (class_exists('\setasign\Fpdi\Fpdi')) {
            try {
                $temp = sys_get_temp_dir().'/'.uniqid('wm_').'.pdf';
                // basic FPDI stamping: import pages and add watermark text
                $fpdf = new \setasign\Fpdf\Fpdf();
                $pdf = new \setasign\Fpdi\Fpdi($fpdf);
                $pageCount = $pdf->setSourceFile($storagePath);
                for ($i = 1; $i <= $pageCount; $i++) {
                    $tpl = $pdf->importPage($i);
                    $size = $pdf->getTemplateSize($tpl);
                    $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                    $pdf->useTemplate($tpl);
                    $pdf->SetFont('Arial', 'B', 50);
                    $pdf->SetTextColor(200, 200, 200);
                    $pdf->SetXY(30, 30);
                    $txt = 'ALBACHEW — '.$order->transaction_id;
                    $pdf->SetAlpha ? $pdf->SetAlpha(0.15) : null; // if extension provided
                    $pdf->Rotate ? $pdf->Rotate(45) : null;
                    $pdf->Cell(0, 0, $txt);
                }
                $pdf->Output($temp, 'F');
                return response()->download($temp, basename($storagePath))->deleteFileAfterSend(true);
            } catch (\Exception $e) {
                Log::error('Watermarking failed: '.$e->getMessage());
                // fallback to standard download
            }
        }

        return response()->download($storagePath, basename($storagePath));
    }

    protected function authorizeDownload(Order $order)
    {
        $user = Auth::user();
        if (!$user || ($order->user_id !== $user->id && !$user->is_admin)) {
            abort(403);
        }
        if ($order->status !== 'paid') {
            abort(403, 'Order not paid');
        }
    }
}
