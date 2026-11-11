<?php

namespace App\Imports;

use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PendaftaranImport implements ToModel, WithHeadingRow
{
    public function model(array $row): Model
    {
        $tanggal = is_numeric($row['tanggal_daftar'])
            ? Date::excelToDateTimeObject($row['tanggal_daftar'])->format('Y-m-d')
            : date('Y-m-d', strtotime($row['tanggal_daftar']));

        $peserta = Peserta::where('nama', $row['nama_peserta'])->first();
        $event = Event::where('nama_event', $row['nama_event'])->first();

        if (!$peserta || !$event) {
            throw new \Exception('Nama peserta atau event tidak ditemukan.');
        }

        return new Pendaftaran([
            'tanggal_daftar' => $tanggal,
            'peserta_id' => $peserta->id,
            'event_id' => $event->id,
            'status_pendaftaran' => $row['status_pendaftaran'],
            'status_pembayaran' => $row['status_pembayaran'],
        ]);
    }
}
