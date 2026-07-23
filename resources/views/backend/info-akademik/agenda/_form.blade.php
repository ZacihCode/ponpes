@csrf
@isset($agenda)
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
                        value="{{ old('urutan', $agenda->urutan ?? '') }}"
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
                        value="{{ old('judul', $agenda->judul ?? '') }}"
                        placeholder="cth. Ujian Akhir Semester"
                    >
                    @error('judul')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Tipe --}}
            <div class="col-md-2">
                <div class="form-group">
                    <label for="tipe">Tipe <span class="text-danger">*</span></label>
                    <select name="tipe" id="tipe"
                            class="form-control @error('tipe') is-invalid @enderror">
                        <option value="info"
                            {{ old('tipe', $agenda->tipe ?? 'info') === 'info' ? 'selected' : '' }}>
                            Info
                        </option>
                        <option value="warning"
                            {{ old('tipe', $agenda->tipe ?? '') === 'warning' ? 'selected' : '' }}>
                            Peringatan
                        </option>
                        <option value="success"
                            {{ old('tipe', $agenda->tipe ?? '') === 'success' ? 'selected' : '' }}>
                            Sukses
                        </option>
                    </select>
                    @error('tipe')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Status --}}
            <div class="col-md-2">
                <div class="form-group">
                    <label class="d-block">Status</label>
                    <div class="custom-control custom-switch mt-2">
                        <input
                            type="checkbox"
                            name="is_active"
                            id="is_active"
                            class="custom-control-input"
                            value="1"
                            {{ old('is_active', $agenda->is_active ?? true) ? 'checked' : '' }}
                        >
                        <label class="custom-control-label" for="is_active">Aktif</label>
                    </div>
                </div>
            </div>

        </div>

        {{-- Isi --}}
        <div class="form-group mb-0">
            <label for="isi">Isi <span class="text-danger">*</span></label>
            <textarea
                name="isi"
                id="isi"
                rows="5"
                class="form-control @error('isi') is-invalid @enderror"
                placeholder="Isi agenda..."
            >{{ old('isi', $agenda->isi ?? '') }}</textarea>
            @error('isi')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
</div>

{{-- Submit --}}
<div class="mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i>
        @isset($agenda) Perbarui Data @else Simpan Data @endisset
    </button>
    <a href="{{ route('admin.info-akademik.index') }}" class="btn btn-secondary ml-2">Batal</a>
</div>