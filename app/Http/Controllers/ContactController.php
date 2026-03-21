<?php
namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;

class ContactController extends Controller {
    public function create() {
        $practiceAreas = \App\Models\PracticeArea::where('is_active', true)
            ->pluck('title', 'title');
            
        return view('contact.create', compact('practiceAreas'));
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'practice_area' => 'nullable|string',
        ]);
        
        $contact = Contact::create($validated);
        
        // Send email notification (Note: If App\Mail\ContactFormSubmitted does not exist, you might need to build it or comment out Mail::to).
        // Mail::to(config('mail.admin_address'))->send(new ContactFormSubmitted($contact));
        
        return redirect()->route('contact.success')
            ->with('success', 'Your message has been sent successfully. We will contact you soon.');
    }
    
    public function success() {
        return view('contact.success');
    }
}
