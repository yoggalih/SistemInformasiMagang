@extends('layouts.app')

@section('title', 'Divisi PTIP - Magang PN Klaten')

@section('content')

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h1 class="text-4xl font-bold text-pn-maroon mb-8 border-b-2 pb-2">Divisi PTIP</h1>
    
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <p class="text-lg text-gray-700 mb-6 leading-relaxed">
            Divisi **PTIP (Pelayanan Terpadu Satu Pintu dan Teknologi Informasi)** bertanggung jawab atas pengelolaan teknologi informasi, sistem aplikasi, website, dan peralatan komputer di lingkungan PN Klaten, serta memastikan kelancaran layanan terpadu kepada masyarakat.
        </p>
        
        <h3 class="text-2xl font-semibold text-gray-800 mt-6 mb-4">Informasi Magang</h3>
        
        <div class="space-y-4">
            <div class="flex items-start">
                <span class="text-xl text-pn-maroon mr-3">🔹</span>
                <div>
                    <strong class="text-lg">Bidang Cocok:</strong> 
                    <span class="text-gray-600">Informatika, Sistem Informasi, Teknik Komputer, Manajemen IT.</span>
                </div>
            </div>
            
            <div class="flex items-start">
                <span class="text-xl text-pn-maroon mr-3">🔹</span>
                <div>
                    <strong class="text-lg">Contoh Kegiatan Magang:</strong> 
                    <ul class="list-disc list-inside ml-5 text-gray-600">
                        <li>Pendataan dan inventarisasi aset teknologi informasi.</li>
                        <li>Pemeliharaan sistem informasi dan aplikasi internal (SIPP, dll.).</li>
                        <li>Administrasi jaringan komputer dan dukungan teknis harian.</li>
                        <li>Pengembangan konten dan pemeliharaan website Pengadilan.</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="flex justify-between mt-10 border-t pt-4">
            <a href="#" class="flex items-center text-pn-maroon hover:text-red-800 transition duration-150">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                &lt; Sebelumnya (Divisi Umum)
            </a>
            <a href="#" class="flex items-center text-pn-maroon hover:text-red-800 transition duration-150">
                Selanjutnya (Divisi Kepegawaian) &gt;
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>
</div>

@endsection