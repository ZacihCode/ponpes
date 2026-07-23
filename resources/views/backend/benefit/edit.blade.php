@extends('backend.layouts')

@section('title', 'Edit Benefit')

@section('content')

<!-- Header -->
<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Edit Benefit</h1>
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

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">

        <div class="card card-primary card-outline">

            <div class="card-header">
                <h3 class="card-title">
                    Form Edit Benefit
                </h3>
            </div>

            <form action="{{ route('admin.benefit.update', $benefit->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Title --}}
                    <div class="form-group">

                        <label>Judul Benefit</label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $benefit->title) }}"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Masukkan judul benefit"
                        >

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Description --}}
                    <div class="form-group">

                        <label>Deskripsi Benefit</label>

                        <textarea
                            name="description"
                            rows="5"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Masukkan deskripsi benefit"
                        >{{ old('description', $benefit->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Order --}}
                    <div class="form-group">

                        <label>Urutan Benefit</label>

                        <input
                            type="number"
                            name="order"
                            value="{{ old('order', $benefit->order) }}"
                            class="form-control @error('order') is-invalid @enderror"
                            placeholder="Masukkan urutan benefit"
                        >

                        @error('order')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                <div class="card-footer text-right">

                    <button
                        type="submit"
                        class="btn btn-warning">

                        <i class="fas fa-save"></i>
                        Update Benefit

                    </button>

                </div>

            </form>

        </div>

    </div>
</section>

@endsection