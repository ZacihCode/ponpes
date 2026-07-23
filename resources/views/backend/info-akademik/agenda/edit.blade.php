@extends('backend.layouts')

@section('title', 'Edit Agenda')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 fw-semibold">Edit Agenda</h1>
        <a href="{{ route('admin.info-akademik.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.info-akademik.agenda.update', $agenda) }}" method="POST">
        @include('backend.info-akademik.agenda._form', ['agenda' => $agenda])
    </form>

</div>
@endsection