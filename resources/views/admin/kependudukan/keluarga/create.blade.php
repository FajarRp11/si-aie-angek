<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800">Tambah Data Keluarga & Kepala Keluarga</h1>
        <p class="mt-1 text-gray-600">Isi data kartu keluarga beserta data kepala keluarganya.</p>

        <form action="{{ route('keluarga.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf

            <!-- BAGIAN DATA KELUARGA -->
            <div class="bg-white p-6 rounded-lg shadow space-y-4 mb-6">
                <h2 class="text-lg font-semibold border-b pb-2 mb-4">Data Kartu Keluarga</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="nomor_kk" class="block text-sm font-medium text-gray-700">Nomor KK</label>
                        <input type="text" name="nomor_kk" id="nomor_kk" value="{{ old('nomor_kk') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        @error('nomor_kk')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="dusun" class="block text-sm font-medium text-gray-700">Dusun</label>
                        <input type="text" name="dusun" id="dusun" value="{{ old('dusun') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        @error('dusun')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="tanggal_dibuat" class="block text-sm font-medium text-gray-700">Tanggal
                            Diterbitkan
                            KK</label>
                        <input type="date" name="tanggal_dibuat" id="tanggal_dibuat"
                            value="{{ old('tanggal_dibuat') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('tanggal_dibuat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="rt" class="block text-sm font-medium text-gray-700">RT</label>
                        <input type="text" name="rt" id="rt" value="{{ old('rt') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        @error('rt')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
                        <input type="text" name="rw" id="rw" value="{{ old('rw') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        @error('rw')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- BAGIAN DATA KEPALA KELUARGA -->
            <div class="bg-white p-6 rounded-lg shadow space-y-4">
                <h2 class="text-lg font-semibold border-b pb-2 mb-4">Data Kepala Keluarga</h2>
                {{-- Memanggil partial form penduduk --}}
                @include('components._form', ['prefix' => 'penduduk'])
            </div>

            <div class="flex justify-end space-x-3 pt-6 mt-6 border-t">
                <a href="{{ route('keluarga.index') }}"
                    class="py-2 px-4 rounded-md text-gray-700 bg-gray-200">Batal</a>
                <button type="submit" class="py-2 px-4 rounded-md text-white bg-blue-600">Simpan Data Keluarga</button>
            </div>
        </form>
    </div>
</x-app-layout>
