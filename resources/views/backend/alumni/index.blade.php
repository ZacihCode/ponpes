@extends('backend.layouts')

@section('title', 'Kelola Alumni')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 fw-semibold">Kelola Alumni</h1>
        <a href="{{ route('admin.alumni.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Alumni
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    {{-- Filter Tipe --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex gap-2">
                <a href="{{ route('admin.alumni.index') }}"
                   class="btn btn-sm {{ !request('tipe') ? 'btn-primary' : 'btn-outline-primary' }}">
                    Semua
                </a>
                <a href="{{ route('admin.alumni.index', ['tipe' => 'sebaran']) }}"
                   class="btn btn-sm {{ request('tipe') === 'sebaran' ? 'btn-success' : 'btn-outline-success' }}">
                    Sebaran Alumni
                </a>
                <a href="{{ route('admin.alumni.index', ['tipe' => 'kiprah']) }}"
                   class="btn btn-sm {{ request('tipe') === 'kiprah' ? 'btn-info' : 'btn-outline-info' }}">
                    Kiprah Alumni
                </a>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3" style="width:50px">#</th>
                            <th style="width:70px">Foto</th>
                            <th>Nama</th>
                            <th style="width:100px">Tipe</th>
                            <th>Profesi / Kampus</th>
                            <th style="width:80px">Lulus</th>
                            <th style="width:80px" class="text-center">Juz</th>
                            <th style="width:90px" class="text-center">Status</th>
                            <th style="width:110px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alumnis as $alumni)
                            <tr>

                                <td class="ps-3 text-muted small">
                                    {{ $alumnis->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <img src="{{ $alumni->foto_url }}"
                                         alt="{{ $alumni->nama }}"
                                         class="rounded-circle"
                                         style="width:40px;height:40px;object-fit:cover;">
                                </td>

                                <td>
                                    <div class="fw-semibold small">{{ $alumni->nama }}</div>
                                    @if($alumni->badge)
                                        <span class="badge bg-warning bg-opacity-15 text-warning"
                                              style="font-size:10px;">
                                            {{ $alumni->badge }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if($alumni->tipe === 'sebaran')
                                        <span class="badge bg-success bg-opacity-15 text-success">Sebaran</span>
                                    @else
                                        <span class="badge bg-info bg-opacity-15 text-info">Kiprah</span>
                                    @endif
                                </td>

                                <td class="small">{{ $alumni->profesi_atau_kampus }}</td>

                                <td class="small text-muted">{{ $alumni->tahun_lulus }}</td>

                                <td class="text-center small">{{ $alumni->hafalan_juz }} Juz</td>

                                <td class="text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                               class="custom-control-input toggle-active"
                                               id="toggle-{{ $alumni->id }}"
                                               data-id="{{ $alumni->id }}"
                                               {{ $alumni->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label"
                                               for="toggle-{{ $alumni->id }}">
                                        </label>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('admin.alumni.edit', $alumni) }}"
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.alumni.destroy', $alumni) }}"
                                              method="POST"
                                              onsubmit="return confirm('Hapus alumni {{ $alumni->nama }}? Foto juga akan dihapus.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="fas fa-user-graduate d-block mb-1" style="font-size:24px"></i>
                                    Belum ada data alumni
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($alumnis->hasPages())
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $alumnis->links() }}
                </div>
            </div>
        @endif
    </div>

</div>

@push('scripts')
<script>
    document.querySelectorAll('.toggle-active').forEach(function (toggle) {
        toggle.addEventListener('change', function () {
            const id = this.dataset.id;
            const checkbox = this;

            fetch(`/admin/alumni/${id}/toggle-active`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    checkbox.checked = !checkbox.checked;
                }
            })
            .catch(() => {
                checkbox.checked = !checkbox.checked;
            });
        });
    });
</script>
@endpush

@endsection