<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PendudukController extends Controller
{
    public function create(Request $request)
    {
        $keluarga = Keluarga::findOrFail($request->query('keluarga_id'));
        return view('admin.kependudukan.penduduk.create', compact('keluarga'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'keluarga_id' => 'required|exists:keluargas,id',
            'nik' => 'required|string|size:16|unique:penduduks,nik',
            'nama_lengkap' => 'required|string|max:255',
            'hubungan_keluarga' => 'required|string',
            'jenis_kelamin' => 'required|in:LAKI-LAKI,PEREMPUAN',
            'agama' => 'required|string',
            'status_penduduk' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'pendidikan_dalam_kk' => 'required|string',
            'pekerjaan' => 'required|string',
            'status_warga_negara' => 'required|string',
            'status_perkawinan' => 'required|string',
            'golongan_darah' => 'required|string',
            'foto' => 'nullable|image|max:2048',
            'email' => 'nullable|email|unique:penduduks,email',
        ]);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('public/penduduk_fotos');
        }

        $penduduk = Penduduk::create($validatedData);

        if ($request->hubungan_keluarga === 'KEPALA KELUARGA') {
            $keluarga = Keluarga::find($request->keluarga_id);
            if ($keluarga->kepala_keluarga_id === null) {
                $keluarga->kepala_keluarga_id = $penduduk->id;
                $keluarga->save();
            }
        }

        return redirect()->route('keluarga.show', $request->keluarga_id)->with('success', 'Anggota keluarga berhasil ditambahkan.');
    }

    public function edit(Penduduk $penduduk)
    {
        return view('admin.kependudukan.penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        // (FIX: Validasi disamakan dengan method store)
        $validatedData = $request->validate([
            'nik' => ['required', 'string', 'size:16', Rule::unique('penduduks')->ignore($penduduk->id)],
            'nama_lengkap' => 'required|string|max:255',
            'hubungan_keluarga' => 'required|string',
            'jenis_kelamin' => 'required|in:LAKI-LAKI,PEREMPUAN',
            'agama' => 'required|string',
            'status_penduduk' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'pendidikan_dalam_kk' => 'required|string',
            'pekerjaan' => 'required|string',
            'status_warga_negara' => 'required|string',
            'status_perkawinan' => 'required|string',
            'golongan_darah' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($penduduk->foto) {
                Storage::delete($penduduk->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('public/penduduk_fotos');
        }

        // Gunakan $validatedData yang sudah aman untuk memperbarui record
        $penduduk->update($validatedData);

        if ($request->hubungan_keluarga === 'KEPALA KELUARGA') {
            $keluarga = $penduduk->keluarga;
            if ($keluarga->kepala_keluarga_id != $penduduk->id) {
                $keluarga->kepala_keluarga_id = $penduduk->id;
                $keluarga->save();
            }
        }

        return redirect()->route('admin.keluarga.show', $penduduk->keluarga_id)->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        if ($penduduk->keluarga->kepala_keluarga_id == $penduduk->id) {
            return back()->with('error', 'Kepala Keluarga tidak bisa dihapus. Ganti dulu statusnya ke anggota lain.');
        }

        if ($penduduk->foto) {
            Storage::delete($penduduk->foto);
        }
        $penduduk->delete();

        return back()->with('success', 'Data penduduk berhasil dihapus.');
    }
}
