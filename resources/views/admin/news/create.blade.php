<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800">Tambah Berita Baru</h1>

        {{-- 
      Komponen Uploader Kustom dengan Alpine.js
      - files: Menyimpan objek File asli.
      - previews: Menyimpan URL sementara untuk ditampilkan.
      - addFiles(): Menambahkan file baru ke dalam 'files' dan 'previews'.
      - removeFile(): Menghapus file dari 'files' dan 'previews'.
      - prepareForUpload(): Mengumpulkan semua file ke input tersembunyi sebelum submit.
    --}}
        <div x-data="{
            files: [],
            previews: [],
            addFiles(event) {
                let newFiles = [...event.target.files];
                for (let file of newFiles) {
                    this.files.push(file);
                    this.previews.push(URL.createObjectURL(file));
                }
            },
            removeFile(index) {
                this.files.splice(index, 1);
                this.previews.splice(index, 1);
            },
            async prepareForUpload(event) {
                const dataTransfer = new DataTransfer();
                this.files.forEach(file => dataTransfer.items.add(file));
                document.querySelector('#images').files = dataTransfer.files;
            }
        }">
            <form action="{{ route('berita.store') }}" @submit="prepareForUpload" method="POST"
                enctype="multipart/form-data" class="mt-6 bg-white p-6 rounded-lg shadow space-y-6">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                    <input type="text" name="title" id="title"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Tanggal Publikasi</label>
                    <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div>
                    <label for="body" class="block text-sm font-medium text-gray-700">Isi Berita</label>
                    <textarea name="body" id="body" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Gambar</label>
                    <div @click="$refs.fileInput.click()"
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md cursor-pointer hover:border-blue-500">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48" aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <p class="text-sm text-gray-600">Pilih atau seret gambar ke sini</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP hingga 2MB</p>
                        </div>
                    </div>
                    <input type="file" x-ref="fileInput" @change="addFiles" class="hidden" multiple accept="image/*">
                    <input type="file" name="images[]" id="images" multiple class="hidden">
                </div>

                <div x-show="previews.length > 0" class="mt-4 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-4">
                    <template x-for="(preview, index) in previews" :key="index">
                        <div class="relative group">
                            <img :src="preview" class="h-24 w-full object-cover rounded-md">
                            <button @click.prevent="removeFile(index)"
                                class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-600 hover:bg-red-700 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity">&times;</button>
                        </div>
                    </template>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <a href="{{ route('berita.index') }}"
                        class="py-2 px-4 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300">Batal</a>
                    <button type="submit"
                        class="py-2 px-4 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Simpan
                        Berita</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
