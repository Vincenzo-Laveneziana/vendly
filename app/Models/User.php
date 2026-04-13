<?php

namespace App\Models;

// Fondamentale: usa Authenticatable per gestire il login dopo la registrazione
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'date_of_birth',
        'address',
        'phone',
    ];

    /**
     * Campi sensibili che non devono mai apparire nelle risposte API/JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'address' => 'json',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'is_admin' => 'boolean',
            'deleted_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/\s+/', '', $value);
    }
}