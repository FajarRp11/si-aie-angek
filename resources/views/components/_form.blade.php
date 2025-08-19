{{-- File ini berisi semua field untuk data penduduk --}}
@php
    $data = $penduduk ?? null;
    $prefix = $prefix ?? '';
    $name = fn($field) => $prefix ? "{$prefix}[{$field}]" : $field;
    $old = fn($field) => old($prefix ? "{$prefix}.{$field}" : $field, $data->$field ?? '');
@endphp

<div class="space-y-6">
    <fieldset class="border p-4 rounded-md">
        <legend class="px-2 font-semibold text-gray-700">Data Diri</legend>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-2">
            <div><label for="nik" class="block text-sm font-medium">NIK</label><input type="text"
                    name="{{ $name('nik') }}" value="{{ $old('nik') }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required></div>
            <div><label for="nama_lengkap" class="block text-sm font-medium">Nama Lengkap</label><input type="text"
                    name="{{ $name('nama_lengkap') }}" value="{{ $old('nama_lengkap') }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required></div>
            <div><label for="hubungan_keluarga" class="block text-sm font-medium">Hubungan Keluarga</label><input
                    type="text" name="{{ $name('hubungan_keluarga') }}" value="{{ $old('hubungan_keluarga') }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required></div>
            <div>
                <label for="jenis_kelamin" class="block text-sm font-medium">Jenis Kelamin</label>
                <select name="{{ $name('jenis_kelamin') }}" class="mt-1 block w-full rounded-md border-gray-300"
                    required>
                    <option value="">Pilih...</option>
                    <option value="LAKI-LAKI" @if ($old('jenis_kelamin') == 'LAKI-LAKI') selected @endif>LAKI-LAKI</option>
                    <option value="PEREMPUAN" @if ($old('jenis_kelamin') == 'PEREMPUAN') selected @endif>PEREMPUAN</option>
                </select>
            </div>
            <div><label for="agama" class="block text-sm font-medium">Agama</label><input type="text"
                    name="{{ $name('agama') }}" value="{{ $old('agama') }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required></div>
            <div><label for="status_penduduk" class="block text-sm font-medium">Status Penduduk</label><input
                    type="text" name="{{ $name('status_penduduk') }}" value="{{ $old('status_penduduk') }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required></div>
            <div><label for="no_kk_sebelumnya" class="block text-sm font-medium">No. KK Sebelumnya</label><input
                    type="text" name="{{ $name('no_kk_sebelumnya') }}" value="{{ $old('no_kk_sebelumnya') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
        </div>
    </fieldset>

    <fieldset class="border p-4 rounded-md">
        <legend class="px-2 font-semibold text-gray-700">Data Kelahiran</legend>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-2">
            <div><label for="tempat_lahir" class="block text-sm font-medium">Tempat Lahir</label><input type="text"
                    name="{{ $name('tempat_lahir') }}" value="{{ $old('tempat_lahir') }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required></div>
            <div><label for="tanggal_lahir" class="block text-sm font-medium">Tanggal Lahir</label><input type="date"
                    name="{{ $name('tanggal_lahir') }}" value="{{ $old('tanggal_lahir') }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required></div>
            <div><label for="waktu_lahir" class="block text-sm font-medium">Waktu Lahir</label><input type="time"
                    name="{{ $name('waktu_lahir') }}" value="{{ $old('waktu_lahir') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
            <div><label for="tempat_dilahirkan" class="block text-sm font-medium">Tempat Dilahirkan</label><input
                    type="text" name="{{ $name('tempat_dilahirkan') }}" value="{{ $old('tempat_dilahirkan') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
            <div><label for="jenis_kelahiran" class="block text-sm font-medium">Jenis Kelahiran</label><input
                    type="text" name="{{ $name('jenis_kelahiran') }}" value="{{ $old('jenis_kelahiran') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
            <div><label for="anak_ke" class="block text-sm font-medium">Anak Ke</label><input type="number"
                    name="{{ $name('anak_ke') }}" value="{{ $old('anak_ke') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
            <div><label for="penolong_kelahiran" class="block text-sm font-medium">Penolong Kelahiran</label><input
                    type="text" name="{{ $name('penolong_kelahiran') }}" value="{{ $old('penolong_kelahiran') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
            <div><label for="berat_lahir" class="block text-sm font-medium">Berat Lahir (kg)</label><input
                    type="number" step="0.01" name="{{ $name('berat_lahir') }}" value="{{ $old('berat_lahir') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
            <div><label for="panjang_lahir" class="block text-sm font-medium">Panjang Lahir (cm)</label><input
                    type="number" name="{{ $name('panjang_lahir') }}" value="{{ $old('panjang_lahir') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
        </div>
    </fieldset>

    <fieldset class="border p-4 rounded-md">
        <legend class="px-2 font-semibold text-gray-700">Pendidikan dan Pekerjaan</legend>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-2">
            <div><label for="pendidikan_dalam_kk" class="block text-sm font-medium">Pendidikan Terakhir</label><input
                    type="text" name="{{ $name('pendidikan_dalam_kk') }}"
                    value="{{ $old('pendidikan_dalam_kk') }}" class="mt-1 block w-full rounded-md border-gray-300"
                    required></div>
            <div><label for="pendidikan_sedang_ditempuh" class="block text-sm font-medium">Pendidikan
                    Ditempuh</label><input type="text" name="{{ $name('pendidikan_sedang_ditempuh') }}"
                    value="{{ $old('pendidikan_sedang_ditempuh') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
            <div><label for="pekerjaan" class="block text-sm font-medium">Pekerjaan</label><input type="text"
                    name="{{ $name('pekerjaan') }}" value="{{ $old('pekerjaan') }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required></div>
        </div>
    </fieldset>

    <fieldset class="border p-4 rounded-md">
        <legend class="px-2 font-semibold text-gray-700">Data Orang Tua</legend>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-2">
            <div><label for="nik_ayah" class="block text-sm font-medium">NIK Ayah</label><input type="text"
                    name="{{ $name('nik_ayah') }}" value="{{ $old('nik_ayah') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
            <div><label for="nama_ayah" class="block text-sm font-medium">Nama Ayah</label><input type="text"
                    name="{{ $name('nama_ayah') }}" value="{{ $old('nama_ayah') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
            <div><label for="nik_ibu" class="block text-sm font-medium">NIK Ibu</label><input type="text"
                    name="{{ $name('nik_ibu') }}" value="{{ $old('nik_ibu') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
            <div><label for="nama_ibu" class="block text-sm font-medium">Nama Ibu</label><input type="text"
                    name="{{ $name('nama_ibu') }}" value="{{ $old('nama_ibu') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
        </div>
    </fieldset>

    <fieldset class="border p-4 rounded-md">
        <legend class="px-2 font-semibold text-gray-700">Status Perkawinan</legend>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-2">
            <div><label for="status_perkawinan" class="block text-sm font-medium">Status Perkawinan</label><input
                    type="text" name="{{ $name('status_perkawinan') }}" value="{{ $old('status_perkawinan') }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required></div>
            <div><label for="tanggal_perkawinan" class="block text-sm font-medium">Tanggal Perkawinan</label><input
                    type="date" name="{{ $name('tanggal_perkawinan') }}"
                    value="{{ $old('tanggal_perkawinan') }}" class="mt-1 block w-full rounded-md border-gray-300">
            </div>
        </div>
    </fieldset>

    <fieldset class="border p-4 rounded-md">
        <legend class="px-2 font-semibold text-gray-700">Data Kesehatan</legend>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-2">
            <div><label for="golongan_darah" class="block text-sm font-medium">Golongan Darah</label><input
                    type="text" name="{{ $name('golongan_darah') }}" value="{{ $old('golongan_darah') }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required></div>
            <div><label for="cacat" class="block text-sm font-medium">Cacat</label><input type="text"
                    name="{{ $name('cacat') }}" value="{{ $old('cacat') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
            <div><label for="sakit_menahun" class="block text-sm font-medium">Sakit Menahun</label><input
                    type="text" name="{{ $name('sakit_menahun') }}" value="{{ $old('sakit_menahun') }}"
                    class="mt-1 block w-full rounded-md border-gray-300"></div>
        </div>
    </fieldset>

    <fieldset class="border p-4 rounded-md">
        <legend class="px-2 font-semibold text-gray-700">Kewarganegaraan</legend>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-2">
            <div><label for="status_warga_negara" class="block text-sm font-medium">Status Warga Negara</label><input
                    type="text" name="{{ $name('status_warga_negara') }}"
                    value="{{ $old('status_warga_negara', 'WNI') }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required></div>
        </div>
    </fieldset>
</div>
