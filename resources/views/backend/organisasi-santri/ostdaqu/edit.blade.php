@extends('backend.layouts')

@section('title', 'Edit Jabatan OSTDAQU')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 fw-semibold">Edit Jabatan OSTDAQU</h1>
        <a href="{{ route('admin.organisasi-santri.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.organisasi-santri.ostdaqu.update', $ostdaqu) }}" method="POST">
                @include('backend.organisasi-santri.ostdaqu._form')
            </form>
        </div>
    </div>

</div>
@endsection
