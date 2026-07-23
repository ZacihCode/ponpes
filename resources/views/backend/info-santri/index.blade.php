@extends('backend.layouts')
@section('title', 'Info Santri - Prestasi')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Prestasi Santri</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Info Santri</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daftar Prestasi Santri</h3>
                <a href="{{ route('admin.info-santri.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> Tambah Prestasi
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="50">No</th>
                                <th width="80">Foto</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Nama Santri</th>
                                <th>Kelas</th>
                                <th>Tahun</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($infoSantris as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ Storage::url($item->foto) }}"
                                             alt="{{ $item->judul }}"
                                             style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px;">
                                    </td>
                                    <td>{{ $item->judul }}</td>
                                    <td><span class="badge badge-info">{{ $item->kategori }}</span></td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->tahun }}</td>
                                    <td>
                                        <a href="{{ route('admin.info-santri.edit', $item) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.info-santri.destroy', $item) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Hapus prestasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        Belum ada data prestasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection