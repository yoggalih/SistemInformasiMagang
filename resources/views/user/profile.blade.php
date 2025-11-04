@extends('layouts.app')

@section('title', 'Pengaturan Profil - PN Klaten')

@section('content')

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-4xl font-bold text-pn-maroon mb-6">Pengaturan Profil</h1>
        <div class="max-w-xl mx-auto">

            {{-- Pesan Status --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Terjadi Kesalahan:</p>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-8 rounded-lg shadow-xl border-t-4 border-pn-maroon">
                <form method="POST" action="{{ route('user.profile.update') }}">
                    @csrf

                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Informasi Dasar</h2>

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap:</label>
                        {{-- Menggunakan Auth::user() untuk mengisi nilai saat ini --}}
                        <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-t pt-4">Ganti Password (Opsional)</h2>
                    <p class="text-sm text-gray-500 mb-4">Isi kolom ini jika Anda ingin mengubah password.</p>

                    <div class="mb-4">
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat
                            Ini:</label>
                        <input type="password" name="current_password" id="current_password"
                            placeholder="Diperlukan untuk mengganti password baru"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru:</label>
                        <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak ingin ganti"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi
                            Password Baru:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="w-full bg-red-900 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-800 transition duration-300 shadow-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
