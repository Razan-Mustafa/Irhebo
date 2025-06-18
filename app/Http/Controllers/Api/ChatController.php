<?php

namespace App\Http\Controllers\Api;

use App\Events\NewMessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getOrCreateChat(Request $request)
    {
        $userOne = auth()->id();
        $userTwo = $request->user_id;

        $chat = Chat::where(function ($q) use ($userOne, $userTwo) {
            $q->where('user_id_one', $userOne)->where('user_id_two', $userTwo);
        })
            ->orWhere(function ($q) use ($userOne, $userTwo) {
                $q->where('user_id_one', $userTwo)->where('user_id_two', $userOne);
            })
            ->first();

        if (!$chat) {
            $chat = Chat::create([
                'user_id_one' => $userOne,
                'user_id_two' => $userTwo
            ]);
        }

        return response()->json($chat);
    }

    // إرسال رسالة
    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'message' => 'nullable|string',
            'attachment_url' => 'nullable|string',
            'attachment_type' => 'nullable|in:image,video,file,audio'
        ]);

        $message = ChatMessage::create([
            'chat_id'        => $request->chat_id,
            'sender_id'      => auth()->id(),
            'message'        => $request->message,
            'attachment_url' => $request->attachment_url,
            'attachment_type' => $request->attachment_type,
        ]);

        broadcast(new NewMessageEvent($message))->toOthers();

        return response()->json(['status' => 'Message Sent!', 'message' => $message]);
    }

    // جلب الرسائل داخل شات
    public function getMessages($chatId)
    {
        $messages = ChatMessage::where('chat_id', $chatId)
            ->with('sender:id,name')
            ->orderBy('created_at')
            ->get();

        return response()->json($messages);
    }


    // تحديث الرسائل لمقروءة
    public function markAsRead($chatId)
    {
        ChatMessage::where('chat_id', $chatId)
            ->where('sender_id', '!=', auth()->id())
            ->update(['is_read' => true]);

        return response()->json(['status' => 'messages marked as read']);
    }
}
