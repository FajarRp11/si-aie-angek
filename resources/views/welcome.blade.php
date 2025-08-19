<x-frontend-layout>
    <main>
        <section
            class="relative min-h-screen flex flex-col justify-center items-center bg-cover bg-center text-center text-white p-4"
            style="background-image: url('{{ asset('/latar_website.jpg') }}');">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>

            <!-- Konten -->
            <div class="relative z-10 flex flex-col items-center">
                <h1 class="text-2xl md:text-5xl font-bold leading-tight">Selamat Datang di Nagari Aie Angek</h1>
                <p class="mt-4 text-lg md:text-xl max-w-2xl">
                    Kecamatan X Koto, Kabupaten Tanah Datar Provinsi Sumatera Barat
                </p>
                <a href="#visi-misi"
                    class="mt-8 px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                    Lihat Visi & Misi
                </a>

                <!-- Video YouTube -->
                <div class="mt-4 w-full max-w-lg mx-auto rounded-lg overflow-hidden shadow-lg border border-gray-200">
                    <div class="aspect-video">
                        <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/ZlqmEbah5B4?si=8zgiWunREc5FB7YA"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>

        <section id="visi-misi" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-900">Visi & Misi Nagari</h2>
                    <p class="mt-4 text-lg text-gray-600">Arah dan tujuan pembangunan Nagari Aie Angek.</p>
                </div>
                <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div class="p-6 border border-gray-200 rounded-lg">
                        <h3 class="text-2xl font-semibold text-blue-600">Visi</h3>
                        <p class="mt-4 text-gray-700">
                            "{{ $visi->vision }}"
                        </p>
                    </div>
                    <div class="p-6 border border-gray-200 rounded-lg">
                        <h3 class="text-2xl font-semibold text-blue-600">Misi</h3>
                        @if (!empty($misi_items))
                            <ol class="list-decimal list-inside text-gray-600 space-y-2">
                                @foreach ($misi_items as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ol>
                        @else
                            <p class="text-gray-500">Belum ada data misi yang diisi.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section id="sejarah" class="bg-gray-50 py-16">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900">Jejak Langkah Nagari Aie Angek</h2>
                    <p class="mt-4 text-lg text-gray-600">Menelusuri rangkaian peristiwa penting dalam sejarah kami.</p>
                </div>

                <div class="relative max-w-4xl mx-auto">
                    <!-- Garis Tengah -->
                    <div class="absolute w-1 bg-blue-200 h-full left-1/2 transform -translate-x-1/2"></div>

                    @forelse ($histories as $history)
                        <div class="mb-12 grid grid-cols-9 items-center">
                            @if ($loop->iteration % 2 != 0)
                                <!-- Konten Kiri -->
                                <div class="col-span-4 bg-white rounded-lg shadow-xl p-6 text-right">
                                    <p class="mb-2 text-sm font-bold text-blue-600">ERA {{ $history->year }}-an</p>
                                    <p class="text-sm text-gray-600">{{ $history->history }}</p>
                                </div>
                                <!-- Lingkaran Nomor -->
                                <div class="col-span-1 flex justify-center">
                                    <div
                                        class="z-20 flex items-center justify-center bg-blue-600 shadow-xl w-12 h-12 rounded-full text-white font-semibold">
                                        {{ $loop->iteration }}
                                    </div>
                                </div>
                                <!-- Kosong Kanan -->
                                <div class="col-span-4"></div>
                            @else
                                <!-- Kosong Kiri -->
                                <div class="col-span-4"></div>
                                <!-- Lingkaran Nomor -->
                                <div class="col-span-1 flex justify-center">
                                    <div
                                        class="z-20 flex items-center justify-center bg-blue-600 shadow-xl w-12 h-12 rounded-full text-white font-semibold">
                                        {{ $loop->iteration }}
                                    </div>
                                </div>
                                <!-- Konten Kanan -->
                                <div class="col-span-4 bg-white rounded-lg shadow-xl p-6 text-left">
                                    <p class="mb-2 text-sm font-bold text-blue-600">ERA {{ $history->year }}-an</p>
                                    <p class="text-sm text-gray-600">{{ $history->history }}</p>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center">
                            <p class="text-gray-500">Belum ada data sejarah yang diisi.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900">Berita Terkini</h2>
                    <p class="mt-4 text-lg text-gray-600">Informasi dan kegiatan terbaru dari Nagari Aie Angek.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($news as $item)
                        <div
                            class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                            <img class="h-56 w-full object-cover"
                                src="{{ Storage::url($item->images->first()->image) }}" alt="Kegiatan Gotong Royong">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $item->title }}</h3>
                                <p class="mt-2 text-gray-600">{{ $item->body }}</p>
                                <a href="{{ route('news.show', $item->slug) }}"
                                    class="mt-4 inline-block text-blue-600 font-semibold hover:underline">Baca
                                    Selengkapnya &rarr;</a>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center justify-center w-full">
                            <p class="text-gray-500 text-center">Belum ada data berita yang diisi.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
</x-frontend-layout>
