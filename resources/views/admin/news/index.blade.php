<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Daftar Berita</h1>
                <p class="mt-1 text-gray-600">Semua artikel berita yang telah dipublikasikan.</p>
            </div>
            <a href="{{ route('berita.create') }}"
                class="py-2 px-4 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Tambah
                Berita</a>
        </div>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs font-semibold text-gray-600 uppercase">
                        <th class="p-4">Gambar Utama</th>
                        <th class="p-4">Judul</th>
                        <th class="p-4">Isi Berita</th>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($news as $item)
                        <tr>
                            <td class="p-4">
                                @if ($item->images->first())
                                    <img src="{{ asset($item->images->first()->image) }}" alt="{{ $item->title }}"
                                        class="w-24 h-16 object-cover rounded">
                                @else
                                    <div
                                        class="w-24 h-16 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-500">
                                        No Image</div>
                                @endif
                            </td>
                            <td class="p-4 text-sm text-gray-800 font-medium">{{ $item->title }}</td>
                            <td class="p-4 text-sm text-gray-600">
                                {{ Str::limit(strip_tags($item->body), 50) }}...</td>
                            <td class="p-4 text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($item->date)->isoFormat('D MMMM YYYY') }}</td>
                            <td class="p-4">
                                <div class="flex items-center justify-center space-x-4">
                                    <a href="{{ route('berita.edit', $item->id) }}"
                                        class="text-yellow-600 hover:text-yellow-900">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('berita.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900"><svg
                                                class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-6 text-gray-500">Belum ada berita.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $news->links() }}</div>
    </div>
</x-app-layout>
