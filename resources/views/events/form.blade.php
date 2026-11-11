<style>
    .event-form {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .event-form .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .event-form .full-width {
        grid-column: 1 / -1;
    }

    .event-form label {
        font-size: 14px;
        font-weight: 600;
        color: #334155;
    }

    .event-form input,
    .event-form textarea,
    .event-form select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        background: #fff;
        font-size: 14px;
        color: #1e293b;
        outline: none;
        transition: 0.2s;
    }

    .event-form input:focus,
    .event-form textarea:focus,
    .event-form select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .event-form textarea {
        min-height: 110px;
        resize: vertical;
    }

    @media (max-width: 600px) {
        .event-form {
            grid-template-columns: 1fr;
        }

        .event-form .full-width {
            grid-column: auto;
        }
    }
</style>

<div class="event-form">

    <div class="form-group">
        <label>Nama Event</label>
        <input type="text" name="nama_event"
            value="{{ old('nama_event', $event->nama_event ?? '') }}"
            placeholder="Masukkan nama event" required>
    </div>

    <div class="form-group">
        <label>Lokasi</label>
        <input type="text" name="lokasi"
            value="{{ old('lokasi', $event->lokasi ?? '') }}"
            placeholder="Masukkan lokasi event" required>
    </div>

    <div class="form-group full-width">
        <label>Deskripsi</label>
        <textarea name="deskripsi"
            placeholder="Tuliskan deskripsi event">{{ old('deskripsi', $event->deskripsi ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label>Tanggal Mulai</label>
        <input type="datetime-local" name="tanggal_mulai"
            value="{{ old('tanggal_mulai', isset($event) ? $event->tanggal_mulai->format('Y-m-d\TH:i') : '') }}"
            required>
    </div>

    <div class="form-group">
        <label>Tanggal Selesai</label>
        <input type="datetime-local" name="tanggal_selesai"
            value="{{ old('tanggal_selesai', isset($event) && $event->tanggal_selesai ? $event->tanggal_selesai->format('Y-m-d\TH:i') : '') }}">
    </div>

    <div class="form-group">
        <label>Kuota Peserta</label>
        <input type="number" name="kuota" min="1"
            value="{{ old('kuota', $event->kuota ?? 1) }}" required>
    </div>

    <div class="form-group">
        <label>Biaya Pendaftaran (Rp)</label>
        <input type="number" name="biaya" min="0" step="0.01"
            value="{{ old('biaya', $event->biaya ?? 0) }}" required>
    </div>

    <div class="form-group full-width">
        <label>Status Event</label>
        <select name="status_event" required>
            @foreach(['draft', 'aktif', 'selesai'] as $status)
                <option value="{{ $status }}"
                    @selected(old('status_event', $event->status_event ?? 'draft') == $status)>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
    </div>

</div>