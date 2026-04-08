<?php

namespace App\Events; // Deve essere in App\Events, non App\Models

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        // Passiamo l'intero oggetto Message
        $this->message = $message;
    }

    /**
     * Il canale su cui trasmettere.
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->message->conversation_id);
    }

    /**
     * Il nome dell'evento che Echo ascolterà nel frontend.
     * Se non lo metti, Echo cercherà "App\Events\MessageSent".
     */
    public function broadcastAs()
    {
        return 'message.sent';
    }
}