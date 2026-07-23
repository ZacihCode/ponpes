@extends('backend.layouts')

@section('title', 'Edit Curriculum Item')

@section('content')

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Edit Curriculum Item</h1>
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
                        Form Edit Curriculum Item
                    </h3>

                </div>

                <form action="{{ route('admin.curiculum-item.update', $item->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

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
                                value="{{ old('icon', $item->icon) }}"
                                placeholder="Contoh: fas fa-quran">

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
                                value="{{ old('title', $item->title) }}"
                                placeholder="Masukkan judul kurikulum">

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
                                placeholder="Masukkan deskripsi kurikulum">{{ old('description', $item->description) }}</textarea>

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
                                class="form-control @error('order') is-invalid @enderror"
                                value="{{ old('order', $item->order) }}"
                                min="1">

                            @error('order')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Status --}}
                        <div class="form-group">

                            <div class="custom-control custom-checkbox">

                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    class="custom-control-input"
                                    id="is_active"
                                    {{ old('is_active', $item->is_active) ? 'checked' : '' }}>

                                <label class="custom-control-label"
                                    for="is_active">

                                    Aktifkan item ini

                                </label>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer text-right">

                        <button type="submit"
                                class="btn btn-warning">

                            <i class="fas fa-save"></i>
                            Update

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </section>

@endsection