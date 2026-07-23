@extends('backend.layouts')

@section('title', 'Kelola Berita')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 fw-semibold">Kelola Berita</h1>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Berita
        </a>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    {{-- Statistik --}}
    <div class="row g-3 mb-4">
        {{-- Total Berita --}}
        <div class="col-md-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['total'] }}</h3>
                    <p>Total Berita</p>
                </div>
                <div class="icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <a href="{{ route('admin.berita.index') }}" class="small-box-footer">
                    Lihat Semua <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Terbit --}}
        <div class="col-md-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['terbit'] }}</h3>
                    <p>Berita Terbit</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check"></i>
                </div>
                <a href="{{ route('admin.berita.index', ['status' => 'terbit']) }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Draf --}}
        <div class="col-md-4">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['draf'] }}</h3>
                    <p>Berita Draf</p>
                </div>
                <div class="icon">
                    <i class="fas fa-edit"></i>
                </div>
                <a href="{{ route('admin.berita.index', ['status' => 'draf']) }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Filter & Pencarian --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.berita.index') }}" method="GET" class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small text-muted">Cari Judul</label>
                    <input type="text" name="q" class="form-control form-control-sm"
                           placeholder="Cari judul berita..." value="{{ request('q') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Status</label>
                    <select name="status" class="form-control form-control-sm">
                        <option value="">Semua Status</option>
                        <option value="terbit" @selected(request('status') === 'terbit')>Terbit</option>
                        <option value="draf" @selected(request('status') === 'draf')>Draf</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-sm btn-secondary w-100">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
                @if(request()->hasAny(['q', 'status']))
                    <div class="col-md-2">
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-outline-secondary w-100">
                            Reset
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    {{-- Tabel Berita --}}
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3" style="width:50px">#</th>
                            <th style="width:70px">Foto</th>
                            <th>Judul</th>
                            <th style="width:130px">Tanggal</th>
                            <th style="width:90px">Status</th>
                            <th style="width:120px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($beritas as $berita)
                            <tr>
                                <td class="ps-3 text-muted small">{{ $loop->iteration }}</td>
                                <td>
                                    @if ($berita->gambar)
                                        <img src="{{ Storage::url($berita->gambar) }}"
                                             alt="{{ $berita->judul }}"
                                             class="rounded" style="width:56px;height:40px;object-fit:cover">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                             style="width:56px;height:40px">
                                            <i class="ti ti-photo text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold small">{{ $berita->judul }}</div>
                                    <div class="text-muted" style="font-size:12px;max-width:320px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                        {{ $berita->excerpt }}
                                    </div>
                                </td>
                                <td class="text-muted small">
                                    {{ $berita->tanggal_publish->format('d M Y') }}
                                </td>
                                <td>
                                    @if ($berita->status === 'terbit')
                                        <span class="badge bg-success bg-opacity-15 text-success">
                                            <i class="ti ti-circle-check me-1"></i>Terbit
                                        </span>
                                    @else
                                        <span class="badge bg-warning bg-opacity-15 text-warning">
                                            <i class="ti ti-edit me-1"></i>Draf
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('admin.berita.edit', $berita) }}"
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.berita.destroy', $berita) }}"
                                              method="POST"
                                              onsubmit="return confirm('Hapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="ti ti-news-off d-block mb-1" style="font-size:24px"></i>
                                    Belum ada berita
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($beritas->hasPages())
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $beritas->links() }}
                </div>
            </div>
        @endif
    </div>

</div>
@endsection