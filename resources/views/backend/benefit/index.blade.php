@extends('backend.layouts')

@section('title', 'Data Benefit')

@section('content')

<!-- Header -->
<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Data Benefit</h1>
            </div>

            <div class="col-sm-6 text-right">

                <a href="{{ route('admin.benefit.create') }}"
                   class="btn btn-primary">

                    <i class="fas fa-plus"></i>
                    Tambah Benefit

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

                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close">

                    <span aria-hidden="true">
                        &times;
                    </span>

                </button>

                {{ session('success') }}

            </div>
        @endif

        {{-- CARD BENEFIT --}}
        <div class="card shadow-sm">

            <div class="card-header">
                <h3 class="card-title mb-0">
                    Daftar Benefit
                </h3>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover table-bordered mb-0">

                        <thead class="thead-light">

                            <tr>
                                <th width="8%" class="text-center">
                                    No
                                </th>

                                <th width="20%">
                                    Judul
                                </th>

                                <th>
                                    Deskripsi
                                </th>

                                <th width="20%" class="text-center">
                                    Action
                                </th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($items as $item)

                                <tr>

                                    <td class="text-center align-middle">
                                        {{ $item->order }}
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

                                        <a href="{{ route('admin.benefit.edit', $item->id) }}"
                                           class="btn btn-warning btn-sm">

                                            <i class="fas fa-edit"></i>
                                            Edit

                                        </a>

                                        <form action="{{ route('admin.benefit.destroy', $item->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus benefit ini?')">

                                                <i class="fas fa-trash"></i>
                                                Hapus

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4"
                                        class="text-center py-5">

                                        <img
                                            src="https://cdn-icons-png.flaticon.com/512/7486/7486740.png"
                                            width="120"
                                            class="mb-3"
                                        >

                                        <h5 class="font-weight-bold">
                                            Data Benefit Masih Kosong
                                        </h5>

                                        <p class="text-muted mb-0">
                                            Silakan tambahkan benefit baru.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        {{-- CARD GAMBAR BENEFIT --}}
        <div class="card shadow-sm mt-4">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h3 class="card-title mb-0">
                    Gambar Benefit
                </h3>

                @if($imageCount >= 3)

                    <a href="{{ route('admin.benefit-image.manage') }}"
                       class="btn btn-warning btn-sm">

                        <i class="fas fa-edit"></i>
                        Edit Gambar

                    </a>

                @else

                    <a href="{{ route('admin.benefit-image.manage') }}"
                       class="btn btn-primary btn-sm">

                        <i class="fas fa-plus"></i>
                        Tambah Gambar

                    </a>

                @endif

            </div>

            <div class="card-body">

                <div class="row">

                    {{-- LEFT IMAGE --}}
                    <div class="col-md-4 mb-3">

                        <h6 class="font-weight-bold text-center mb-3">
                            Left Image
                        </h6>

                        <div class="border rounded p-2 text-center">

                            @if(isset($images['left']))

                                <img
                                    src="{{ asset('storage/' . $images['left']->image) }}"
                                    class="img-fluid rounded shadow-sm"
                                    style="height: 180px; width: 100%; object-fit: cover;"
                                >

                            @else

                                <div class="py-5 text-muted">
                                    Belum Ada Gambar
                                </div>

                            @endif

                        </div>

                    </div>

                    {{-- CENTER IMAGE --}}
                    <div class="col-md-4 mb-3">

                        <h6 class="font-weight-bold text-center mb-3">
                            Center Image
                        </h6>

                        <div class="border rounded p-2 text-center">

                            @if(isset($images['center']))

                                <img
                                    src="{{ asset('storage/' . $images['center']->image) }}"
                                    class="img-fluid rounded shadow-sm"
                                    style="height: 180px; width: 100%; object-fit: cover;"
                                >

                            @else

                                <div class="py-5 text-muted">
                                    Belum Ada Gambar
                                </div>

                            @endif

                        </div>

                    </div>

                    {{-- RIGHT IMAGE --}}
                    <div class="col-md-4 mb-3">

                        <h6 class="font-weight-bold text-center mb-3">
                            Right Image
                        </h6>

                        <div class="border rounded p-2 text-center">

                            @if(isset($images['right']))

                                <img
                                    src="{{ asset('storage/' . $images['right']->image) }}"
                                    class="img-fluid rounded shadow-sm"
                                    style="height: 180px; width: 100%; object-fit: cover;"
                                >

                            @else

                                <div class="py-5 text-muted">
                                    Belum Ada Gambar
                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection