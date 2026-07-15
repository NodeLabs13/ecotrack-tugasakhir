<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_klien',
        'nama_perusahaan',
        'alamat',
        'no_telepon',
        'email',
    ];

    public function proyeks()
    {
        return $this->hasMany(Proyek::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'klien_id');
    }
}
