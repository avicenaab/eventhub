<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHub - Dashboard</title>

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
            color: #263248;
        }

        .sidebar {
            width: 240px;
            background: #172554;
            color: white;
            padding: 30px 20px;
            flex-shrink: 0;
        }

        .brand {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .brand-subtitle {
            color: #94a3b8;
            font-size: 12px;
            margin-bottom: 40px;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .main {
            flex: 1;
            padding: 40px;
            min-width: 0;
        }

        .header {
            margin-bottom: 35px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            color: #64748b;
        }

        .section-title {
            font-size: 19px;
            margin-bottom: 20px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            border-left: 4px solid #2563eb;
        }

        .stat-card:nth-child(2) {
            border-left-color: #16a34a;
        }

        .stat-card:nth-child(3) {
            border-left-color: #7c3aed;
        }

        .stat-card:nth-child(4) {
            border-left-color: #f59e0b;
        }

        .stat-card p {
            color: #64748b;
            font-size: 14px;
        }

        .stat-card h2 {
            font-size: 32px;
            margin-top: 12px;
        }

        .menus {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
        }

        .menu-card {
            display: block;
            background: white;
            padding: 25px;
            border-radius: 14px;
            text-decoration: none;
            color: #263248;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            transition: 0.2s;
        }

        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        .menu-card .icon {
            font-size: 30px;
            margin-bottom: 18px;
        }

        .menu-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .menu-card p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            min-height: 42px;
        }

        .menu-card span {
            display: inline-block;
            color: #2563eb;
            font-size: 13px;
            font-weight: bold;
            margin-top: 20px;
        }

        .footer {
            margin-top: 45px;
            color: #94a3b8;
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 1100px) {
            .stats, .menus {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .main {
                padding: 22px;
            }

            .stats, .menus {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">EventHub</div>
        <div class="brand-subtitle">Event Management System</div>

        <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('pesertas.index') }}">Peserta</a>
        <a href="{{ route('pendaftarans.index') }}">Pendaftaran</a>
        <a href="{{ route('presensis.index') }}">Presensi</a>
    </aside>

    <main class="main">

        <div class="header">
            <h1>Selamat Datang di EventHub!</h1>
            <p>Kelola event, peserta, pendaftaran, dan presensi dalam satu platform.</p>
        </div>

        <h2 class="section-title">Ringkasan Data</h2>

        <div class="stats">

            <div class="stat-card">
                <p>Total Events</p>
                <h2>{{ $totalEvents }}</h2>
            </div>

            <div class="stat-card">
                <p>Total Peserta</p>
                <h2>{{ $totalPeserta }}</h2>
            </div>

            <div class="stat-card">
                <p>Total Pendaftaran</p>
                <h2>{{ $totalPendaftaran }}</h2>
            </div>

            <div class="stat-card">
                <p>Total Presensi</p>
                <h2>{{ $totalPresensi }}</h2>
            </div>

        </div>

        <h2 class="section-title">Menu Manajemen</h2>

        <div class="menus">

            <a href="{{ route('events.index') }}" class="menu-card">
                <div class="icon">📅</div>
                <h3>Events</h3>
                <p>Kelola informasi dan jadwal event.</p>
                <span>Buka Menu →</span>
            </a>

            <a href="{{ route('pesertas.index') }}" class="menu-card">
                <div class="icon">👥</div>
                <h3>Peserta</h3>
                <p>Kelola data peserta event.</p>
                <span>Buka Menu →</span>
            </a>

            <a href="{{ route('pendaftarans.index') }}" class="menu-card">
                <div class="icon">📋</div>
                <h3>Pendaftaran</h3>
                <p>Kelola data pendaftaran event.</p>
                <span>Buka Menu →</span>
            </a>

            <a href="{{ route('presensis.index') }}" class="menu-card">
                <div class="icon">✅</div>
                <h3>Presensi</h3>
                <p>Kelola kehadiran peserta event.</p>
                <span>Buka Menu →</span>
            </a>

        </div>

        <div class="footer">
            © 2026 EventHub. Event Management System.
        </div>

    </main>

</body>
</html>