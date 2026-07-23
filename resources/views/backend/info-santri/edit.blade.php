@extends('backend.layouts')
@section('title', 'Edit Prestasi')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Prestasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.info-santri.index') }}">Info Santri</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Prestasi</h3>
            </div>
            <form action="{{ route('admin.info-santri.update', $infoSantri) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('backend.info-santri._form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
                    <a href="{{ route('admin.info-santri.index') }}" class="btn btn-secondary ml-2">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection