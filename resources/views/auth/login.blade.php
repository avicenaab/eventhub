<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Super Admin · EventHub</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="auth-body">
        <main class="auth-card">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark">E</span>
                <span>EventHub</span>
            </a>
            <p class="eyebrow">PRIVATE MANAGEMENT</p>
            <h1>Selamat datang kembali</h1>
            <p class="muted">Masuk menggunakan akun Admin.</p>
            <form method="POST" action="{{ route('admin.login.store') }}" class="stack-form">
                @csrf
                <label>Email
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                </label>
                @error('email')
                    <small class="field-error">{{ $message }}</small>
                @enderror
                <label>Password
                    <input type="password" name="password" required autocomplete="current-password">
                </label>
                <label class="check-line">
                    <input type="checkbox" name="remember" value="1"> Ingat saya
                </label>
                <button class="btn primary full" type="submit">Masuk ke Dashboard</button>
            </form>
            <a class="muted back-link" href="{{ route('home') }}">← Kembali ke website</a>
        </main>
    </body>
</html>
