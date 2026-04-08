<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['product_id', 'buyer_id', 'seller_id'];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // RELAZIONI
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // --- AGGIUNTE PER LIVE CHAT ---
    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    public function getInterlocutorAttribute()
    {
        return $this->buyer_id === auth()->id() ? $this->seller : $this->buyer;
    }
}