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
        Schema::create('keluargas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kk', 16)->unique();
            // kepala_keluarga_id akan diisi setelah data penduduknya dibuat
            $table->unsignedBigInteger('kepala_keluarga_id')->nullable();
            $table->text('alamat');
            $table->string('dusun');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->date('tanggal_dibuat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluargas');
    }
};
