@extends('public.layout')
@section('title','Konfirmasi Pendaftaran')
@section('content')
<section class="public-section confirmation">
    <div class="success-mark">✓</div>
    <p class="eyebrow">REGISTRATION RECEIVED</p>
    <h1>Pendaftaran berhasil dikirim</h1>
    <p class="muted">Simpan halaman ini sebagai bukti bahwa pendaftaranmu sudah diterima sistem.</p>
    <div class="confirmation-card">
        <div>
            <small>KODE PRESENSI</small>
            <strong>{{ $pendaftaran->attendance_code }}</strong>
        </div>
        <div>
            <small>NAMA</small>
            <strong>{{ $pendaftaran->peserta->nama }}</strong>
        </div>
        <div>
            <small>EVENT</small>
            <strong>{{ $pendaftaran->event->nama_event }}</strong>
        </div>
        <div>
            <small>STATUS</small>
            <strong>{{ ucfirst($pendaftaran->status_pendaftaran) }}</strong>
        </div>
    </div>
    <a class="btn primary" href="{{ route('public.attendance.form') }}">Lakukan presensi</a>
    <a class="btn outline" href="{{ route('public.events.index') }}">Jelajahi event lainnya</a>
</section>@endsection
