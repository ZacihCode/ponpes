@extends('backend.layouts')

@section('title', 'Tambah kurikulum Item')

@section('content')

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Tambah Kurikulum Item</h1>
                </div>

                <div class="col-sm-6 text-right">

                    <a href="{{ route('admin.curiculum-section.index') }}"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-sm">

                <div class="card-header">

                    <h3 class="card-title mb-0">
                        Form Tambah Kurikulum Item
                    </h3>

                </div>

                <form action="{{ route('admin.curiculum-item.store') }}"
                      method="POST">

                    @csrf

                    <div class="card-body">

                        {{-- Icon --}}
                        <div class="form-group">

                            <label>
                                Icon <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="icon"
                                class="form-control @error('icon') is-invalid @enderror"
                                value="{{ old('icon') }}"
                                placeholder="Contoh: fas fa-quran"
                            >

                            <small class="text-muted">
                                Gunakan class icon Font Awesome.
                            </small>

                            @error('icon')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        {{-- Title --}}
                        <div class="form-group">

                            <label>
                                Judul <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                placeholder="Masukkan judul item"
                            >

                            @error('title')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        {{-- Description --}}
                        <div class="form-group">

                            <label>
                                Deskripsi <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="description"
                                rows="5"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Masukkan deskripsi item"
                            >{{ old('description') }}</textarea>

                            @error('description')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        {{-- Order --}}
                        <div class="form-group">

                            <label>
                                Urutan <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                name="order"
                                min="1"
                                class="form-control @error('order') is-invalid @enderror"
                                value="{{ old('order') }}"
                                placeholder="Masukkan urutan tampil"
                            >

                            @error('order')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        {{-- Status --}}
                        <div class="form-group">

                            <div class="custom-control custom-switch">

                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="is_active"
                                    name="is_active"
                                    value="1"
                                    {{ old('is_active', true) ? 'checked' : '' }}
                                >

                                <label class="custom-control-label"
                                       for="is_active">

                                    Aktif

                                </label>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer text-right">

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="fas fa-save"></i>
                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </section>

@endsection