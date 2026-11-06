<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pendaftaran</title>
</head>
<body>
    <h1>Form Pendaftaran Event</h1>

    <form action="{{ route('pendaftarans.store') }}" method="POST">
        @csrf

        <label>Tanggal Daftar</label>
        <input type="date" name="tanggal_daftar" required>

        <label>ID Peserta</label>
        <input type="number" name="peserta_id" required>

        <label>ID Event</label>
        <input type="number" name="event_id" required>

        <label>Status Pendaftaran</label>
        <select name="status_pendaftaran">
            <option value="menunggu">Menunggu</option>
            <option value="diterima">Diterima</option>
            <option value="ditolak">Ditolak</option>
        </select>

        <label>Status Pembayaran</label>
        <select name="status_pembayaran">
            <option value="belum_bayar">Belum Bayar</option>
            <option value="sudah_bayar">Sudah Bayar</option>
        </select>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('pendaftarans.index') }}">Kembali</a>
</body>
</html>