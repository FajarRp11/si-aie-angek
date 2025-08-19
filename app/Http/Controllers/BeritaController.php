<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        // Ambil semua berita dengan relasi gambar, urutkan berdasarkan tanggal terbaru
        $news = News::with('images')->latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    public function show($slug)
    {
        // Cari berita berdasarkan slug. Jika tidak ditemukan, akan muncul error 404.
        $berita = News::where('slug', $slug)->with('images')->firstOrFail();

        // Ambil beberapa berita lain untuk sidebar "Berita Populer"
        // (contoh: 4 berita terbaru, kecuali berita yang sedang dibuka)
        $latestNews = News::where('id', '!=', $berita->id)
            ->latest()
            ->take(4)
            ->get();

        return view('news-detail', compact('berita', 'latestNews'));
    }
}
