<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'category',
        'sold_at',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'sold_at' => 'datetime',
            'deleted_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public static function categories(): array
    {
        return Cache::rememberForever(
            'categories_list',
            fn() =>
            json_decode(@file_get_contents(storage_path('app/categories.json')), true) ?: []
        );
    }

    public function getCategoryNameAttribute(): string
    {
        $categories = self::categories();
        $key = $categories[$this->category] ?? null;

        return $key ? __('categories.' . $key) : __('messages.no_category');
    }
}
