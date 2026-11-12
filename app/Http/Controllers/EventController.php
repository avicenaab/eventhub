<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'terbaru');
        $direction = $sort === 'terlama' ? 'asc' : 'desc';
        $events = Event::orderBy('tanggal_mulai', $direction)->paginate(10)->withQueryString();

        return view('events.index', compact('events', 'sort'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_event' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'required|string|max:255',
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'kuota' => 'required|integer|min:1',
            'biaya' => 'required|numeric|min:0',
            'status_event' => 'required|in:draft,aktif,berlangsung,selesai',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil ditambahkan!');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'nama_event' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'required|string|max:255',
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'kuota' => 'required|integer|min:1',
            'biaya' => 'required|numeric|min:0',
            'status_event' => 'required|in:draft,aktif,berlangsung,selesai',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        try {
            $event->delete();

            return redirect()->route('events.index')
                ->with('success', 'Event berhasil dihapus!');
        } catch (QueryException $e) {
            return redirect()->route('events.index')
                ->with('error', 'Event tidak dapat dihapus karena sudah memiliki data pendaftaran.');
        }
    }
}
