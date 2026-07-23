@csrf
@if(isset($ketua))
    @method('PUT')
@endif

<div class="form-group">
    <label for="nama_kelas">Nama Kelas</label>
    <input type="text" name="nama_kelas" id="nama_kelas"
           class="form-control @error('nama_kelas') is-invalid @enderror"
           value="{{ old('nama_kelas', $ketua->nama_kelas ?? '') }}"
           placeholder="Contoh: Kelas 7A">
    @error('nama_kelas')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="nama_ketua">Nama Ketua</label>
    <input type="text" name="nama_ketua" id="nama_ketua"
           class="form-control @error('nama_ketua') is-invalid @enderror"
           value="{{ old('nama_ketua', $ketua->nama_ketua ?? '') }}"
           placeholder="Nama santri yang menjabat sebagai ketua kelas">
    @error('nama_ketua')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="icon">Icon (emoji)</label>
    <input type="text" name="icon" id="icon"
           class="form-control @error('icon') is-invalid @enderror"
           value="{{ old('icon', $ketua->icon ?? '📚') }}"
           placeholder="Contoh: 📚">
    @error('icon')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="urutan">Urutan</label>
    <input type="number" name="urutan" id="urutan" min="0"
           class="form-control @error('urutan') is-invalid @enderror"
           value="{{ old('urutan', $ketua->urutan ?? 0) }}">
    @error('urutan')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group form-check">
    <input type="checkbox" name="aktif" id="aktif" value="1" class="form-check-input"
           {{ old('aktif', $ketua->aktif ?? true) ? 'checked' : '' }}>
    <label for="aktif" class="form-check-label">Aktif (tampilkan di halaman frontend)</label>
</div>

<div class="mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> {{ isset($ketua) ? 'Update' : 'Simpan' }}
    </button>
    <a href="{{ route('admin.organisasi-santri.index') }}" class="btn btn-secondary">Batal</a>
</div>
