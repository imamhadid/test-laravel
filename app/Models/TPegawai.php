<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'jk',
        'agama',
        'kode_kel',
        'kode_prov',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(TKelurahan::class, 'kode_kel', 'kode');
    }

    public function provinsi()
    {
        return $this->belongsTo(TProvinsi::class, 'kode_prov', 'kode');
    }
}
