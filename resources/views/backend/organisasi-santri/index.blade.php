@extends('backend.layouts')

@section('title', 'Organisasi Santri')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 fw-semibold">Organisasi Santri</h1>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    {{-- Card dengan Tabs --}}
    <div class="card">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="organisasi-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-ostdaqu-link" data-toggle="tab" href="#tab-ostdaqu" role="tab">
                        <i class="fas fa-mosque me-1"></i> OSTDAQU
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-mudabbir-link" data-toggle="tab" href="#tab-mudabbir" role="tab">
                        <i class="fas fa-user-tie me-1"></i> Mudabbir
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-ketua-kelas-link" data-toggle="tab" href="#tab-ketua-kelas" role="tab">
                        <i class="fas fa-book me-1"></i> Ketua Kelas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-ketua-asrama-link" data-toggle="tab" href="#tab-ketua-asrama" role="tab">
                        <i class="fas fa-building me-1"></i> Ketua Asrama
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="organisasi-tabs-content">

                {{-- TAB: OSTDAQU --}}
                <div class="tab-pane fade show active" id="tab-ostdaqu" role="tabpanel">
                    @include('backend.organisasi-santri.ostdaqu._table', ['ostdaquPositions' => $ostdaquPositions])
                </div>

                {{-- TAB: MUDABBIR --}}
                <div class="tab-pane fade" id="tab-mudabbir" role="tabpanel">
                    @include('backend.organisasi-santri.mudabbir._table', ['mudabbir' => $mudabbir])
                </div>

                {{-- TAB: KETUA KELAS --}}
                <div class="tab-pane fade" id="tab-ketua-kelas" role="tabpanel">
                    @include('backend.organisasi-santri.ketua-kelas._table', ['ketuaKelas' => $ketuaKelas])
                </div>

                {{-- TAB: KETUA ASRAMA --}}
                <div class="tab-pane fade" id="tab-ketua-asrama" role="tabpanel">
                    @include('backend.organisasi-santri.ketua-asrama._table', ['ketuaAsrama' => $ketuaAsrama])
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Pertahankan tab aktif setelah redirect (misal setelah create/update/delete)
    $(document).ready(function () {
        let activeTab = localStorage.getItem('organisasiSantriActiveTab');
        if (activeTab) {
            $('#organisasi-tabs a[href="' + activeTab + '"]').tab('show');
        }

        $('#organisasi-tabs a').on('click', function () {
            localStorage.setItem('organisasiSantriActiveTab', $(this).attr('href'));
        });
    });
</script>
@endpush
