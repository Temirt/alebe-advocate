<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\Faq;

class ChatController extends Controller
{
    public function index()
    {
        $messages = ChatMessage::orderBy('created_at','desc')->paginate(30);
        $faqs = Faq::orderBy('rating', 'desc')->orderBy('created_at', 'desc')->get();
        return view('admin.chat.index', compact('messages', 'faqs'));
    }

    public function reply(Request $request, ChatMessage $chat)
    {
        $data = $request->validate([
            'assistant_reply' => 'required|string|max:2000',
            'add_to_faq' => 'nullable|boolean',
            'keywords' => 'nullable|string',
            'rating' => 'nullable|integer|min:0|max:5',
        ]);

        $chat->assistant_reply = $data['assistant_reply'];

        if ($request->boolean('add_to_faq')) {
            $rating = (int)($data['rating'] ?? 3);
            $publishThreshold = (int)env('FAQ_PUBLISH_RATING', 4);
            $faq = Faq::create([
                'question' => $chat->message,
                'answer' => $data['assistant_reply'],
                'keywords' => $data['keywords'] ?? null,
                'rating' => $rating,
                'created_by' => auth()->id(),
                'is_published' => $rating >= $publishThreshold,
            ]);
            $chat->faq_id = $faq->id;
        }

        $chat->save();

        return redirect()->route('admin.chat.index')->with('status', 'Reply saved');
    }
}
