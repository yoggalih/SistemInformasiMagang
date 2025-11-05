@extends('layouts.app')

@section('title', 'Beranda - Sistem Informasi Magang PN Klaten')

@section('content')

    {{-- BAGIAN 1: HERO SECTION --}}
    <section class="relative bg-cover bg-center h-screen flex items-center "
        style="background-image: url({{ asset('images/gedung.jpg') }});">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div
            class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-white text-center animate__animated animate__bounceIn">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4 animate-fadeInDown">
                Sistem Informasi Magang
            </h1>
            <p class="text-xl md:text-2xl mb-8 animate-fadeInUp">
                Pengadilan Negeri Klaten Kelas IA
            </p>
            <div class="flex justify-center space-x-4 animate-fadeInUp delay-300">
                <a href="{{ route('daftar.form') }}"
                    class="bg-pn-maroon hover:bg-red-800 text-white font-semibold py-3 px-8 rounded-full transition duration-300 shadow-lg">
                    Daftar Magang Sekarang
                </a>

                <a href="{{ route('faq') }}"
                    class="bg-pn-maroon hover:bg-red-800 text-white font-semibold py-3 px-8 rounded-full transition duration-300 shadow-lg">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    {{-- BAGIAN 2: FITUR UTAMA --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-10">Layanan Utama Sistem Informasi Magang PN Klaten</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="p-6 bg-pn-light rounded-lg shadow-md border-t-4 border-pn-maroon hover:shadow-xl transition">
                    <i class="fas fa-laptop text-4xl text-pn-maroon mb-4"></i>
                    <h3 class="text-xl font-semibold mb-3">Pendaftaran Digital</h3>
                    <p class="text-gray-600">
                        Calon peserta dapat melakukan <strong>pendaftaran magang secara online</strong> tanpa harus datang
                        ke kantor, cukup melalui formulir yang tersedia pada sistem ini.
                    </p>
                </div>

                <div class="p-6 bg-pn-light rounded-lg shadow-md border-t-4 border-pn-maroon hover:shadow-xl transition">
                    <i class="fas fa-envelope-open-text text-4xl text-pn-maroon mb-4"></i>
                    <h3 class="text-xl font-semibold mb-3">Notifikasi Hasil Seleksi</h3>
                    <p class="text-gray-600">
                        Peserta akan menerima <strong>pemberitahuan resmi melalui email</strong> terkait hasil seleksi
                        magang — apakah diterima atau belum, dengan informasi jadwal dan ketentuan selanjutnya.
                    </p>
                </div>

                <div class="p-6 bg-pn-light rounded-lg shadow-md border-t-4 border-pn-maroon hover:shadow-xl transition">
                    <i class="fas fa-clipboard-list text-4xl text-pn-maroon mb-4"></i>
                    <h3 class="text-xl font-semibold mb-3">Pemantauan Status</h3>
                    <p class="text-gray-600">
                        Sistem menyediakan fitur untuk <strong>melacak status lamaran</strong> secara langsung, mulai dari
                        tahap pengajuan hingga selesai, agar peserta mendapatkan transparansi penuh.
                    </p>
                </div>

            </div>
        </div>
    </section>


    {{-- BAGIAN 3: TENTANG PN KLATEN --}}
    <section class="bg-gray-100 py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 mb-10 lg:mb-0 lg:pr-10">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Mengenal Pengadilan Negeri Klaten</h2>
                <p class="text-gray-600 mb-4">
                    Kegiatan magang di Pengadilan Negeri Klaten Kelas IA merupakan kesempatan bagi mahasiswa untuk
                    memperoleh pengalaman langsung dalam memahami sistem kerja lembaga peradilan di bawah naungan Mahkamah
                    Agung Republik Indonesia. Melalui kegiatan ini, mahasiswa dapat mempelajari proses administrasi perkara,
                    mekanisme persidangan, serta penerapan teknologi informasi dalam mendukung pelayanan publik. Selain itu,
                    magang ini juga bertujuan untuk menumbuhkan sikap profesional, kedisiplinan, dan tanggung jawab
                    mahasiswa dalam menerapkan ilmu yang telah diperoleh di lingkungan kerja nyata.

                </p>

                <a href="{{ route('faq') }}"
                    class="text-pn-maroon font-semibold hover:text-red-800 transition duration-300 flex items-center">
                    Lihat detail persyaratan <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </a>
            </div>
            <div class="lg:w-1/2">
                <img src="{{ asset('images/gedung.jpg') }}" alt="Gedung PN Klaten"
                    class="rounded-lg shadow-xl w-full max-w-lg mx-auto transform hover:scale-105 transition duration-500">
            </div>
        </div>
    </section>

    {{-- BAGIAN 5: DAFTAR PESERTA MAGANG AKTIF & SELESAI (TABEL GABUNGAN) [BARU] --}}
    <section class="py-20 bg-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Daftar Peserta Magang (Aktif & Riwayat)</h2>
            <p class="text-center text-gray-600 mb-8">Data mahasiswa yang sedang dan telah menyelesaikan program magang di
                PN Klaten.</p>

            <div class="max-w-6xl mx-auto overflow-x-auto bg-white shadow-lg rounded-lg">
                @if ($allInterns->isEmpty())
                    <div class="text-center p-8 text-gray-500 italic">
                        Tidak ada data peserta magang (aktif maupun riwayat) yang ditemukan.
                    </div>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-pn-light">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Institusi / Prodi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Periode Magang</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($allInterns as $intern)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $intern->nama_lengkap }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <div class="font-medium text-gray-900">{{ $intern->asal_institusi }}</div>
                                        <div class="text-xs text-gray-500">{{ $intern->program_studi }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($intern->tanggal_mulai)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($intern->tanggal_selesai)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $intern->status_color }}-100 text-{{ $intern->status_color }}-800">
                                            {{ $intern->status_desc }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <p class="text-center text-xs text-gray-500 mt-4">Data riwayat magang dibatasi 10 entri terbaru.</p>
        </div>
    </section>

    {{-- BAGIAN 4: TESTIMONIAL --}}
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

@endsection
