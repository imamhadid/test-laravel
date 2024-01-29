<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TKecamatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama_kecamatan',
        'active',
    ];

    public function kelurahans()
    {
        return $this->hasMany(TKelurahan::class, 'kode_kec', 'kode');
    }
}
