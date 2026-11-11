<!DOCTYPE html>
<html>
<head>
    <title>Data Pendaftaran EventHub</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #eeeeee;
        }
    </style>
</head>
<body>

    <h2>Data Pendaftaran EventHub</h2>

    <table>
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
        @foreach ($pendaftarans as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->tanggal_daftar }}</td>
                <td>{{ $data->peserta->nama ?? '-' }}</td>
                <td>{{ $data->event->nama_event ?? '-' }}</td>
                <td>{{ $data->status_pendaftaran }}</td>
                <td>{{ $data->status_pembayaran }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>