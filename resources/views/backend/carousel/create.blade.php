@extends('backend.layouts')

@section('title', 'Tambah Carousel')

@section('content')


        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Carousel</h1>
                    </div>

                    <div class="col-sm-6 text-right">
                        <a href="{{ route('admin.carousel.index') }}"
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
                            Form Tambah Carousel
                        </h3>
                    </div>

                    <form action="{{ route('admin.carousel.store') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="card-body">

                            {{-- Image --}}
                            <div class="form-group">
                                <label>Gambar Carousel</label>

                                <input type="file"
                                    name="image"
                                    class="form-control @error('image') is-invalid @enderror"
                                    accept="image/*"
                                    id="imageInput">

                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Preview Image --}}
                            <div class="form-group">
                                <img id="previewImage"
                                    src="https://placehold.co/600x300?text=Preview+Image"
                                    class="img-fluid rounded shadow-sm"
                                    style="max-height: 300px; object-fit: cover;">
                            </div>

                            {{-- Order --}}
                            <div class="form-group">
                                <label>Urutan Carousel</label>

                                <input type="number"
                                    name="order"
                                    value="{{ old('order') }}"
                                    class="form-control @error('order') is-invalid @enderror"
                                    placeholder="Masukkan urutan carousel">

                                @error('order')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="form-group">

                                <div class="custom-control custom-switch">

                                    <input type="checkbox"
                                        name="is_active"
                                        value="1"
                                        class="custom-control-input"
                                        id="statusCarousel"
                                        checked>

                                    <label class="custom-control-label"
                                        for="statusCarousel">
                                        Aktifkan Carousel
                                    </label>

                                </div>

                            </div>

                        </div>

                        <div class="card-footer text-right">

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Simpan Carousel
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