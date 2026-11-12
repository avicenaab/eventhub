@extends('layouts.admin')

@section('title', 'Pendaftaran')

@push('styles')
<style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #f4f6fb;
            color: #263248;
        }

        .legacy-module-page .sidebar {
            width: 240px;
            background: #172554;
            color: white;
            padding: 30px 20px;
        }

        .legacy-module-page .brand {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .legacy-module-page .sidebar a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .legacy-module-page .sidebar a:hover,
        .legacy-module-page .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .main {
            flex: 1;
            padding: 40px;
        }

        .legacy-module-page .header {
            margin-bottom: 30px;
        }

        .legacy-module-page .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .legacy-module-page .header p {
            color: #64748b;
        }

        .form-card {
            background: white;
            max-width: 750px;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 9px;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            background: white;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #2563eb;
        }

        .legacy-module-page .actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        button, .back {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }

        button {
            background: #2563eb;
            color: white;
        }

        button:hover {
            background: #1d4ed8;
        }

        .back {
            background: #e2e8f0;
            color: #334155;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }

        @media (max-width: 700px) {
            body {
                flex-direction: column;
            }

            .legacy-module-page .sidebar {
                width: 100%;
            }

            .main {
                padding: 20px;
            }
        }
    

/* Compatibility overrides: shared EventHub admin shell */
body { display:block !important; min-height:100vh; background:var(--bg) !important; color:var(--text) !important; font-family:'DM Sans',sans-serif !important; }
.legacy-module-page 
.legacy-module-page .main { width:auto !important; min-height:0 !important; margin:0 !important; padding:0 !important; flex:initial !important; background:transparent !important; }
.layout { display:block !important; min-height:0 !important; }
.legacy-module-page .footer { display:none !important; }

</style>
@endpush

@section('content')
<div class="legacy-module-page">
<div class="header">
            <h1>Edit Pendaftaran</h1>
            <p>Perbarui informasi pendaftaran event.</p>
        </div>

        <div class="form-card">

            <form action="{{ route('pendaftarans.update', ['id' => $pendaftaran->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Tanggal Daftar</label>
                    <input type="date" name="tanggal_daftar"
                        value="{{ old('tanggal_daftar', $pendaftaran->tanggal_daftar) }}"
                        required>
                    @error('tanggal_daftar')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nama Peserta</label>
                    <select name="peserta_id" required>
                        @foreach ($pesertas as $peserta)
                            <option value="{{ $peserta->id }}"
                                {{ old('peserta_id', $pendaftaran->peserta_id) == $peserta->id ? 'selected' : '' }}>
                                {{ $peserta->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('peserta_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nama Event</label>
                    <select name="event_id" required>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}"
                                {{ old('event_id', $pendaftaran->event_id) == $event->id ? 'selected' : '' }}>
                                {{ $event->nama_event }}
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Status Pendaftaran</label>
                    <select name="status_pendaftaran" required>
                        <option value="menunggu" {{ old('status_pendaftaran', $pendaftaran->status_pendaftaran) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diterima" {{ old('status_pendaftaran', $pendaftaran->status_pendaftaran) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ old('status_pendaftaran', $pendaftaran->status_pendaftaran) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status Pembayaran</label>
                    <select name="status_pembayaran" required>
                        <option value="belum_bayar" {{ old('status_pembayaran', $pendaftaran->status_pembayaran) == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                        <option value="sudah_bayar" {{ old('status_pembayaran', $pendaftaran->status_pembayaran) == 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                    </select>
                </div>

                <div class="actions">
                    <button type="submit">Simpan Perubahan</button>
                    <a href="{{ route('pendaftarans.index') }}" class="back">Kembali</a>
                </div>

            </form>
</div>
@endsection

