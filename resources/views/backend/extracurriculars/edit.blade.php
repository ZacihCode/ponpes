@php use Illuminate\Support\Facades\Storage; @endphp

@extends('backend.layouts')

@section('title', 'Edit Ekstrakurikuler')

@section('content')

<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Edit Ekstrakurikuler</h1>
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

<section class="content">
    <div class="container-fluid">

        <div class="card card-primary card-outline">

            <form action="{{ route('admin.extracurriculars.update', $extracurricular->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- CATEGORY --}}
                    <div class="form-group">
                        <label>Kategori</label>

                        <select name="category_id"
                                class="form-control @error('category_id') is-invalid @enderror">

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $extracurricular->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TITLE --}}
                    <div class="form-group">
                        <label>Judul</label>

                        <input type="text"
                               name="title"
                               value="{{ old('title', $extracurricular->title) }}"
                               class="form-control">

                    </div>

                    {{-- ICON --}}
                    <div class="form-group">
                        <label>Icon (FontAwesome class)</label>

                        <input type="text"
                               name="icon"
                               value="{{ old('icon', $extracurricular->icon) }}"
                               class="form-control"
                               placeholder="fas fa-drum">
                    </div>

                    {{-- SHORT DESC --}}
                    <div class="form-group">
                        <label>Deskripsi Singkat</label>

                        <textarea name="short_description"
                                  class="form-control"
                                  rows="3">{{ old('short_description', $extracurricular->short_description) }}</textarea>
                    </div>

                    {{-- FULL DESC --}}
                    <div class="form-group">
                        <label>Deskripsi Lengkap</label>

                        <textarea name="description"
                                  id="description"
                                  class="form-control"
                                  rows="6">{{ old('description', $extracurricular->description) }}</textarea>
                    </div>

                    {{-- ORDER --}}
                    <div class="form-group">
                        <label>Urutan</label>

                        <input type="number"
                               name="order"
                               value="{{ old('order', $extracurricular->order) }}"
                               class="form-control">
                    </div>

                    {{-- ACTIVE --}}
                    <div class="form-group">
                        <label>Status</label>

                        <select name="is_active" class="form-control">
                            <option value="1" {{ $extracurricular->is_active ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="0" {{ !$extracurricular->is_active ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>

                </div>

                <div class="card-footer text-right">
                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Update
                    </button>
                </div>

            </form>

        </div>

        {{-- ================= GALLERY CARD ================= --}}
        <div class="card card-outline card-success mt-4">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-images"></i>
                    Foto Galeri
                </h3>
            </div>

            {{-- FORM UPLOAD --}}
            <div class="card-body">

                <form action="{{ route('admin.extracurriculars.galleries.store', $extracurricular) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="row align-items-end">

                        <div class="col-md-8">
                            <div class="form-group mb-0">
                                <label>Upload Foto <small class="text-muted">(bisa pilih beberapa sekaligus)</small></label>

                                <div class="custom-file">
                                    <input type="file"
                                           name="images[]"
                                           id="galleryImages"
                                           multiple
                                           accept="image/*"
                                           class="custom-file-input @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror">

                                    <label class="custom-file-label" for="galleryImages">
                                        Pilih foto...
                                    </label>
                                </div>

                                @error('images')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                @error('images.*')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-upload"></i>
                                Upload Foto
                            </button>
                        </div>

                    </div>

                </form>

            </div>

            {{-- DAFTAR FOTO --}}
            <div class="card-footer p-3">

                @if ($extracurricular->galleries->isEmpty())

                    <p class="text-muted text-center mb-0">
                        <i class="fas fa-image"></i>
                        Belum ada foto galeri.
                    </p>

                @else

                    <div class="row">

                        @foreach ($extracurricular->galleries as $gallery)

                            <div class="col-6 col-md-3 mb-3">
                                <div class="card mb-0 shadow-sm">

                                    <img src="{{ Storage::url($gallery->image) }}"
                                         class="card-img-top"
                                         style="height: 140px; object-fit: cover;">

                                    <div class="card-footer p-1 text-center">

                                        <form action="{{ route('admin.extracurriculars.galleries.destroy', $gallery) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger btn-block"
                                                    onclick="return confirm('Hapus foto ini?')">
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </div>
                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>

    </div>
</section>

@push('scripts')
<script>
    const galleryInput = document.getElementById('galleryImages');
    const galleryLabel = document.querySelector('.custom-file-label');

    galleryInput.addEventListener('change', function(event) {
        const files = event.target.files;

        // Update label
        if (files.length > 0) {
            galleryLabel.textContent = files.length + ' foto dipilih';
        }

        // Hapus preview lama
        const oldPreview = document.getElementById('galleryPreview');
        if (oldPreview) oldPreview.remove();

        // Buat preview baru
        const previewContainer = document.createElement('div');
        previewContainer.id = 'galleryPreview';
        previewContainer.className = 'row mt-3';

        Array.from(files).forEach(file => {
            const col = document.createElement('div');
            col.className = 'col-6 col-md-3 mb-2';

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'img-fluid rounded shadow-sm';
            img.style = 'height: 120px; width: 100%; object-fit: cover;';

            col.appendChild(img);
            previewContainer.appendChild(col);
        });

        // Sisipkan preview setelah input file
        galleryInput.closest('.card-body').appendChild(previewContainer);
    });
</script>
@endpush

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