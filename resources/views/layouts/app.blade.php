<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Magang PN Klaten')</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
<body class="font-sans antialiased bg-white text-gray-800">

    @include('components.navbar') 

    <main>
        @yield('content')
    </main>

    @include('components.footer')

</body>
</html>