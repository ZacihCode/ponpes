@extends('backend.layouts')

@section('title', 'Edit ' . $sejarah->judul)

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-semibold mb-0">Edit {{ $sejarah->judul }}</h4>
            <small class="text-muted">{{ \App\Models\Sejarah::TIPE_LABELS[$sejarah->tipe] }}</small>
        </div>
        <a href="{{ route('admin.sejarah.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Form Judul & Konten --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 py-3">
                    <span class="fw-semibold text-muted small text-uppercase">
                        <i class="fas fa-align-left me-1"></i> Konten Teks
                    </span>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sejarah.update', $sejarah) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Tipe</label>
                            <input type="text" class="form-control" value="{{ \App\Models\Sejarah::TIPE_LABELS[$sejarah->tipe] }}" disabled>
                            <small class="text-muted">Tipe tidak dapat diubah.</small>
                        </div>

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" name="judul" id="judul"
                                   class="form-control @error('judul') is-invalid @enderror"
                                   value="{{ old('judul', $sejarah->judul) }}">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="konten" class="form-label">Konten</label>
                            <textarea name="konten" id="konten" rows="10"
                                      class="form-control @error('konten') is-invalid @enderror">{{ old('konten', $sejarah->konten) }}</textarea>
                            @error('konten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Galeri Gambar Carousel --}}
        <div class="col-lg-5">

            {{-- Form upload gambar baru --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-0 py-3">
                    <span class="fw-semibold text-muted small text-uppercase">
                        <i class="fas fa-upload me-1"></i> Tambah Gambar
                    </span>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sejarah.images.store', $sejarah) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="file" name="gambar" accept="image/*"
                                   class="form-control @error('gambar') is-invalid @enderror">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format jpg, jpeg, png, webp. Maks 2MB.</small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Upload Gambar
                        </button>
                    </form>
                </div>
            </div>

            {{-- Daftar gambar yang sudah ada --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 py-3">
                    <span class="fw-semibold text-muted small text-uppercase">
                        <i class="fas fa-th-large me-1"></i> Gambar Carousel ({{ $sejarah->images->count() }})
                    </span>
                </div>
                <div class="card-body">
                    @forelse ($sejarah->images as $image)
                        <div class="d-flex align-items-start gap-3 mb-3 pb-3 border-bottom">
                            <img src="{{ $image->url }}" class="rounded flex-shrink-0"
                                 style="width:70px;height:70px;object-fit:cover;">

                            <form action="{{ route('admin.images.update', $image) }}" method="POST"
                                  enctype="multipart/form-data" class="flex-grow-1">
                                @csrf
                                @method('PUT')
                                <div class="row g-2 align-items-center">
                                    <div class="col-12">
                                        <input type="file" name="gambar" accept="image/*" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-7">
                                        <input type="number" name="urutan" value="{{ $image->urutan }}" min="0"
                                               class="form-control form-control-sm" placeholder="Urutan">
                                    </div>
                                    <div class="col-5 text-end">
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="fas fa-save"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <form action="{{ route('admin.images.destroy', $image) }}" method="POST"
                                  onsubmit="return confirm('Hapus gambar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-muted text-center py-3 mb-0">
                            <i class="fas fa-image fa-2x mb-2 d-block opacity-25"></i>
                            Belum ada gambar.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>
@endsection