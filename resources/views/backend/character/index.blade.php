@extends('backend.layouts')

@section('title', 'Data Pendidikan Karakter')

@section('content')

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Data Pendidikan Karakter</h1>
                </div>

            </div>

        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            {{-- Success Message --}}
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    <button type="button"
                            class="close"
                            data-dismiss="alert">

                        <span>&times;</span>

                    </button>

                    {{ session('success') }}

                </div>

            @endif

            {{-- CARD SECTION --}}
            <div class="card shadow-sm">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h3 class="card-title mb-0">
                        Pendidikan Karakter Section
                    </h3>

                    @if($section)

                        <a href="{{ route('admin.character-section.edit', $section) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>
                            Edit Section

                        </a>

                    @else

                        <a href="{{ route('admin.character-section.create') }}"
                           class="btn btn-primary btn-sm">

                            <i class="fas fa-plus"></i>
                            Tambah Section

                        </a>

                    @endif

                </div>

                <div class="card-body">

                    @if($section)

                        <div class="mb-3">

                            <label class="font-weight-bold">
                                Judul Section
                            </label>

                            <p class="mb-0">
                                {{ $section->section_title }}
                            </p>

                        </div>

                        <div class="mb-3">

                            <label class="font-weight-bold">
                                Judul Konten
                            </label>

                            <p class="mb-0">
                                {{ $section->title }}
                            </p>

                        </div>

                        <div>

                            <label class="font-weight-bold">
                                Deskripsi
                            </label>

                            <p class="mb-0">
                                {{ $section->description }}
                            </p>

                        </div>

                    @else

                        <div class="text-center py-4">

                            <img
                                src="https://cdn-icons-png.flaticon.com/512/7486/7486740.png"
                                width="120"
                                class="mb-3"
                            >

                            <h5 class="font-weight-bold">
                                Data Section Belum Ada
                            </h5>

                            <p class="text-muted mb-0">
                                Silakan tambahkan data section terlebih dahulu.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

            {{-- CARD CAROUSEL --}}
            <div class="card shadow-sm mt-4">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h3 class="card-title mb-0">
                        Carousel Pendidikan Karakter
                    </h3>

                    <a href="{{ route('admin.character-carousel.create') }}"
                       class="btn btn-primary btn-sm">

                        <i class="fas fa-plus"></i>
                        Tambah Carousel

                    </a>

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover table-bordered mb-0">

                            <thead class="thead-light">

                                <tr>

                                    <th width="8%" class="text-center">
                                        Order
                                    </th>

                                    <th width="20%">
                                        Gambar
                                    </th>

                                    <th>
                                        Judul Carousel
                                    </th>

                                    <th width="10%" class="text-center">
                                        Status
                                    </th>

                                    <th width="20%" class="text-center">
                                        Action
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($carousels as $carousel)

                                    <tr>

                                        <td class="text-center align-middle">
                                            {{ $carousel->order }}
                                        </td>

                                        <td class="text-center align-middle">

                                            <img
                                                src="{{ asset('storage/' . $carousel->image) }}"
                                                width="120"
                                                class="rounded shadow-sm"
                                            >

                                        </td>

                                        <td class="align-middle">
                                            {{ $carousel->title }}
                                        </td>

                                        <td class="text-center align-middle">

                                            @if($carousel->is_active)

                                                <span class="badge badge-success">
                                                    Aktif
                                                </span>

                                            @else

                                                <span class="badge badge-secondary">
                                                    Nonaktif
                                                </span>

                                            @endif

                                        </td>

                                        <td class="text-center align-middle">

                                            <a href="{{ route('admin.character-carousel.edit', $carousel->id) }}"
                                               class="btn btn-warning btn-sm">

                                                <i class="fas fa-edit"></i>
                                                Edit

                                            </a>

                                            <form action="{{ route('admin.character-carousel.destroy', $carousel->id) }}"
                                                  method="POST"
                                                  class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus carousel ini?')">

                                                    <i class="fas fa-trash"></i>
                                                    Hapus

                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5"
                                            class="text-center py-5">

                                            <img
                                                src="https://cdn-icons-png.flaticon.com/512/7486/7486740.png"
                                                width="120"
                                                class="mb-3"
                                            >

                                            <h5 class="font-weight-bold">
                                                Carousel Masih Kosong
                                            </h5>

                                            <p class="text-muted mb-0">
                                                Silakan tambahkan carousel pendidikan karakter.
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