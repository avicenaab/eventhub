<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftaran</title>
</head>
<body>
    <h1>Data Pendaftaran</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('pendaftarans.create') }}">Tambah Pendaftaran</a>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Tanggal Daftar</th>
            <th>ID Peserta</th>
            <th>ID Event</th>
            <th>Status Pendaftaran</th>
            <th>Status Pembayaran</th>
        </tr>

        @foreach ($pendaftarans as $pendaftaran)
            <tr>
                <td>{{ $pendaftaran->id }}</td>
                <td>{{ $pendaftaran->tanggal_daftar }}</td>
                <td>{{ $pendaftaran->peserta_id }}</td>
                <td>{{ $pendaftaran->event_id }}</td>
                <td>{{ $pendaftaran->status_pendaftaran }}</td>
                <td>{{ $pendaftaran->status_pembayaran }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>