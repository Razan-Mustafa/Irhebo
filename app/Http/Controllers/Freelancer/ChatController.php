<?php

namespace App\Http\Controllers\Freelancer;

use App\Events\PusherNewMessage;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{


    public function index()
    {
        $userId = auth()->id();
        $chats = Chat::where('user_id_one', $userId)
            ->orWhere('user_id_two', $userId)
            ->get();

        return view('pages-freelancer.chat.index', compact('chats'));
    }



    public function showChat($id)
    {
        $chat = Chat::with(['messages.sender'])->findOrFail($id);

        $otherUser = $chat->user_id_one === auth()->id()
            ? $chat->userTwo
            : $chat->userOne;

        $messages = $chat->messages()->orderBy('created_at')->get();

        return view('pages-freelancer.chat.showChat', compact('chat', 'messages', 'otherUser'));
    }


    public function sendMessage(Request $request, $chatId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $chat = Chat::findOrFail($chatId);

        // Create message
        $message = $chat->messages()->create([
            'sender_id' => auth()->id(),
            'message' => $request->message,
            'is_read' => 0,
        ]);

        // Broadcast to others
        broadcast(new PusherNewMessage($message))->toOthers();
        return response()->json([
            'message' => $message
        ]);
    }
}
