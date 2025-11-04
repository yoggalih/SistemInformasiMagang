@extends('layouts.app')

@section('title', 'Beranda - Magang PN Klaten')

@section('content')

    {{-- BAGIAN 1: HERO (Selamat Datang) | FULL SCREEN --}}
    <section class="bg-pn-light min-h-screen flex items-center py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center gap-10">
            <div class="md:w-1/2">
                {{-- Mengurangi ukuran font pada layar besar agar tidak terlalu dominan --}}
                <h1 class="text-4xl lg:text-5xl xl:text-5xl font-extrabold text-pn-maroon mb-4 leading-tight">
                    Selamat Datang di Website Informasi Magang Pengadilan Negeri Klaten
                </h1>
                <p class="text-lg lg:text-xl text-gray-600 mb-8">
                    Temukan informasi lengkap tentang prosedur, dan pendaftaran magang di sini.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    {{-- Tombol Primer (Daftar Sekarang) --}}
                    <a href="{{ url('/daftar') }}"
                        class="bg-red-600 text-white px-6 py-3 rounded-xl font-bold text-base hover:bg-red-700 transition duration-300 shadow-lg transform hover:scale-105">
                        Daftar Sekarang
                    </a>
                    {{-- Tombol Sekunder (Lihat Alur) --}}
                    <a href="#alur-syarat"
                        class="bg-white border-2 border-red-600 text-red-600 px-6 py-3 rounded-xl font-bold text-base hover:bg-red-50 transition duration-300 shadow-md">
                        Lihat Alur & Syarat
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                {{-- Memastikan gambar tidak terlalu besar (maksimal lebar L) --}}
                <img src="{{ asset('images/gedung.jpg') }}" alt="Gambar Gedung PN Klaten"
                    class="w-full max-w-lg h-auto rounded-xl shadow-2xl border-4 border-white">
            </div>
        </div>
    </section>

    {{-- BAGIAN 2: TENTANG MAGANG | FULL SCREEN --}}
    <section id="tentang" class="min-h-screen flex items-center py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-pn-maroon mb-10">Tentang Magang di PN Klaten</h2>
            <div class="max-w-4xl mx-auto bg-gray-50 p-8 rounded-2xl shadow-xl border-t-8 border-red-600">
                <p class="text-lg text-gray-700 leading-relaxed text-justify">
                    Pengadilan Negeri Klaten membuka kesempatan magang bagi mahasiswa dan siswa SMK/sederajat yang ingin
                    mendapatkan pengalaman praktis di lingkungan peradilan. Kegiatan ini bertujuan utama memberikan
                    pemahaman yang komprehensif tentang dunia kerja, struktur organisasi, dan proses operasional di
                    lingkungan Pengadilan Negeri. Peserta magang akan terlibat dalam kegiatan nyata seperti administrasi,
                    bantuan teknologi informasi, dan observasi persidangan.
                </p>
            </div>
        </div>
    </section>

    {{-- BAGIAN 3: ALUR DAN SYARAT PENDAFTARAN | FULL SCREEN --}}
    <section id="alur-syarat" class="min-h-screen flex items-center py-16 bg-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-pn-maroon mb-10">Alur & Syarat Pendaftaran Magang</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 max-w-6xl mx-auto">

                {{-- BLOK SYARAT PENDAFTARAN --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <span class="text-red-600 mr-2 text-3xl">📝</span> Syarat Administrasi
                    </h3>
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-pn-maroon space-y-3">
                        <p class="text-base text-gray-700">1. Mahasiswa aktif atau Siswa SMK/Sederajat.</p>
                        <p class="text-base text-gray-700">2. Mengajukan permohonan magang untuk periode minimal 1 bulan.
                        </p>
                        <p class="text-base text-gray-700">3. Melampirkan <b>Surat Pengantar Resmi</b> dari Lembaga
                            Pendidikan
                            (kampus/sekolah) dalam format <b>PDF</b>.</p>
                        <p class="text-base text-gray-700">4. Melakukan pendaftaran menggunakan <b>Email Aktif</b> dan Nomor
                            HP yang valid.
                        </p>
                        <p class="text-base text-gray-700">5. Sudah memiliki akun login di sistem ini (melalui halaman
                            <b>Register</b>).
                        </p>
                    </div>
                </div>

                {{-- BLOK ALUR PENDAFTARAN --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-5 flex items-center">
                        <span class="text-red-600 mr-2 text-3xl">➡️</span> Tahapan Pendaftaran
                    </h3>
                    <ol class="space-y-4">
                        <li class="p-4 bg-white rounded-xl shadow-md border-l-4 border-pn-maroon">
                            <span class="font-bold text-pn-maroon mr-2">Tahap 1: Registrasi Akun</span>
                            <p class="text-sm text-gray-700">Daftar akun melalui menu <b>Login</b> atau <b>Register.</b></p>
                        </li>
                        <li class="p-4 bg-white rounded-xl shadow-md border-l-4 border-pn-maroon">
                            <span class="font-bold text-pn-maroon mr-2">Tahap 2: Isi Formulir</span>
                            <p class="text-sm text-gray-700">Akses menu <b>Daftar Magang</b>, isi formulir dengan lengkap
                                dan
                                <b>upload</b> Surat Pengantar PDF Anda.
                            </p>
                        </li>
                        <li class="p-4 bg-white rounded-xl shadow-md border-l-4 border-pn-maroon">
                            <span class="font-bold text-pn-maroon mr-2">Tahap 3: Review Admin</span>
                            <p class="text-sm text-gray-700">Admin PN Klaten akan meninjau kelengkapan dan kesesuaian berkas
                                Anda.</p>
                        </li>
                        <li class="p-4 bg-white rounded-xl shadow-md border-l-4 border-pn-maroon">
                            <span class="font-bold text-pn-maroon mr-2">Tahap 4: Cek Status</span>
                            <p class="text-sm text-gray-700">Cek status keputusan (Diterima/Ditolak) secara berkala melalui
                                menu
                                <b>Cek Status.</b>
                            </p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    {{-- BAGIAN 4: TESTIMONIAL | TIDAK FULL SCREEN, LEBIH RAPI --}}
    <section class="bg-pn-light py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-pn-maroon mb-10">💬 Kata Mereka</h2>
            <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-xl border-l-8 border-pn-maroon">
                <p class="text-lg italic text-gray-700 mb-4 leading-relaxed">
                    "Magang di PN Klaten memberikan pengalaman berharga, terutama dalam memahami proses administrasi dan
                    teknologi informasi di lingkungan peradilan. Stafnya sangat membantu dan lingkungannya sangat kondusif
                    untuk belajar!"
                </p>
                <p class="text-right font-semibold text-base text-pn-maroon">
                    — Andi, Mahasiswa Informatika
                </p>
            </div>
        </div>
    </section>

    {{-- FOOTER STATIS (Menggulir) --}}
    <footer class="bg-pn-maroon text-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-base font-semibold mb-2">Pengadilan Negeri Klaten Kelas IA</p>
            <p class="text-sm mb-1">Jl. Pramuka No.1, Klaten, Jawa Tengah 57413</p>
            <p class="text-sm mb-4">Telepon: (0272) 321683 | Email: <a href="mailto:pn.klaten@gmail.com"
                    class="hover:underline">pn.klaten@gmail.com</a></p>
            {{-- <p class="text-xs text-gray-300 border-t border-gray-700 pt-4 mt-4">
                &copy; {{ date('Y') }} Sistem Informasi Magang Pengadilan Negeri Klaten. Semua Hak Dilindungi.
            </p> --}}
        </div>
    </footer>

@endsection
