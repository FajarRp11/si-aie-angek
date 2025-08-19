<x-app-layout>
    <div x-data="{ isVisiModalOpen: false, isMisiModalOpen: false }" class="p-6">

        <h1 class="text-2xl font-semibold text-gray-800">Kelola Visi & Misi</h1>
        <p class="mt-1 text-gray-600">Atur konten Visi dan Misi yang akan tampil di website.</p>

        @if (session('success'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-gray-800">Visi Nagari</h3>
                    <button @click="isVisiModalOpen = true"
                        class="py-2 px-4 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Ubah
                    </button>
                </div>
                <hr class="my-4">
                @if (!empty($visi->vision))
                    <blockquote class="text-gray-600 italic">
                        "{{ $visi->vision }}"
                    </blockquote>
                @else
                    <p class="text-gray-500">Belum ada data visi yang diisi.</p>
                @endif
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-gray-800">Misi Nagari</h3>
                    <button @click="isMisiModalOpen = true"
                        class="py-2 px-4 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Ubah
                    </button>
                </div>
                <hr class="my-4">
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


        <div x-show="isVisiModalOpen" x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
            <div @click.away="isVisiModalOpen = false"
                class="relative bg-white rounded-lg shadow-xl w-full max-w-lg mx-4">
                <div class="flex items-start justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900">Formulir Edit Visi</h3>
                    <button @click="isVisiModalOpen = false" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 p-1.5 rounded-lg text-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('visi.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6">
                        <label for="visi_content" class="block mb-2 text-sm font-medium text-gray-900">Isi Visi</label>
                        <textarea id="visi_content" name="visi_content" rows="6"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Tuliskan visi nagari di sini...">{{ $visi->vision ?? '' }}</textarea>
                    </div>
                    <div class="flex items-center justify-end p-4 space-x-2 border-t">
                        <button @click="isVisiModalOpen = false" type="button"
                            class="py-2 px-4 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300">Batal</button>
                        <button type="submit"
                            class="py-2 px-4 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="isMisiModalOpen" x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
            <div @click.away="isMisiModalOpen = false"
                class="relative bg-white rounded-lg shadow-xl w-full max-w-lg mx-4">
                <div class="flex items-start justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900">Formulir Edit Misi</h3>
                    <button @click="isMisiModalOpen = false" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 p-1.5 rounded-lg text-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('misi.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6">
                        <label for="misi_content" class="block mb-2 text-sm font-medium text-gray-900">Isi Misi</label>
                        <p class="text-xs text-gray-500 mb-2">Tulis setiap poin misi di baris yang baru.</p>
                        <textarea id="misi_content" name="misi_content" rows="10"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="1. Poin misi pertama...">{{ $misi->mission ?? '' }}</textarea>
                    </div>
                    <div class="flex items-center justify-end p-4 space-x-2 border-t">
                        <button @click="isMisiModalOpen = false" type="button"
                            class="py-2 px-4 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300">Batal</button>
                        <button type="submit"
                            class="py-2 px-4 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
