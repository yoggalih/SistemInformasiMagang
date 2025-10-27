@extends('layouts.app')

@section('title', 'Kontak Kami - Magang PN Klaten')

@section('content')

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-4xl font-bold text-center text-pn-maroon mb-10 border-b-2 pb-2">Hubungi Kami</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto">

            <div class="bg-white p-8 rounded-lg shadow-lg border-l-4 border-pn-maroon space-y-4">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Informasi Utama</h2>

                <div class="flex items-start">
                    <svg class="w-6 h-6 text-pn-maroon mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <div>
                        <strong class="block text-gray-800">Alamat:</strong>
                        <p class="text-gray-600">Jl. Pemuda No. 25, Klaten</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <svg class="w-6 h-6 text-pn-maroon mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.129a11.042 11.042 0 005.516 5.516l1.129-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 16.72V19a2 2 0 01-2 2h-1.72a2 2 0 01-2-2v-1.72a2 2 0 01-2-2H9.28a2 2 0 01-2-2V8.28a2 2 0 012-2h1.72a2 2 0 012 2v1.72a1 1 0 01-1.21.502L11.7 8.441a1 1 0 00-.948-.684H5z">
                        </path>
                    </svg>
                    <div>
                        <strong class="block text-gray-800">Telepon:</strong>
                        <p class="text-gray-600">(0272) 321000</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <svg class="w-6 h-6 text-pn-maroon mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    <div>
                        <strong class="block text-gray-800">Email:</strong>
                        <p class="text-gray-600">pnkla@pn.go.id</p>
                    </div>
                </div>

                <div class="flex items-start pt-4 border-t mt-4">
                    <svg class="w-6 h-6 text-pn-maroon mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <strong class="block text-gray-800">Waktu Operasional:</strong>
                        <p class="text-gray-600">Senin – Jumat, 08.00–16.00 WIB</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-8 rounded-lg shadow-xl border-t-4 border-pn-maroon">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Kirim Pesan Singkat</h2>

                {{-- ini notif --}}
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p class="font-bold">Terima Kasih!</p>
                        <p>{{ session('success') }}</p>
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

                <form action="{{ route('kontak.send') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="kontak_nama" class="block text-sm font-medium text-gray-700 mb-1">Nama:</label>
                        <input type="text" name="nama" id="kontak_nama" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    <div class="mb-4">
                        <label for="kontak_email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                        <input type="email" name="email" id="kontak_email" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon">
                    </div>

                    <div class="mb-6">
                        <label for="kontak_pesan" class="block text-sm font-medium text-gray-700 mb-1">Pesan:</label>
                        <textarea name="pesan" id="kontak_pesan" rows="4" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon"></textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit"
                            class="bg-pn-maroon text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition duration-300 shadow-md">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
