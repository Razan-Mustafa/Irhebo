<?php

namespace App\Http\Controllers\Api;

use App\Events\NewMessageEvent;
use App\Events\PusherNewMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatMessageResource;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Utilities\FileManager;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getAllChats()
    {
        $userId = auth()->id();

        $chats = Chat::with(['userOne', 'userTwo'])
            ->where(function ($q) use ($userId) {
                $q->where('user_id_one', $userId)
                    ->orWhere('user_id_two', $userId);
            })
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($chat) use ($userId) {
                $otherUser = $chat->user_id_one == $userId ? $chat->userTwo : $chat->userOne;

                // احسب عدد الرسائل غير المقروءة
                $unreadCount = ChatMessage::where('chat_id', $chat->id)
                    ->where('sender_id', '!=', $userId)
                    ->where('is_read', false)
                    ->count();

                return [
                    'chat_id'       => $chat->id,
                    'receiver'      => [
                        'id'       => $otherUser->id,
                        'username' => $otherUser->username,
                        'image'    => url($otherUser->avatar),
                    ],
                    'unread_count'  => $unreadCount,
                ];
            });

        return $this->successResponse(__('messages.chats_retrived'), $chats->values());
    }




    public function startChat(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $userIdOne = auth()->id();
        $userIdTwo = $validated['user_id'];

        $ids = [$userIdOne, $userIdTwo];
        sort($ids);

        $chat = Chat::firstOrCreate([
            'user_id_one' => $ids[0],
            'user_id_two' => $ids[1],
        ]);
        return $this->successResponse(__('messages.chat_started'), $chat);
    }




    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'message' => 'nullable|string',
            'attachment_url' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mp3,pdf',
            'attachment_type' => 'nullable|in:image,video,file,audio|required_with:attachment_url',
        ]);
        if (is_null($request->message) && is_null($request->file('attachment_url'))) {
            return $this->errorResponse(__('either_message_or_attachment_required'));
        }
        $attachmentUrl = null;

        if ($request->hasFile('attachment_file')) {
            $attachmentUrl = FileManager::upload('chat_attachments', $request->file('attachment_file'));
        }

        $message = ChatMessage::create([
            'chat_id'        => $request->chat_id,
            'sender_id'      => auth()->id(),
            'message'        => $request->message,
            'attachment_url' => $attachmentUrl,
            'attachment_type' => $request->attachment_type,
            'is_read' => false,
        ]);

        broadcast(new PusherNewMessage($message))->toOthers();

        return $this->successResponse(__('messages.message_sent'), $message);
    }

    public function getMessages($chatId)
    {
        $messages = ChatMessage::where('chat_id', $chatId)
            ->with([
                'sender:id,username',
                'chat.userOne:id,username',
                'chat.userTwo:id,username'
            ])
            ->orderBy('created_at')
            ->get();

        return $this->successResponse(_('messages.message_retrived'), ChatMessageResource::collection($messages));
    }


    public function markAsRead($chatId)
    {
        ChatMessage::where('chat_id', $chatId)
            ->where('sender_id', '!=', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return $this->successResponse(_('messages.mark_as_read_message'));
    }


    public function unreadCount($chatId)
    {
        $count = ChatMessage::where('chat_id', $chatId)
            ->where('sender_id', '!=', auth()->id())
            ->where('is_read', false)
            ->count();


        return $this->successResponse(_('messages.count_message'), $count);
    }
}
