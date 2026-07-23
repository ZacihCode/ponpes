@if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        <h5><i class="fas fa-exclamation-triangle"></i> Periksa kembali inputan:</h5>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">

    {{-- Kolom kiri --}}
    <div class="col-lg-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-graduate mr-1"></i> Data Alumni
                </h3>
            </div>
            <div class="card-body">

                {{-- TIPE --}}
                <div class="form-group">
                    <label>Tipe Alumni <span class="text-danger">*</span></label>
                    <select name="tipe"
                            class="form-control @error('tipe') is-invalid @enderror">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="sebaran"
                                {{ old('tipe', $alumni->tipe ?? '') === 'sebaran' ? 'selected' : '' }}>
                            Sebaran Alumni
                        </option>
                        <option value="kiprah"
                                {{ old('tipe', $alumni->tipe ?? '') === 'kiprah' ? 'selected' : '' }}>
                            Kiprah Alumni
                        </option>
                    </select>
                    @error('tipe')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- NAMA --}}
                <div class="form-group">
                    <label>Nama Alumni <span class="text-danger">*</span></label>
                    <input type="text"
                           name="nama"
                           class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $alumni->nama ?? '') }}"
                           placeholder="Nama lengkap alumni">
                    @error('nama')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- TAHUN LULUS --}}
                <div class="form-group">
                    <label>Tahun Lulus <span class="text-danger">*</span></label>
                    <input type="number"
                           name="tahun_lulus"
                           class="form-control @error('tahun_lulus') is-invalid @enderror"
                           value="{{ old('tahun_lulus', $alumni->tahun_lulus ?? '') }}"
                           placeholder="2021"
                           min="2000"
                           max="{{ date('Y') }}">
                    @error('tahun_lulus')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- BADGE --}}
                <div class="form-group">
                    <label>Badge</label>
                    <input type="text"
                           name="badge"
                           class="form-control @error('badge') is-invalid @enderror"
                           value="{{ old('badge', $alumni->badge ?? '') }}"
                           placeholder="Contoh: Inspiratif, Teladan, Aktif Dakwah">
                    <small class="text-muted">Label kecil yang muncul di pojok foto.</small>
                    @error('badge')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- PROFESI / KAMPUS --}}
                <div class="form-group">
                    <label>Profesi / Kampus <span class="text-danger">*</span></label>
                    <input type="text"
                           name="profesi_atau_kampus"
                           class="form-control @error('profesi_atau_kampus') is-invalid @enderror"
                           value="{{ old('profesi_atau_kampus', $alumni->profesi_atau_kampus ?? '') }}"
                           placeholder="Guru Tahfidz / Universitas Indonesia">
                    <small class="text-muted">
                        Untuk tipe Sebaran isi profesi, untuk Kiprah isi nama kampus.
                    </small>
                    @error('profesi_atau_kampus')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- DESKRIPSI --}}
                <div class="form-group mb-0">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control @error('deskripsi') is-invalid @enderror"
                              rows="3"
                              placeholder="Deskripsi singkat tentang alumni...">{{ old('deskripsi', $alumni->deskripsi ?? '') }}</textarea>
                    @error('deskripsi')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
    </div>

    {{-- Kolom kanan --}}
    <div class="col-lg-4">

        {{-- Publikasi --}}
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-cog mr-1"></i> Pengaturan
                </h3>
            </div>
            <div class="card-body">

                {{-- HAFALAN JUZ --}}
                <div class="form-group">
                    <label>Hafalan Juz <span class="text-danger">*</span></label>
                    <input type="number"
                           name="hafalan_juz"
                           class="form-control @error('hafalan_juz') is-invalid @enderror"
                           value="{{ old('hafalan_juz', $alumni->hafalan_juz ?? 0) }}"
                           min="0"
                           max="30">
                    @error('hafalan_juz')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- URUTAN --}}
                <div class="form-group">
                    <label>Urutan</label>
                    <input type="number"
                           name="urutan"
                           class="form-control @error('urutan') is-invalid @enderror"
                           value="{{ old('urutan', $alumni->urutan ?? 0) }}"
                           min="0">
                    <small class="text-muted">Angka lebih kecil tampil lebih awal.</small>
                    @error('urutan')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- IS ACTIVE --}}
                <div class="form-group mb-0">
                    <div class="custom-control custom-switch">
                        <input type="checkbox"
                               name="is_active"
                               id="is_active"
                               class="custom-control-input"
                               value="1"
                               {{ old('is_active', $alumni->is_active ?? true) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">
                            Tampilkan di halaman publik
                        </label>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-save mr-1"></i>
                    {{ isset($alumni) ? 'Simpan Perubahan' : 'Tambah Alumni' }}
                </button>
                <a href="{{ route('admin.alumni.index') }}"
                   class="btn btn-default btn-block mt-1">
                    <i class="fas fa-times mr-1"></i> Batal
                </a>
            </div>
        </div>

        {{-- Foto --}}
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-image mr-1"></i> Foto Alumni
                </h3>
            </div>
            <div class="card-body">

                @if(isset($alumni) && $alumni->foto)
                    <div class="form-group">
                        <img src="{{ $alumni->foto_url }}"
                             alt="{{ $alumni->nama }}"
                             class="img-fluid rounded mb-1"
                             style="max-height:140px;width:100%;object-fit:cover;">
                        <small class="text-muted">Foto saat ini</small>
                    </div>
                @endif

                <div class="form-group mb-0">
                    <label>
                        {{ isset($alumni) && $alumni->foto ? 'Ganti Foto' : 'Upload Foto' }}
                        <small class="text-muted">(jpg/png/webp, maks 2MB)</small>
                    </label>
                    <div class="custom-file">
                        <input type="file"
                               id="foto"
                               name="foto"
                               class="custom-file-input @error('foto') is-invalid @enderror"
                               accept="image/*"
                               onchange="previewFoto(this)">
                        <label class="custom-file-label" for="foto">Pilih foto...</label>
                    </div>
                    @error('foto')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                    <img id="foto-preview"
                         class="img-fluid rounded mt-2 d-none"
                         style="max-height:140px;width:100%;object-fit:cover;"
                         alt="Preview">
                </div>

            </div>
        </div>

    </div>
</div>

<script>
function previewFoto(input) {
    const preview = document.getElementById('foto-preview');
    const label = input.nextElementSibling;
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>