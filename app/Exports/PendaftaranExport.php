<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Enumerable;

class PendaftaranExport implements FromCollection, WithHeadings
{
    public function collection(): Enumerable
    {
        return Pendaftaran::select(
            'tanggal_daftar',
            'peserta_id',
            'event_id',
            'status_pendaftaran',
            'status_pembayaran'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal Daftar',
            'ID Peserta',
            'ID Event',
            'Status Pendaftaran',
            'Status Pembayaran',
        ];
    }
}