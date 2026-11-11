@extends('presensis.layout')

@section('title', 'Data Presensi')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .page-header h1 {
        font-size: 28px;
        color: #263248;
        margin-bottom: 8px;
    }

    .page-header p {
        color: #64748b;
        margin: 0;
    }

    .btn-add {
        background: #2563eb;
        color: white;
        padding: 12px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
    }

    .btn-add:hover {
        background: #1d4ed8;
        color: white;
    }

    .alert {
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 18px;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
    }

    .alert-error {
        background: #fee2e2;
        color: #b91c1c;
    }

    .filter-card,
    .table-card {
        background: white;
        padding: 25px;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        margin-bottom: 22px;
    }

    .filter-card h3,
    .table-card h3 {
        font-size: 18px;
        color: #263248;
        margin-bottom: 18px;
    }

    .search-form {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .search-form input,
    .search-form select {
        flex: 1;
        min-width: 180px;
        padding: 11px 13px;
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        font-size: 13px;
    }

    .btn-search,
    .btn-reset {
        padding: 11px 18px;
        border-radius: 7px;
        border: none;
        text-decoration: none;
        font-size: 13px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn-search {
        background: #2563eb;
        color: white;
    }

    .btn-reset {
        background: #e2e8f0;
        color: #334155;
    }

    .table-wrap {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 750px;
    }

    th {
        background: #172554;
        color: white;
        padding: 14px 12px;
        text-align: left;
        font-size: 13px;
    }

    td {
        padding: 14px 12px;
        border-bottom: 1px solid #e2e8f0;
        font-size: 13px;
        color: #334155;
    }

    tr:hover td {
        background: #f8fafc;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        background: #e0e7ff;
        color: #3730a3;
    }

    .actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .actions a,
    .actions button {
        padding: 7px 11px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: bold;
        text-decoration: none;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-detail {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .btn-edit {
        background: #fef3c7;
        color: #92400e;
    }

    .btn-delete {
        background: #fee2e2;
        color: #b91c1c;
    }

    .empty-state {
        text-align: center;
        color: #64748b;
        padding: 30px;
    }

    .pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-top: 22px;
        flex-wrap: wrap;
        font-size: 13px;
        color: #64748b;
    }

    .pagination a {
        color: #2563eb;
        text-decoration: none;
        font-weight: bold;
    }

    .pagination span {
        color: #94a3b8;
    }
</style>

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
                            Belum ada data presensi atau data tidak ditemukan.
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

@endsection