<x-app-layout>
    <div class="p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Data Keluarga</h1>
                <p class="mt-1 text-gray-600">Daftar semua kartu keluarga yang terdaftar.</p>
            </div>
            <a href="{{ route('keluarga.create') }}"
                class="mt-4 sm:mt-0 w-full sm:w-auto inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                Tambah Keluarga Baru
            </a>
        </div>

        @include('components.flash-message')

        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th class="p-4">No. KK</th>
                        <th class="p-4">Kepala Keluarga</th>
                        <th class="p-4">Alamat</th>
                        <th class="p-4">Jumlah Anggota</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($keluargas as $keluarga)
                        <tr>
                            <td class="p-4 font-mono">{{ $keluarga->nomor_kk }}</td>
                            <td class="p-4 font-medium">
                                {{ $keluarga->kepalaKeluarga->nama_lengkap ?? 'Belum Ditentukan' }}</td>
                            <td class="p-4 text-sm">{{ $keluarga->alamat }}, RT {{ $keluarga->rt }}/RW
                                {{ $keluarga->rw }}</td>
                            <td class="p-4 text-sm text-center">{{ $keluarga->anggota_keluarga_count }} Orang</td>
                            <td class="p-4">
                                <div class="flex items-center justify-center space-x-4 text-sm font-medium">
                                    <a href="{{ route('keluarga.show', $keluarga->id) }}"
                                        class="text-blue-600 hover:text-blue-800">Lihat</a>
                                    <a href="{{ route('keluarga.edit', $keluarga->id) }}"
                                        class="text-yellow-600 hover:text-yellow-800">Edit</a>
                                    <form action="{{ route('keluarga.destroy', $keluarga->id) }}" method="POST"
                                        onsubmit="return confirm('Anda yakin ingin menghapus keluarga ini beserta semua anggotanya?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-6 text-gray-500">
                                Belum ada data keluarga yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $keluargas->links() }}
        </div>
    </div>
</x-app-layout>
