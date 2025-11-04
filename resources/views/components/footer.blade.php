<footer class="bg-red-900 text-white mt-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 md:flex md:justify-between md:items-center">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
            {{-- KOLOM 1: Informasi Dasar --}}
            <div class="mb-4 md:mb-0">
                <p class="text-lg font-bold mb-2">Pengadilan Negeri Klaten</p>
                <p class="text-sm">Jl. Pemuda No. 25, Klaten</p>
                <p class="text-sm">© {{ date('Y') }} PN Klaten</p>
            </div>

            {{-- KOLOM 2: Detail Kontak (Dari Halaman Kontak Lama) --}}
            <div>
                <p class="text-lg font-bold mb-2">Hubungi Kami</p>
                <div class="space-y-1">
                    <p class="text-sm flex items-center">
                        <i class="fas fa-envelope mr-2"></i> Email: pnkla@pn.go.id
                    </p>
                    <p class="text-sm flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i> Telepon: (0272) 321000
                    </p>
                    <p class="text-sm mt-2">Jam Kerja: Sen–Jum, 08.00–16.00 WIB</p>
                </div>
            </div>

            {{-- KOLOM 3: Navigasi Cepat --}}
            <div>
                <p class="text-lg font-bold mb-2">Navigasi</p>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ url('/') }}" class="hover:underline">Beranda</a></li>
                    <li><a href="{{ route('daftar.form') }}" class="hover:underline">Daftar Magang</a></li>
                    <li><a href="{{ url('/faq') }}" class="hover:underline">FAQ</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-3 text-center border-t border-red-700">
        <p class="text-xs">Dikembangkan oleh **Galih Yoga**</p>
    </div> --}}
</footer>

<style>
    /* Hanya untuk demo: Pastikan Font Awesome dikenali (diperlukan untuk icon envelope/phone) */
    /* Di implementasi nyata, Anda harus mengimpor Font Awesome di layouts/app.blade.php */
    .fas {
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
    }
</style>
