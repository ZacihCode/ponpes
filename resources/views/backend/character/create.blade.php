@extends('backend.layouts')

@section('title', 'Tambah Pendidikan Karakter Section')

@section('content')

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Tambah Pendidikan Karakter Section</h1>
                </div>

                <div class="col-sm-6 text-right">

                    <a href="{{ route('admin.character-section.index') }}"
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
                        Form Pendidikan Karakter Section
                    </h3>

                </div>

                <form action="{{ route('admin.character-section.store') }}"
                      method="POST">

                    @csrf

                    <div class="card-body">

                        {{-- Section Title --}}
                        <div class="form-group">

                            <label>
                                Judul Section
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="section_title"
                                class="form-control @error('section_title') is-invalid @enderror"
                                value="{{ old('section_title') }}"
                                placeholder="Masukkan judul section">

                            @error('section_title')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        {{-- Content Title --}}
                        <div class="form-group">

                            <label>
                                Judul Konten
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                placeholder="Masukkan judul konten">

                            @error('title')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        {{-- Description --}}
                        <div class="form-group">

                            <label>
                                Deskripsi
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="description"
                                rows="8"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Masukkan deskripsi">{{ old('description') }}</textarea>

                            @error('description')

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
                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </section>

@endsection