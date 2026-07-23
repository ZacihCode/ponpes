@extends('backend.layouts')

@section('title', 'Tambah Mudabbir')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 fw-semibold">Tambah Mudabbir</h1>
        <a href="{{ route('admin.organisasi-santri.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.organisasi-santri.mudabbir.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="kamar">Kamar</label>
                    <input type="text" name="kamar" id="kamar"
                           class="form-control @error('kamar') is-invalid @enderror"
                           value="{{ old('kamar') }}"
                           placeholder="Contoh: Al-Fatih 202">
                    @error('kamar')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nama Mudabbir</label>
                    <div id="nama-wrapper">
                        @php $namaLama = old('nama', ['']); @endphp
                        @foreach($namaLama as $i => $nama)
                        <div class="input-group mb-2 nama-row">
                            <input type="text" name="nama[]"
                                   class="form-control @error('nama.'.$i) is-invalid @enderror"
                                   value="{{ $nama }}"
                                   placeholder="Contoh: Ahmad Nur Ridwan">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-danger btn-remove-nama">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @error('nama.'.$i)
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        @endforeach
                    </div>
                    <button type="button" id="btn-add-nama" class="btn btn-sm btn-outline-primary mt-1">
                        <i class="fas fa-plus"></i> Tambah Nama
                    </button>
                    <small class="form-text text-muted">
                        Tambahkan satu input untuk setiap mudabbir di kamar ini.
                    </small>
                </div>

                <div class="form-group">
                    <label for="urutan">Urutan Awal</label>
                    <input type="number" name="urutan" id="urutan" min="0"
                           class="form-control @error('urutan') is-invalid @enderror"
                           value="{{ old('urutan', 0) }}">
                    @error('urutan')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small class="form-text text-muted">
                        Nama pertama akan memakai urutan ini, nama berikutnya otomatis +1.
                    </small>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" name="aktif" id="aktif" value="1" class="form-check-input"
                           {{ old('aktif', true) ? 'checked' : '' }}>
                    <label for="aktif" class="form-check-label">Aktif (tampilkan di halaman frontend)</label>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.organisasi-santri.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.getElementById('btn-add-nama').addEventListener('click', function () {
        const wrapper = document.getElementById('nama-wrapper');
        const row = document.createElement('div');
        row.className = 'input-group mb-2 nama-row';
        row.innerHTML = `
            <input type="text" name="nama[]" class="form-control" placeholder="Contoh: Arif Sumarecon">
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-danger btn-remove-nama">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        wrapper.appendChild(row);
    });

    document.getElementById('nama-wrapper').addEventListener('click', function (e) {
        if (e.target.closest('.btn-remove-nama')) {
            const rows = document.querySelectorAll('.nama-row');
            if (rows.length > 1) {
                e.target.closest('.nama-row').remove();
            }
        }
    });
</script>
@endpush