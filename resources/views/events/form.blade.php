@php
    $savedLocation = old('lokasi', $event->lokasi ?? '');
    $savedLatitude = old('latitude', $event->latitude ?? '');
    $savedLongitude = old('longitude', $event->longitude ?? '');
    $hasSavedPoint = $savedLatitude !== '' && $savedLongitude !== '';
@endphp

<div class="event-form-grid">
    <label class="field">
        <span>Nama Event</span>
        <input type="text" name="nama_event" value="{{ old('nama_event', $event->nama_event ?? '') }}" placeholder="Masukkan nama event" maxlength="255" required>
        @error('nama_event')<small class="field-error">{{ $message }}</small>@enderror
    </label>

    <label class="field">
        <span>Lokasi Event</span>
        <input type="text" name="lokasi" data-map-location value="{{ $savedLocation }}" placeholder="Contoh: Auditorium IPB, Bogor" maxlength="255" required>
        <small class="field-hint">Ketik nama tempat atau alamat, lalu pilih titik lokasinya di peta.</small>
        @error('lokasi')<small class="field-error">{{ $message }}</small>@enderror
    </label>

    <div class="field full-width map-picker-card">
        <div class="map-picker-heading">
            <div>
                <strong>Pilih titik lokasi di peta</strong>
                <small>Pilih hasil pencarian, klik peta, atau geser marker untuk menentukan titik yang tepat.</small>
            </div>
        </div>

        <div class="map-search-wrap">
            <input
                type="search"
                data-map-search
                placeholder="Cari gedung, kampus, jalan, tempat umum, atau alamat..."
                autocomplete="off"
                spellcheck="false"
                aria-label="Cari lokasi event"
                aria-controls="event-location-results"
                aria-expanded="false"
            >
            <div id="event-location-results" class="map-search-results" data-map-results role="listbox" aria-label="Hasil pencarian lokasi" hidden></div>
        </div>

        <div id="event-location-map" class="event-location-map" aria-label="Peta pemilih lokasi event"></div>

        <input type="hidden" name="latitude" data-map-latitude value="{{ $savedLatitude }}">
        <input type="hidden" name="longitude" data-map-longitude value="{{ $savedLongitude }}">

        <small class="field-hint" data-map-message aria-live="polite">
            {{ $hasSavedPoint ? 'Titik lokasi tersimpan. Marker bisa digeser untuk memperbarui.' : 'Belum ada titik koordinat. Pilih lokasi lewat pencarian atau klik langsung pada peta.' }}
        </small>
        @error('latitude')<small class="field-error">{{ $message }}</small>@enderror
        @error('longitude')<small class="field-error">{{ $message }}</small>@enderror
    </div>

    <label class="field full-width">
        <span>Deskripsi</span>
        <textarea name="deskripsi" rows="4" placeholder="Tuliskan deskripsi event">{{ old('deskripsi', $event->deskripsi ?? '') }}</textarea>
        @error('deskripsi')<small class="field-error">{{ $message }}</small>@enderror
    </label>

    <label class="field">
        <span>Tanggal Mulai</span>
        <input type="datetime-local" name="tanggal_mulai" value="{{ old('tanggal_mulai', isset($event) && $event->tanggal_mulai ? $event->tanggal_mulai->format('Y-m-d\\TH:i') : '') }}" required>
        @error('tanggal_mulai')<small class="field-error">{{ $message }}</small>@enderror
    </label>

    <label class="field">
        <span>Tanggal Selesai</span>
        <input type="datetime-local" name="tanggal_selesai" value="{{ old('tanggal_selesai', isset($event) && $event->tanggal_selesai ? $event->tanggal_selesai->format('Y-m-d\\TH:i') : '') }}">
        @error('tanggal_selesai')<small class="field-error">{{ $message }}</small>@enderror
    </label>

    <label class="field">
        <span>Kuota Peserta</span>
        <input type="number" name="kuota" min="1" step="1" value="{{ old('kuota', $event->kuota ?? 1) }}" required>
        @error('kuota')<small class="field-error">{{ $message }}</small>@enderror
    </label>

    <label class="field">
        <span>Biaya Pendaftaran (Rp)</span>
        <input type="number" name="biaya" min="0" step="0.01" value="{{ old('biaya', $event->biaya ?? 0) }}" required>
        @error('biaya')<small class="field-error">{{ $message }}</small>@enderror
    </label>

    <label class="field full-width">
        <span>Status Event</span>
        <select name="status_event" required>
            @foreach(['draft', 'aktif', 'berlangsung', 'selesai'] as $status)
                <option value="{{ $status }}" @selected(old('status_event', $event->status_event ?? 'draft') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
        @error('status_event')<small class="field-error">{{ $message }}</small>@enderror
    </label>
</div>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
<style>
.event-form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}
.event-form-grid>.full-width{grid-column:1/-1}
.field{display:flex;flex-direction:column;gap:8px;color:var(--text);font-size:13px;font-weight:600;min-width:0}
.field input,.field select,.field textarea{width:100%;min-height:44px;padding:12px 14px;background:#252525!important;color:#eee!important;border:1px solid #414141!important;border-radius:9px}
.field textarea{resize:vertical;min-height:110px}
.field input:focus,.field select:focus,.field textarea:focus{outline:none;border-color:var(--teal)!important;box-shadow:0 0 0 3px rgba(85,214,194,.1)}
.field-hint{color:var(--muted);font-size:11px;font-weight:400;line-height:1.5}
.field-error{color:#ff9696;font-size:11px}
.map-picker-card{padding:17px;background:#202020;border:1px solid var(--border);border-radius:13px}
.map-picker-heading{display:flex;align-items:center;justify-content:space-between;gap:14px;margin-bottom:13px}
.map-picker-heading>div{display:flex;flex-direction:column;gap:5px}
.map-picker-heading strong{font-size:13px}
.map-picker-heading small{color:var(--muted);font-size:11px;font-weight:400;line-height:1.5}
.map-provider-label{font-size:10px;color:var(--teal);white-space:nowrap}
.map-search-wrap{position:relative;margin-bottom:10px}
.map-search-wrap input{width:100%;min-height:44px;padding:12px 14px;background:#252525;color:#eee;border:1px solid #414141;border-radius:9px;outline:none}
.map-search-wrap input:focus{border-color:var(--teal);box-shadow:0 0 0 3px rgba(85,214,194,.1)}
.map-search-results{position:absolute;z-index:1100;top:calc(100% + 5px);left:0;right:0;max-height:300px;overflow:auto;background:#292929;border:1px solid #484848;border-radius:10px;box-shadow:0 14px 35px #0009}
.map-search-results[hidden]{display:none}
.map-search-results button{display:block;width:100%;padding:12px 14px;text-align:left;color:#eee;background:transparent;border:0;border-bottom:1px solid #3c3c3c;cursor:pointer}
.map-search-results button:last-child{border-bottom:0}
.map-search-results button:hover,.map-search-results button:focus{background:#383838;outline:none}
.map-search-results button strong{display:block;font-size:12px;font-weight:650;line-height:1.45}
.map-search-results button small{display:block;margin-top:4px;color:#aaa;font-size:10px;line-height:1.45}
.map-search-state{padding:13px 14px;color:#aaa;font-size:11px;line-height:1.5}
.event-location-map{height:350px;width:100%;border-radius:10px;overflow:hidden;background:#303030;z-index:0}
.map-attribution-note{display:block;margin-top:7px;text-align:right;color:#9ca3af;font-size:10px;font-weight:400}
.map-attribution-note a{color:#9ca3af}
.leaflet-container{font:12px inherit}
.leaflet-control-attribution{font-size:10px!important}
.form-actions{display:flex;justify-content:flex-end;gap:9px;margin-top:18px}
@media(max-width:700px){.event-form-grid{grid-template-columns:1fr}.event-form-grid>.full-width{grid-column:auto}.event-location-map{height:290px}.map-picker-heading{align-items:flex-start;flex-direction:column}}
@media(prefers-reduced-motion:reduce){.map-search-results button{scroll-behavior:auto}}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
(() => {
    'use strict';

    const mapElement = document.getElementById('event-location-map');
    if (!mapElement || typeof window.L === 'undefined') return;

    const locationInput = document.querySelector('[data-map-location]');
    const latitudeInput = document.querySelector('[data-map-latitude]');
    const longitudeInput = document.querySelector('[data-map-longitude]');
    const messageElement = document.querySelector('[data-map-message]');
    const searchInput = document.querySelector('[data-map-search]');
    const resultsElement = document.querySelector('[data-map-results]');

    if (!locationInput || !latitudeInput || !longitudeInput || !searchInput || !resultsElement) return;

    const INDONESIA_BOUNDS = {
        west: 94.7,
        south: -11.0,
        east: 141.1,
        north: 6.1,
    };
    const DEFAULT_CENTER = [-6.5971, 106.8060];
    const SEARCH_MIN_LENGTH = 3;
    const SEARCH_DEBOUNCE_MS = 400;
    const PHOTON_LIMIT = 20;
    const DISPLAY_LIMIT = 10;

    const hasSavedPoint = latitudeInput.value !== '' && longitudeInput.value !== '';
    const savedLat = Number(latitudeInput.value);
    const savedLng = Number(longitudeInput.value);
    const validSavedPoint = hasSavedPoint
        && Number.isFinite(savedLat)
        && Number.isFinite(savedLng)
        && savedLat >= -90 && savedLat <= 90
        && savedLng >= -180 && savedLng <= 180;
    const initialPoint = validSavedPoint ? [savedLat, savedLng] : DEFAULT_CENTER;

    const map = L.map(mapElement, {
        scrollWheelZoom: true,
        preferCanvas: true,
    }).setView(initialPoint, validSavedPoint ? 16 : 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 3,
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener noreferrer">OpenStreetMap</a> contributors',
    }).addTo(map);

    let marker = null;
    let debounceTimer = null;
    let activeController = null;
    let latestSearchId = 0;
    let selectedResultIndex = -1;

    const setMessage = (message) => {
        if (messageElement) messageElement.textContent = message;
    };

    const setResultsOpen = (open) => {
        resultsElement.hidden = !open;
        searchInput.setAttribute('aria-expanded', String(open));
    };

    const showSearchState = (message, isError = false) => {
        resultsElement.replaceChildren();
        selectedResultIndex = -1;
        const state = document.createElement('div');
        state.className = 'map-search-state';
        state.textContent = message;
        if (isError) state.style.color = '#ff9999';
        resultsElement.appendChild(state);
        setResultsOpen(true);
    };

    const updateMarker = (latlng) => {
        if (!marker) {
            marker = L.marker(latlng, { draggable: true }).addTo(map);
            marker.on('dragend', () => updatePoint(marker.getLatLng(), 'Marker dipindahkan. Koordinat lokasi sudah diperbarui.'));
        } else {
            marker.setLatLng(latlng);
        }
    };

    const updatePoint = (latlng, message = 'Koordinat lokasi sudah dipilih. Marker bisa digeser untuk menyesuaikan titik.') => {
        const lat = Number(latlng.lat);
        const lng = Number(latlng.lng);
        if (!Number.isFinite(lat) || !Number.isFinite(lng)) return;

        latitudeInput.value = lat.toFixed(7);
        longitudeInput.value = lng.toFixed(7);
        updateMarker(L.latLng(lat, lng));
        setMessage(message);
    };

    if (validSavedPoint) {
        updateMarker(L.latLng(savedLat, savedLng));
    } else if (hasSavedPoint) {
        latitudeInput.value = '';
        longitudeInput.value = '';
        setMessage('Koordinat sebelumnya tidak valid. Pilih ulang titik lokasi pada peta.');
    }

    map.on('click', (event) => updatePoint(event.latlng, 'Titik dipilih dari peta. Marker bisa digeser untuk menyesuaikan lokasi.'));

    const isInIndonesia = (feature) => {
        const coordinates = feature?.geometry?.coordinates;
        if (!Array.isArray(coordinates) || coordinates.length < 2) return false;

        const longitude = Number(coordinates[0]);
        const latitude = Number(coordinates[1]);
        if (!Number.isFinite(latitude) || !Number.isFinite(longitude)) return false;

        const insideBounds = longitude >= INDONESIA_BOUNDS.west
            && longitude <= INDONESIA_BOUNDS.east
            && latitude >= INDONESIA_BOUNDS.south
            && latitude <= INDONESIA_BOUNDS.north;
        if (!insideBounds) return false;

        const country = String(feature.properties?.country || '').trim().toLowerCase();
        return !country || country === 'indonesia' || country.includes('indonesia');
    };

    const buildPhotonUrl = (query, includeBounds = true) => {
        const center = map.getCenter();
        const url = new URL('https://photon.komoot.io/api/');
        url.searchParams.set('q', query);
        url.searchParams.set('lang', 'id');
        url.searchParams.set('limit', String(PHOTON_LIMIT));

        // Bias pencarian mengikuti posisi tengah dan tingkat zoom peta saat ini.
        url.searchParams.set('lat', center.lat.toFixed(6));
        url.searchParams.set('lon', center.lng.toFixed(6));
        url.searchParams.set('zoom', String(map.getZoom()));

        // Batas geografis Indonesia membantu mengurangi hasil dari negara lain.
        if (includeBounds) {
            url.searchParams.set('bbox', [
                INDONESIA_BOUNDS.west,
                INDONESIA_BOUNDS.south,
                INDONESIA_BOUNDS.east,
                INDONESIA_BOUNDS.north,
            ].join(','));
        }
        return url.toString();
    };

    const requestPhoton = async (url, signal) => {
        const response = await fetch(url, {
            method: 'GET',
            mode: 'cors',
            signal,
            headers: { Accept: 'application/geo+json, application/json' },
        });
        if (!response.ok) throw new Error(`Photon mengembalikan HTTP ${response.status}.`);
        return response.json();
    };

    const getAddressParts = (properties) => {
        const parts = [
            properties.street,
            properties.housenumber,
            properties.district,
            properties.city,
            properties.county,
            properties.state,
        ].filter((value, index, array) => value && array.indexOf(value) === index);
        return parts;
    };

    const renderResults = (features, query, searchId) => {
        if (searchId !== latestSearchId) return;

        resultsElement.replaceChildren();
        selectedResultIndex = -1;

        const validFeatures = features.filter(isInIndonesia).slice(0, DISPLAY_LIMIT);
        if (!validFeatures.length) {
            showSearchState('Lokasi belum ditemukan. Coba nama tempat, nama jalan, atau tambahkan nama kota.');
            return;
        }

        validFeatures.forEach((feature, index) => {
            const properties = feature.properties || {};
            const [longitude, latitude] = feature.geometry.coordinates.map(Number);
            const addressParts = getAddressParts(properties);
            const title = properties.name || addressParts.shift() || properties.city || properties.county || 'Lokasi tanpa nama';
            const subtitleParts = addressParts.filter((part) => part.toLowerCase() !== String(title).toLowerCase());
            const subtitle = [...subtitleParts, properties.country || 'Indonesia'].filter(Boolean).join(', ');

            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'map-search-result';
            button.setAttribute('role', 'option');
            button.setAttribute('aria-selected', 'false');
            button.dataset.resultIndex = String(index);

            const titleElement = document.createElement('strong');
            titleElement.textContent = title;
            button.appendChild(titleElement);

            if (subtitle) {
                const subtitleElement = document.createElement('small');
                subtitleElement.textContent = subtitle;
                button.appendChild(subtitleElement);
            }

            button.addEventListener('click', () => {
                if (!Number.isFinite(latitude) || !Number.isFinite(longitude)) return;

                const point = L.latLng(latitude, longitude);
                const nextZoom = Math.max(map.getZoom(), 16);
                map.setView(point, Math.min(nextZoom, 19), { animate: true });
                updatePoint(point, 'Lokasi dipilih dari hasil Photon. Periksa kembali posisi marker sebelum menyimpan.');

                const fullAddress = [title, ...addressParts, properties.country || 'Indonesia']
                    .filter((part, partIndex, array) => part && array.indexOf(part) === partIndex)
                    .join(', ');
                locationInput.value = fullAddress || query;
                searchInput.value = fullAddress || query;
                setResultsOpen(false);
                searchInput.blur();
            });

            resultsElement.appendChild(button);
        });

        setResultsOpen(true);
    };

    const searchLocations = async (query, searchId) => {
        if (activeController) activeController.abort();
        activeController = new AbortController();
        const controller = activeController;

        showSearchState('Mencari lokasi di Indonesia...');

        try {
            let data;
            try {
                data = await requestPhoton(buildPhotonUrl(query, true), controller.signal);
            } catch (error) {
                if (error.name === 'AbortError') return;
                // Jika parameter bbox tidak didukung atau gagal, ulangi tanpa bbox.
                data = await requestPhoton(buildPhotonUrl(query, false), controller.signal);
            }

            if (searchId !== latestSearchId || controller.signal.aborted) return;
            renderResults(Array.isArray(data.features) ? data.features : [], query, searchId);
        } catch (error) {
            if (error.name === 'AbortError' || searchId !== latestSearchId) return;
            console.error('Photon location search failed:', error);
            showSearchState('Pencarian gagal dihubungkan. Coba lagi beberapa saat.', true);
        }
    };

    searchInput.addEventListener('input', () => {
        const query = searchInput.value.trim();
        latestSearchId += 1;
        const searchId = latestSearchId;

        window.clearTimeout(debounceTimer);
        if (activeController) activeController.abort();

        if (query.length < SEARCH_MIN_LENGTH) {
            resultsElement.replaceChildren();
            setResultsOpen(false);
            if (query.length > 0) setMessage('Ketik minimal 3 karakter untuk mencari lokasi.');
            return;
        }

        debounceTimer = window.setTimeout(() => searchLocations(query, searchId), SEARCH_DEBOUNCE_MS);
    });

    searchInput.addEventListener('keydown', (event) => {
        const options = [...resultsElement.querySelectorAll('button[role="option"]')];
        if (event.key === 'Escape') {
            setResultsOpen(false);
            return;
        }
        if (!options.length) return;

        if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
            event.preventDefault();
            const direction = event.key === 'ArrowDown' ? 1 : -1;
            if (selectedResultIndex === -1) {
                selectedResultIndex = direction > 0 ? 0 : options.length - 1;
            } else {
                selectedResultIndex = (selectedResultIndex + direction + options.length) % options.length;
            }
            options.forEach((option, index) => {
                option.setAttribute('aria-selected', String(index === selectedResultIndex));
                if (index === selectedResultIndex) option.scrollIntoView({ block: 'nearest' });
            });
        } else if (event.key === 'Enter' && selectedResultIndex >= 0) {
            event.preventDefault();
            options[selectedResultIndex].click();
        }
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('.map-search-wrap')) setResultsOpen(false);
    });

    // Leaflet perlu menghitung ulang ukuran ketika form selesai dirender.
    window.requestAnimationFrame(() => map.invalidateSize());
    window.addEventListener('resize', () => map.invalidateSize(), { passive: true });
})();
</script>
@endpush
