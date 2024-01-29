<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TProvinsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama_provinsi',
        'active',
    ];
}
