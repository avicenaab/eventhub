@extends('layouts.admin')

@section('title', 'Edit Presensi')

@section('content')
<div class="presensi-page">
<div class="legacy-module-page">
@push('styles')
@endpush



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

</div>
</div>
@endsection