<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\BroadcastsEvents; // Importante per il broadcasting automatico

class Message extends Model
{

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'content',
    ];

    /**
     * Define the channel the event should broadcast on.
     */
    public function broadcastOn($event)
    {
        return new \Illuminate\Broadcasting\PrivateChannel('chat.' . $this->conversation_id);
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith($event)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'sender_id' => $this->sender_id,
            'created_at' => $this->created_at->format('H:i'),
        ];
    }

    /**
     * Casts per le date.
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // RELAZIONI
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}