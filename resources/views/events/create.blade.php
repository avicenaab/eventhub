<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event - EventHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #f4f6fb;
        }

        .sidebar {
            width: 240px;
            background: #172554;
            color: white;
            padding: 30px 20px;
            flex-shrink: 0;
        }

        .sidebar h2 {
            margin-bottom: 35px;
            font-size: 24px;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 15px;
            margin-bottom: 8px;
            border-radius: 8px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .main {
            flex: 1;
            padding: 40px;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            color: #172554;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #64748b;
        }

        .form-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            max-width: 850px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        }

        .error-box {
            background: #fee2e2;
            color: #b91c1c;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-box ul {
            padding-left: 20px;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 11px 20px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #1d4ed8;
        }

        .back {
            display: inline-block;
            margin-left: 10px;
            color: #475569;
            text-decoration: none;
        }

        .back:hover {
            color: #2563eb;
        }

        @media (max-width: 700px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .main {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <h2>EventHub</h2>

        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('events.index') }}" class="active">Events</a>
        <a href="{{ route('pesertas.index') }}">Peserta</a>
        <a href="{{ route('pendaftarans.index') }}">Pendaftaran</a>
        <a href="{{ route('presensis.index') }}">Presensi</a>
    </aside>

    <main class="main">

        <div class="header">
            <h1>Tambah Event</h1>
            <p>Tambahkan informasi event baru ke EventHub.</p>
        </div>

        <div class="form-card">

            @if($errors->any())
                <div class="error-box">
                    <strong>Terjadi kesalahan:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('events.store') }}" method="POST">
                @csrf

                @include('events.form')

                <button type="submit">Simpan Event</button>
                <a href="{{ route('events.index') }}" class="back">Kembali</a>
            </form>

        </div>

    </main>

</body>
</html>