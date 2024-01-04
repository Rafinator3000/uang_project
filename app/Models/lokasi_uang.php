<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lokasi_uang extends Model
{
    use HasFactory;
    protected $table = "lokasi_uang";

    protected $fillable = [
        'nama_lokasi', 'keterangan_lokasi'
    ];
}



