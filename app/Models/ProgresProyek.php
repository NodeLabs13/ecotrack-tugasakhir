<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresProyek extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyek_id',
        'tanggal_progres',
        'uraian_pekerjaan',
        'dokumentasi',
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class);
    }
}
