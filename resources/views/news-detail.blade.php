<x-frontend-layout> {{-- Sesuaikan dengan nama layout Anda --}}
    <main class="pt-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">

                <div class="lg:col-span-2 bg-white p-6 sm:p-8 rounded-lg shadow-md">

                    <div class="border-b pb-4 mb-6">
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight">
                            {{-- Judul Berita dari Database --}}
                            {{ $berita->title }}
                        </h1>
                        <p class="mt-4 text-gray-500 text-sm">
                            Dipublikasikan pada
                            <span class="font-medium text-gray-700">
                                {{-- Tanggal dari Database --}}
                                {{ $berita->date->format('d F Y') }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-6 rounded-lg overflow-hidden">
                        {{-- Gambar pertama dari relasi images --}}
                        <img src="{{ Storage::url($berita->images->first()->image) }}"
                            class="w-full h-auto object-cover">
                    </div>

                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        {{-- Isi berita (body) dari database --}}
                        <p>{{ $berita->body }}</p>
                    </div>

                    <div class="mt-8 border-t pt-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Galeri Foto</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            {{-- Loop untuk sisa gambar berita (skip gambar pertama) --}}
                            @foreach ($berita->images as $image)
                                <div class="rounded-lg overflow-hidden shadow-sm">
                                    <img src="{{ Storage::url($image->image) }}" alt="Gambar Berita"
                                        class="w-full h-32 object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-28 bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4">Berita terbaru</h3>
                        <div class="space-y-4">
                            {{-- Loop untuk 3-5 berita lain dari database --}}
                            @forelse ($latestNews as $newsItem)
                                <a href="{{ route('news.show', $newsItem->slug) }}"
                                    class="block hover:bg-gray-50 p-4 rounded-lg transition">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ Storage::url($newsItem->images->first()->image) }}"
                                            alt="Gambar Berita" class="w-16 h-16 object-cover rounded-lg">
                                        <div>
                                            <h4 class="font-semibold text-gray-800">{{ $newsItem->title }}</h4>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $newsItem->date->format('d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <p class="text-gray-500">Tidak ada berita terbaru.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</x-frontend-layout>
