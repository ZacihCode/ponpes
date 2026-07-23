@csrf
@isset($evaluasi)
    @method('PUT')
@endisset

{{-- Alert Error --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-1"></i> Mohon periksa kembali form di bawah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="row">

            {{-- Tipe --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tipe">Tipe Kolom <span class="text-danger">*</span></label>
                    <select name="tipe" id="tipe"
                            class="form-control @error('tipe') is-invalid @enderror">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="kolom_kiri"
                            {{ old('tipe', $evaluasi->tipe ?? '') === 'kolom_kiri' ? 'selected' : '' }}>
                            Kolom Kiri
                        </option>
                        <option value="kolom_kanan"
                            {{ old('tipe', $evaluasi->tipe ?? '') === 'kolom_kanan' ? 'selected' : '' }}>
                            Kolom Kanan
                        </option>
                    </select>
                    @error('tipe')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Urutan --}}
            <div class="col-md-2">
                <div class="form-group">
                    <label for="urutan">Urutan <span class="text-danger">*</span></label>
                    <input
                        type="number"
                        name="urutan"
                        id="urutan"
                        min="1"
                        class="form-control @error('urutan') is-invalid @enderror"
                        value="{{ old('urutan', $evaluasi->urutan ?? '') }}"
                        placeholder="cth. 1"
                    >
                    @error('urutan')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Judul --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="judul">Judul <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="judul"
                        id="judul"
                        class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul', $evaluasi->judul ?? '') }}"
                        placeholder="cth. Evaluasi Tahfidz"
                    >
                    @error('judul')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>

        {{-- Deskripsi --}}
        <div class="form-group mb-0">
            <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
            <textarea
                name="deskripsi"
                id="deskripsi"
                rows="5"
                class="form-control @error('deskripsi') is-invalid @enderror"
                placeholder="Isi deskripsi evaluasi..."
            >{{ old('deskripsi', $evaluasi->deskripsi ?? '') }}</textarea>
            @error('deskripsi')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
</div>

{{-- Submit --}}
<div class="mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i>
        @isset($evaluasi) Perbarui Data @else Simpan Data @endisset
    </button>
    <a href="{{ route('admin.info-akademik.index') }}" class="btn btn-secondary ml-2">Batal</a>
</div>