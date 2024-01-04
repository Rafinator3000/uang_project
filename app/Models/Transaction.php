<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "total_by_lokasi";
    protected $fillable = ['lokasi', 'total_masuk', 'total_keluar'];
}
