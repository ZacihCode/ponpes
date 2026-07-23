@extends('backend.layouts')

@section('title', 'Edit Mudabbir')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 fw-semibold">Edit Mudabbir</h1>
        <a href="{{ route('admin.organisasi-santri.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.organisasi-santri.mudabbir.update', $mudabbir) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="kamar">Kamar</label>
                    <input type="text" name="kamar" id="kamar"
                           class="form-control @error('kamar') is-invalid @enderror"
                           value="{{ old('kamar', $mudabbir->kamar) }}">
                    @error('kamar')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama"
                           class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $mudabbir->nama) }}"
                           placeholder="Contoh: Ahmad Nur Ridwan">
                    @error('nama')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="urutan">Urutan</label>
                    <input type="number" name="urutan" id="urutan" min="0"
                           class="form-control @error('urutan') is-invalid @enderror"
                           value="{{ old('urutan', $mudabbir->urutan) }}">
                    @error('urutan')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" name="aktif" id="aktif" value="1" class="form-check-input"
                           {{ old('aktif', $mudabbir->aktif) ? 'checked' : '' }}>
                    <label for="aktif" class="form-check-label">Aktif (tampilkan di halaman frontend)</label>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.organisasi-santri.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection