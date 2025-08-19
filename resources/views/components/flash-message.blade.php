@if (session('success'))
    <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
        <p class="font-bold">Sukses</p>
        <p>{{ session('success') }}</p>
    </div>
@endif

@if (session('error'))
    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
        <p class="font-bold">Error</p>
        <p>{{ session('error') }}</p>
    </div>
@endif

@if (session('info'))
    <div class="mb-4 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
        <p class="font-bold">Informasi</p>
        <p>{{ session('info') }}</p>
    </div>
@endif
