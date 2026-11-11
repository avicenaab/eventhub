<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pendaftaran - EventHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6fb;
            color: #1e293b;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 245px;
            background: #172554;
            color: white;
            padding: 28px 18px;
            flex-shrink: 0;
        }

        .brand {
            font-size: 25px;
            font-weight: 800;
            padding: 0 12px;
            margin-bottom: 45px;
            letter-spacing: -1px;
        }

        .brand span {
            color: #60a5fa;
        }

        .menu-label {
            font-size: 11px;
            color: #94a3b8;
            letter-spacing: 1.5px;
            margin: 25px 12px 12px;
        }

        .menu a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 14px;
            border-radius: 9px;
            margin-bottom: 7px;
            font-size: 14px;
        }

        .menu a:hover,
        .menu a.active {
            background: #2563eb;
            color: white;
        }

        .main {
            flex: 1;
            padding: 35px;
            min-width: 0;
        }

        .topbar {
            margin-bottom: 30px;
        }

        .topbar h1 {
            font-size: 27px;
            color: #172554;
        }

        .topbar p {
            color: #64748b;
            font-size: 14px;
            margin-top: 6px;
        }

        .breadcrumb {
            font-size: 13px;
            color: #94a3b8;
            margin-bottom: 12px;
        }

        .breadcrumb a {
            color: #2563eb;
            text-decoration: none;
        }

        .form-card {
            max-width: 750px;
            background: white;
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 3px 15px #00000008;
            border: 1px solid #edf0f5;
        }

        .form-heading {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #edf0f5;
        }

        .form-heading h2 {
            color: #172554;
            font-size: 20px;
        }

        .form-heading p {
            color: #94a3b8;
            font-size: 13px;
            margin-top: 6px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
            color: #334155;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #dbe2ea;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            background: white;
            color: #334155;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px #2563eb18;
        }

        .form-group small {
            display: block;
            margin-top: 7px;
            color: #94a3b8;
            font-size: 12px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #edf0f5;
        }

        .btn {
            padding: 11px 18px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-gray {
            background: #e2e8f0;
            color: #334155;
        }

        .btn:hover {
            opacity: .85;
        }

        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            margin-top: 25px;
        }

        @media (max-width: 850px) {
            .sidebar {
                width: 180px;
            }

            .main {
                padding: 20px;
            }
        }

        @media (max-width: 600px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                padding: 15px;
            }

            .brand {
                margin-bottom: 15px;
            }

            .menu {
                display: flex;
                flex-wrap: wrap;
            }

            .menu-label {
                display: none;
            }

            .menu a {
                padding: 9px 11px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
<div class="layout">

    <aside class="sidebar">
        <div class="brand">Event<span>Hub.</span></div>

        <div class="menu-label">MENU UTAMA</div>

        <nav class="menu">
            <a href="{{ url('/') }}">⌂ Dashboard</a>
            <a href="{{ route('events.index') }}">▣ Events</a>
            <a href="{{ route('pesertas.index') }}">♙ Peserta</a>
            <a href="{{ route('pendaftarans.index') }}" class="active">▤ Pendaftaran</a>
            <a href="{{ route('presensis.index') }}">◷ Presensi</a>
        </nav>
    </aside>

    <main class="main">

        <div class="topbar">
            <div class="breadcrumb">
                <a href="{{ route('pendaftarans.index') }}">Pendaftaran</a>
                / Tambah Pendaftaran
            </div>

            <h1>Tambah Pendaftaran</h1>
            <p>Masukkan informasi peserta dan event yang ingin didaftarkan.</p>
        </div>

        <section class="form-card">

            <div class="form-heading">
                <h2>Formulir Pendaftaran Event</h2>
                <p>Lengkapi seluruh informasi di bawah ini.</p>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    <strong>Terjadi kesalahan:</strong>
                    <ul style="margin: 8px 0 0 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pendaftarans.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Tanggal Daftar</label>
                    <input
                        type="date"
                        name="tanggal_daftar"
                        value="{{ old('tanggal_daftar') }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Peserta</label>
                    <select name="peserta_id" required>
                        <option value="">-- Pilih Peserta --</option>

                        @foreach ($pesertas as $peserta)
                            <option
                                value="{{ $peserta->id }}"
                                {{ old('peserta_id') == $peserta->id ? 'selected' : '' }}
                            >
                                {{ $peserta->nama }}
                            </option>
                        @endforeach
                    </select>
                    <small>Pilih peserta yang akan mengikuti event.</small>
                </div>

                <div class="form-group">
                    <label>Event</label>
                    <select name="event_id" required>
                        <option value="">-- Pilih Event --</option>

                        @foreach ($events as $event)
                            <option
                                value="{{ $event->id }}"
                                {{ old('event_id') == $event->id ? 'selected' : '' }}
                            >
                                {{ $event->nama_event }}
                            </option>
                        @endforeach
                    </select>
                    <small>Pilih event yang ingin diikuti peserta.</small>
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label>Status Pendaftaran</label>
                        <select name="status_pendaftaran">
                            <option value="menunggu" {{ old('status_pendaftaran', 'menunggu') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diterima" {{ old('status_pendaftaran') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ old('status_pendaftaran') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status Pembayaran</label>
                        <select name="status_pembayaran">
                            <option value="belum_bayar" {{ old('status_pembayaran', 'belum_bayar') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                            <option value="sudah_bayar" {{ old('status_pembayaran') == 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                        </select>
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('pendaftarans.index') }}"
                       class="btn btn-gray">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Simpan Pendaftaran
                    </button>
                </div>

            </form>
        </section>

        <div class="footer">
            © {{ date('Y') }} EventHub — Event Management System
        </div>

    </main>
</div>
</body>
</html>
