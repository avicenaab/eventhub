<?php

namespace App\Http\Controllers;

use App\Models\Peserta; // Tambahkan baris ini untuk memanggil Model Peserta
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    /**
     * Menampilkan daftar data peserta.
     */
    public function index()
    {
        $pesertas = Peserta::latest()->get(); // Mengambil semua data peserta dari yang terbaru
        return view('pesertas.index', compact('pesertas')); // Mengirim data ke tampilan (view)
    }

    // ... (biarkan fungsi create, store, dll tetap ada seperti bawaannya dulu)
}