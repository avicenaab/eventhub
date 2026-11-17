@extends('layouts.admin')
@section('title','Peserta')
@section('content')
@push('styles')<style>.th-sort{display:inline-flex;align-items:center;justify-content:center;margin-left:5px;width:22px;height:22px;border:1px solid var(--border);border-radius:6px;color:var(--muted);text-decoration:none;font-size:13px;vertical-align:middle}.th-sort:hover{color:var(--teal);border-color:var(--teal);background:var(--surface-2)}</style>@endpush
<div class="page-heading">
    <div>
        <p class="eyebrow">MANAGEMENT</p>
        <h1>Peserta</h1>
        <p class="muted">Kelola identitas peserta EventHub.</p>
    </div>
    <a class="btn primary" href="{{ route('pesertas.create') }}">＋ Tambah peserta</a>
</div>
<form class="filter-bar" method="GET">
    <input name="search" value="{{ request('search') }}" placeholder="Cari nama, email, atau instansi...">
    <button class="btn outline" type="submit">Terapkan</button>
</form>
<section class="panel">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Instansi</th>
                    <th>Tanggal Ditambahkan <a class="th-sort" title="Urutkan tanggal" href="{{ route('pesertas.index', array_merge(request()->query(), ['sort' => ($sort ?? 'terbaru') === 'terbaru' ? 'terlama' : 'terbaru'])) }}">⇅</a></th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesertas as $peserta)
                <tr>
                    <td><b>{{ $peserta->nama }}</b></td>
                    <td>{{ $peserta->email }}</td>
                    <td>{{ $peserta->no_hp }}</td>
                    <td>{{ $peserta->instansi }}</td>
                    <td>{{ $peserta->created_at?->format('d M Y H:i') ?? '-' }}</td>
                    <td>
                        <div class="table-actions">
                            <a class="btn small outline" href="{{ route('pesertas.edit',$peserta) }}">Edit</a>
                            <form method="POST" action="{{ route('pesertas.destroy',$peserta) }}" data-confirm="Hapus peserta ini?">
                                <button class="btn small danger">Hapus</button>
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">Belum ada data peserta.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">
        {{ $pesertas->links() }}
    </div>
</section>
@endsection
