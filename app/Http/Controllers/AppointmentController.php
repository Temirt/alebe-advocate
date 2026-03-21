<?php
namespace App\Http\Controllers;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller {
    public function create() {
        $practiceAreas = \App\Models\PracticeArea::where('is_active', true)
            ->pluck('title', 'title');
            
        return view('appointments.create', compact('practiceAreas'));
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'preferred_date' => 'required|date|after:today',
            'preferred_time' => 'required',
            'practice_area' => 'required|string',
            'notes' => 'nullable|string',
        ]);
        
        Appointment::create($validated);
        
        return redirect()->route('appointment.success')
            ->with('success', 'Your appointment request has been submitted. We will confirm shortly.');
    }
    
    public function success() {
        return view('appointments.success');
    }
}
