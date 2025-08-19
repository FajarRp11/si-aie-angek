<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('images')->latest()->paginate(10);
        // dd($news);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'date' => 'required|date',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $news = News::create($request->only('title', 'body', 'date'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imagefile) {
                $path = $imagefile->store('news_images', 'public');
                $news->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(News $berita)
    {
        return view('admin.news.edit', compact('berita'));
    }

    public function update(Request $request, News $berita) // asumsikan nama variabelnya $berita
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'date' => 'required|date',
            'images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'nullable|array', // Validasi untuk gambar yang akan dihapus
            'delete_images.*' => 'integer|exists:news_images,id' // Pastikan ID-nya valid
        ]);

        // 1. Hapus gambar yang ditandai
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = NewsImages::find($imageId);
                if ($image) {
                    // Hapus file dari storage
                    Storage::disk('public')->delete($image->image);
                    // Hapus record dari database
                    $image->delete();
                }
            }
        }

        // 2. Upload gambar baru jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('news-images', 'public');
                $berita->images()->create(['image' => $path]);
            }
        }

        // 3. Update data berita utama
        $berita->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'date' => $validatedData['date'],
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $berita)
    {
        foreach ($berita->images as $image) {
            Storage::delete($image->image);
            $image->delete();
        }
        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }

    // Fungsi untuk menghapus satu gambar spesifik
    public function destroyImage(NewsImages $image)
    {
        Storage::delete($image->image);
        $image->delete();
        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}
