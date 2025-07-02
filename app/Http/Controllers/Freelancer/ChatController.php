<?php

namespace App\Http\Controllers\Freelancer;

use App\Events\PusherNewMessage;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use App\Utilities\FileManager;
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
            'attachment' => 'nullable|file|max:51200', // 50MB max

        ]);

        // $chat = Chat::findOrFail($chatId);

        // Create message
        // $message = $chat->messages()->create([
        //     'sender_id' => auth()->id(),
        //     'message' => $request->message,
        //     'is_read' => 0,
        // ]);

        $message = new ChatMessage();
        $message->chat_id = $chatId;
        $message->sender_id = auth()->id();
        $message->message = $request->message;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = FileManager::upload('chat_attachments', $file);

            $message->attachment_path = $path;
            $message->attachment_type = $file->getMimeType();
        }


        $message->save();



        // Broadcast to others
        broadcast(new PusherNewMessage($message))->toOthers();
        return response()->json([
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'attachment_url' => $message->attachment_path ? asset($message->attachment_path) : null,
                'attachment_type' => $message->attachment_type,
                'sender_id' => $message->sender_id,
                'created_at' => $message->created_at->toDateTimeString()
            ]
        ]);
    }
}
