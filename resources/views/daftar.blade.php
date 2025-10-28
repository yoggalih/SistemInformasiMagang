@extends('layouts.app')

@section('title', 'Daftar Magang - PN Klaten')

@section('content')

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-4xl font-bold text-pn-maroon mb-4 border-b-2 pb-2">Formulir Pendaftaran Magang</h1>
        <p class="text-lg text-gray-600 mb-8">
            Silakan isi data berikut untuk mengajukan permohonan magang di Pengadilan Negeri Klaten.
        </p>

        <div class="max-w-3xl mx-auto bg-gray-50 p-8 rounded-lg shadow-xl border-t-4 border-pn-maroon">
            <form action="{{ route('daftar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p class="font-bold">Sukses!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        <p class="font-bold">Kesalahan:</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        <p class="font-bold">Terjadi Kesalahan:</p>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap:</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" required value="{{ old('nama_lengkap') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    <div>
                        <label for="asal_institusi" class="block text-sm font-medium text-gray-700 mb-1">Asal
                            Universitas/Sekolah:</label>
                        <input type="text" name="asal_institusi" id="asal_institusi" required value="{{ old('asal_institusi') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    <div>
                        <label for="program_studi" class="block text-sm font-medium text-gray-700 mb-1">Program
                            Studi:</label>
                        <input type="text" name="program_studi" id="program_studi" required value="{{ old('program_studi') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    @auth
                        {{-- Jika sudah login: Email disembunyikan dan diisi otomatis --}}
                        <div class="md:col-span-2 bg-blue-100 p-3 rounded-md border border-blue-300">
                            <p class="text-sm font-medium text-blue-700">Email Anda otomatis terisi: 
                            <span class="font-semibold">{{ Auth::user()->email }}</span> 
                            </p>
                        </div>
                        {{-- Input email disembunyikan untuk dikirim ke controller --}}
                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                    @else
                        {{-- Jika belum login: Tampilkan form email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                            <input type="email" name="email" id="email" required value="{{ old('email') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                            <p class="text-xs text-gray-500 mt-1">Email akan digunakan sebagai kunci unik pendaftaran.</p>
                        </div>
                    @endauth

                    <div>
                        <label for="nomor_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP:</label>
                        <input type="tel" name="nomor_hp" id="nomor_hp" required value="{{ old('nomor_hp') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>
                    
                </div>

                <div class="mt-6">
                    <label for="surat_pengantar" class="block text-sm font-medium text-gray-700 mb-1">Upload Surat Pengantar
                        (PDF):</label>
                    <input type="file" name="surat_pengantar" id="surat_pengantar" accept=".pdf" required
                        class="w-full text-gray-600 border border-gray-300 rounded-md p-2 focus:border-pn-maroon focus:ring-pn-maroon">
                    <p class="text-xs text-gray-500 mt-1">Hanya file PDF yang diizinkan.</p>
                </div>

                <div class="mt-8 text-center">
                    <button type="submit"
                        class="bg-pn-maroon text-black px-8 py-3 rounded-lg font-semibold hover:bg-red-800 transition duration-300 shadow-lg transform hover:scale-105">
                        Kirim Pendaftaran
                    </button>
                </div>

                <p class="text-sm text-center text-gray-500 mt-4 italic">
                    Setelah dikirim, data akan diteruskan ke admin untuk proses seleksi.
                </p>
            </form>
        </div>
    </div>

@endsection