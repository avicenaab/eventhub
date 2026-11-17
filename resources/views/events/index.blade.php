@extends('layouts.admin')

@section('title', 'Events')

@section('content')
@push('styles')<style>.th-sort{display:inline-flex;align-items:center;justify-content:center;margin-left:5px;width:22px;height:22px;border:1px solid var(--border);border-radius:6px;color:var(--muted);text-decoration:none;font-size:13px;vertical-align:middle}.th-sort:hover{color:var(--teal);border-color:var(--teal);background:var(--surface-2)}</style>@endpush
<div class="legacy-module-page">
<div class="header">
            <div>
                <h1>Data Events</h1>
                <p>Kelola informasi kegiatan dan event EventHub.</p>
            </div>

            <a href="{{ route('events.create') }}" class="btn-add">
                + Tambah Event
            </a>
        </div>

        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert error">
                {{ session('error') }}
            </div>
        @endif
        <div class="table-card">

            <h3>Daftar Events</h3>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Event</th>
                        <th>Tanggal Mulai <a class="th-sort" title="Urutkan tanggal" href="{{ route('events.index', array_merge(request()->query(), ['sort' => ($sort ?? 'terbaru') === 'terbaru' ? 'terlama' : 'terbaru'])) }}">⇅</a></th>
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
                            <td>
                                Rp {{ number_format((float)$event->biaya, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="status">
                                    {{ ucfirst($event->status_event) }}
                                </span>
                            </td>
                            <td>
                                <div class="actions">

                                    <a class="btn-detail"
                                       href="{{ route('events.show', $event->id) }}">
                                        Detail
                                    </a>

                                    <a class="btn-edit"
                                       href="{{ route('events.edit', $event->id) }}">
                                        Edit
                                    </a>

                                    <form action="{{ route('events.destroy', $event->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus event ini?')">
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
                            <td colspan="8" class="empty">
                                Belum ada data event.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination">
                {{ $events->links() }}
            </div>

        </div>
</div>
@endsection

