<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);

        return view('events.index', compact('events'));
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
            'kuota' => 'required|integer|min:1',
            'biaya' => 'required|numeric|min:0',
            'status_event' => 'required|in:draft,aktif,selesai',
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
            'kuota' => 'required|integer|min:1',
            'biaya' => 'required|numeric|min:0',
            'status_event' => 'required|in:draft,aktif,selesai',
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
