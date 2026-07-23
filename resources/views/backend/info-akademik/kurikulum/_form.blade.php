@csrf
@isset($kurikulum)
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
                            {{ old('tipe', $kurikulum->tipe ?? '') === 'kolom_kiri' ? 'selected' : '' }}>
                            Kolom Kiri
                        </option>
                        <option value="kolom_kanan"
                            {{ old('tipe', $kurikulum->tipe ?? '') === 'kolom_kanan' ? 'selected' : '' }}>
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
                        value="{{ old('urutan', $kurikulum->urutan ?? '') }}"
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
                        value="{{ old('judul', $kurikulum->judul ?? '') }}"
                        placeholder="cth. Kurikulum Tahfidz Qur'an"
                    >
                    @error('judul')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>

        {{-- Poin-poin --}}
        <div class="form-group mb-0">
            <label>Poin-poin <span class="text-danger">*</span></label>
            @error('poin_poin')
                <div class="text-danger small mb-1">{{ $message }}</div>
            @enderror
            @error('poin_poin.*')
                <div class="text-danger small mb-1">{{ $message }}</div>
            @enderror

            <div id="poin-wrapper">
                @foreach (old('poin_poin', $kurikulum->poin_poin ?? ['']) as $poin)
                    <div class="input-group mb-2 poin-item">
                        <input
                            type="text"
                            name="poin_poin[]"
                            class="form-control"
                            value="{{ $poin }}"
                            placeholder="Isi poin..."
                        >
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-danger btn-hapus-poin">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-outline-primary btn-sm mt-1" id="btn-tambah-poin">
                <i class="fas fa-plus me-1"></i> Tambah Poin
            </button>
        </div>

    </div>
</div>

{{-- Submit --}}
<div class="mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i>
        @isset($kurikulum) Perbarui Data @else Simpan Data @endisset
    </button>
    <a href="{{ route('admin.info-akademik.index') }}" class="btn btn-secondary ml-2">Batal</a>
</div>

@push('scripts')
<script>
    document.getElementById('btn-tambah-poin').addEventListener('click', function () {
        const wrapper = document.getElementById('poin-wrapper');
        const div = document.createElement('div');
        div.className = 'input-group mb-2 poin-item';
        div.innerHTML = `
            <input type="text" name="poin_poin[]" class="form-control" placeholder="Isi poin...">
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-danger btn-hapus-poin">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        wrapper.appendChild(div);
        bindHapus();
    });

    function bindHapus() {
        document.querySelectorAll('.btn-hapus-poin').forEach(function (btn) {
            btn.onclick = function () {
                const wrapper = document.getElementById('poin-wrapper');
                const items = wrapper.querySelectorAll('.poin-item');
                if (items.length > 1) {
                    this.closest('.poin-item').remove();
                } else {
                    alert('Minimal harus ada 1 poin.');
                }
            };
        });
    }

    bindHapus();
</script>
@endpush