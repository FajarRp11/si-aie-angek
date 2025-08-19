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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel keluarga
            $table->foreignId('keluarga_id')->constrained('keluargas')->onDelete('cascade');

            // Data Diri
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->string('foto')->nullable(); // Path untuk foto
            $table->string('hubungan_keluarga');
            $table->enum('jenis_kelamin', ['LAKI-LAKI', 'PEREMPUAN']);
            $table->string('agama');
            $table->string('status_penduduk');
            $table->string('no_kk_sebelumnya', 16)->nullable();

            // Data Kelahiran
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->time('waktu_lahir')->nullable();
            $table->string('tempat_dilahirkan')->nullable();
            $table->string('jenis_kelahiran')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->string('penolong_kelahiran')->nullable();
            $table->decimal('berat_lahir', 5, 2)->nullable(); // e.g., 3.50 (dalam kg)
            $table->integer('panjang_lahir')->nullable(); // dalam cm

            // Pendidikan dan Pekerjaan
            $table->string('pendidikan_dalam_kk');
            $table->string('pendidikan_sedang_ditempuh')->nullable();
            $table->string('pekerjaan');

            // Data Kewarganegaraan
            $table->string('status_warga_negara');
            $table->string('suku')->nullable();
            $table->string('nomor_paspor')->nullable();
            $table->date('tgl_berakhir_paspor')->nullable();

            // Data Orang Tua
            $table->string('nik_ayah', 16)->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nik_ibu', 16)->nullable();
            $table->string('nama_ibu')->nullable();

            // Kontak & Alamat Lain
            $table->string('nomor_telepon')->nullable();
            $table->string('email')->nullable()->unique();
            $table->text('alamat_sebelumnya')->nullable();

            // Status Perkawinan
            $table->string('status_perkawinan');
            $table->string('no_akta_nikah')->nullable();
            $table->date('tanggal_perkawinan')->nullable();
            $table->string('akta_perceraian')->nullable();
            $table->date('tanggal_perceraian')->nullable();

            // Data Kesehatan
            $table->string('golongan_darah');
            $table->string('cacat')->nullable();
            $table->string('sakit_menahun')->nullable();
            $table->string('asuransi_kesehatan')->nullable();
            $table->string('nomor_bpjs_ketenagakerjaan')->nullable();

            // Lainnya
            $table->string('status_rekam')->nullable();
            $table->string('dapat_membaca')->nullable();
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
