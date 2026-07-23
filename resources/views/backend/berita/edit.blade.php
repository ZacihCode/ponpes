@extends('backend.layouts')

@section('title', 'Edit Berita')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Berita</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.berita.index') }}">Berita</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('backend.berita.form')
        </form>
    </div>
</section>
@endsection