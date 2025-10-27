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
                Temukan informasi lengkap tentang divisi, prosedur, dan pendaftaran magang di sini.
            </p>
            <div class="flex space-x-4">
                <a href="#tentang" class="bg-pn-maroon text-black px-6 py-3 rounded-lg font-semibold hover:bg-red-800 transition duration-300 shadow-md">
                    Lihat Informasi Magang
                </a>
                <a href="{{ url('/daftar') }}" class="bg-pn-maroon text-black px-6 py-3 rounded-lg font-semibold hover:bg-red-800 transition duration-300 shadow-md">
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
    <div class="max-w-4xl mx-auto bg-gray-50 p-8 rounded-lg shadow-lg border-t-4 border-pn-maroon">
        <p class="text-lg text-gray-700 leading-relaxed text-justify">
            Pengadilan Negeri Klaten membuka kesempatan magang bagi mahasiswa dan siswa SMK/sederajat yang ingin mendapatkan pengalaman praktis di lingkungan peradilan. 
            Kegiatan ini bertujuan utama memberikan pemahaman yang komprehensif tentang dunia kerja, struktur organisasi, dan proses operasional di lingkungan Pengadilan Negeri. Peserta magang akan terlibat dalam kegiatan nyata sesuai dengan divisi yang dipilih.
        </p>
    </div>
</section>

<hr class="border-gray-200 my-10">

<section class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-3xl font-bold text-center text-pn-maroon mb-8">🔹 Divisi yang Tersedia</h2>
    
    <div class="grid grid-cols-2 md:grid-cols-5 gap-6 max-w-6xl mx-auto">
        @php
            $divisi = ['PTIP', 'Kepegawaian', 'Keuangan', 'Hukum', 'Umum'];
        @endphp

        @foreach ($divisi as $d)
            <a href="{{ url('/divisi/' . strtolower($d)) }}" class="block p-4 text-center border-2 border-pn-maroon rounded-lg shadow-md hover:bg-pn-maroon hover:text-black transition duration-300 transform hover:scale-105">
                <p class="text-xl font-semibold">{{ $d }}</p>
            </a>
        @endforeach
    </div>

    <p class="text-center text-gray-600 mt-6 italic">
        Setiap divisi memiliki peran penting dalam operasional Pengadilan Negeri Klaten. Klik untuk detailnya.
    </p>
</section>

<hr class="border-gray-200 my-10">

<section class="bg-pn-light py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-pn-maroon mb-8">💬 Kata Mereka</h2>
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-xl border-l-4 border-pn-maroon">
            <p class="text-xl italic text-gray-700 mb-4">
                "Magang di PN Klaten memberikan pengalaman berharga, terutama dalam memahami proses administrasi dan teknologi informasi di lingkungan peradilan. Stafnya sangat membantu!"
            </p>
            <p class="text-right font-semibold text-pn-maroon">
                — Andi, Mahasiswa Informatika
            </p>
        </div>
    </div>
</section>

@endsection