<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class PendaftaranExport implements FromCollection, WithHeadings
{
    public function collection(): Collection
    {
        return Pendaftaran::with(['peserta', 'event'])
            ->get()
            ->map(function ($pendaftaran) {
                return [
                    'tanggal_daftar' => $pendaftaran->tanggal_daftar,
                    'nama_peserta' => $pendaftaran->peserta->nama ?? '-',
                    'nama_event' => $pendaftaran->event->nama_event ?? '-',
                    'status_pendaftaran' => $pendaftaran->status_pendaftaran,
                    'status_pembayaran' => $pendaftaran->status_pembayaran,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Tanggal Daftar',
            'Nama Peserta',
            'Nama Event',
            'Status Pendaftaran',
            'Status Pembayaran',
        ];
    }
}