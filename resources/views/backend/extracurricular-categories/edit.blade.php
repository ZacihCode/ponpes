@extends('backend.layouts')

@section('title', 'Edit Kategori Ekstrakurikuler')

@section('content')

<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Edit Kategori</h1>
            </div>

            <div class="col-sm-6 text-right">

                <a href="{{ route('admin.extracurricular-categories.index') }}"
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

            <form action="{{ route('admin.extracurricular-categories.update', $category) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- NAME --}}
                    <div class="form-group">
                        <label>Nama Kategori</label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $category->name) }}"
                               class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ORDER --}}
                    <div class="form-group">
                        <label>Urutan</label>

                        <input type="number"
                               name="order"
                               value="{{ old('order', $category->order) }}"
                               class="form-control @error('order') is-invalid @enderror">

                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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

    </div>
</section>

@endsection