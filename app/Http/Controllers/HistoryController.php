<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        // Ambil semua data sejarah, urutkan berdasarkan tahun
        $histories = History::orderBy('year', 'asc')->get();
        return view('admin.history.index', compact('histories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|string|max:255',
            'history' => 'required|string',
        ]);

        History::create($request->all());

        return back()->with('success', 'Data sejarah berhasil ditambahkan.');
    }

    public function update(Request $request, History $sejarah)
    {
        $request->validate([
            'year' => 'required|string|max:255',
            'history' => 'required|string',
        ]);

        $sejarah->update($request->all());

        return back()->with('success', 'Data sejarah berhasil diperbarui.');
    }

    public function destroy(History $sejarah)
    {
        $sejarah->delete();

        return back()->with('success', 'Data sejarah berhasil dihapus.');
    }
}
