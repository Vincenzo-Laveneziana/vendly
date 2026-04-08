<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Conversation;
use App\Models\User;

Broadcast::channel('chat.{conversation}', function (User $user, Conversation $conversation) {

    return (int) $user->id === (int) $conversation->buyer_id || 
           (int) $user->id === (int) $conversation->seller_id;
});
