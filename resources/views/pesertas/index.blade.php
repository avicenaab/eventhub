<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta - EventHub</title>

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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 15px;
            flex-wrap: wrap;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #64748b;
        }

        .btn-add {
            background: #2563eb;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-add:hover {
            background: #1d4ed8;
        }

        .alert {
            background: #dcfce7;
            color: #166534;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .table-card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            overflow-x: auto;
        }

        .table-card h3 {
            margin-bottom: 20px;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th {
            background: #172554;
            color: white;
            padding: 14px 12px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }

        tr:hover td {
            background: #f8fafc;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-edit, .btn-delete {
            padding: 7px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background: #fef3c7;
            color: #92400e;
        }

        .btn-delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        .empty {
            text-align: center;
            color: #64748b;
            padding: 30px;
        }

        .footer {
            margin-top: 35px;
            color: #94a3b8;
            font-size: 12px;
            text-align: center;
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
        <div class="brand">EventHub</div>

        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('pesertas.index') }}" class="active">Peserta</a>
        <a href="{{ route('pendaftarans.index') }}">Pendaftaran</a>
        <a href="{{ route('presensis.index') }}">Presensi</a>
    </aside>

    <main class="main">

        <div class="header">
            <div>
                <h1>Data Peserta</h1>
                <p>Kelola informasi seluruh peserta EventHub.</p>
            </div>

            <a href="{{ route('pesertas.create') }}" class="btn-add">
                + Tambah Peserta
            </a>
        </div>

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-card">

            <h3>Daftar Peserta</h3>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Instansi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pesertas as $index => $peserta)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $peserta->nama }}</td>
                            <td>{{ $peserta->email }}</td>
                            <td>{{ $peserta->no_hp }}</td>
                            <td>{{ $peserta->instansi }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('pesertas.edit', $peserta->id) }}"
                                       class="btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('pesertas.destroy', $peserta->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus peserta ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-delete">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                Belum ada data peserta.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <div class="footer">
            © 2026 EventHub. Event Management System.
        </div>

    </main>

</body>
</html>