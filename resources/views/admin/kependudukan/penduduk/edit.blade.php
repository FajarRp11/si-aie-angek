<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Data Penduduk</h1>
        <p class="mt-1 text-gray-600">Mengubah data untuk: <span class="font-bold">{{ $penduduk->nama_lengkap }}</span>
        </p>

        <form action="{{ route('admin.penduduk.update', $penduduk->id) }}" method="POST" enctype="multipart/form-data"
            class="mt-6">
            @csrf
            @method('PUT')

            <div class="bg-white p-6 rounded-lg shadow space-y-6">
                <fieldset class="border p-4 rounded-md">
                    <legend class="px-2 font-semibold text-gray-700">Data Diri</legend>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-2">
                        <div>
                            <label for="nik" class="block text-sm font-medium">NIK</label>
                            <input type="text" name="nik" id="nik" value="{{ old('nik', $penduduk->nik) }}"
                                class="mt-1 block w-full rounded-md border-gray-300" required>
                            @error('nik')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                value="{{ old('nama_lengkap', $penduduk->nama_lengkap) }}"
                                class="mt-1 block w-full rounded-md border-gray-300" required>
                            @error('nama_lengkap')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="hubungan_keluarga" class="block text-sm font-medium">Hubungan Keluarga</label>
                            <input type="text" name="hubungan_keluarga" id="hubungan_keluarga"
                                value="{{ old('hubungan_keluarga', $penduduk->hubungan_keluarga) }}"
                                class="mt-1 block w-full rounded-md border-gray-300" required>
                            @error('hubungan_keluarga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- Tambahkan field lain dari skema database di sini --}}
                    </div>
                </fieldset>

                {{-- Tambahkan <fieldset> lain untuk Data Kelahiran, Pendidikan, dll. --}}
            </div>

            <div class="flex justify-end space-x-3 pt-6 mt-6 border-t">
                <a href="{{ route('admin.keluarga.show', $penduduk->keluarga_id) }}"
                    class="py-2 px-4 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300">Batal</a>
                <button type="submit"
                    class="py-2 px-4 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout>
