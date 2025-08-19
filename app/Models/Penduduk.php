<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Penduduk extends Model
{
    protected $table = 'penduduks';

    protected $guarded = [];

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'keluarga_id');
    }

    public function fotoUrl()
    {
        return Attribute::make(
            get: function () {
                // Cek apakah ada path foto dan file-nya ada di storage
                if ($this->foto && Storage::disk('public')->exists($this->foto)) {
                    return Storage::url($this->foto);
                }

                // Jika tidak ada, kembalikan URL ke gambar default/placeholder
                // Ganti 'images/default-avatar.png' sesuai path placeholder kamu
                return asset('images/default-avatar.png');
            }
        );
    }
}
