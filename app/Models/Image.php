<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'post_id',
        'image_path',
        'alt_text',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id');
    }
}
