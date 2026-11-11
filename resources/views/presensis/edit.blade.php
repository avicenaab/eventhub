@extends('presensis.layout')

@section('title', 'Edit Presensi')

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

    .presensi-card {
        background: white;
        max-width: 850px;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        margin-top: 20px;
    }

    .presensi-form {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .presensi-form .form-group {
        display: flex;
        flex-direction: column;
        gap: 9px;
    }

    .presensi-form label {
        color: #334155;
        font-size: 14px;
        font-weight: 600;
    }

    .presensi-form input,
    .presensi-form select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        background: white;
        color: #1e293b;
        font-size: 14px;
        outline: none;
    }

    .presensi-form input:focus,
    .presensi-form select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 5px;
    }

    .btn-save {
        background: #2563eb;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
    }

    .btn-save:hover {
        background: #1d4ed8;
    }

    .btn-cancel {
        background: #e2e8f0;
        color: #334155;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-cancel:hover {
        background: #cbd5e1;
    }

    .alert-error {
        background: #fee2e2;
        color: #b91c1c;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        max-width: 850px;
    }
</style>

<div class="page-header">
    <h1>Edit Presensi</h1>
    <p>Perbarui data kehadiran peserta EventHub.</p>
</div>

@if($errors->any())
    <div class="alert-error">
        <strong>Periksa kembali input berikut:</strong>

        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="presensi-card">

    <form action="{{ route('presensis.update', $presensi->id) }}"
          method="POST"
          class="presensi-form">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="pendaftaran_id">Peserta dan Event</label>

            <select name="pendaftaran_id" id="pendaftaran_id" required>
                <option value="">-- Pilih Pendaftaran --</option>

                @foreach($pendaftarans as $pendaftaran)
                    <option value="{{ $pendaftaran->id }}"
                        {{ old('pendaftaran_id', $presensi->pendaftaran_id) == $pendaftaran->id ? 'selected' : '' }}>

                        {{ data_get($pendaftaran, 'peserta.nama', 'Peserta tidak ditemukan') }}
                        -
                        {{ data_get($pendaftaran, 'event.nama_event', 'Event tidak ditemukan') }}

                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="waktu_hadir">Waktu Hadir</label>

            <input
                type="datetime-local"
                name="waktu_hadir"
                id="waktu_hadir"
                value="{{ old(
                    'waktu_hadir',
                    $presensi->waktu_hadir
                        ? $presensi->waktu_hadir->format('Y-m-d\TH:i')
                        : ''
                ) }}">
        </div>

        <div class="form-group">
            <label for="status_kehadiran">Status Kehadiran</label>

            <select name="status_kehadiran" id="status_kehadiran" required>
                @foreach(['belum_hadir', 'hadir', 'izin', 'sakit', 'alpa'] as $status)
                    <option value="{{ $status }}"
                        {{ old('status_kehadiran', $presensi->status_kehadiran) == $status ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                Simpan Perubahan
            </button>

            <a href="{{ route('presensis.index') }}" class="btn-cancel">
                Batal
            </a>
        </div>

    </form>

</div>

@endsection