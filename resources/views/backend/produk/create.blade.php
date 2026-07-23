@extends('backend.layouts')

@section('title', 'Tambah Produk')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="m-0">Tambah Produk</h4>
        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('backend.produk._form')
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
            </form>
        </div>
    </div>

</div>
@endsection