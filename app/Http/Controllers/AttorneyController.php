<?php
namespace App\Http\Controllers;
use App\Models\Attorney;

class AttorneyController extends Controller {
    public function index() {
        $attorneys = Attorney::where('is_active', true)
            ->orderBy('order')
            ->get();
            
        return view('attorneys.index', compact('attorneys'));
    }
    
    public function show(Attorney $attorney) {
        return view('attorneys.show', compact('attorney'));
    }
}
