<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Library\Message;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
  // ※イベントをブロードキャストすると、publicメンバーが送信される。
  public $chat;

    public function __construct($chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn()
    {
        return new Channel('chat.' . $this->chat->to_user_id);
    }
    /**
     *追加
     */
    public function broadcastWith()
    {
        return [
            'message' => $this->chat->message,
            'created_at' => $this->chat->created_at,
        ];
    }
    /**
     * イベントブロードキャスト名
     */
    public function broadcastAs()
    {
        return 'chat_event';
    }
}