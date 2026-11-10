
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Event</title>
</head>
<body>
<h1>Detail Event</h1>

<p><b>Nama:</b> {{ $event->nama_event }}</p>
<p><b>Deskripsi:</b> {{ $event->deskripsi ?? '-' }}</p>
<p><b>Tanggal Mulai:</b> {{ $event->tanggal_mulai->format('d-m-Y H:i') }}</p>
<p><b>Tanggal Selesai:</b>
    {{ $event->tanggal_selesai?->format('d-m-Y H:i') ?? '-' }}
</p>
<p><b>Lokasi:</b> {{ $event->lokasi }}</p>
<p><b>Kuota:</b> {{ $event->kuota }}</p>
<p><b>Biaya:</b> Rp {{ number_format((float)$event->biaya, 0, ',', '.') }}</p>
<p><b>Status:</b> {{ ucfirst($event->status_event) }}</p>

<a href="{{ route('events.edit', $event->id) }}">Edit</a>
<a href="{{ route('events.index') }}">Kembali</a>
</body>
</html>
