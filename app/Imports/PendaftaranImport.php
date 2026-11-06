<?php

namespace App\Imports;

use App\Models\Pendaftaran;
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

        return new Pendaftaran([
            'tanggal_daftar' => $tanggal,
            'peserta_id' => $row['id_peserta'],
            'event_id' => $row['id_event'],
            'status_pendaftaran' => $row['status_pendaftaran'],
            'status_pembayaran' => $row['status_pembayaran'],
        ]);
    }
}