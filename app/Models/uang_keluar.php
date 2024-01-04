<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uang_keluar extends Model
{
    use HasFactory;
    protected $table = "uang_keluar";

    protected $fillable = [
        'created_by', 'lokasi_uang', 'jumlah_keluar', 'keterangan_keluar', 'file'
    ];
    
    public function lokasi_uang_nama() {
        return $this->hasOne(lokasi_uang::class, 'id','lokasi_uang');
    }

}



