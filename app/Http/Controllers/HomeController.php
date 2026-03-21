<?php
namespace App\Http\Controllers;
use App\Models\PracticeArea;
use App\Models\Attorney;
use App\Models\CaseResult;
use App\Models\Testimonial;

class HomeController extends Controller {
    public function index() {
        $practiceAreas = PracticeArea::where('is_active', true)
            ->orderBy('order')
            ->take(6)
            ->get();
            
        $attorneys = Attorney::where('is_active', true)
            ->orderBy('order')
            ->take(4)
            ->get();
            
        $featuredCases = CaseResult::where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();
            
        $testimonials = Testimonial::where('is_approved', true)
            ->latest()
            ->take(6)
            ->get();
            
        return view('home', compact('practiceAreas', 'attorneys', 'featuredCases', 'testimonials'));
    }
}
