<?php
namespace App\Http\Controllers;
use App\Models\PracticeArea;

class PracticeAreaController extends Controller {
    public function index(\Illuminate\Http\Request $request) {
        $query = $request->input('search');
        
        $practiceAreas = PracticeArea::where('is_active', true)
            ->when($query, function($q) use ($query) {
                return $q->where(function($sub) use ($query) {
                    $sub->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                });
            })
            ->orderBy('order')
            ->paginate(12)
            ->withQueryString();
            
        return view('practice-areas.index', compact('practiceAreas'));
    }
    
    public function show(PracticeArea $practiceArea) {
        return view('practice-areas.show', compact('practiceArea'));
    }
}
