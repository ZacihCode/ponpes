@extends('backend.layouts')

@section('title', 'Kelola Gambar Benefit')

@section('content')

<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Kelola Gambar Benefit</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.benefit.index') }}"
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

            <div class="card-header">
                <h3 class="card-title">
                    Form Gambar Benefit
                </h3>
            </div>

            <form action="{{ route('admin.benefit-image.store-or-update') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="card-body">

                    <div class="row">

                        {{-- LEFT IMAGE --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Left Image</label>

                                <div class="mb-3 text-center">

                                    <img
                                        id="previewLeft"
                                        src="{{ isset($images['left']) 
                                                ? asset('storage/' . $images['left']->image)
                                                : 'https://placehold.co/400x300?text=Left+Image' }}"
                                        class="img-fluid rounded shadow-sm"
                                        style="height: 220px; width:100%; object-fit:cover;">

                                </div>

                                <input type="file"
                                       name="left_image"
                                       id="leftImageInput"
                                       class="form-control @error('left_image') is-invalid @enderror"
                                       accept="image/*">

                                @error('left_image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                        {{-- CENTER IMAGE --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Center Image</label>

                                <div class="mb-3 text-center">

                                    <img
                                        id="previewCenter"
                                        src="{{ isset($images['center']) 
                                                ? asset('storage/' . $images['center']->image)
                                                : 'https://placehold.co/400x300?text=Center+Image' }}"
                                        class="img-fluid rounded shadow-sm"
                                        style="height: 220px; width:100%; object-fit:cover;">

                                </div>

                                <input type="file"
                                       name="center_image"
                                       id="centerImageInput"
                                       class="form-control @error('center_image') is-invalid @enderror"
                                       accept="image/*">

                                @error('center_image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                        {{-- RIGHT IMAGE --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Right Image</label>

                                <div class="mb-3 text-center">

                                    <img
                                        id="previewRight"
                                        src="{{ isset($images['right']) 
                                                ? asset('storage/' . $images['right']->image)
                                                : 'https://placehold.co/400x300?text=Right+Image' }}"
                                        class="img-fluid rounded shadow-sm"
                                        style="height: 220px; width:100%; object-fit:cover;">

                                </div>

                                <input type="file"
                                       name="right_image"
                                       id="rightImageInput"
                                       class="form-control @error('right_image') is-invalid @enderror"
                                       accept="image/*">

                                @error('right_image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card-footer text-right">

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fas fa-save"></i>

                        {{ count($images) >= 3 
                            ? 'Update Gambar'
                            : 'Simpan Gambar' }}

                    </button>

                </div>

            </form>

        </div>

    </div>
</section>

@endsection

@push('scripts')

<script>

function setupPreview(inputId, previewId) {

    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);

    input.addEventListener('change', function(event) {

        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
        }

    });

}

setupPreview('leftImageInput', 'previewLeft');
setupPreview('centerImageInput', 'previewCenter');
setupPreview('rightImageInput', 'previewRight');

</script>