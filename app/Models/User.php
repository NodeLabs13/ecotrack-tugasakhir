<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'klien_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function klien()
    {
        return $this->belongsTo(Klien::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isDirektur(): bool
    {
        return $this->role === 'direktur';
    }

    public function isCivilEngineer(): bool
    {
        return $this->role === 'civil_engineer';
    }

    public function isPerizinan(): bool
    {
        return $this->role === 'perizinan_lingkungan';
    }

    public function isKlien(): bool
    {
        return $this->role === 'klien';
    }
}
