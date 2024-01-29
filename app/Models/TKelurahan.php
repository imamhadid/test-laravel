<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TKelurahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'kode_kec',
        'nama_kelurahan',
        'active',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(TKecamatan::class, 'kode_kec', 'kode');
    }
}
