<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageReadEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $conversationId;
    public $userId;

    public function __construct($conversationId, $userId)
    {
        $this->conversationId = $conversationId;
                return new Channel('chat.' . $this->chatId);

        $this->userId = $userId;
    }

    public function broadcastOn()
    {
        
        // return new PrivateChannel('private-conversation.' . $this->conversationId);
                return new Channel('chat.' . $this->chatId);

    }

    public function broadcastAs()
    {
        return 'message-read';
    }
    public function broadcastWith()
    {
        return [
            'conversation_id' => $this->conversationId,
            'user_id' => $this->userId,
            'status' => 'read', 
        ];
    }
}
