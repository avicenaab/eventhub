@extends('presensis.layout')

@section('title', 'Detail Presensi')

@section('content')

<style>
    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        color: #172554;
        font-size: 28px;
        margin-bottom: 8px;
    }

    .page-header p {
        color: #64748b;
    }

    .detail-card {
        background: white;
        max-width: 950px;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        margin-top: 20px;
    }

    .section-title {
        color: #172554;
        font-size: 17px;
        font-weight: bold;
        padding-bottom: 13px;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 20px;
    }

    .detail-section {
        margin-bottom: 30px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .detail-item {
        background: #f8fafc;
        padding: 15px;
        border-radius: 9px;
        min-width: 0;
    }

    .detail-item label {
        display: block;
        color: #64748b;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .detail-item p {
        color: #1e293b;
        font-size: 15px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .status {
        display: inline-block;
        padding: 6px 13px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        text-transform: capitalize;
    }

    .status.hadir {
        background: #dcfce7;
        color: #15803d;
    }

    .status.belum_hadir {
        background: #fef3c7;
        color: #92400e;
    }

    .status.izin {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status.sakit {
        background: #f3e8ff;
        color: #7e22ce;
    }

    .status.alpa {
        background: #fee2e2;
        color: #b91c1c;
    }

    .actions {
        display: flex;
        gap: 12px;
        padding-top: 25px;
        border-top: 1px solid #e2e8f0;
    }

    .btn {
        display: inline-block;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
    }

    .btn-edit {
        background: #2563eb;
        color: white;
    }

    .btn-edit:hover {
        background: #1d4ed8;
    }

    .btn-back {
        background: #e2e8f0;
        color: #334155;
    }

    .btn-back:hover {
        background: #cbd5e1;
    }

    @media (max-width: 600px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-card {
            padding: 20px;
        }
    }
</style>

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

@endsection