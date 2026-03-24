<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'photo' => 'nullable|image|max:4096',
            'is_video' => 'nullable|boolean',
            'video_url' => 'nullable|url|required_if:is_video,1',
            'is_approved' => 'nullable|boolean',
        ]);

        $data['is_video'] = $request->has('is_video');
        $data['is_approved'] = $request->has('is_approved');

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('testimonials', 'public');
            $data['photo'] = Storage::url($path);
        }

        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial created');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'photo' => 'nullable|image|max:4096',
            'is_video' => 'nullable|boolean',
            'video_url' => 'nullable|url|required_if:is_video,1',
            'is_approved' => 'nullable|boolean',
        ]);

        $data['is_video'] = $request->has('is_video');
        $data['is_approved'] = $request->has('is_approved');

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('testimonials', 'public');
            $data['photo'] = Storage::url($path);
        }

        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial updated');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial deleted');
    }
}
