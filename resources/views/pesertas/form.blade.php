<label>Nama lengkap
    <input name="nama" value="{{ old('nama',$peserta->nama ?? '') }}" required>
    @error('nama')
    <small class="field-error">{{ $message }}</small>
    @enderror
</label>
<label>Email
    <input type="email" name="email" value="{{ old('email',$peserta->email ?? '') }}" required>
    @error('email')
    <small class="field-error">{{ $message }}</small>
    @enderror
</label>
<label>Nomor HP
    <input name="no_hp" value="{{ old('no_hp',$peserta->no_hp ?? '') }}" required>
    @error('no_hp')
    <small class="field-error">{{ $message }}</small>
    @enderror
</label>
<label>Instansi
    <input name="instansi" value="{{ old('instansi',$peserta->instansi ?? '') }}" required>
    @error('instansi')
    <small class="field-error">{{ $message }}</small>
    @enderror
</label>
