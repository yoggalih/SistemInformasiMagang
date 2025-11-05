<footer class="bg-red-900 text-white mt-12">
    <div
        class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0">

        {{-- KOLOM 1: Identitas --}}
        <div class="text-center md:text-left">
            <p class="text-lg font-bold mb-1">Pengadilan Negeri Klaten Kelas IA</p>
            <p class="text-sm">Jl. Pemuda No. 25, Klaten, Jawa Tengah</p>
            <p class="text-sm mt-1">© {{ date('Y') }} Sistem Informasi Magang PN Klaten</p>
        </div>

        {{-- KOLOM 2: Kontak --}}
        <div class="text-center md:text-left">
            <p class="text-lg font-bold mb-2">Hubungi Kami</p>

            {{-- Email --}}
            <p class="text-sm flex items-center justify-center md:justify-start">
                <i class="fas fa-envelope mr-2"></i>
                <a href="mailto:pengadilannegeriklaten@gmail.com"
                    class="hover:text-gray-300 underline underline-offset-2 transition">
                    pengadilannegeriklaten@gmail.com
                </a>
            </p>

            {{-- Telepon --}}
            <p class="text-sm flex items-center justify-center md:justify-start">
                <i class="fas fa-phone-alt mr-2"></i>
                <a href="tel:+62272323566" class="hover:text-gray-300 underline underline-offset-2 transition">
                    (0272) 323566
                </a>
            </p>

            <p class="text-sm mt-2">Sen–Jum, 08.00–16.00 WIB</p>
        </div>


        {{-- KOLOM 3: Media Sosial --}}
        <div class="text-center">
            <p class="text-lg font-bold mb-3">Ikuti Kami</p>
            <div class="flex justify-center space-x-5 text-2xl">
                <a href="https://www.instagram.com/pn.klaten/" target="_blank" class="hover:text-gray-300 transition">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.facebook.com/pengadilannegeriklaten" target="_blank"
                    class="hover:text-gray-300 transition">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://www.youtube.com/@pengadilannegeriklaten" target="_blank"
                    class="hover:text-gray-300 transition">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>

    </div>

    {{-- Baris bawah kecil --}}
    <div class="border-t border-red-800 py-3 text-center text-sm text-gray-200">
        Dikembangkan oleh <span class="font-semibold">Mahasiswa Magang PN Klaten</span>
    </div>
</footer>

{{-- Tambahkan ini di layouts/app.blade.php (bagian <head>) --}}
{{-- Pastikan hanya sekali, jangan diulang di tiap halaman --}}
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-9L0FQl5Er1Ev7+I5q5q8mL7EGD+j2OZgcnLPqYPSRuZkZqcnOv5vD5evvS5Owhl3cXn9TkAkViS3r0yEJH+log=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
