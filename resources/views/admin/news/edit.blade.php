<x-app-layout>
    <div class.="p-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Berita</h1>

        {{-- Awal dari komponen Alpine.js --}}
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
            prepareAndSubmit() {
                // Langkah 1: Siapkan file untuk di-upload
                const dataTransfer = new DataTransfer();
                this.files.forEach(file => dataTransfer.items.add(file));
                document.querySelector('#images').files = dataTransfer.files;
        
                // Langkah 2: Submit form secara manual
                this.$refs.editForm.submit();
            }
        }">
            {{-- Beri 'x-ref' pada form agar bisa diakses dari Alpine --}}
            <form x-ref="editForm" action="{{ route('berita.update', $berita->id) }}" method="POST"
                enctype="multipart/form-data" class="mt-6 bg-white p-6 rounded-lg shadow space-y-6">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $berita->title) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('title') border-red-500 @enderror"
                        required>
                    @error('title')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Tanggal Publikasi</label>
                    <input type="date" name="date" id="date" value="{{ old('date', $berita->date) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('date') border-red-500 @enderror"
                        required>
                    @error('date')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Isi Berita --}}
                <div>
                    <label for="body" class="block text-sm font-medium text-gray-700">Isi Berita</label>
                    <textarea name="body" id="body" rows="10"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('body') border-red-500 @enderror">{{ old('body', $berita->body) }}</textarea>
                    @error('body')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <hr>

                {{-- GAMBAR SAAT INI (SUDAH DIPERBAIKI) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gambar Saat Ini</label>
                    <p class="text-xs text-gray-500 mb-2">Beri centang pada gambar yang ingin Anda hapus, lalu klik
                        "Simpan Perubahan".</p>

                    @if ($berita->images->isNotEmpty())
                        <div class="mt-2 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-4">
                            @foreach ($berita->images as $image)
                                <div class="relative group">
                                    <img src="{{ Storage::url($image->image) }}"
                                        class="h-24 w-full object-cover rounded-md">

                                    {{-- Checkbox untuk menandai penghapusan --}}
                                    <div class="absolute top-1 right-1">
                                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"
                                            class="h-5 w-5 rounded border-gray-300 text-red-600 focus:ring-red-500 cursor-pointer"
                                            title="Tandai untuk dihapus">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-2 text-sm text-gray-500">Belum ada gambar untuk berita ini.</p>
                    @endif
                </div>

                {{-- Uploader Gambar Baru --}}
                {{-- <div>
                    <label class="block text-sm font-medium text-gray-700">Tambah Gambar Baru</label>
                    <div @click="$refs.fileInput.click()"
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md cursor-pointer">
                        <div class="space-y-1 text-center"><svg class="mx-auto h-12 w-12 text-gray-400"
                                stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <p>Pilih atau seret gambar</p>
                        </div>
                    </div>
                    <input type="file" x-ref="fileInput" @change="addFiles" class="hidden" multiple accept="image/*">
                    <input type="file" name="images[]" id="images" multiple class="hidden">
                    @error('images.*')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div> --}}

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

                {{-- Preview Gambar Baru --}}
                <div x-show="previews.length > 0" class="mt-4 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-4">
                    <template x-for="(preview, index) in previews" :key="index">
                        <div class="relative group">
                            <img :src="preview" class="h-24 w-full object-cover rounded-md">
                            <button @click.prevent="removeFile(index)"
                                class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center">&times;</button>
                        </div>
                    </template>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <a href="{{ route('berita.index') }}"
                        class="py-2 px-4 text-sm font-medium rounded-md text-gray-700 bg-gray-200">Batal</a>
                    {{-- Tombol ini sekarang memanggil fungsi prepareAndSubmit --}}
                    <button type="button" @click="prepareAndSubmit"
                        class="py-2 px-4 text-sm font-medium rounded-md text-white bg-blue-600">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
