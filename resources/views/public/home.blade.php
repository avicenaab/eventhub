@extends('public.layout')
@section('title','Temukan Event')
@section('content')
<section class="hero">
    <p class="eyebrow">DISCOVER · CONNECT · EXPERIENCE</p>
    <h1>Temukan event.<br><span>Buat pengalaman.</span></h1>
    <p class="hero-copy">Jelajahi kegiatan menarik dan daftarkan dirimu dengan mudah melalui EventHub.</p>
    <form class="hero-search" action="{{ route('public.events.index') }}">
        <input name="q" placeholder="Cari event atau lokasi...">
        <button class="btn primary">Jelajahi</button>
    </form>
    <div class="hero-meta">
        <span>● Pendaftaran mudah</span>
        <span>● Tanpa perlu membuat akun</span>
    </div>
</section>
<section class="public-section">
    <div class="section-heading">
        <div>
            <p class="eyebrow">UPCOMING</p>
            <h2>Event pilihan</h2>
        </div>
        <a class="text-link" href="{{ route('public.events.index') }}">Lihat semua event →</a>
    </div>
    <div class="event-grid">
        @forelse($events as $event)
            <article class="event-card">
                <div class="event-card-top">
                    <span class="event-tag">{{ $event->status_event }}</span>
                    <span class="event-date">{{ $event->tanggal_mulai->format('d M Y') }}</span>
                </div>
                <h3>{{ $event->nama_event }}</h3>
                <p>{{ Str::limit($event->deskripsi, 100) }}</p>
                <div class="event-info">
                    <span>⌖ {{ $event->lokasi }}</span>
                    <strong>{{ $event->biaya > 0 ? 'Rp '.number_format($event->biaya,0,',','.') : 'Gratis' }}</strong>
                </div>
                <a class="btn outline full" href="{{ route('public.events.show',$event) }}">Lihat detail</a>
            </article>
        @empty
            <div class="empty-state">
                <h3>Belum ada event tersedia</h3>
                <p>Silakan kembali lagi nanti untuk melihat event terbaru.</p>
            </div>
        @endforelse
    </div>
</section>
@endsection
