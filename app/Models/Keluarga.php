<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $table = 'keluargas';

    protected $fillable = [
        'nomor_kk',
        'kepala_keluarga_id',
        'alamat',
        'dusun',
        'rt',
        'rw',
        'tanggal_dibuat'
    ];

    public function kepalaKeluarga()
    {
        return $this->belongsTo(Penduduk::class, 'kepala_keluarga_id');
    }

    public function anggotaKeluarga()
    {
        return $this->hasMany(Penduduk::class, 'keluarga_id');
    }
}
