@extends('backend.layouts')

@section('title', 'Data Kurikulum')

@section('content')

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Data Kurikulum</h1>
                </div>

                <!-- <div class="col-sm-6 text-right">

                    <a href="{{ route('admin.curiculum-item.create') }}"
                    class="btn btn-primary">

                        <i class="fas fa-plus"></i>
                        Tambah Item

                    </a>

                </div> -->

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
                        Kurikulum Section
                    </h3>

                    @if($section)

                        <a href="{{ route('admin.curiculum-section.edit', $section->id) }}"
                        class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>
                            Edit Section

                        </a>

                    @else

                        <a href="{{ route('admin.curiculum-section.create') }}"
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
                                Judul
                            </label>

                            <p class="mb-0">
                                {{ $section->title }}
                            </p>

                        </div>

                        <div>

                            <label class="font-weight-bold">
                                Intro
                            </label>

                            <p class="mb-0">
                                {{ $section->intro }}
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
                                Kurikulum Section Belum Ada
                            </h5>

                            <p class="text-muted mb-0">
                                Silakan tambahkan data section terlebih dahulu.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

            {{-- CARD ITEM --}}
            <div class="card shadow-sm mt-4">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h3 class="card-title mb-0">
                        Kurikulum Items
                    </h3>

                    <a href="{{ route('admin.curiculum-item.create') }}"
                    class="btn btn-primary btn-sm">

                        <i class="fas fa-plus"></i>
                        Tambah Item

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

                                    <th width="15%">
                                        Icon
                                    </th>

                                    <th width="25%">
                                        Judul
                                    </th>

                                    <th>
                                        Deskripsi
                                    </th>

                                    <th width="10%" class="text-center">
                                        Status
                                    </th>

                                    <th width="18%" class="text-center">
                                        Action
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($items as $item)

                                    <tr>

                                        <td class="text-center align-middle">
                                            {{ $item->order }}
                                        </td>

                                        <td class="align-middle">
                                            <i class="{{ $item->icon }}"></i>
                                            <small class="ml-2 text-muted">
                                                {{ $item->icon }}
                                            </small>
                                        </td>

                                        <td class="align-middle">
                                            <strong>
                                                {{ $item->title }}
                                            </strong>
                                        </td>

                                        <td class="align-middle">
                                            {{ Str::limit($item->description, 100) }}
                                        </td>

                                        <td class="text-center align-middle">

                                            @if($item->is_active)

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

                                            <a href="{{ route('admin.curiculum-item.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">

                                                <i class="fas fa-edit"></i>
                                                Edit

                                            </a>

                                            <form action="{{ route('admin.curiculum-item.destroy', $item->id) }}"
                                                method="POST"
                                                class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus item ini?')">

                                                    <i class="fas fa-trash"></i>
                                                    Hapus

                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6"
                                            class="text-center py-5">

                                            <img
                                                src="https://cdn-icons-png.flaticon.com/512/7486/7486740.png"
                                                width="120"
                                                class="mb-3"
                                            >

                                            <h5 class="font-weight-bold">
                                                Kurikulum Item Masih Kosong
                                            </h5>

                                            <p class="text-muted mb-0">
                                                Silakan tambahkan item kurikulum.
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