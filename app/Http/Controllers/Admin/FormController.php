<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::orderBy('created_at','desc')->paginate(20);
        return view('admin.forms.index', compact('forms'));
    }

    public function create()
    {
        return view('admin.forms.create');
    }

    public function store(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Admin form store attempt', ['input' => $request->except('file')]);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'is_published' => 'nullable|boolean',
            'file' => 'nullable|file|mimes:pdf,doc,docx,zip|max:20480'
        ]);
        $data['created_by'] = auth()->id();
        $data['is_published'] = $request->has('is_published');
        // handle file upload
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('forms', 'public');
            // store public url
            $data['file_url'] = \Illuminate\Support\Facades\Storage::url($path);
        }

        $form = Form::create($data);
        \Illuminate\Support\Facades\Log::info('Form created', ['id' => $form->id, 'title' => $form->title, 'is_published' => $form->is_published]);
        return redirect()->route('admin.forms.index')->with('status', 'Form created');
    }

    public function edit(Form $form)
    {
        return view('admin.forms.edit', compact('form'));
    }

    public function update(Request $request, Form $form)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'is_published' => 'nullable|boolean',
            'file' => 'nullable|file|mimes:pdf,doc,docx,zip|max:20480'
        ]);
        $data['is_published'] = $request->has('is_published');
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('forms', 'public');
            $data['file_url'] = \Illuminate\Support\Facades\Storage::url($path);
        }
        $form->update($data);
        return redirect()->route('admin.forms.index')->with('status', 'Form updated');
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('admin.forms.index')->with('status', 'Form deleted');
    }
}
