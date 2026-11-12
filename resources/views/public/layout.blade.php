<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title','EventHub') · EventHub</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="public-body">
        <header class="public-nav">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark">E</span>
                <span>EventHub</span>
            </a>
            <nav>
                <a href="{{ route('home') }}">Beranda</a>
                <a href="{{ route('public.events.index') }}">Jelajahi Event</a>
                <a href="{{ route('public.attendance.form') }}">Presensi</a>
            </nav>
            <a class="btn outline" href="{{ route('admin.login') }}">Admin Login</a>
        </header>
        <main>@yield('content')</main>
        <footer class="public-footer">
            <span>© {{ date('Y') }} EventHub</span>
            <span>Temukan kegiatan. Buat pengalaman.</span>
        </footer>
        @stack('scripts')
    </body>
</html>
