<?php
namespace App\Http\Controllers;
use App\Models\Form;

class LegalFormController extends Controller {
    public function index(\Illuminate\Http\Request $request) {
        $query = $request->input('search');
        
        $forms = Form::where('is_published', true)
            ->when($query, function($q) use ($query) {
                return $q->where(function($sub) use ($query) {
                    $sub->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->orWhere('file_url', 'like', "%{$query}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();
            
        return view('legal-forms.index', compact('forms'));
    }
    
    public function show(Form $form) {
        return view('legal-forms.show', compact('form'));
    }
}
