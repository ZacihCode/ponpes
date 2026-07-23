@extends('backend.layouts')

@section('title', 'Data Ekstrakurikuler')

@section('content')

<!-- Header -->
<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Data Ekstrakurikuler</h1>
            </div>

            <div class="col-sm-6 text-right">

                <a href="{{ route('admin.extracurriculars.create') }}"
                   class="btn btn-primary">

                    <i class="fas fa-plus"></i>
                    Tambah Ekskul

                </a>

            </div>

        </div>

    </div>
</section>

<!-- Content -->
<section class="content">
    <div class="container-fluid">

        <div class="card card-outline card-primary">

            <div class="card-header">
                <h3 class="card-title">
                    Daftar Ekstrakurikuler
                </h3>
            </div>

            <div class="card-body p-0">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Icon</th>
                            <th>Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($extracurriculars as $item)
                            <tr>

                                {{-- No --}}
                                <td>{{ $loop->iteration }}</td>

                                {{-- Title --}}
                                <td>
                                    <strong>{{ $item->title }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        {{ $item->short_description }}
                                    </small>
                                </td>

                                {{-- Category Badge --}}
                                <td>
                                    <span class="badge badge-info">
                                        {{ $item->category->name ?? '-' }}
                                    </span>
                                </td>

                                {{-- Icon --}}
                                <td>
                                    <i class="{{ $item->icon }}"></i>
                                    <small class="text-muted d-block">
                                        {{ $item->icon }}
                                    </small>
                                </td>

                                {{-- Status --}}
                                <td>
                                    @if ($item->is_active)
                                        <span class="badge badge-success">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                {{-- Action --}}
                                <td>

                                    <a href="{{ route('admin.extracurriculars.edit', $item->id) }}"
                                       class="btn btn-sm btn-warning">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <form action="{{ route('admin.extracurriculars.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus data ini?')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Tidak ada data ekstrakurikuler
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</section>

@endsection