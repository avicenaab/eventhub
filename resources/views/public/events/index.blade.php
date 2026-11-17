@extends('public.layout')
@section('title','Jelajahi Event')
@section('content')
<section class="public-section">
    <p class="eyebrow">EVENT DIRECTORY</p>
    <h1>Jelajahi event</h1>
    <p class="muted">Temukan kegiatan yang sesuai dengan minatmu.</p>
    <form class="filter-bar">
        <input name="q" value="{{ request('q') }}" placeholder="Cari nama event atau lokasi">
        <button class="btn primary">Cari</button>
    </form>
    <div class="event-grid">
        @forelse($events as $event)
            <article class="event-card">
                <div class="event-card-top">
                    <span class="event-tag">{{ $event->status_event }}</span>
                    <span class="event-date">{{ $event->tanggal_mulai->format('d M Y') }}</span>
                </div>
                <h3>{{ $event->nama_event }}</h3>
                <p>{{ Str::limit($event->deskripsi,100) }}</p>
                <div class="event-info">
                    <span>⌖ {{ $event->lokasi }}</span>
                    <strong>{{ $event->biaya > 0 ? 'Rp '.number_format($event->biaya,0,',','.') : 'Gratis' }}</strong>
                </div>
                <a class="btn outline full" href="{{ route('public.events.show',$event) }}">Lihat detail</a>
            </article>
        @empty
            <div class="empty-state">
                <h3>Event tidak ditemukan</h3>
                <p>Coba kata kunci lain.</p>
            </div>
        @endforelse
    </div>
    <div class="pagination-wrap">
        {{ $events->links() }}
    </div>
</section>
@endsection
