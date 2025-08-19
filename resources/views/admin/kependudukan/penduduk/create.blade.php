<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800">Tambah Anggota Keluarga Baru</h1>
        <p class="mt-1 text-gray-600">Untuk Keluarga No. KK: <span
                class="font-bold font-mono">{{ $keluarga->nomor_kk }}</span></p>
        <form action="{{ route('penduduk.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            <input type="hidden" name="keluarga_id" value="{{ $keluarga->id }}">
            <div class="bg-white p-6 rounded-lg shadow">
                @include('components._form-penduduk', ['prefix' => ''])
            </div>
            <div class="flex justify-end space-x-3 pt-6 mt-6 border-t">
                <a href="{{ route('keluarga.show', $keluarga->id) }}"
                    class="py-2 px-4 rounded-md text-gray-700 bg-gray-200">Batal</a>
                <button type="submit" class="py-2 px-4 rounded-md text-white bg-blue-600">Simpan Anggota</button>
            </div>
        </form>
    </div>
</x-app-layout>
