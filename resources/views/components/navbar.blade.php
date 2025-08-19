<nav class="bg-white shadow-md fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                    Nagari Aie Angek
                </a>
            </div>

            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">

                    {{-- Cek apakah rute saat ini adalah 'home' --}}
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-200 hover:text-black' }} px-3 py-2 rounded-md text-sm font-medium">
                        Beranda
                    </a>

                    {{-- Cek apakah rute saat ini adalah 'news' (atau nama rute berita Anda) --}}
                    <a href="{{ route('news') }}"
                        class="{{ request()->routeIs('news') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-200 hover:text-black' }} px-3 py-2 rounded-md text-sm font-medium">
                        Berita
                    </a>

                    <a href="#"
                        class="{{ request()->routeIs('kontak') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-200 hover:text-black' }} px-3 py-2 rounded-md text-sm font-medium">
                        Kontak
                    </a>
                </div>
            </div>

            <div class="-mr-2 flex md:hidden">
                <button id="mobile-menu-button" type="button"
                    class="bg-gray-200 inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-black hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-200 focus:ring-white">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">

            <a href="{{ route('home') }}"
                class="{{ request()->routeIs('home') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-200 hover:text-black' }} block px-3 py-2 rounded-md text-base font-medium">
                Beranda
            </a>

            <a href="{{ route('news') }}"
                class="{{ request()->routeIs('news') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-200 hover:text-black' }} block px-3 py-2 rounded-md text-base font-medium">
                Berita
            </a>

            <a href="#"
                class="{{ request()->routeIs('kontak') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-200 hover:text-black' }} block px-3 py-2 rounded-md text-base font-medium">
                Kontak
            </a>
        </div>
    </div>
</nav>
