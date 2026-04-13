<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'path',
        'alt_text',
    ];

    protected $appends = ['image_url'];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Accessor per ottenere l'URL completo dell'immagine
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => asset($this->path),
        );
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
