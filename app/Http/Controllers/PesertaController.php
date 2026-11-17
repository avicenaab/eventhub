<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'sort' => ['nullable', 'in:terbaru,terlama'],
        ]);
        $sort = $filters['sort'] ?? 'terbaru';
        $pesertas = Peserta::query()
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('instansi', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', $sort === 'terlama' ? 'asc' : 'desc')
            ->paginate(10)->withQueryString();

        return view('pesertas.index', compact('pesertas', 'sort'));
    }

    public function create() { return view('pesertas.create'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:pesertas,email'],
            'no_hp' => ['required', 'string', 'max:30'],
            'instansi' => ['required', 'string', 'max:255'],
        ]);
        Peserta::create($validated);
        return redirect()->route('pesertas.index')->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function edit(Peserta $peserta) { return view('pesertas.edit', compact('peserta')); }

    public function update(Request $request, Peserta $peserta)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('pesertas', 'email')->ignore($peserta->id)],
            'no_hp' => ['required', 'string', 'max:30'],
            'instansi' => ['required', 'string', 'max:255'],
        ]);
        $peserta->update($validated);
        return redirect()->route('pesertas.index')->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function destroy(Peserta $peserta)
    {
        if ($peserta->pendaftarans()->exists()) {
            return back()->with('error', 'Peserta tidak dapat dihapus karena masih memiliki data pendaftaran.');
        }
        $peserta->delete();
        return redirect()->route('pesertas.index')->with('success', 'Peserta berhasil dihapus.');
    }
}
