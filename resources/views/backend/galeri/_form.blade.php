{{-- Judul --}}
<div class="form-group">
    <label>Judul <span class="text-danger">*</span></label>
    <input
        type="text"
        name="judul"
        class="form-control @error('judul') is-invalid @enderror"
        value="{{ old('judul', $galeri->judul ?? '') }}"
        placeholder="Masukkan judul foto"
    >
    @error('judul')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Kategori --}}
<div class="form-group">
    <label>Kategori</label>
    <input
        type="text"
        name="kategori"
        class="form-control @error('kategori') is-invalid @enderror"
        value="{{ old('kategori', $galeri->kategori ?? '') }}"
        placeholder="Contoh: Kegiatan, Wisuda, Pramuka"
    >
    @error('kategori')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Deskripsi --}}
<div class="form-group">
    <label>Deskripsi</label>
    <textarea
        name="deskripsi"
        rows="3"
        class="form-control @error('deskripsi') is-invalid @enderror"
        placeholder="Keterangan singkat foto (opsional)"
    >{{ old('deskripsi', $galeri->deskripsi ?? '') }}</textarea>
    @error('deskripsi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Foto --}}
<div class="form-group">
    <label>
        Foto
        @if(!isset($galeri))
            <span class="text-danger">*</span>
        @endif
    </label>

    {{-- Preview foto lama saat edit --}}
    @if(isset($galeri) && $galeri->foto)
        <div class="mb-2">
            <img
                id="foto-preview"
                src="{{ asset('storage/' . $galeri->foto) }}"
                alt="Preview"
                style="max-height: 200px; border-radius: 6px; object-fit: cover;"
            >
        </div>
    @else
        <div class="mb-2">
            <img
                id="foto-preview"
                src=""
                alt="Preview"
                style="max-height: 200px; border-radius: 6px; object-fit: cover; display: none;"
            >
        </div>
    @endif

    <input
        type="file"
        name="foto"
        id="foto-input"
        class="form-control-file @error('foto') is-invalid @enderror"
        accept="image/*"
    >
    <small class="text-muted">Format: jpg, jpeg, png, webp. Maksimal 2MB.</small>
    @error('foto')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

{{-- Urutan --}}
<div class="form-group">
    <label>Urutan</label>
    <input
        type="number"
        name="urutan"
        class="form-control @error('urutan') is-invalid @enderror"
        value="{{ old('urutan', $galeri->urutan ?? 0) }}"
        min="0"
        style="width: 120px;"
    >
    @error('urutan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Status --}}
<div class="form-group">
    <div class="custom-control custom-switch">
        <input
            type="checkbox"
            name="is_active"
            id="is_active"
            class="custom-control-input"
            value="1"
            {{ old('is_active', $galeri->is_active ?? true) ? 'checked' : '' }}
        >
        <label class="custom-control-label" for="is_active">Tampilkan di Frontend</label>
    </div>
</div>

{{-- Script preview foto --}}
@push('scripts')
<script>
    document.getElementById('foto-input').addEventListener('change', function () {
        const preview = document.getElementById('foto-preview');
        const file = this.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });
</script>
@endpush