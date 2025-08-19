<x-app-layout>
    <div x-data="{ isModalOpen: false, editMode: false, formData: {}, formAction: '' }" class="p-6">

        <!-- Header Halaman dan Tombol Aksi -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Kelola Sejarah Nagari</h1>
                <p class="mt-1 text-gray-600">Daftar peristiwa penting dalam linimasa sejarah nagari.</p>
            </div>
            <!-- Tombol untuk membuka modal dalam mode 'Tambah' -->
            <button
                @click="editMode = false; formData = {}; formAction = '{{ route('sejarah.store') }}'; isModalOpen = true"
                class="mt-4 sm:mt-0 w-full sm:w-auto inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Data Sejarah
            </button>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Container Tabel -->
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th class="p-4">Tahun</th>
                        <th class="p-4">Peristiwa Sejarah</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($histories as $history)
                        <tr>
                            <td class="p-4 font-medium text-gray-800">{{ $history->year }}</td>
                            <td class="p-4 text-gray-600">{{ $history->history }}</td>
                            <td class="p-4">
                                <div class="flex items-center justify-center space-x-4">
                                    <!-- Tombol untuk membuka modal dalam mode 'Edit' -->
                                    <button
                                        @click="editMode = true; formData = {{ json_encode($history) }}; formAction = '{{ route('sejarah.update', $history->id) }}'; isModalOpen = true"
                                        class="text-yellow-600 hover:text-yellow-900">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <!-- Form untuk menghapus data -->
                                    <form action="{{ route('sejarah.destroy', $history->id) }}" method="POST"
                                        onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
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
                            <td colspan="3" class="text-center p-6 text-gray-500">
                                Belum ada data sejarah yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- =================================================================== -->
        <!-- MODAL UNTUK TAMBAH & EDIT DATA                                        -->
        <!-- =================================================================== -->
        <div x-show="isModalOpen" x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
            <div @click.away="isModalOpen = false" class="relative bg-white rounded-lg shadow-xl w-full max-w-lg mx-4">
                <div class="flex items-start justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900"
                        x-text="editMode ? 'Edit Data Sejarah' : 'Tambah Data Sejarah'"></h3>
                    <button @click="isModalOpen = false" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 p-1.5 rounded-lg text-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Form dinamis yang action-nya di-binding ke formAction -->
                <form :action="formAction" method="POST">
                    @csrf
                    <!-- Method spoofing untuk PUT (Update) -->
                    <template x-if="editMode">
                        @method('PUT')
                    </template>
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Tahun</label>
                            <input type="text" name="year" id="year" x-model="formData.year"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Contoh: 1945" required>
                        </div>
                        <div>
                            <label for="history" class="block mb-2 text-sm font-medium text-gray-900">Peristiwa
                                Sejarah</label>
                            <textarea id="history" name="history" x-model="formData.history" rows="4"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Jelaskan peristiwa yang terjadi..." required></textarea>
                        </div>
                    </div>
                    <div class="flex items-center justify-end p-4 space-x-2 border-t">
                        <button @click="isModalOpen = false" type="button"
                            class="py-2 px-4 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300">Batal</button>
                        <button type="submit"
                            class="py-2 px-4 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700"
                            x-text="editMode ? 'Simpan Perubahan' : 'Tambah Data'"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
