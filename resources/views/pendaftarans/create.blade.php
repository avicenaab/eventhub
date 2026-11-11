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

        <br><br>

        <label>Peserta</label>
        <select name="peserta_id" required>
            <option value="">-- Pilih Peserta --</option>
            @foreach ($pesertas as $peserta)
                <option value="{{ $peserta->id }}">
                    {{ $peserta->nama }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Event</label>
        <select name="event_id" required>
            <option value="">-- Pilih Event --</option>
            @foreach ($events as $event)
                <option value="{{ $event->id }}">
                    {{ $event->nama_event }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Status Pendaftaran</label>
        <select name="status_pendaftaran">
            <option value="menunggu">Menunggu</option>
            <option value="diterima">Diterima</option>
            <option value="ditolak">Ditolak</option>
        </select>

        <br><br>

        <label>Status Pembayaran</label>
        <select name="status_pembayaran">
            <option value="belum_bayar">Belum Bayar</option>
            <option value="sudah_bayar">Sudah Bayar</option>
        </select>

        <br><br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('pendaftarans.index') }}">Kembali</a>
</body>
</html>