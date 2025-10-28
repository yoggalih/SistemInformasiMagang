@extends('layouts.app')

@section('title', 'Beranda - Magang PN Klaten')

@section('content')

    <section class="bg-pn-light py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center gap-8">
            <div class="md:w-1/2">
                <h1 class="text-4xl lg:text-5xl font-extrabold text-pn-maroon mb-4 leading-tight">
                    Selamat Datang di Website Informasi Magang Pengadilan Negeri Klaten
                </h1>
                <p class="text-xl text-gray-600 mb-8">
                    Temukan informasi lengkap tentang prosedur, dan pendaftaran magang di sini.
                </p>
                <div class="flex space-x-4">
                    <a href="#alur-syarat"
                        class="bg-red-600 text-pn-maroon px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition duration-300 shadow-md">
                        Lihat Alur & Syarat
                    </a>
                    <a href="{{ url('/daftar') }}"
                        class="bg-red-600 text-pn-maroon px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition duration-300 shadow-md">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
            <div class="md:w-1/2">

                <div class="bg-gray-200 w-full h-72 rounded-lg flex items-center justify-center text-gray-500">
                    <img src="/storage/gedung.jpg" alt="Gambar Gedung PN Klaten">
                </div>
            </div>
        </div>
    </section>

    <hr class="border-gray-200 my-10">

    <section id="tentang" class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-3xl font-bold text-center text-pn-maroon mb-6">Tentang Magang di PN Klaten</h2>
        <div class="max-w-4xl mx-auto bg-gray-50 p-8 rounded-lg shadow-lg border-t-10 border-red-600">
            <p class="text-lg text-gray-700 leading-relaxed text-justify">
                Pengadilan Negeri Klaten membuka kesempatan magang bagi mahasiswa dan siswa SMK/sederajat yang ingin
                mendapatkan pengalaman praktis di lingkungan peradilan.
                Kegiatan ini bertujuan utama memberikan pemahaman yang komprehensif tentang dunia kerja, struktur
                organisasi, dan proses operasional di lingkungan Pengadilan Negeri. Peserta magang akan terlibat dalam
                kegiatan nyata.
            </p>
        </div>
    </section>

    <hr class="border-gray-200 my-10">

    {{-- BAGIAN ALUR DAN SYARAT PENDAFTARAN --}}
    <section id="alur-syarat" class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-3xl font-bold text-center text-pn-maroon mb-10">Alur & Syarat Pendaftaran Magang</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 max-w-6xl mx-auto">

            {{-- BLOK SYARAT PENDAFTARAN --}}
            <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                    <span class="text-pn-maroon mr-2 text-3xl">📝</span> Syarat Administrasi
                </h3>
                <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-pn-maroon space-y-3">
                    <p class="text-gray-700">1. Mahasiswa aktif atau Siswa SMK/Sederajat.</p>
                    <p class="text-gray-700">2. Mengajukan permohonan magang untuk periode minimal 1 bulan.</p>
                    <p class="text-gray-700">3. Melampirkan <b>Surat Pengantar Resmi</b> dari Lembaga Pendidikan
                        (kampus/sekolah) dalam format <b>PDF</b>.</p>
                    <p class="text-gray-700">4. Melakukan pendaftaran menggunakan <b>Email Aktif</b> dan Nomor HP yang valid.
                    </p>
                    <p class="text-gray-700">5. Sudah memiliki akun login di sistem ini (melalui halaman <b>Register</b>).</p>
                </div>
            </div>

            {{-- BLOK ALUR PENDAFTARAN --}}
            <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                    <span class="text-pn-maroon mr-2 text-3xl">➡️</span> Tahapan Pendaftaran
                </h3>
                <ol class="space-y-4">
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm border-l-4 border-pn-maroon">
                        <span class="font-bold text-pn-maroon mr-2">Tahap 1: Registrasi Akun</span>
                        <p class="text-sm text-gray-700">Daftar akun melalui menu <b>Login</b> atau <b>Register.</b></p>
                    </li>
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm border-l-4 border-pn-maroon">
                        <span class="font-bold text-pn-maroon mr-2">Tahap 2: Isi Formulir</span>
                        <p class="text-sm text-gray-700">Akses menu <b>Daftar Magang</b>, isi formulir dengan lengkap dan
                            <b>upload</b> Surat Pengantar PDF Anda.</p>
                    </li>
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm border-l-4 border-pn-maroon">
                        <span class="font-bold text-pn-maroon mr-2">Tahap 3: Review Admin</span>
                        <p class="text-sm text-gray-700">Admin PN Klaten akan meninjau kelengkapan dan kesesuaian berkas
                            Anda.</p>
                    </li>
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm border-l-4 border-pn-maroon">
                        <span class="font-bold text-pn-maroon mr-2">Tahap 4: Cek Status</span>
                        <p class="text-sm text-gray-700">Cek status keputusan (Diterima/Ditolak) secara berkala melalui menu
                            <b>Cek Status.</b></p>
                    </li>
                </ol>
            </div>
        </div>
    </section>
    <hr class="border-gray-200 my-10">
    {{-- AKHIR BAGIAN ALUR DAN SYARAT PENDAFTARAN --}}


    <section class="bg-pn-light py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-pn-maroon mb-8">💬 Kata Mereka</h2>
            <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-xl border-l-4 border-pn-maroon">
                <p class="text-xl italic text-gray-700 mb-4">
                    "Magang di PN Klaten memberikan pengalaman berharga, terutama dalam memahami proses administrasi dan
                    teknologi informasi di lingkungan peradilan. Stafnya sangat membantu!"
                </p>
                <p class="text-right font-semibold text-pn-maroon">
                    — Andi, Mahasiswa Informatika
                </p>
            </div>
        </div>
    </section>

@endsection
