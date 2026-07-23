@extends('backend.layouts')

@section('title', 'Tambah Kategori Ekstrakurikuler')

@section('content')

<!-- Header -->
<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Tambah Kategori Ekstrakurikuler</h1>
            </div>

            <div class="col-sm-6 text-right">

                <a href="{{ route('admin.extracurricular-categories.index') }}"
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
                    Form Tambah Kategori
                </h3>
            </div>

            <form action="{{ route('admin.extracurricular-categories.store') }}"
                  method="POST">

                @csrf

                <div class="card-body">

                    {{-- Nama Kategori --}}
                    <div class="form-group">
                        <label>Nama Kategori</label>

                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Contoh: Seni, Beladiri, Kesehatan">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Urutan --}}
                    <div class="form-group">
                        <label>Urutan</label>

                        <input type="number"
                               name="order"
                               value="{{ old('order', 0) }}"
                               class="form-control @error('order') is-invalid @enderror">

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
                        Simpan Kategori

                    </button>

                </div>

            </form>

        </div>

    </div>
</section>

@endsection