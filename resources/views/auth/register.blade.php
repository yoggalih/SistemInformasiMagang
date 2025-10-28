@extends('layouts.app')

@section('title', isset($admin_mode) ? 'Registrasi Admin' : 'Registrasi Pengguna - PN Klaten')

@section('content')

    @php
        // Tentukan Judul dan Rute berdasarkan $admin_mode
        $title = isset($admin_mode) ? 'Registrasi Akun Admin' : 'Registrasi Akun Pengguna';
        $storeRoute = isset($admin_mode) ? route('admin.register.store') : route('register.store');
        $loginRoute = isset($admin_mode) ? route('admin.login') : route('login');
    @endphp

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="max-w-md mx-auto">
            <div class="bg-white p-8 rounded-lg shadow-xl border-t-4 border-pn-maroon">
                <h1 class="text-3xl font-bold text-center text-pn-maroon mb-6">{{ $title }}</h1>

                <form method="POST" action="{{ $storeRoute }}">
                    @csrf
                    
                    {{-- Menampilkan Error Validasi --}}
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap:</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password:</label>
                        <input type="password" name="password" id="password" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>
                    
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="w-full bg-red-900 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-800 transition duration-300 shadow-md">
                            Daftar
                        </button>
                    </div>
                    
                    <p class="text-center text-sm text-gray-600 mt-4">
                        Sudah punya akun? <a href="{{ $loginRoute }}" class="text-pn-maroon hover:underline">Login di sini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

@endsection