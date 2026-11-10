<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta - EventHub</title>
    <!-- Memanggil CSS Bootstrap agar tampilan rapi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Data Peserta EventHub</h2>
        
        <!-- Tombol untuk menambah data (akan kita fungsikan di langkah selanjutnya) -->
        <a href="{{ route('pesertas.create') }}" class="btn btn-primary mb-3">Tambah Peserta Baru</a>

        <!-- Tempat memunculkan pesan sukses -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data Peserta -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
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
                <!-- Melakukan perulangan data peserta dari database -->
                @forelse($pesertas as $index => $peserta)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->email }}</td>
                        <td>{{ $peserta->no_hp }}</td>
                        <td>{{ $peserta->instansi }}</td>
                        <td>
                            <!-- Tombol aksi sementara (akan kita aktifkan nanti) -->
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data peserta.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>