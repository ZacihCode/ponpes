@csrf
@if(isset($mudabbir))
    @method('PUT')
@endif

<div class="form-group">
    <label for="kamar">Kamar</label>
    <input type="text" name="kamar" id="kamar"
           class="form-control @error('kamar') is-invalid @enderror"
           value="{{ old('kamar', $mudabbir->kamar ?? '') }}"
           placeholder="Contoh: Kamar 1 / Asrama Abu Bakar - Kamar 1">
    @error('kamar')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama"
           class="form-control @error('nama') is-invalid @enderror"
           value="{{ old('nama', $mudabbir->nama ?? '') }}"
           placeholder="Contoh: Ustadz Ali">
    @error('nama')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="urutan">Urutan</label>
    <input type="number" name="urutan" id="urutan" min="0"
           class="form-control @error('urutan') is-invalid @enderror"
           value="{{ old('urutan', $mudabbir->urutan ?? 0) }}">
    @error('urutan')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group form-check">
    <input type="checkbox" name="aktif" id="aktif" value="1" class="form-check-input"
           {{ old('aktif', $mudabbir->aktif ?? true) ? 'checked' : '' }}>
    <label for="aktif" class="form-check-label">Aktif (tampilkan di halaman frontend)</label>
</div>

<div class="mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> {{ isset($mudabbir) ? 'Update' : 'Simpan' }}
    </button>
    <a href="{{ route('admin.organisasi-santri.index') }}" class="btn btn-secondary">Batal</a>
</div>
