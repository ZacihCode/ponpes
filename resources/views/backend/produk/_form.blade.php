{{-- Nama --}}
<div class="form-group">
    <label>Nama Produk <span class="text-danger">*</span></label>
    <input
        type="text"
        name="nama"
        class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $produk->nama ?? '') }}"
        placeholder="Masukkan nama produk"
    >
    @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Kategori --}}
<div class="form-group">
    <label>Kategori <span class="text-danger">*</span></label>
    <input
        type="text"
        name="kategori"
        class="form-control @error('kategori') is-invalid @enderror"
        value="{{ old('kategori', $produk->kategori ?? '') }}"
        placeholder="Contoh: Makanan, Merchandise, Buku"
    >
    @error('kategori')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Deskripsi --}}
<div class="form-group">
    <label>Deskripsi <span class="text-danger">*</span></label>
    <textarea
        name="deskripsi"
        rows="3"
        class="form-control @error('deskripsi') is-invalid @enderror"
        placeholder="Keterangan singkat produk"
    >{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
    @error('deskripsi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Harga --}}
<div class="form-group">
    <label>Harga <span class="text-danger">*</span></label>
    <div class="input-group" style="max-width: 300px;">
        <div class="input-group-prepend">
            <span class="input-group-text">Rp</span>
        </div>
        <input
            type="text"
            name="harga"
            id="harga-input"
            inputmode="numeric"
            autocomplete="off"
            class="form-control @error('harga') is-invalid @enderror"
            value="{{ old('harga', isset($produk) ? number_format($produk->harga, 0, ',', '.') : '') }}"
            placeholder="0"
        >
        @error('harga')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- Badge --}}
<div class="form-group">
    <label>Badge</label>
    <input
        type="text"
        name="badge"
        class="form-control @error('badge') is-invalid @enderror"
        value="{{ old('badge', $produk->badge ?? '') }}"
        placeholder="Contoh: Best Seller, Baru, Promo"
        style="max-width: 300px;"
    >
    @error('badge')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Gambar --}}
<div class="form-group">
    <label>
        Gambar
        @if(!isset($produk))
            <span class="text-danger">*</span>
        @endif
    </label>

    {{-- Preview gambar lama saat edit --}}
    @if(isset($produk) && $produk->gambar)
        <div class="mb-2">
            <img
                id="gambar-preview"
                src="{{ asset('storage/' . $produk->gambar) }}"
                alt="Preview"
                style="max-height: 200px; border-radius: 6px; object-fit: cover;"
            >
        </div>
    @else
        <div class="mb-2">
            <img
                id="gambar-preview"
                src=""
                alt="Preview"
                style="max-height: 200px; border-radius: 6px; object-fit: cover; display: none;"
            >
        </div>
    @endif

    <input
        type="file"
        name="gambar"
        id="gambar-input"
        class="form-control-file @error('gambar') is-invalid @enderror"
        accept="image/*"
    >
    <small class="text-muted">Format: jpg, jpeg, png, webp. Maksimal 2MB.</small>
    @error('gambar')
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
        value="{{ old('urutan', $produk->urutan ?? 0) }}"
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
            {{ old('is_active', $produk->is_active ?? true) ? 'checked' : '' }}
        >
        <label class="custom-control-label" for="is_active">Tampilkan di Frontend</label>
    </div>
</div>

{{-- Script preview gambar --}}
@push('scripts')
<script>
    document.getElementById('gambar-input').addEventListener('change', function () {
        const preview = document.getElementById('gambar-preview');
        const file = this.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });

    document.getElementById('gambar-input').addEventListener('change', function () {
        const preview = document.getElementById('gambar-preview');
        const file = this.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });

    // Format harga: ketik 35000 -> tampil 35.000
    const hargaInput = document.getElementById('harga-input');

    function formatHarga(value) {
        // hapus semua karakter selain angka
        const angka = value.replace(/\D/g, '');
        // kasih titik tiap 3 digit dari belakang
        return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    hargaInput.addEventListener('input', function () {
        this.value = formatHarga(this.value);
    });

    // sebelum submit, hapus titik supaya kekirim angka polos ke server
    hargaInput.closest('form').addEventListener('submit', function () {
        hargaInput.value = hargaInput.value.replace(/\./g, '');
    });
</script>
@endpush