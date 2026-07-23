@extends('backend.layouts')

@section('title', 'Tambah Carousel Pendidikan Karakter')

@section('content')

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Tambah Carousel Pendidikan Karakter</h1>
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
                        Form Carousel Pendidikan Karakter
                    </h3>

                </div>

                <form action="{{ route('admin.character-carousel.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="card-body">

                        {{-- Judul Carousel --}}
                        <div class="form-group">

                            <label>
                                Judul Carousel
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                placeholder="Masukkan judul carousel">

                            @error('title')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        {{-- Gambar --}}
                        <div class="form-group">

                            <label>
                                Gambar
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="file"
                                name="image"
                                id="imageInput"
                                class="form-control-file @error('image') is-invalid @enderror"
                                accept=".jpg,.jpeg,.png,.webp">

                            @error('image')

                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        {{-- Preview Image --}}
                        <div class="form-group">

                            <img
                                id="previewImage"
                                src="https://placehold.co/600x300?text=Preview+Image"
                                class="img-fluid rounded shadow-sm"
                                style="max-height: 300px; object-fit: cover;">

                        </div>

                        {{-- Urutan --}}
                        <div class="form-group">

                            <label>
                                Urutan
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                name="order"
                                class="form-control @error('order') is-invalid @enderror"
                                value="{{ old('order', 0) }}"
                                min="0">

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
                                    name="is_active"
                                    value="1"
                                    class="custom-control-input"
                                    id="is_active"
                                    {{ old('is_active', true) ? 'checked' : '' }}>

                                <label
                                    class="custom-control-label"
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

@push('scripts')

<script>

    const imageInput = document.getElementById('imageInput');
    const previewImage = document.getElementById('previewImage');

    imageInput.addEventListener('change', function(event) {

        const file = event.target.files[0];

        if (file) {

            previewImage.src = URL.createObjectURL(file);

        }

    });

</script>

@endpush