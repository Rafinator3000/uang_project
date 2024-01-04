<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uang_masuk extends Model
{
    use HasFactory;
    protected $table = "uang_masuk";

    protected $fillable = [
        'created_by', 'lokasi_uang', 'jumlah_masuk', 'keterangan_masuk', 'file'
    ];
    
    public function lokasi_uang_nama() {
        return $this->hasOne(lokasi_uang::class, 'id','lokasi_uang');
    }

}



