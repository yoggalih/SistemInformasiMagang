@extends('layouts.app')

@section('title', 'Lupa Password - PN Klaten')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="max-w-md mx-auto">
            <div class="bg-white p-8 rounded-lg shadow-xl border-t-4 border-pn-maroon">
                <h1 class="text-3xl font-bold text-center text-pn-maroon mb-6">Lupa Password</h1>

                {{-- Pesan Status (misalnya: Tautan telah dikirim) --}}
                @if (session('status'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p>{{ session('status') }}</p>
                    </div>
                @endif

                <p class="text-gray-700 mb-4">
                    Masukkan alamat email yang terdaftar di akun Anda. Kami akan mengirimkan tautan reset password ke email
                    tersebut.
                </p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                        <input type="email" name="email" id="email" required autofocus
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="w-full bg-red-900 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-800 transition duration-300 shadow-md">
                            Kirim Tautan Reset Password
                        </button>
                    </div>
                </form>

                <p class="text-center text-sm text-gray-600 mt-4">
                    <a href="{{ route('login') }}" class="text-pn-maroon hover:underline">Kembali ke Login</a>
                </p>
            </div>
        </div>
    </div>
@endsection
