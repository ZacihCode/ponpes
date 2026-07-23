@extends('backend.layouts')

@section('title', 'Tambah Ekstrakurikuler')

@section('content')

<!-- Header -->
<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Tambah Ekstrakurikuler</h1>
            </div>

            <div class="col-sm-6 text-right">

                <a href="{{ route('admin.extracurriculars.index') }}"
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
                    Form Tambah Ekstrakurikuler
                </h3>
            </div>

            <form action="{{ route('admin.extracurriculars.store') }}"
                  method="POST">

                @csrf

                <div class="card-body">

                    {{-- Kategori --}}
                    <div class="form-group">
                        <label>Kategori</label>

                        <select name="category_id"
                                class="form-control @error('category_id') is-invalid @enderror">

                            <option value="">-- Pilih Kategori --</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Judul --}}
                    <div class="form-group">
                        <label>Judul Ekstrakurikuler</label>

                        <input type="text"
                               name="title"
                               value="{{ old('title') }}"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="Contoh: Marawis">

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Icon --}}
                    <div class="form-group">
                        <label>Icon (FontAwesome)</label>

                        <input type="text"
                               name="icon"
                               value="{{ old('icon') }}"
                               class="form-control @error('icon') is-invalid @enderror"
                               placeholder="fas fa-drum">

                        @error('icon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Deskripsi Singkat --}}
                    <div class="form-group">
                        <label>Deskripsi Singkat</label>

                        <textarea name="short_description"
                                rows="3"
                                class="form-control @error('short_description') is-invalid @enderror"
                                placeholder="Deskripsi singkat untuk card">{{ old('short_description') }}</textarea>

                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi Panjang --}}
                    <div class="form-group">
                        <label>Deskripsi Lengkap</label>

                        <textarea name="description"
                                id="description"
                                rows="6"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Deskripsi detail untuk modal">{{ old('description') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">

                        {{-- Order --}}
                        <div class="col-md-6">
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

                        {{-- Status --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>

                                <select name="is_active"
                                        class="form-control @error('is_active') is-invalid @enderror">

                                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>
                                        Aktif
                                    </option>

                                    <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>
                                        Nonaktif
                                    </option>

                                </select>

                                @error('is_active')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- INFO GALLERY --}}
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle"></i>
                        Foto galeri dapat diupload setelah data ekstrakurikuler disimpan.
                    </div>

                </div>

                <div class="card-footer text-right">

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan Ekstrakurikuler
                    </button>

                </div>

            </form>

        </div>

    </div>
</section>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', '|',
                'bulletedList', 'numberedList', '|',
                'blockQuote', 'link', '|',
                'undo', 'redo'
            ],
            language: 'id',
        })
        .catch(error => console.error(error));
</script>
@endpush

@endsection