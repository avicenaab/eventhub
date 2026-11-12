@extends('public.layout')
@section('title',$event->nama_event)
@section('content')
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
<style>.public-event-map{height:330px;width:100%;border-radius:14px;overflow:hidden;margin-top:18px;background:#252525}.map-attribution-note{display:block;text-align:right;color:#9ca3af;font-size:10px;margin-top:6px}.map-attribution-note a{color:#9ca3af}</style>
@endpush
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>document.addEventListener('DOMContentLoaded',()=>{const el=document.getElementById('public-event-map');if(!el||typeof L==='undefined')return;const point=[Number(el.dataset.latitude),Number(el.dataset.longitude)];const map=L.map(el,{scrollWheelZoom:false}).setView(point,15);L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:19,attribution:'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);L.marker(point).addTo(map);});</script>
@endpush
<section class="public-section detail-layout">
    <article class="detail-main">
        <a class="text-link" href="{{ route('public.events.index') }}">← Semua event</a>~
        <p class="eyebrow">EVENT DETAIL</p>
        <h1>{{ $event->nama_event }}</h1>
        <p class="lead">{{ $event->deskripsi }}</p>
        <div class="detail-facts">
            <div>
                <small>TANGGAL</small>
                <strong>{{ $event->tanggal_mulai->format('d M Y, H:i') }}</strong>
            </div>
            <div>
                <small>LOKASI</small>
                <strong>{{ $event->lokasi }}</strong>
            </div>
            <div>
                <small>BIAYA</small>
                <strong>{{ $event->biaya > 0 ? 'Rp '.number_format($event->biaya,0,',','.') : 'Gratis' }}</strong>
            </div>
        </div>
        @if($event->latitude !== null && $event->longitude !== null)
            <h2 class="map-section-title">Lokasi Event</h2>
            <div id="public-event-map" class="public-event-map" data-latitude="{{ $event->latitude }}" data-longitude="{{ $event->longitude }}"></div>
            <small class="map-attribution-note">© <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap contributors</a></small>
        @endif
    </article>
    <aside class="register-panel">
        <p class="eyebrow">REGISTRATION</p>
        <h2>{{ $remaining }} slot tersisa</h2>
        <p class="muted">Kuota tersedia: {{ $event->kuota }} peserta.</p>
        @if($remaining > 0)
            <a class="btn primary full" href="{{ route('public.events.register',$event) }}">Daftar sekarang</a>
        @else
            <button class="btn disabled full" disabled>Kuota penuh</button>
        @endif
        <p class="tiny muted">Pendaftaran tidak memerlukan akun.</p>
    </aside>
</section>
@endsection
