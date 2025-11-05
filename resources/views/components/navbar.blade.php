<header class="bg-red-900 text-white shadow-md sticky top-0 z-50" x-data="{ open: false }">
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center py-4">
        {{-- Logo --}}
        <div class="flex items-center space-x-3">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo-1.png') }}" alt="Logo PN Klaten" class="h-15 w-auto">
            </a>
        </div>

        {{-- Tombol Hamburger (Mobile Only) --}}
        <div class="md:hidden">
            <button @click="open = !open" type="button"
                class="text-white hover:text-red-300 focus:outline-none focus:text-red-300 transition duration-150">
                <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
                <svg x-show="open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        {{-- Menu Navigasi (Desktop Only: md:flex) --}}
        <div class="hidden md:flex space-x-8 text-white font-medium">
            {{-- Link Navigasi Umum --}}
            <a href="{{ url('/') }}" class="hover:text-red-300 transition duration-150">Beranda</a>
            <a href="{{ url('/daftar') }}" class="hover:text-red-300 transition duration-150">Daftar Magang</a>

            @auth
                {{-- Link Cek Status (saat login) --}}
                <a href="{{ route('status.show') }}" class="hover:text-red-300 transition duration-150">Cek Status</a>
            @else
                {{-- Link Cek Status (saat belum login, diarahkan ke /login) --}}
                <a href="{{ route('login') }}" class="hover:text-red-300 transition duration-150">Cek Status</a>
            @endauth

            <a href="{{ url('/faq') }}" class="hover:text-red-300 transition duration-150">FAQ</a>

            {{-- Bagian Otentikasi --}}
            @auth
                @php
                    $role = Auth::user()->role;
                    $profileRoute = $role === 'admin' ? route('admin.dashboard') : route('user.dashboard');
                @endphp

                {{-- Link Profil: Menggunakan font-bold untuk penekanan, tapi sejajar --}}
                <a href="{{ $profileRoute }}" class="font-bold hover:text-red-300 transition duration-150">
                    Profil
                </a>
            @else
                {{-- Link Login --}}
                <a href="{{ route('login') }}" class="hover:text-red-300 transition duration-150 font-bold">
                    Login
                </a>
            @endauth
        </div>
    </nav>

    {{-- Menu Mobile (Muncul saat 'open' true) --}}
    <div x-show="open" @click.outside="open = false"
        class="md:hidden px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-red-800 absolute w-full shadow-lg"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        style="display: none;"> {{-- Tambahkan AlpineJS untuk state open --}}

        <a href="{{ url('/') }}"
            class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-red-700">Beranda</a>
        <a href="{{ url('/daftar') }}"
            class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-red-700">Daftar Magang</a>

        @auth
            <a href="{{ route('status.show') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-red-700">Cek Status</a>
        @else
            <a href="{{ route('login') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-red-700">Cek Status</a>
        @endauth

        <a href="{{ url('/faq') }}"
            class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-red-700">FAQ</a>

        @auth
            <a href="{{ $profileRoute }}"
                class="block px-3 py-2 rounded-md text-base font-bold text-white hover:bg-red-700">
                Profil
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-white bg-red-700 hover:bg-red-600">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}"
                class="block px-3 py-2 rounded-md text-base font-bold text-white bg-red-700 hover:bg-red-600">
                Login
            </a>
        @endauth
    </div>
</header>
