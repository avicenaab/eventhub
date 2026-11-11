<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pendaftaran EventHub</title>

    <style>
        @page {
            margin: 35px 35px 50px 35px;
        }

        body {
            font-family: sans-serif;
            font-size: 11px;
            color: #263248;
        }

        .header {
            border-bottom: 3px solid #172554;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            color: #172554;
            margin-bottom: 5px;
        }

        .subtitle {
            color: #64748b;
            font-size: 10px;
        }

        h2 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 5px;
            color: #172554;
        }

        .description {
            text-align: center;
            color: #64748b;
            margin-bottom: 25px;
            font-size: 10px;
        }

        .info {
            margin-bottom: 18px;
            width: 100%;
        }

        .info td {
            padding: 5px 0;
            border: none;
            text-align: left;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data th {
            background-color: #172554;
            color: white;
            padding: 9px 6px;
            text-align: center;
            border: 1px solid #172554;
        }

        table.data td {
            padding: 8px 6px;
            border: 1px solid #dbe2ea;
            text-align: center;
        }

        table.data tr:nth-child(even) {
            background-color: #f1f5f9;
        }

        .status {
            font-weight: bold;
        }

        .footer {
            margin-top: 25px;
            padding-top: 10px;
            border-top: 1px solid #cbd5e1;
            color: #64748b;
            font-size: 9px;
            text-align: center;
        }

        .total {
            margin-top: 15px;
            text-align: right;
            font-weight: bold;
            font-size: 11px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="brand">EventHub</div>
        <div class="subtitle">Event Management System</div>
    </div>

    <h2>LAPORAN DATA PENDAFTARAN EVENT</h2>

    <div class="description">
        Laporan administrasi data pendaftaran peserta event
    </div>

    <table class="info">
        <tr>
            <td width="50%">
                <strong>Tanggal Cetak:</strong>
                {{ date('d-m-Y') }}
            </td>
            <td width="50%" style="text-align: right;">
                <strong>Jenis Laporan:</strong> Data Pendaftaran
            </td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Daftar</th>
                <th>Nama Peserta</th>
                <th>Nama Event</th>
                <th>Status Pendaftaran</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($pendaftarans as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->tanggal_daftar }}</td>
                    <td>{{ $data->peserta->nama ?? '-' }}</td>
                    <td>{{ $data->event->nama_event ?? '-' }}</td>
                    <td class="status">{{ ucfirst($data->status_pendaftaran) }}</td>
                    <td class="status">{{ str_replace('_', ' ', ucfirst($data->status_pembayaran)) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data pendaftaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">
        Total Pendaftaran: {{ $pendaftarans->count() }} Data
    </div>

    <div class="footer">
        Dokumen ini dibuat secara otomatis oleh sistem EventHub.
    </div>

</body>
</html>