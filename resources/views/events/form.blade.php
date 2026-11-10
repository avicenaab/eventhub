
<label>Nama Event</label><br>
<input type="text" name="nama_event"
    value="{{ old('nama_event', $event->nama_event ?? '') }}" required>
<br><br>

<label>Deskripsi</label><br>
<textarea name="deskripsi">{{ old('deskripsi', $event->deskripsi ?? '') }}</textarea>
<br><br>

<label>Tanggal Mulai</label><br>
<input type="datetime-local" name="tanggal_mulai"
    value="{{ old('tanggal_mulai', isset($event) ? $event->tanggal_mulai->format('Y-m-d\TH:i') : '') }}"
    required>
<br><br>

<label>Tanggal Selesai</label><br>
<input type="datetime-local" name="tanggal_selesai"
    value="{{ old('tanggal_selesai', isset($event) && $event->tanggal_selesai ? $event->tanggal_selesai->format('Y-m-d\TH:i') : '') }}">
<br><br>

<label>Lokasi</label><br>
<input type="text" name="lokasi"
    value="{{ old('lokasi', $event->lokasi ?? '') }}" required>
<br><br>

<label>Kuota</label><br>
<input type="number" name="kuota" min="1"
    value="{{ old('kuota', $event->kuota ?? 1) }}" required>
<br><br>

<label>Biaya</label><br>
<input type="number" name="biaya" min="0" step="0.01"
    value="{{ old('biaya', $event->biaya ?? 0) }}" required>
<br><br>

<label>Status Event</label><br>
<select name="status_event" required>
    @foreach(['draft', 'aktif', 'selesai'] as $status)
        <option value="{{ $status }}"
            @selected(old('status_event', $event->status_event ?? 'draft') == $status)>
            {{ ucfirst($status) }}
        </option>
    @endforeach
</select>
<br><br>
