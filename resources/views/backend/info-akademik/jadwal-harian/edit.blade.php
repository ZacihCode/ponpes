{{-- resources/views/backend/info-akademik/jadwal-harian/edit.blade.php --}}
@extends('backend.layouts')

@section('title', 'Edit Jadwal Harian')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 fw-semibold">Edit Jadwal Harian</h1>
        <a href="{{ route('admin.info-akademik.jadwal-harian.create') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <form action="{{ route('admin.info-akademik.jadwal-harian.update', $jadwalHarian) }}" method="POST">
        @include('backend.info-akademik.jadwal-harian._form')
    </form>

</div>
@endsection