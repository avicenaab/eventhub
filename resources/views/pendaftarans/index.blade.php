<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - EventHub</title>

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

        /* SIDEBAR */
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
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #2563eb;
            color: white;
        }

        /* MAIN CONTENT */
        .main {
            flex: 1;
            padding: 35px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 15px;
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

        .profile {
            background: white;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 2px 10px #00000008;
        }

        /* STATISTICS */
        .stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            padding: 23px;
            border-radius: 13px;
            box-shadow: 0 3px 15px #00000008;
            border: 1px solid #edf0f5;
        }

        .stat-card p {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .stat-card h2 {
            font-size: 29px;
            color: #172554;
        }

        .stat-icon {
            font-size: 23px;
            margin-bottom: 12px;
        }

        /* CONTENT CARD */
        .content-card {
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 3px 15px #00000008;
            border: 1px solid #edf0f5;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 22px;
        }

        .section-header h2 {
            font-size: 19px;
            color: #172554;
        }

        .section-header p {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 5px;
        }

        /* BUTTONS */
        .btn {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: .2s;
        }

        .btn:hover {
            opacity: .85;
            transform: translateY(-1px);
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-green {
            background: #dcfce7;
            color: #15803d;
        }

        .btn-red {
            background: #fee2e2;
            color: #b91c1c;
        }

        .btn-purple {
            background: #ede9fe;
            color: #6d28d9;
        }

        .btn-gray {
            background: #e2e8f0;
            color: #334155;
        }

        .toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-bottom: 20px;
        }

        /* IMPORT */
        .import-box {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            padding: 17px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .import-box label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .import-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        input[type="file"],
        input[type="text"] {
            padding: 10px;
            border: 1px solid #dbe2ea;
            border-radius: 8px;
            background: white;
            font-size: 13px;
        }

        input[type="text"] {
            width: 230px;
        }
        select {
    padding: 10px;
    border: 1px solid #dbe2ea;
    border-radius: 8px;
    background: white;
    font-size: 13px;
    cursor: pointer;
}
        /* TABLE */
        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        th {
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .4px;
            padding: 15px 13px;
            text-align: left;
        }

        td {
            padding: 15px 13px;
            border-bottom: 1px solid #edf0f5;
            font-size: 13px;
        }

        tr:hover td {
            background: #f8fafc;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .menunggu {
            background: #fef3c7;
            color: #92400e;
        }

        .diterima {
            background: #dcfce7;
            color: #166534;
        }

        .ditolak {
            background: #fee2e2;
            color: #991b1b;
        }

        .belum_bayar {
            background: #fef3c7;
            color: #92400e;
        }

        .sudah_bayar {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .action {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .action form {
            display: inline;
        }

        .action button {
            font-family: inherit;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            text-align: center;
            color: #94a3b8;
            padding: 35px;
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

            .stats {
                grid-template-columns: 1fr;
            }

            .topbar,
            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
<div class="layout">

    <!-- SIDEBAR -->
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

    <!-- MAIN -->
    <main class="main">

        <div class="topbar">
            <div>
                <h1>Data Pendaftaran</h1>
                <p>Kelola seluruh pendaftaran event dalam satu tempat.</p>
            </div>

            <div class="profile">Admin EventHub</div>
        </div>

        <!-- ALERT -->
        @if (session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- STATISTICS -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-icon">▤</div>
                <p>Total Pendaftaran</p>
                <h2>{{ $pendaftarans->count() }}</h2>
            </div>

            <div class="stat-card">
                <div class="stat-icon">◷</div>
                <p>Pendaftaran Menunggu</p>
                <h2>{{ $pendaftarans->where('status_pendaftaran', 'menunggu')->count() }}</h2>
            </div>
        </div>

        <!-- TABLE CARD -->
        <section class="content-card">

            <div class="section-header">
                <div>
                    <h2>Daftar Pendaftaran</h2>
                    <p>Informasi peserta dan event yang terdaftar.</p>
                </div>

                <a href="{{ route('pendaftarans.create') }}"
                   class="btn btn-primary">
                    + Tambah Pendaftaran
                </a>
            </div>

            <!-- EXPORT BUTTONS -->
            <div class="toolbar">
                <a href="{{ route('pendaftarans.export') }}"
                   class="btn btn-green">
                    ↓ Export Excel
                </a>

                <a href="{{ route('pendaftarans.pdf') }}"
                   class="btn btn-red">
                    ↓ Export PDF
                </a>

                <a href="{{ route('pendaftarans.chart') }}"
                   class="btn btn-purple">
                    ▥ Lihat Grafik
                </a>
            </div>

            <!-- IMPORT -->
            <div class="import-box">
                <form action="{{ route('pendaftarans.import') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <label>Import Data dari Excel</label>

                    <div class="import-form">
                        <input type="file"
                               name="file"
                               accept=".xlsx,.xls,.csv"
                               required>

                        <button type="submit" class="btn btn-primary">
                            ↑ Import Excel
                        </button>
                    </div>
                </form>
            </div>

            <!-- SEARCH -->
            <!-- SEARCH DAN SORTIR -->
<div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 17px;">

    <input type="text"
           id="searchTable"
           placeholder="Cari peserta atau event..."
           onkeyup="searchTable()">

    <form action="{{ route('pendaftarans.index') }}" method="GET">
        <select name="sort" onchange="this.form.submit()">
            <option value="terbaru" {{ ($sort ?? 'terbaru') == 'terbaru' ? 'selected' : '' }}>
                Tanggal Terbaru
            </option>

            <option value="terlama" {{ ($sort ?? 'terbaru') == 'terlama' ? 'selected' : '' }}>
                Tanggal Terlama
            </option>
        </select>
    </form>

</div>

<!-- TABLE -->
<div class="table-wrapper">
    <table id="pendaftaranTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal Daftar</th>
                <th>Nama Peserta</th>
                <th>Nama Event</th>
                <th>Status Pendaftaran</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($pendaftarans as $pendaftaran)
                <tr>
                    <td>#{{ $pendaftaran->id }}</td>
                    <td>{{ $pendaftaran->tanggal_daftar }}</td>
                    <td>{{ $pendaftaran->peserta->nama ?? '-' }}</td>
                    <td>{{ $pendaftaran->event->nama_event ?? '-' }}</td>

                    <td>
                        <span class="badge {{ strtolower($pendaftaran->status_pendaftaran) }}">
                            {{ ucfirst($pendaftaran->status_pendaftaran) }}
                        </span>
                    </td>

                    <td>
                        <span class="badge {{ strtolower($pendaftaran->status_pembayaran) }}">
                            {{ str_replace('_', ' ', ucfirst($pendaftaran->status_pembayaran)) }}
                        </span>
                    </td>

                    <td>
                        <div class="action">
                            <a href="{{ route('pendaftarans.edit', $pendaftaran->id) }}"
                               class="btn btn-gray">Edit</a>

                            <form action="{{ route('pendaftarans.destroy', $pendaftaran->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-red">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty">
                        Belum ada data pendaftaran.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


        </section>

        <div class="footer">
            © {{ date('Y') }} EventHub — Event Management System
        </div>

    </main>
</div>

<script>
    function searchTable() {
        let input = document.getElementById("searchTable");
        let filter = input.value.toLowerCase();
        let table = document.getElementById("pendaftaranTable");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            let text = rows[i].textContent.toLowerCase();
            rows[i].style.display = text.includes(filter) ? "" : "none";
        }
    }
</script>

</body>
</html>