<header class="bg-red-900 text-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center py-4">
        <div class="flex items-center space-x-3">
            {{-- Logo: Menggunakan warna kontras yang terang (yellow-300) --}}
            <span class="text-xl font-bold text-white-300">PN KLATEN</span>
        </div>
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

                {{-- Link Profil: Menggunakan warna terang (yellow-300) sebagai penekanan --}}
                <a href="{{ $profileRoute }}" class="font-bold text-red-300 px-3 py-1 rounded-md hover:text-white">
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
</header>
