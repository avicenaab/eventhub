@extends('layouts.admin')

@section('title', 'Pendaftaran')

@push('styles')
<style>
.legacy-module-page{color:var(--text);width:100%;}
.legacy-module-page .topbar{display:flex;justify-content:space-between;align-items:center;gap:16px;margin:0 0 24px;padding:0 0 18px;border-bottom:1px solid var(--border);}
.legacy-module-page .topbar h1{color:var(--text);font-size:28px;margin:0 0 6px;}
.legacy-module-page .topbar p,.legacy-module-page .section-header p{color:var(--muted);}
.legacy-module-page .profile,.legacy-module-page .stat-card,.legacy-module-page .content-card{background:var(--surface);color:var(--text);border:1px solid var(--border);box-shadow:none;border-radius:14px;}
.legacy-module-page .stats{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px;margin-bottom:22px;}
.legacy-module-page .stat-card{padding:22px;}.legacy-module-page .stat-card p{color:var(--muted);}.legacy-module-page .stat-card h2,.legacy-module-page .section-header h2{color:var(--text);}
.legacy-module-page .content-card{padding:22px;}.legacy-module-page .section-header{display:flex;justify-content:space-between;align-items:center;gap:14px;margin-bottom:18px;}
.legacy-module-page .toolbar{display:flex;flex-wrap:wrap;gap:10px;margin-bottom:18px;}
.legacy-module-page input,.legacy-module-page select{background:var(--surface-2);color:var(--text);border:1px solid var(--border);border-radius:9px;padding:11px 13px;}
.legacy-module-page .table-wrapper{overflow-x:auto;}.legacy-module-page table{width:100%;border-collapse:collapse;min-width:760px;}
.legacy-module-page th{background:var(--surface-2);color:var(--muted);font-size:12px;text-align:left;letter-spacing:.03em;}
.legacy-module-page td,.legacy-module-page th{padding:13px 14px;border-bottom:1px solid var(--border);color:var(--text);}
.legacy-module-page tr:hover td{background:rgba(255,255,255,.025);}
.legacy-module-page .btn{display:inline-flex;align-items:center;justify-content:center;padding:10px 14px;border-radius:9px;font-weight:600;border:1px solid transparent;cursor:pointer;}
.legacy-module-page .btn-primary{background:var(--teal);color:#10201e;}.legacy-module-page .btn-green{background:rgba(85,214,194,.14);color:var(--teal);}.legacy-module-page .btn-purple{background:rgba(180,154,255,.14);color:var(--purple);}.legacy-module-page .btn-gray{background:var(--surface-2);color:var(--text);border-color:var(--border);}.legacy-module-page .btn-red{background:rgba(239,119,119,.14);color:var(--red);}
.legacy-module-page .badge{display:inline-flex;padding:5px 10px;border-radius:999px;background:var(--surface-2);color:var(--text);font-size:12px;}
.legacy-module-page .action{display:flex;align-items:center;gap:7px;}.legacy-module-page .action form{margin:0;}
.legacy-module-page .alert{padding:12px 15px;border-radius:10px;margin-bottom:14px;}.legacy-module-page .alert-success{background:rgba(85,214,194,.12);color:var(--teal);}.legacy-module-page .alert-error{background:rgba(239,119,119,.12);color:var(--red);}
@media(max-width:760px){.legacy-module-page .stats{grid-template-columns:1fr;}.legacy-module-page .section-header,.legacy-module-page .topbar{align-items:flex-start;flex-direction:column;}}
</style>
@endpush

@section('content')
@push('styles')<style>.th-sort{display:inline-flex;align-items:center;justify-content:center;margin-left:5px;width:22px;height:22px;border:1px solid var(--border);border-radius:6px;color:var(--muted);text-decoration:none;font-size:13px;vertical-align:middle}.th-sort:hover{color:var(--teal);border-color:var(--teal);background:var(--surface-2)}</style>@endpush
<div class="legacy-module-page">
<div class="topbar">
            <div>
                <h1>Data Pendaftaran</h1>
                <p>Kelola seluruh pendaftaran event dalam satu tempat.</p>
            </div>

            <div class="profile">Admin EventHub</div>
        </div>

        <!-- ALERT -->
        @if (session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- STATISTICS -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-icon">▤</div>
                <p>Total Pendaftaran</p>
                <h2>{{ $totalPendaftaran ?? $pendaftarans->total() }}</h2>
            </div>

            <div class="stat-card">
                <div class="stat-icon">◷</div>
                <p>Pendaftaran Menunggu</p>
                <h2>{{ $menunggu ?? 0 }}</h2>
            </div>
        </div>

        <!-- TABLE CARD -->
        <section class="content-card">

            <div class="section-header">
                <div>
                    <h2>Daftar Pendaftaran</h2>
                    <p>Informasi peserta dan event yang terdaftar.</p>
                </div>

                <a href="{{ route('pendaftarans.create') }}"
                   class="btn btn-primary">
                    + Tambah Pendaftaran
                </a>
            </div>

            <div class="toolbar">
                <a href="{{ route('data-management.index') }}" class="btn btn-purple">⇅ Import / Export semua data</a>
                <a href="{{ route('analytics.index') }}" class="btn btn-green">▥ Buka Analitik</a>
            </div>

            <!-- SEARCH -->
            <!-- SEARCH DAN SORTIR -->
<form action="{{ route('pendaftarans.index') }}" method="GET" class="toolbar">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari peserta atau event...">
    <button type="submit" class="btn btn-gray">Terapkan</button>
</form>

<!-- TABLE -->
<div class="table-wrapper">
    <table id="pendaftaranTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal Daftar <a class="th-sort" title="Urutkan tanggal" href="{{ route('pendaftarans.index', array_merge(request()->query(), ['sort' => ($sort ?? 'terbaru') === 'terbaru' ? 'terlama' : 'terbaru'])) }}">⇅</a></th>
                <th>Nama Peserta</th>
                <th>Nama Event</th>
                <th>Status Pendaftaran</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($pendaftarans as $pendaftaran)
                <tr>
                    <td>#{{ $pendaftaran->id }}</td>
                    <td>{{ $pendaftaran->tanggal_daftar }}</td>
                    <td>{{ $pendaftaran->peserta->nama ?? '-' }}</td>
                    <td>{{ $pendaftaran->event->nama_event ?? '-' }}</td>

                    <td>
                        <span class="badge {{ strtolower($pendaftaran->status_pendaftaran) }}">
                            {{ ucfirst($pendaftaran->status_pendaftaran) }}
                        </span>
                    </td>

                    <td>
                        <span class="badge {{ strtolower($pendaftaran->status_pembayaran) }}">
                            {{ str_replace('_', ' ', ucfirst($pendaftaran->status_pembayaran)) }}
                        </span>
                    </td>

                    <td>
                        <div class="action">
                            <a href="{{ route('pendaftarans.edit', $pendaftaran->id) }}"
                               class="btn btn-gray">Edit</a>

                            <form action="{{ route('pendaftarans.destroy', $pendaftaran->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-red">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty">
                        Belum ada data pendaftaran.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


        </section>
        <div class="pagination-wrap">{{ $pendaftarans->links() }}</div>
</div>
@endsection


