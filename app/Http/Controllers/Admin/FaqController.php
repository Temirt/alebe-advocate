<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('created_at','desc')->paginate(20);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create(Request $request)
    {
        $initialData = ['question' => '', 'answer' => ''];
        if ($request->has('from_chat')) {
            $msg = \App\Models\ChatMessage::find($request->from_chat);
            if ($msg) {
                $initialData['question'] = $msg->message;
                // If there was an automated assistant reply, suggest it as the answer
                $initialData['answer'] = $msg->assistant_reply ?? '';
            }
        }
        return view('admin.faqs.create', compact('initialData'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'keywords' => 'nullable|string',
            'rating' => 'nullable|integer|min:0|max:5',
        ]);
        $data['created_by'] = auth()->id();
        $rating = (int)($data['rating'] ?? 0);
        $publishThreshold = (int)env('FAQ_PUBLISH_RATING', 4);
        $data['is_published'] = $request->has('is_published') || $rating >= $publishThreshold;
        Faq::create($data);
        return redirect()->route('admin.faqs.index')->with('status','FAQ created');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'keywords' => 'nullable|string',
            'rating' => 'nullable|integer|min:0|max:5',
        ]);
        $rating = (int)($data['rating'] ?? 0);
        $publishThreshold = (int)env('FAQ_PUBLISH_RATING', 4);
        $data['is_published'] = $request->has('is_published') || $rating >= $publishThreshold;
        $faq->update($data);
        return redirect()->route('admin.faqs.index')->with('status','FAQ updated');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('status','FAQ deleted');
    }
}
