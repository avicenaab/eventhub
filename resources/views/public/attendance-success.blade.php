@extends('public.layout')
@section('title','Presensi Berhasil')
@section('content')
<section class="public-section confirmation">
    <div class="success-mark">✓</div>
    <p class="eyebrow">CHECK-IN SUCCESSFUL</p>
    <h1>Presensi berhasil dicatat</h1>
    <p class="muted">Terima kasih, {{ $pendaftaran->peserta->nama }}. Kehadiranmu untuk event berikut sudah tercatat.</p>
    <div class="confirmation-card">
        <div><small>NAMA EVENT</small><strong>{{ $pendaftaran->event->nama_event }}</strong></div>
        <div><small>WAKTU PRESENSI</small><strong>{{ now()->format('d M Y, H:i') }}</strong></div>
        <div><small>STATUS</small><strong>Hadir</strong></div>
    </div>
    <a class="btn outline" href="{{ route('home') }}">Kembali ke beranda</a>
</section>
@endsection
