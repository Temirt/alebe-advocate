<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatSubmitController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $chat = ChatMessage::create([
            'name' => $request->name ?? 'Visitor',
            'email' => $request->email,
            'message' => $request->message,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json([
            'status' => 'success',
            'chat_id' => $chat->id,
            'reply' => $chat->assistant_reply,
            'message' => 'Thanks - we received your message. An admin will reply shortly.',
        ]);
    }

    public function show(ChatMessage $chat)
    {
        return response()->json([
            'status' => 'success',
            'reply' => $chat->assistant_reply,
            'faq_id' => $chat->faq_id,
        ]);
    }
}
