
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Events</title>
    <style>
        body { font-family: Arial; margin: 40px; background: #f5f5f5; }
        .container { background: white; padding: 25px; border-radius: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #222; color: white; }
        a, button { padding: 7px 12px; text-decoration: none; border: none; cursor: pointer; border-radius: 4px; }
        .add { background: #198754; color: white; }
        .edit { background: #ffc107; color: black; }
        .detail { background: #0d6efd; color: white; }
        .delete { background: #dc3545; color: white; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
<div class="container">
    <h1>Daftar Events</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <a href="{{ route('events.create') }}" class="add">+ Tambah Event</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Event</th>
                <th>Tanggal Mulai</th>
                <th>Lokasi</th>
                <th>Kuota</th>
                <th>Biaya</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
                <tr>
                    <td>{{ $events->firstItem() + $loop->index }}</td>
                    <td>{{ $event->nama_event }}</td>
                    <td>{{ $event->tanggal_mulai->format('d-m-Y H:i') }}</td>
                    <td>{{ $event->lokasi }}</td>
                    <td>{{ $event->kuota }}</td>
                    <td>Rp {{ number_format((float)$event->biaya, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($event->status_event) }}</td>
                    <td>
                        <a class="detail" href="{{ route('events.show', $event->id) }}">Detail</a>
                        <a class="edit" href="{{ route('events.edit', $event->id) }}">Edit</a>

                        <form action="{{ route('events.destroy', $event->id) }}"
                              method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="delete"
                                onclick="return confirm('Yakin ingin menghapus event ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada data event.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $events->links() }}
</div>
</body>
</html>
