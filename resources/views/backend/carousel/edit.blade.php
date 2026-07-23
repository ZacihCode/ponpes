@extends('backend.layouts')

@section('title', 'Edit Carousel')

@section('content')

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Edit Carousel</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.carousel.index') }}" class="btn btn-secondary">
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

            <div class="card-header">
                <h3 class="card-title">
                    Form Edit Carousel
                </h3>
            </div>

            <form action="{{ route('admin.carousel.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Preview Lama --}}
                    <div class="form-group">

                        <label>Preview Gambar Lama</label>

                        <div>
                            <img src="{{ asset('storage/' . $carousel->image) }}" class="img-fluid rounded shadow-sm mb-3"style="max-height: 300px; object-fit: cover;">
                        </div>

                    </div>

                    {{-- Upload Baru --}}
                    <div class="form-group">

                        <label>Ganti Gambar</label>

                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="imageInput">

                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Preview Baru --}}
                    <div class="form-group">
                        <img id="previewImage" src="{{ asset('storage/' . $carousel->image) }}" class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: cover;">
                    </div>

                    {{-- Order --}}
                    <div class="form-group">
                        <label>Urutan Carousel</label>
                        <input type="number" name="order" value="{{ old('order', $carousel->order) }}" class="form-control">
                    </div>

                    {{-- Status --}}
                    <div class="form-group">

                        <div class="custom-control custom-switch">

                            <input type="checkbox" name="is_active" value="1" class="custom-control-input" id="statusCarousel" {{ $carousel->is_active ? 'checked' : '' }}>

                            <label class="custom-control-label" for="statusCarousel">
                                Aktifkan Carousel
                            </label>

                        </div>

                    </div>

                </div>

                <div class="card-footer text-right">

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Update Carousel
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