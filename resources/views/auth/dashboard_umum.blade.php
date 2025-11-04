@extends('layouts.app')

@section('title', 'Dashboard Pengguna - PN Klaten')

@section('content')

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-4xl font-bold text-pn-maroon mb-4">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="text-lg text-gray-600 mb-8">Ini adalah dashboard khusus pengguna untuk melacak status dan pengajuan Anda.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-blue-500">
                <h2 class="text-2xl font-semibold text-gray-800 mb-3">Cek Status Pengajuan</h2>
                <p class="text-gray-600 mb-4">Anda dapat memeriksa status pendaftaran magang Anda secara real-time di sini.
                </p>
                <a href="{{ route('status.show') }}"
                    class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    Lihat Status Anda &rarr;
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-gray-500">
                <h2 class="text-2xl font-semibold text-gray-800 mb-3">Pengaturan Akun</h2>
                <p class="text-gray-600 mb-4">Perbarui nama, email, dan ubah password Anda di sini.</p>
                <a href="{{ route('user.profile.show') }}"
                    class="inline-flex items-center text-gray-600 hover:text-pn-maroon font-medium">
                    Kelola Profil &rarr;
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-red-500">
                <h2 class="text-2xl font-semibold text-gray-800 mb-3">Informasi Akun</h2>
                <p class="text-gray-600">Email Anda: {{ Auth::user()->email }}</p>
                <p class="text-sm text-gray-500 mt-3">
                    *Catatan: Akun ini dibuat untuk mengakses fitur khusus.
                </p>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 underline">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
