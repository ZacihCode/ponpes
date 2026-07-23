@extends('backend.layouts')

@section('title', 'Kategori Ekstrakurikuler')

@section('content')

<!-- Header -->
<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Kategori Ekstrakurikuler</h1>
            </div>

            <div class="col-sm-6 text-right">

                <a href="{{ route('admin.extracurricular-categories.create') }}"
                   class="btn btn-primary">

                    <i class="fas fa-plus"></i>
                    Tambah Kategori

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
                    Daftar Kategori
                </h3>
            </div>

            <div class="card-body p-0">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Urutan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($categories as $category)
                            <tr>

                                {{-- No --}}
                                <td>{{ $loop->iteration }}</td>

                                {{-- Name --}}
                                <td>
                                    <strong>{{ $category->name }}</strong>
                                </td>

                                {{-- Slug --}}
                                <td>
                                    <code>{{ $category->slug }}</code>
                                </td>

                                {{-- Order --}}
                                <td>
                                    {{ $category->order }}
                                </td>

                                {{-- Action --}}
                                <td>

                                    <a href="{{ route('admin.extracurricular-categories.edit', $category) }}"
                                       class="btn btn-sm btn-warning">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <form action="{{ route('admin.extracurricular-categories.destroy', $category->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus kategori ini?')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Belum ada kategori
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