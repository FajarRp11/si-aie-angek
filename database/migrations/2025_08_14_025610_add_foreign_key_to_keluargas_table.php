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
        Schema::table('keluargas', function (Blueprint $table) {
            // Menambahkan foreign key setelah tabel penduduks ada
            $table->foreign('kepala_keluarga_id')
                ->references('id')
                ->on('penduduks')
                ->onDelete('set null'); // Jika kepala keluarga dihapus, field ini jadi NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keluargas', function (Blueprint $table) {
            //
        });
    }
};
