<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeluargaController extends Controller
{
    public function index()
    {
        $keluargas = Keluarga::with('kepalaKeluarga')->withCount('anggotaKeluarga')->latest()->paginate(15);
        return view('admin.kependudukan.keluarga.index', compact('keluargas'));
    }

    public function create()
    {
        return view('admin.kependudukan.keluarga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Validasi Data Keluarga
            'nomor_kk' => 'required|string|size:16|unique:keluargas,nomor_kk',
            'alamat' => 'required|string',
            'dusun' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'tanggal_dibuat' => 'nullable|date',

            // Validasi Data Penduduk (Kepala Keluarga) - WAJIB
            'penduduk.nik' => 'required|string|size:16|unique:penduduks,nik',
            'penduduk.nama_lengkap' => 'required|string|max:255',
            'penduduk.jenis_kelamin' => 'required|in:LAKI-LAKI,PEREMPUAN',
            'penduduk.agama' => 'required|string',
            'penduduk.status_penduduk' => 'required|string',
            'penduduk.tempat_lahir' => 'required|string',
            'penduduk.tanggal_lahir' => 'required|date',
            'penduduk.pendidikan_dalam_kk' => 'required|string',
            'penduduk.pekerjaan' => 'required|string',
            'penduduk.status_warga_negara' => 'required|string',
            'penduduk.status_perkawinan' => 'required|string',
            'penduduk.golongan_darah' => 'required|string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // 1. Buat data keluarga
                $keluarga = Keluarga::create($request->only('nomor_kk', 'alamat', 'dusun', 'rt', 'rw', 'tanggal_dibuat'));

                // 2. Siapkan data penduduk
                $dataPenduduk = $request->input('penduduk');
                $dataPenduduk['keluarga_id'] = $keluarga->id;
                $dataPenduduk['hubungan_keluarga'] = 'KEPALA KELUARGA'; // Otomatis

                // 3. Buat data kepala keluarga
                $kepalaKeluarga = Penduduk::create($dataPenduduk);

                // 4. Update keluarga dengan ID kepala keluarga
                $keluarga->kepala_keluarga_id = $kepalaKeluarga->id;
                $keluarga->save();
            });
        } catch (\Exception $e) {
            // !! TAMBAHKAN BARIS INI UNTUK MELIHAT ERROR ASLINYA !!
            dd($e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }

        return redirect()->route('keluarga.index')->with('success', 'Data Keluarga dan Kepala Keluarga berhasil ditambahkan.');
    }

    public function show(Keluarga $keluarga)
    {
        $keluarga->load('kepalaKeluarga', 'anggotaKeluarga');
        return view('admin.kependudukan.keluarga.show', compact('keluarga'));
    }

    public function edit(Keluarga $keluarga)
    {
        return view('admin.kependudukan.keluarga.edit', compact('keluarga'));
    }

    public function update(Request $request, Keluarga $keluarga)
    {
        $request->validate([
            'nomor_kk' => 'required|string|size:16|unique:keluargas,nomor_kk,' . $keluarga->id,
            'alamat' => 'required|string',
            'dusun' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'tanggal_dibuat' => 'nullable|date',
        ]);

        $keluarga->update($request->all());
        return redirect()->route('keluarga.index')->with('success', 'Data Keluarga berhasil diperbarui.');
    }

    public function destroy(Keluarga $keluarga)
    {
        $keluarga->delete();
        return back()->with('success', 'Data Keluarga dan semua anggotanya berhasil dihapus.');
    }
}
