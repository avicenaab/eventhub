@extends('layouts.admin')

@section('title', 'Events')

@section('content')
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
<style>.event-detail-map{height:320px;width:100%;border-radius:12px;overflow:hidden;background:#252525}.map-attribution-note{display:block;text-align:right;color:#9ca3af;font-size:10px;margin-top:6px}.map-attribution-note a{color:#9ca3af}</style>
@endpush
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>document.addEventListener('DOMContentLoaded',()=>{const el=document.getElementById('event-detail-map');if(!el||typeof L==='undefined')return;const point=[Number(el.dataset.latitude),Number(el.dataset.longitude)];const map=L.map(el,{scrollWheelZoom:false}).setView(point,15);L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:19,attribution:'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);L.marker(point).addTo(map);});</script>
@endpush
<div class="legacy-module-page">
<div class="header">
            <h1>Detail Event</h1>
            <p>Informasi lengkap mengenai event yang terdaftar di EventHub.</p>
        </div>

        <div class="detail-card">

            <div class="event-title">
                <h2>{{ $event->nama_event }}</h2>

                <span class="status {{ $event->status_event }}">
                    {{ ucfirst($event->status_event) }}
                </span>
            </div>

            <div class="detail-grid">

                <div class="detail-item full">
                    <label>Deskripsi Event</label>
                    <p class="description">{{ $event->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                </div>

                <div class="detail-item">
                    <label>Tanggal Mulai</label>
                    <p>{{ $event->tanggal_mulai->format('d-m-Y H:i') }}</p>
                </div>

                <div class="detail-item">
                    <label>Tanggal Selesai</label>
                    <p>{{ $event->tanggal_selesai?->format('d-m-Y H:i') ?? '-' }}</p>
                </div>

                <div class="detail-item">
                    <label>Lokasi</label>
                    <p>{{ $event->lokasi }}</p>
                </div>

                @if($event->latitude !== null && $event->longitude !== null)
                    <div class="detail-item full">
                        <label>Lokasi pada Peta</label>
                        <div id="event-detail-map" class="event-detail-map" data-latitude="{{ $event->latitude }}" data-longitude="{{ $event->longitude }}"></div>
                        <small class="map-attribution-note">© <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap contributors</a></small>
                    </div>
                @else
                    <div class="detail-item full"><label>Lokasi pada Peta</label><p>Koordinat peta belum ditambahkan untuk event ini.</p></div>
                @endif

                <div class="detail-item">
                    <label>Kuota Peserta</label>
                    <p>{{ $event->kuota }} Peserta</p>
                </div>

                <div class="detail-item">
                    <label>Biaya Pendaftaran</label>
                    <p>Rp {{ number_format((float)$event->biaya, 0, ',', '.') }}</p>
                </div>

                <div class="detail-item">
                    <label>Status Event</label>
                    <p>{{ ucfirst($event->status_event) }}</p>
                </div>

            </div>

            <div class="actions">
                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-edit">
                    Edit Event
                </a>

                <a href="{{ route('events.index') }}" class="btn btn-back">
                    Kembali
                </a>
            </div>
</div>
@endsection

