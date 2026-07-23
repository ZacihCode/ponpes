@extends('backend.layouts')

@section('title', 'Tambah ' . $label)

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-semibold mb-0">Tambah {{ $label }}</h4>
            <small class="text-muted">Lengkapi judul dan konten untuk bagian ini</small>
        </div>
        <a href="{{ route('admin.sejarah.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-1"></i> Periksa kembali input yang Anda masukkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.sejarah.store') }}" method="POST">
                @csrf
                <input type="hidden" name="tipe" value="{{ $tipe }}">

                <div class="mb-3">
                    <label class="form-label">Tipe</label>
                    <input type="text" class="form-control" value="{{ $label }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" id="judul"
                           class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul') }}" placeholder="Mis. {{ $label }}">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="konten" class="form-label">Konten</label>
                    <textarea name="konten" id="konten" rows="8"
                              class="form-control @error('konten') is-invalid @enderror">{{ old('konten') }}</textarea>
                    @error('konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </form>
        </div>
    </div>

    <div class="alert alert-info mt-4 mb-0">
        <i class="fas fa-info-circle me-1"></i>
        Setelah data ini disimpan, Anda bisa menambahkan gambar carousel di halaman <strong>Edit</strong>.
    </div>
</div>
@endsection