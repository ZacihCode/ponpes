{{-- backend/berita/form.blade.php --}}

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        <h5><i class="fas fa-exclamation-triangle"></i> Periksa kembali inputan:</h5>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">

    {{-- Kolom kiri: konten utama --}}
    <div class="col-lg-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-newspaper mr-1"></i> Informasi Berita
                </h3>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label for="judul">Judul <span class="text-danger">*</span></label>
                    <input type="text" id="judul" name="judul"
                           class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul', $berita->judul ?? '') }}"
                           placeholder="Masukkan judul berita">
                    @error('judul')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="excerpt">
                        Ringkasan <span class="text-danger">*</span>
                        <small class="text-muted">(tampil di halaman utama)</small>
                    </label>
                    <textarea id="excerpt" name="excerpt" rows="3"
                              class="form-control @error('excerpt') is-invalid @enderror"
                              placeholder="Tulis ringkasan singkat berita...">{{ old('excerpt', $berita->excerpt ?? '') }}</textarea>
                    @error('excerpt')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <label for="konten">
                        Konten Lengkap
                        <small class="text-muted">(opsional)</small>
                    </label>
                    <textarea id="konten" name="konten" rows="10"
                              class="form-control @error('konten') is-invalid @enderror"
                              placeholder="Tulis isi lengkap berita...">{{ old('konten', $berita->konten ?? '') }}</textarea>
                    @error('konten')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
    </div>

    {{-- Kolom kanan: pengaturan --}}
    <div class="col-lg-4">

        {{-- Publikasi --}}
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-cog mr-1"></i> Publikasi
                </h3>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label for="tanggal_publish">
                        Tanggal Terbit <span class="text-danger">*</span>
                    </label>
                    <input type="date" id="tanggal_publish" name="tanggal_publish"
                           class="form-control @error('tanggal_publish') is-invalid @enderror"
                           value="{{ old('tanggal_publish', isset($berita) ? $berita->tanggal_publish->format('Y-m-d') : now()->format('Y-m-d')) }}">
                    @error('tanggal_publish')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select id="status" name="status"
                            class="form-control @error('status') is-invalid @enderror">
                        <option value="draf" @selected(old('status', $berita->status ?? 'draf') === 'draf')>
                            Draf
                        </option>
                        <option value="terbit" @selected(old('status', $berita->status ?? '') === 'terbit')>
                            Terbit
                        </option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-save mr-1"></i>
                    {{ isset($berita) ? 'Perbarui Berita' : 'Simpan Berita' }}
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-default btn-block mt-1">
                    <i class="fas fa-times mr-1"></i> Batal
                </a>
            </div>
        </div>

        {{-- Foto Berita --}}
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-image mr-1"></i> Foto Berita
                </h3>
            </div>
            <div class="card-body">

                @if (isset($berita) && $berita->gambar)
                    <div class="form-group">
                        <img src="{{ Storage::url($berita->gambar) }}"
                             alt="{{ $berita->judul }}"
                             class="img-fluid rounded mb-1"
                             style="max-height:140px;width:100%;object-fit:cover">
                        <small class="text-muted">Foto saat ini</small>
                    </div>
                @endif

                <div class="form-group mb-0">
                    <label for="gambar">
                        {{ isset($berita) && $berita->gambar ? 'Ganti Foto' : 'Upload Foto' }}
                        <small class="text-muted">(jpg/png, maks 2MB)</small>
                    </label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" id="gambar" name="gambar"
                                   class="custom-file-input @error('gambar') is-invalid @enderror"
                                   accept="image/*"
                                   onchange="previewGambar(this)">
                            <label class="custom-file-label" for="gambar">Pilih foto...</label>
                        </div>
                    </div>
                    @error('gambar')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                    <img id="gambar-preview" class="img-fluid rounded mt-2 d-none"
                         style="max-height:140px;width:100%;object-fit:cover" alt="Preview">
                </div>

            </div>
        </div>

    </div>
</div>

<script>
function previewGambar(input) {
    const preview = document.getElementById('gambar-preview');
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

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#konten'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', '|',
                'bulletedList', 'numberedList', '|',
                'blockQuote', 'link', '|',
                'undo', 'redo'
            ],
            language: 'id',
        })
        .catch(error => console.error(error));
</script>
@endpush