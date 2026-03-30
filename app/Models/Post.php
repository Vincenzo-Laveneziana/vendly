<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use SoftDeletes;

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

    /**
     * Carica le categorie dal file JSON e le mette in cache.
     */
    public static function getCategoriesFromJson(): array
    {
        return Cache::rememberForever('categories_list', function () {
            $path = storage_path('app/categories.json');
            if (!file_exists($path)) return [];
            
            return json_decode(file_get_contents($path), true);
        });
    }

    /**
     * trasforma l'ID del DB nel nome del JSON.
     */
    public function getCategoryNameAttribute(): string
    {
        $categories = self::getCategoriesFromJson();
        
        // Cerca l'ID della categoria e restituisce il nome, altrimenti "Nessuna Categoria"
        return $categories[$this->category] ?? 'Nessuna Categoria';
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
