<div id="sidebar"
    class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white p-4 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out z-30">
    <div class="flex items-center justify-between pb-4 border-b border-gray-700">
        <a href="{{ route('home') }}" target="_blank" class="flex items-center">
            <span class="text-xl font-bold">Admin Nagari</span>
        </a>
        <button id="sidebar-close" class="md:hidden text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <ul class="mt-6 space-y-2">
        <li>
            <a href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300' }} flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 hover:text-white">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="font-semibold text-gray-400 uppercase mt-4 mb-2 px-4 text-sm">Manajemen Konten</li>
        <li>
            <a href="{{ route('visi-misi.index') }}"
                class="{{ request()->routeIs('visi-misi.*') ? 'bg-gray-900 text-white' : 'text-gray-300' }} flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 hover:text-white">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                    </path>
                </svg>
                <span>Visi & Misi</span>
            </a>
        </li>
        <li>
            <a href="{{ route('sejarah.index') }}"
                class="{{ request()->routeIs('sejarah.*') ? 'bg-gray-900 text-white' : 'text-gray-300' }} flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 hover:text-white">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
                <span>Sejarah</span>
            </a>
        </li>
        <li>
            <a href="{{ route('berita.index') }}"
                class="{{ request()->routeIs('berita.*') ? 'bg-gray-900 text-white' : 'text-gray-300' }} flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 hover:text-white">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6M7 8h6">
                    </path>
                </svg>
                <span>Berita</span>
            </a>
        </li>

        <li class="font-semibold text-gray-400 uppercase mt-4 mb-2 px-4 text-sm">Administrasi</li>
        <li>
            <a href="{{ route('keluarga.index') }}"
                class="{{ request()->routeIs('keluarga.*') || request()->routeIs('penduduk.*') ? 'bg-gray-900 text-white' : 'text-gray-300' }} flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 hover:text-white">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.125-1.273-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.125-1.273.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                <span>Data Kependudukan</span>
            </a>
        </li>
        {{-- Anda bisa menambahkan menu administrasi lain di sini, seperti Surat Menyurat, Keuangan, dll. --}}

    </ul>
</div>
