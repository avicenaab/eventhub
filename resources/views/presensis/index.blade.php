@extends('presensis.layout')

@section('title', 'Data Presensi')

@section('content')

    <h1>Data Presensi Peserta</h1>
    <p>Kelola data kehadiran peserta EventHub.</p>

    <a href="{{ route('presensis.create') }}" class="btn">
        + Tambah Presensi
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- Pencarian dan filter --}}
    <form action="{{ route('presensis.index') }}"
          method="GET"
          class="search-form">

        <input
            type="text"
            name="search"
            placeholder="Cari nama peserta atau event..."
            value="{{ request('search') }}">

        <select name="status_kehadiran">
            <option value="">Semua Status</option>

            @foreach(['belum_hadir', 'hadir', 'izin', 'sakit', 'alpa'] as $status)
                <option value="{{ $status }}"
                    {{ request('status_kehadiran') == $status ? 'selected' : '' }}>
                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                </option>
            @endforeach
        </select>

        <button type="submit">Cari</button>

        <a href="{{ route('presensis.index') }}"
           class="btn btn-secondary">
            Reset
        </a>
    </form>

    {{-- Tabel data --}}
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Nama Event</th>
                    <th>Waktu Hadir</th>
                    <th>Status Kehadiran</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($presensis as $presensi)
                    <tr>
                        <td>
                            {{ $presensis->firstItem() + $loop->index }}
                        </td>

                        <td>
                            {{ data_get($presensi, 'pendaftaran.peserta.nama', '-') }}
                        </td>

                        <td>
                            {{ data_get($presensi, 'pendaftaran.event.nama_event', '-') }}
                        </td>

                        <td>
                            {{ $presensi->waktu_hadir
                                ? $presensi->waktu_hadir->format('d/m/Y H:i')
                                : '-' }}
                        </td>

                        <td>
                            {{ ucfirst(str_replace('_', ' ', $presensi->status_kehadiran)) }}
                        </td>

                        <td>
                            <div class="actions">
                                <a href="{{ route('presensis.show', $presensi->id) }}"
                                   class="btn btn-success">
                                    Detail
                                </a>

                                <a href="{{ route('presensis.edit', $presensi->id) }}"
                                   class="btn">
                                    Edit
                                </a>

                                <form action="{{ route('presensis.destroy', $presensi->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus presensi ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            Belum ada data presensi atau data tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($presensis->hasPages())
        <div class="pagination">
            <div>
                @if($presensis->onFirstPage())
                    <span>Sebelumnya</span>
                @else
                    <a href="{{ $presensis->previousPageUrl() }}">
                        Sebelumnya
                    </a>
                @endif
            </div>

            <span>
                Halaman {{ $presensis->currentPage() }}
                dari {{ $presensis->lastPage() }}
            </span>

            <div>
                @if($presensis->hasMorePages())
                    <a href="{{ $presensis->nextPageUrl() }}">
                        Selanjutnya
                    </a>
                @else
                    <span>Selanjutnya</span>
                @endif
            </div>
        </div>
    @endif

@endsection