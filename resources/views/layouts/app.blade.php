<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Magang PN Klaten')</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Tambahkan Font Awesome untuk icon di footer --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
{{-- PERUBAHAN: Menambahkan class untuk memastikan layout full height --}}

<body class="font-sans antialiased bg-white text-gray-800 min-h-screen flex flex-col">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Konten Utama: Menggunakan flex-grow agar mengisi sisa ruang --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- BARIS UJI COBA --}}
    {{-- <h1 style="color: blue;">FOOTER AKAN MUNCUL DI BAWAH INI</h1> --}}
     {{-- Footer: Dipanggil di sini --}} @include('components.footer')
        {{-- Jika Anda memiliki JS --}} @vite('resources/js/app.js') </body>

</html>
