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

    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Tanggal Daftar</th>
            <th>ID Peserta</th>
            <th>ID Event</th>
            <th>Status Pendaftaran</th>
            <th>Status Pembayaran</th>
            <th>Aksi</th>
        </tr>

        @foreach ($pendaftarans as $pendaftaran)
            <tr>
                <td>{{ $pendaftaran->id }}</td>
                <td>{{ $pendaftaran->tanggal_daftar }}</td>
                <td>{{ $pendaftaran->peserta_id }}</td>
                <td>{{ $pendaftaran->event_id }}</td>
                <td>{{ $pendaftaran->status_pendaftaran }}</td>
                <td>{{ $pendaftaran->status_pembayaran }}</td>

                <td>
                    <a href="{{ route('pendaftarans.edit', $pendaftaran->id) }}">
                        Edit
                    </a>

                    <form action="{{ route('pendaftarans.destroy', $pendaftaran->id) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>