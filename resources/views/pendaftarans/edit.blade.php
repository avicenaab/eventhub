<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pendaftaran</title>
</head>
<body>
    <h1>Edit Pendaftaran Event</h1>

    <form action="{{ route('pendaftarans.update', $pendaftaran->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Tanggal Daftar</label>
        <input type="date" name="tanggal_daftar"
            value="{{ $pendaftaran->tanggal_daftar }}" required>

        <br><br>

        <label>ID Peserta</label>
        <input type="number" name="peserta_id"
            value="{{ $pendaftaran->peserta_id }}" required>

        <br><br>

        <label>ID Event</label>
        <input type="number" name="event_id"
            value="{{ $pendaftaran->event_id }}" required>

        <br><br>

        <label>Status Pendaftaran</label>
        <select name="status_pendaftaran">
            <option value="menunggu"
                {{ $pendaftaran->status_pendaftaran == 'menunggu' ? 'selected' : '' }}>
                Menunggu
            </option>

            <option value="diterima"
                {{ $pendaftaran->status_pendaftaran == 'diterima' ? 'selected' : '' }}>
                Diterima
            </option>

            <option value="ditolak"
                {{ $pendaftaran->status_pendaftaran == 'ditolak' ? 'selected' : '' }}>
                Ditolak
            </option>
        </select>

        <br><br>

        <label>Status Pembayaran</label>
        <select name="status_pembayaran">
            <option value="belum_bayar"
                {{ $pendaftaran->status_pembayaran == 'belum_bayar' ? 'selected' : '' }}>
                Belum Bayar
            </option>

            <option value="sudah_bayar"
                {{ $pendaftaran->status_pembayaran == 'sudah_bayar' ? 'selected' : '' }}>
                Sudah Bayar
            </option>
        </select>

        <br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <br>
    <a href="{{ route('pendaftarans.index') }}">Kembali</a>
</body>
</html>