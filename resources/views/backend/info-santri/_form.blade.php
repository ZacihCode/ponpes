<div class="form-group">
    <label>Foto <span class="text-danger">*</span></label>
    @if(isset($infoSantri) && $infoSantri->foto)
        <div class="mb-2">
            <img src="{{ Storage::url($infoSantri->foto) }}"
                 alt="Foto Prestasi"
                 style="height: 120px; object-fit: cover; border-radius: 6px;">
        </div>
    @endif
    <input type="file" name="foto"
           class="form-control-file @error('foto') is-invalid @enderror"
           accept="image/*" {{ !isset($infoSantri) ? 'required' : '' }}>
    @error('foto') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Kategori <span class="text-danger">*</span></label>
    <input type="text" name="kategori"
           value="{{ old('kategori', $infoSantri->kategori ?? '') }}"
           class="form-control @error('kategori') is-invalid @enderror"
           placeholder="Contoh: Tahfidz, Akademik, Dakwah">
    @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Judul Prestasi <span class="text-danger">*</span></label>
    <input type="text" name="judul"
           value="{{ old('judul', $infoSantri->judul ?? '') }}"
           class="form-control @error('judul') is-invalid @enderror"
           placeholder="Contoh: Juara 1 Musabaqah Tahfidz Tingkat Nasional">
    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Deskripsi <span class="text-danger">*</span></label>
    <textarea name="deskripsi" rows="3"
              class="form-control @error('deskripsi') is-invalid @enderror"
              placeholder="Deskripsi singkat prestasi...">{{ old('deskripsi', $infoSantri->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Nama Santri / Tim <span class="text-danger">*</span></label>
            <input type="text" name="nama"
                   value="{{ old('nama', $infoSantri->nama ?? '') }}"
                   class="form-control @error('nama') is-invalid @enderror">
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Kelas <span class="text-danger">*</span></label>
            <input type="text" name="kelas"
                   value="{{ old('kelas', $infoSantri->kelas ?? '') }}"
                   class="form-control @error('kelas') is-invalid @enderror"
                   placeholder="Contoh: Kelas XII Tahfidz">
            @error('kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Tahun <span class="text-danger">*</span></label>
            <input type="number" name="tahun"
                   value="{{ old('tahun', $infoSantri->tahun ?? date('Y')) }}"
                   class="form-control @error('tahun') is-invalid @enderror"
                   min="2000" max="{{ date('Y') + 1 }}">
            @error('tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>