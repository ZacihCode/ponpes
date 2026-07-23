@extends('backend.layouts')

@section('title', 'Data Carousel')

@section('content')

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Carousel</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.carousel.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Tambah Carousel
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            {{-- Alert Success --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-sm">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        List Carousel
                    </h3>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0">

                            <thead class="thead-light">
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="20%">Image</th>
                                    <th width="15%" class="text-center">Order</th>
                                    <th width="15%" class="text-center">Status</th>
                                    <th width="20%" class="text-center">Created At</th>
                                    <th width="25%" class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($carousels as $carousel)

                                    <tr>
                                        <td class="text-center align-middle">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="align-middle text-center">
                                            <img
                                                src="{{ asset('storage/' . $carousel->image) }}"
                                                alt="Carousel Image"
                                                class="img-fluid rounded shadow-sm"
                                                style="width: 180px; height: 100px; object-fit: cover;"
                                            >
                                        </td>

                                        <td class="text-center align-middle">
                                            {{ $carousel->order }}
                                        </td>

                                        <td class="text-center align-middle">

                                            @if ($carousel->is_active)
                                                <span class="badge badge-success px-3 py-2">
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="badge badge-danger px-3 py-2">
                                                    Nonaktif
                                                </span>
                                            @endif

                                        </td>

                                        <td class="text-center align-middle">
                                            {{ $carousel->created_at->format('d M Y') }}
                                        </td>

                                        <td class="text-center align-middle">

                                            <a href="{{ route('admin.carousel.edit', $carousel->id) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('admin.carousel.destroy', $carousel->id) }}"
                                                method="POST"
                                                class="d-inline"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus carousel ini?')"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                    Hapus
                                                </button>
                                            </form>

                                        </td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center py-5">

                                            <img
                                                src="https://cdn-icons-png.flaticon.com/512/7486/7486740.png"
                                                width="120"
                                                class="mb-3"
                                            >

                                            <h5 class="font-weight-bold">
                                                Data Carousel Masih Kosong
                                            </h5>

                                            <p class="text-muted mb-0">
                                                Silakan tambahkan carousel baru.
                                            </p>

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