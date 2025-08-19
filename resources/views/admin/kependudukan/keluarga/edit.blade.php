<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-semibold">Edit Data Keluarga</h1>
        <p class="mt-1 text-gray-600">Mengubah detail Kartu Keluarga. Untuk mengubah anggota, silakan buka halaman
            detail.</p>

        <form action="{{ route('keluarga.update', $keluarga->id) }}" method="POST"
            class="mt-6 bg-white p-6 rounded-lg shadow space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nomor_kk" class="block text-sm font-medium text-gray-700">Nomor KK</label>
                    <input type="text" name="nomor_kk" id="nomor_kk"
                        value="{{ old('nomor_kk', $keluarga->nomor_kk) }}"
                        class="mt-1 block w-full rounded-md border-gray-300" required>
                    @error('nomor_kk')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="dusun" class="block text-sm font-medium text-gray-700">Dusun</label>
                    <input type="text" name="dusun" id="dusun" value="{{ old('dusun', $keluarga->dusun) }}"
                        class="mt-1 block w-full rounded-md border-gray-300" required>
                    @error('dusun')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300">{{ old('alamat', $keluarga->alamat) }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="rt" class="block text-sm font-medium text-gray-700">RT</label>
                    <input type="text" name="rt" id="rt" value="{{ old('rt', $keluarga->rt) }}"
                        class="mt-1 block w-full rounded-md border-gray-300" required>
                    @error('rt')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
                    <input type="text" name="rw" id="rw" value="{{ old('rw', $keluarga->rw) }}"
                        class="mt-1 block w-full rounded-md border-gray-300" required>
                    @error('rw')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tanggal_dibuat" class="block text-sm font-medium text-gray-700">Tanggal Diterbitkan
                        KK</label>
                    <input type="date" name="tanggal_dibuat" id="tanggal_dibuat"
                        value="{{ old('tanggal_dibuat', $keluarga->tanggal_dibuat) }}"
                        class="mt-1 block w-full rounded-md border-gray-300">
                    @error('tanggal_dibuat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-end space-x-3 pt-6 border-t mt-6">
                <a href="{{ route('keluarga.index') }}"
                    class="py-2 px-4 rounded-md text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300">Batal</a>
                <button type="submit"
                    class="py-2 px-4 rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout>
