<x-app-layout>
    <div class="p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Detail Keluarga</h1>
                <p class="mt-1 font-mono text-gray-600">No. KK: {{ $keluarga->nomor_kk }}</p>
            </div>
            <a href="{{ route('penduduk.create', ['keluarga_id' => $keluarga->id]) }}"
                class="mt-4 sm:mt-0 w-full sm:w-auto inline-flex justify-center py-2 px-4 text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                Tambah Anggota Keluarga
            </a>
        </div>
        @include('components.flash-message')

        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h3 class="text-lg font-semibold border-b pb-2 mb-4">Informasi Kartu Keluarga</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div><strong class="text-gray-600">Kepala Keluarga</strong>
                    <p>{{ $keluarga->kepalaKeluarga->nama_lengkap ?? 'Belum Ditentukan' }}</p>
                </div>
                <div><strong class="text-gray-600">Dusun</strong>
                    <p>{{ $keluarga->dusun }}</p>
                </div>
                <div><strong class="text-gray-600">RT / RW</strong>
                    <p>{{ $keluarga->rt }} / {{ $keluarga->rw }}</p>
                </div>
                <div class="col-span-1 md:col-span-3"><strong class="text-gray-600">Alamat</strong>
                    <p>{{ $keluarga->alamat }}</p>
                </div>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">Daftar Anggota Keluarga</h2>
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs font-semibold text-gray-600 uppercase">
                        <th class="p-4">NIK</th>
                        <th class="p-4">Nama Lengkap</th>
                        <th class="p-4">Hubungan</th>
                        <th class="p-4">Jenis Kelamin</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($keluarga->anggotaKeluarga as $penduduk)
                        <tr class="@if ($keluarga->kepala_keluarga_id == $penduduk->id) bg-blue-50 @endif">
                            <td class="p-4 font-mono">{{ $penduduk->nik }}</td>
                            <td class="p-4 font-medium">{{ $penduduk->nama_lengkap }}</td>
                            <td class="p-4 text-sm">{{ $penduduk->hubungan_keluarga }}</td>
                            <td class="p-4 text-sm">{{ $penduduk->jenis_kelamin }}</td>
                            <td class="p-4">
                                <div class="flex items-center justify-center space-x-4 text-sm font-medium">
                                    <a href="{{ route('penduduk.edit', $penduduk->id) }}"
                                        class="text-yellow-600 hover:text-yellow-800">Edit</a>
                                    <form action="{{ route('penduduk.destroy', $penduduk->id) }}" method="POST"
                                        onsubmit="return confirm('Anda yakin ingin menghapus penduduk ini?');">
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
                                Belum ada anggota keluarga yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
