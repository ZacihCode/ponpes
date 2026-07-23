@extends('backend.layouts')

@section('title', 'Tambah Alumni')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Alumni</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.alumni.index') }}">Alumni</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <form action="{{ route('admin.alumni.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @include('backend.alumni.form')
        </form>
    </div>
</section>
@endsection