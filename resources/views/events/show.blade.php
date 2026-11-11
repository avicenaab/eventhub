<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event - EventHub</title>

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
            font-size: 24px;
            margin-bottom: 35px;
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
            min-width: 0;
            padding: 40px;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #172554;
            margin-bottom: 8px;
        }

        .header p {
            color: #64748b;
        }

        .detail-card {
            background: white;
            max-width: 950px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        }

        .event-title {
            padding-bottom: 25px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 25px;
        }

        .event-title h2 {
            font-size: 23px;
            color: #172554;
            margin-bottom: 12px;
        }

        .status {
            display: inline-block;
            padding: 6px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .status.aktif {
            background: #dcfce7;
            color: #15803d;
        }

        .status.draft {
            background: #fef3c7;
            color: #92400e;
        }

        .status.selesai {
            background: #e2e8f0;
            color: #475569;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 25px;
        }

        .detail-item {
            padding: 15px;
            background: #f8fafc;
            border-radius: 9px;
        }

        .detail-item.full {
            grid-column: 1 / -1;
        }

        .detail-item label {
            display: block;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 9px;
        }

        .detail-item p {
            color: #1e293b;
            font-size: 15px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .description {
            font-weight: normal !important;
            line-height: 1.7;
            white-space: pre-line;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            display: inline-block;
            padding: 11px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-edit {
            background: #2563eb;
            color: white;
        }

        .btn-edit:hover {
            background: #1d4ed8;
        }

        .btn-back {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-back:hover {
            background: #cbd5e1;
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

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .detail-item.full {
                grid-column: auto;
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
            <h1>Detail Event</h1>
            <p>Informasi lengkap mengenai event yang terdaftar di EventHub.</p>
        </div>

        <div class="detail-card">

            <div class="event-title">
                <h2>{{ $event->nama_event }}</h2>

                <span class="status {{ $event->status_event }}">
                    {{ ucfirst($event->status_event) }}
                </span>
            </div>

            <div class="detail-grid">

                <div class="detail-item full">
                    <label>Deskripsi Event</label>
                    <p class="description">{{ $event->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                </div>

                <div class="detail-item">
                    <label>Tanggal Mulai</label>
                    <p>{{ $event->tanggal_mulai->format('d-m-Y H:i') }}</p>
                </div>

                <div class="detail-item">
                    <label>Tanggal Selesai</label>
                    <p>{{ $event->tanggal_selesai?->format('d-m-Y H:i') ?? '-' }}</p>
                </div>

                <div class="detail-item">
                    <label>Lokasi</label>
                    <p>{{ $event->lokasi }}</p>
                </div>

                <div class="detail-item">
                    <label>Kuota Peserta</label>
                    <p>{{ $event->kuota }} Peserta</p>
                </div>

                <div class="detail-item">
                    <label>Biaya Pendaftaran</label>
                    <p>Rp {{ number_format((float)$event->biaya, 0, ',', '.') }}</p>
                </div>

                <div class="detail-item">
                    <label>Status Event</label>
                    <p>{{ ucfirst($event->status_event) }}</p>
                </div>

            </div>

            <div class="actions">
                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-edit">
                    Edit Event
                </a>

                <a href="{{ route('events.index') }}" class="btn btn-back">
                    Kembali
                </a>
            </div>

        </div>

    </main>

</body>
</html>