<x-frontend-layout>
    <main>
        <div class="bg-white">
            <div class="max-w-7xl mx-auto pt-24 px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Arsip Berita</h1>
                <p class="mt-4 text-xl text-gray-600">Kumpulan informasi, pengumuman, dan kegiatan terkini dari Nagari
                    Aie Angek.</p>
            </div>
        </div>

        <div class="bg-gray-50">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @forelse ($news as $berita)
                        <div
                            class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 flex flex-col">
                            <a href="#">
                                <img class="h-56 w-full object-cover"
                                    src="{{ Storage::url($berita->images->first()->image) }}" alt="Gambar Berita">
                            </a>
                            <div class="p-6 flex flex-col flex-grow">

                                <h3 class="mt-4 text-xl font-semibold text-gray-900">
                                    <a href="{{ route('news.show', $berita->slug) }}"
                                        class="hover:text-blue-600">{{ $berita->title }}</a>
                                </h3>
                                <p class="mt-2 text-gray-600 line-clamp-3 flex-grow">
                                    {{ Str::limit(strip_tags($berita->body), 50) }}...
                                </p>
                                <div class="mt-4">
                                    <a href="{{ route('news.show', $berita->slug) }}"
                                        class="font-semibold text-blue-600 hover:underline">Baca
                                        Selengkapnya
                                        &rarr;</a>
                                </div>
                            </div>
                        </div>


                    @empty
                        <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16">
                            <h3 class="text-2xl font-semibold text-gray-800">Oops!</h3>
                            <p class="text-gray-600 text-lg mt-2">Saat ini belum ada berita yang dipublikasikan.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-16">
                    {{-- Di aplikasi Laravel yang terhubung ke database, Anda cukup memanggil: --}}
                    <div class="p-4">

                        {{ $news->links() }}
                    </div>
                    {{-- di sini, dan Laravel akan otomatis membuatkan tombol paginasi. --}}

                    {{-- <nav class="flex items-center justify-between border-t border-gray-200 px-4 py-3 sm:px-6"
                        aria-label="Pagination">
                        <div class="hidden sm:block">
                            <p class="text-sm text-gray-700">
                                Menampilkan
                                <span class="font-medium">1</span>
                                sampai
                                <span class="font-medium">9</span>
                                dari
                                <span class="font-medium">27</span>
                                hasil
                            </p>
                        </div>
                        <div class="flex flex-1 justify-between sm:justify-end">
                            <a href="#"
                                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Sebelumnya</a>
                            <a href="#"
                                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Selanjutnya</a>
                        </div>
                    </nav> --}}
                </div>
            </div>
        </div>
    </main>

</x-frontend-layout>
