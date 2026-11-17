@extends('layouts.admin')

@section('title', 'Data Presensi')

@section('content')
@push('styles')<style>.th-sort{display:inline-flex;align-items:center;justify-content:center;margin-left:5px;width:22px;height:22px;border:1px solid var(--border);border-radius:6px;color:var(--muted);text-decoration:none;font-size:13px;vertical-align:middle}.th-sort:hover{color:var(--teal);border-color:var(--teal);background:var(--surface-2)}</style>@endpush
<div class="presensi-page">
<div class="legacy-module-page">
@push('styles')
@endpush



<div class="page-header">
    <div>
        <h1>Data Presensi</h1>
        <p>Kelola data kehadiran peserta EventHub.</p>
    </div>

    <a href="{{ route('presensis.create') }}" class="btn-add">
        + Tambah Presensi
    </a>
</div>

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

<div class="filter-card">
    <h3>Pencarian dan Filter</h3>

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

        <button type="submit" class="btn-search">Cari</button>

        <a href="{{ route('presensis.index') }}" class="btn-reset">
            Reset
        </a>
    </form>
</div>

<div class="table-card">
    <h3>Daftar Kehadiran Peserta</h3>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Nama Event</th>
                    <th>Waktu Hadir <a class="th-sort" title="Urutkan waktu hadir" href="{{ route('presensis.index', array_merge(request()->query(), ['sort' => ($sort ?? 'terbaru') === 'terbaru' ? 'terlama' : 'terbaru'])) }}">⇅</a></th>
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
                            <span class="status-badge">
                                {{ ucfirst(str_replace('_', ' ', $presensi->status_kehadiran)) }}
                            </span>
                        </td>

                        <td>
                            <div class="actions">
                                <a href="{{ route('presensis.show', $presensi->id) }}"
                                   class="btn-detail">
                                    Detail
                                </a>

                                <a href="{{ route('presensis.edit', $presensi->id) }}"
                                   class="btn-edit">
                                    Edit
                                </a>

                                <form action="{{ route('presensis.destroy', $presensi->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus presensi ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-delete">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            @if($presensis->total() === 0 && !request()->filled('search') && !request()->filled('status_kehadiran'))
                                Belum ada data presensi. Data akan muncul di sini setelah pendaftaran memiliki catatan kehadiran.
                            @else
                                Data presensi tidak ditemukan. Coba ubah kata kunci atau filter pencarian.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($presensis->hasPages())
        <div class="pagination">
            <div>
                @if($presensis->onFirstPage())
                    <span>Sebelumnya</span>
                @else
                    <a href="{{ $presensis->previousPageUrl() }}">Sebelumnya</a>
                @endif
            </div>

            <span>
                Halaman {{ $presensis->currentPage() }}
                dari {{ $presensis->lastPage() }}
            </span>

            <div>
                @if($presensis->hasMorePages())
                    <a href="{{ $presensis->nextPageUrl() }}">Selanjutnya</a>
                @else
                    <span>Selanjutnya</span>
                @endif
            </div>
        </div>
    @endif
</div>

</div>
</div>
@endsection