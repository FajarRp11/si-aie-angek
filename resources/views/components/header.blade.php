<header class="flex justify-between items-center p-4 bg-white border-b">
    <div class="flex items-center">
        <button id="sidebar-open" class="text-gray-500 focus:outline-none focus:text-gray-700 md:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <h2 class="text-xl font-semibold text-gray-700 ml-2">Dashboard</h2>
    </div>

    <div class="flex items-center gap-2 hover:underline transition-all duration-100 cursor-pointer">
        <span class="text-sm hidden md:block">Selamat Datang, Admin!</span>
        <span class="text-sm block md:hidden">Admin!</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="cursor-pointer hover:text-gray-600" :href="route('logout')"
                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
            </a>
        </form>
    </div>
</header>
