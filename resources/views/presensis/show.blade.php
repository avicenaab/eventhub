@extends('presensis.layout')

@section('title', 'Detail Presensi')

@section('content')

    <h1>Detail Presensi</h1>
    <p>Informasi lengkap kehadiran peserta EventHub.</p>

    <a href="{{ route('presensis.index') }}" class="back">
        &larr; Kembali ke Daftar Presensi
    </a>

    <div class="table-wrap">
        <table>
            <tbody>
                <tr>
                    <th>ID Presensi</th>
                    <td>{{ $presensi->id }}</td>
                </tr>

                <tr>
                    <th>ID Pendaftaran</th>
                    <td>{{ $presensi->pendaftaran_id }}</td>
                </tr>

                <tr>
                    <th>Nama Peserta</th>
                    <td>
                        {{ data_get($presensi, 'pendaftaran.peserta.nama', '-') }}
                    </td>
                </tr>

                <tr>
                    <th>Email Peserta</th>
                    <td>
                        {{ data_get($presensi, 'pendaftaran.peserta.email', '-') }}
                    </td>
                </tr>

                <tr>
                    <th>Nomor HP</th>
                    <td>
                        {{ data_get($presensi, 'pendaftaran.peserta.no_hp', '-') }}
                    </td>
                </tr>

                <tr>
                    <th>Nama Event</th>
                    <td>
                        {{ data_get($presensi, 'pendaftaran.event.nama_event', '-') }}
                    </td>
                </tr>

                <tr>
                    <th>Lokasi Event</th>
                    <td>
                        {{ data_get($presensi, 'pendaftaran.event.lokasi', '-') }}
                    </td>
                </tr>

                <tr>
                    <th>Waktu Hadir</th>
                    <td>
                        {{ $presensi->waktu_hadir
                            ? $presensi->waktu_hadir->format('d/m/Y H:i')
                            : '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Status Kehadiran</th>
                    <td>
                        {{ ucfirst(str_replace('_', ' ', $presensi->status_kehadiran)) }}
                    </td>
                </tr>

                <tr>
                    <th>Dibuat Pada</th>
                    <td>
                        {{ $presensi->created_at?->format('d/m/Y H:i') ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Diperbarui Pada</th>
                    <td>
                        {{ $presensi->updated_at?->format('d/m/Y H:i') ?? '-' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('presensis.edit', $presensi->id) }}"
           class="btn">
            Edit Presensi
        </a>
    </div>

@endsection