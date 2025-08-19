<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Vision;
use Illuminate\Http\Request;

class VisionMisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visi = Vision::firstOrCreate([], ['vision' => '']);
        $misi = Mission::firstOrCreate([], ['mission' => '']);

        // Ubah string misi (yang dipisah baris baru) menjadi sebuah array
        // array_filter digunakan untuk menghapus baris kosong jika ada
        $misi_items = array_filter(explode("\n", trim($misi->mission)));

        // Kirim semua data yang dibutuhkan ke view
        return view('admin.visi-misi.index', compact('visi', 'misi', 'misi_items'));
    }

    public function updateVisi(Request $request)
    {
        $request->validate(['visi_content' => 'nullable|string']);

        $visi = Vision::first();
        $visi->update(['vision' => $request->visi_content]);

        return back()->with('success', 'Data Visi berhasil diperbarui!');
    }

    public function updateMisi(Request $request)
    {
        $request->validate(['misi_content' => 'nullable|string']);

        $misi = Mission::first();
        $misi->update(['mission' => $request->misi_content]);

        return back()->with('success', 'Data Misi berhasil diperbarui!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
