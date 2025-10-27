@extends('layouts.app')

@section('title', 'FAQ - Magang PN Klaten')

@section('content')

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h1 class="text-4xl font-bold text-center text-pn-maroon mb-10 border-b-2 pb-2">Pertanyaan Umum Tentang Magang</h1>
    
    <div class="max-w-3xl mx-auto space-y-6">
        
        <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-pn-maroon">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Q: Apakah magang ini berbayar?</h3>
            <p class="text-gray-700">A: Tidak, kegiatan magang di Pengadilan Negeri Klaten bersifat **sukarela** dan bertujuan sebagai sarana **pembelajaran dan pengalaman kerja** bagi peserta.</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-pn-maroon">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Q: Berapa lama durasi magang?</h3>
            <p class="text-gray-700">A: Umumnya durasi magang adalah antara **1 hingga 2 bulan**, namun hal ini dapat disesuaikan dengan kebutuhan dan kebijakan dari institusi pendidikan (kampus/sekolah) asal peserta.</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-pn-maroon">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Q: Apakah mahasiswa IT dilibatkan dalam proyek?</h3>
            <p class="text-gray-700">A: Sesuai kebijakan dan ketersediaan, mahasiswa dapat dilibatkan dalam kegiatan nyata, seperti pemeliharaan sistem, pendataan aset TI, atau proyek pengembangan sederhana yang sesuai dengan bidang studi dan kebutuhan Pengadilan.</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-pn-maroon">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Q: Bagaimana cara mendaftar?</h3>
            <p class="text-gray-700">A: Pendaftaran dapat dilakukan melalui menu **Daftar Magang** dengan mengisi formulir dan mengunggah surat pengantar resmi dari institusi Anda.</p>
        </div>

    </div>
</div>

@endsection