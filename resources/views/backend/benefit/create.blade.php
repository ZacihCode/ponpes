@extends('backend.layouts')

@section('title', 'Tambah Benefit')

@section('content')

<!-- Header -->
<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Tambah Benefit</h1>
            </div>

            <div class="col-sm-6 text-right">

                <a href="{{ route('admin.benefit.index') }}"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>
                    Kembali

                </a>

            </div>

        </div>

    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">

        <div class="card card-primary card-outline">

            <div class="card-header">

                <h3 class="card-title">
                    Form Tambah Benefit
                </h3>

            </div>

            <form action="{{ route('admin.benefit.store') }}"
                  method="POST">

                @csrf

                <div class="card-body">

                    {{-- Judul --}}
                    <div class="form-group">

                        <label>Judul Benefit</label>

                        <input type="text"
                               name="title"
                               value="{{ old('title') }}"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="Contoh: Pembinaan Tahfidz Intensif">

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group">

                        <label>Deskripsi Benefit</label>

                        <textarea
                            name="description"
                            rows="5"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Masukkan deskripsi benefit">{{ old('description') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Urutan --}}
                    <div class="form-group">

                        <label>Urutan Benefit</label>

                        <input type="number"
                               name="order"
                               value="{{ old('order', 1) }}"
                               class="form-control @error('order') is-invalid @enderror"
                               placeholder="Masukkan urutan benefit">

                        @error('order')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                <div class="card-footer text-right">

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fas fa-save"></i>
                        Simpan Benefit

                    </button>

                </div>

            </form>

        </div>

    </div>
</section>

@endsection