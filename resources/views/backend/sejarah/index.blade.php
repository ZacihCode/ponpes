@extends('backend.layouts')

@section('title', 'Kelola Sejarah')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-semibold mb-0">Kelola Sejarah</h4>
            <small class="text-muted">Section Sejarah Pesantren & Sejarah Yayasan</small>
        </div>
    </div>

    {{-- Alert --}}
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
        @foreach ($tipeLabels as $tipe => $label)
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-light border-0 py-3 d-flex justify-content-between align-items-center">
                        <span class="fw-semibold text-muted small text-uppercase">
                            <i class="fas fa-book me-1"></i> {{ $label }}
                        </span>
                        @if (isset($sejarahs[$tipe]))
                            <span class="badge bg-success bg-opacity-10 text-success">Tersedia</span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary">Belum Ada</span>
                        @endif
                    </div>

                    <div class="card-body">
                        @if (isset($sejarahs[$tipe]))
                            <p class="fw-semibold mb-1">{{ $sejarahs[$tipe]->judul }}</p>
                            <p class="text-muted small mb-3">
                                {{ Str::limit(strip_tags($sejarahs[$tipe]->konten), 120) }}
                            </p>

                            @if ($sejarahs[$tipe]->images->isNotEmpty())
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($sejarahs[$tipe]->images->take(4) as $image)
                                        <img src="{{ $image->url }}" class="rounded"
                                             style="width:60px;height:60px;object-fit:cover;border:1px solid #dee2e6;">
                                    @endforeach
                                    @if ($sejarahs[$tipe]->images->count() > 4)
                                        <div class="d-flex align-items-center justify-content-center rounded bg-light text-muted small"
                                             style="width:60px;height:60px;border:1px solid #dee2e6;">
                                            +{{ $sejarahs[$tipe]->images->count() - 4 }}
                                        </div>
                                    @endif
                                </div>
                            @else
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    <i class="fas fa-exclamation-triangle me-1"></i> Belum ada gambar
                                </span>
                            @endif
                        @else
                            <p class="text-muted text-center py-3 mb-0">
                                <i class="fas fa-folder-open fa-2x mb-2 d-block opacity-25"></i>
                                Belum ada data untuk bagian ini.
                            </p>
                        @endif
                    </div>

                    <div class="card-footer bg-white border-0 pb-3">
                        @if (isset($sejarahs[$tipe]))
                            <a href="{{ route('admin.sejarah.edit', $sejarahs[$tipe]) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-1"></i> Edit Data
                            </a>
                        @else
                            <a href="{{ route('admin.sejarah.create', ['tipe' => $tipe]) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i> Tambah Data
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection