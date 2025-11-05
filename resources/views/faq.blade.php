@extends('layouts.app')

@section('title', 'FAQ - Magang PN Klaten')

@section('content')

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 animate__animated animate__fadeInUp">
        <h1 class="text-4xl font-bold text-center text-pn-maroon mb-10 border-b-2 pb-2">
            Pertanyaan Umum Tentang Magang
        </h1>

        <div class="max-w-3xl mx-auto space-y-6">

            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-pn-maroon">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Q: Apakah magang ini berbayar?</h3>
                <p class="text-gray-700">
                    A: Tidak, kegiatan magang di Pengadilan Negeri Klaten bersifat <strong>sukarela</strong> dan berfokus
                    pada pemberian
                    <strong>pengalaman kerja nyata</strong> serta pemahaman terhadap lingkungan peradilan bagi peserta.
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-pn-maroon">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Q: Berapa lama durasi magang?</h3>
                <p class="text-gray-700">
                    A: Umumnya durasi magang berlangsung antara <strong>1 hingga 2 bulan</strong>, tergantung pada kebijakan
                    dari institusi pendidikan peserta dan kebutuhan dari pihak Pengadilan.
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-pn-maroon">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Q: Apa saja kegiatan yang dilakukan selama magang?</h3>
                <p class="text-gray-700">
                    A: Peserta akan dikenalkan pada kegiatan kerja sehari-hari di lingkungan Pengadilan Negeri,
                    seperti administrasi, pelayanan publik, dokumentasi, dan pengenalan sistem informasi peradilan.
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-pn-maroon">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Q: Bagaimana cara mendaftar?</h3>
                <p class="text-gray-700">
                    A: Pendaftaran dapat dilakukan melalui menu <strong>Daftar Magang</strong> pada website ini
                    dengan mengisi formulir dan mengunggah surat pengantar resmi dari institusi asal.
                </p>
            </div>

        </div>
    </div>

@endsection
