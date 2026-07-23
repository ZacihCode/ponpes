@extends('backend.layouts')

@section('title', 'Tambah Kurikulum Section')

@section('content')

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Tambah Kurikulum Section</h1>
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
                        Form Kurikulum Section
                    </h3>

                </div>

                <form action="{{ route('admin.curiculum-section.store') }}"
                    method="POST">

                    @csrf

                    <div class="card-body">

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
                                placeholder="Masukkan judul section">

                            @error('title')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        {{-- Intro --}}
                        <div class="form-group">

                            <label>
                                Intro <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="intro"
                                rows="8"
                                class="form-control @error('intro') is-invalid @enderror"
                                placeholder="Masukkan deskripsi intro">{{ old('intro') }}</textarea>

                            @error('intro')

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