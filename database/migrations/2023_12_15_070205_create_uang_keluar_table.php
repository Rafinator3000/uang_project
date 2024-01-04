<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('uang_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('created_by');
            $table->string('lokasi_uang');
            $table->string('jumlah_keluar');
            $table->string('keterangan_keluar');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uang_keluar');
    }
};
