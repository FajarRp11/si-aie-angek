<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisionMisionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/news', [BeritaController::class, 'index'])->name('news');
Route::get('/news/{slug}', [BeritaController::class, 'show'])->name('news.show'); // <-- TAMBAHKAN INI

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/visi-misi', [VisionMisionController::class, 'index'])->name('visi-misi.index');
    Route::put('/visi', [VisionMisionController::class, 'updateVisi'])->name('visi.update');
    Route::put('/misi', [VisionMisionController::class, 'updateMisi'])->name('misi.update');

    Route::resource('sejarah', HistoryController::class)->except(['create', 'show', 'edit']);

    Route::resource('berita', NewsController::class)->parameters(['berita' => 'berita']);;
    // Route khusus untuk menghapus gambar
    Route::delete('berita/gambar/{image}', [NewsController::class, 'destroyImage'])->name('berita.gambar.destroy');

    // Resource route untuk mengelola data keluarga
    Route::resource('keluarga', KeluargaController::class);

    // Resource route untuk mengelola data penduduk (anggota keluarga)
    // 'index' dan 'show' tidak diperlukan karena anggota dikelola dari halaman detail keluarga
    Route::resource('penduduk', PendudukController::class)->except(['index', 'show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
