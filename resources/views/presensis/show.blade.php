@extends('layouts.admin')

@section('title', 'Detail Presensi')

@section('content')
<div class="presensi-page">
<div class="legacy-module-page">
@push('styles')
@endpush



<div class="page-header">
    <h1>Detail Presensi</h1>
    <p>Informasi lengkap kehadiran peserta EventHub.</p>
</div>

<div class="detail-card">

    <!-- INFORMASI PESERTA -->
    <div class="detail-section">
        <div class="section-title">Informasi Peserta</div>

        <div class="detail-grid">

            <div class="detail-item">
                <label>ID Presensi</label>
                <p>#{{ $presensi->id }}</p>
            </div>

            <div class="detail-item">
                <label>ID Pendaftaran</label>
                <p>#{{ $presensi->pendaftaran_id }}</p>
            </div>

            <div class="detail-item">
                <label>Nama Peserta</label>
                <p>{{ data_get($presensi, 'pendaftaran.peserta.nama', '-') }}</p>
            </div>

            <div class="detail-item">
                <label>Email Peserta</label>
                <p>{{ data_get($presensi, 'pendaftaran.peserta.email', '-') }}</p>
            </div>

            <div class="detail-item">
                <label>Nomor HP</label>
                <p>{{ data_get($presensi, 'pendaftaran.peserta.no_hp', '-') }}</p>
            </div>

        </div>
    </div>

    <!-- INFORMASI EVENT -->
    <div class="detail-section">
        <div class="section-title">Informasi Event</div>

        <div class="detail-grid">

            <div class="detail-item">
                <label>Nama Event</label>
                <p>{{ data_get($presensi, 'pendaftaran.event.nama_event', '-') }}</p>
            </div>

            <div class="detail-item">
                <label>Lokasi Event</label>
                <p>{{ data_get($presensi, 'pendaftaran.event.lokasi', '-') }}</p>
            </div>

        </div>
    </div>

    <!-- INFORMASI KEHADIRAN -->
    <div class="detail-section">
        <div class="section-title">Informasi Kehadiran</div>

        <div class="detail-grid">

            <div class="detail-item">
                <label>Waktu Hadir</label>
                <p>
                    {{ $presensi->waktu_hadir
                        ? $presensi->waktu_hadir->format('d/m/Y H:i')
                        : '-' }}
                </p>
            </div>

            <div class="detail-item">
                <label>Status Kehadiran</label>

                <p>
                    <span class="status {{ $presensi->status_kehadiran }}">
                        {{ ucfirst(str_replace('_', ' ', $presensi->status_kehadiran)) }}
                    </span>
                </p>
            </div>

            <div class="detail-item">
                <label>Dibuat Pada</label>
                <p>{{ $presensi->created_at?->format('d/m/Y H:i') ?? '-' }}</p>
            </div>

            <div class="detail-item">
                <label>Diperbarui Pada</label>
                <p>{{ $presensi->updated_at?->format('d/m/Y H:i') ?? '-' }}</p>
            </div>

        </div>
    </div>

    <div class="actions">
        <a href="{{ route('presensis.edit', $presensi->id) }}" class="btn btn-edit">
            Edit Presensi
        </a>

        <a href="{{ route('presensis.index') }}" class="btn btn-back">
            Kembali
        </a>
    </div>

</div>

</div>
</div>
@endsection