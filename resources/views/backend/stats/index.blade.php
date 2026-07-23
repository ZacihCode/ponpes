@extends('backend.layouts')

@section('title', 'Kelola Stats')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-semibold mb-0">Kelola Stats</h4>
            <small class="text-muted">Section statistik halaman utama</small>
        </div>
        <a href="{{ route('admin.stats.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Stat
        </a>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Preview Section --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-light border-0 py-3">
            <span class="fw-semibold text-muted small text-uppercase letter-spacing-1">
                <i class="fas fa-eye me-1"></i> Preview
            </span>
        </div>
        <div class="card-body">
            <div class="row g-3 justify-content-center">
                @foreach ($stats->where('is_active', true)->sortBy('order') as $stat)
                    <div class="col-6 col-md-3">
                        <div class="text-center p-3 rounded border bg-white">
                            <div class="mb-2" style="font-size: 1.75rem; color: #4f46e5;">
                                <i class="{{ $stat->icon }}"></i>
                            </div>
                            <div class="fw-bold fs-5">{{ $stat->number }}</div>
                            <div class="text-muted small">{{ $stat->label }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0" id="statsTable">
                    <thead class="table-light">
                        <tr>
                            <th width="40" class="ps-4">
                                <i class="fas fa-grip-vertical text-muted" title="Drag untuk ubah urutan"></i>
                            </th>
                            <th>Ikon</th>
                            <th>Angka</th>
                            <th>Label</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="sortableStats">
                        @forelse ($stats as $stat)
                            <tr data-id="{{ $stat->id }}">
                                <td class="ps-4">
                                    <i class="fas fa-grip-vertical text-muted drag-handle" style="cursor: grab;"></i>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="stat-icon-preview rounded d-flex align-items-center justify-content-center"
                                             style="width:38px;height:38px;background:#eef2ff;">
                                            <i class="{{ $stat->icon }}" style="color:#4f46e5;font-size:1.1rem;"></i>
                                        </div>
                                        <code class="small text-muted">{{ $stat->icon }}</code>
                                    </div>
                                </td>
                                <td class="fw-semibold">{{ $stat->number }}</td>
                                <td>{{ $stat->label }}</td>
                                <td>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                        {{ $stat->order }}
                                    </span>
                                </td>
                                <td>
                                    @if ($stat->is_active)
                                        <span class="badge bg-success bg-opacity-10 text-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.stats.edit', $stat) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.stats.destroy', $stat) }}"
                                          method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus stat ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-chart-bar fa-2x mb-2 d-block opacity-25"></i>
                                    Belum ada data stat. <a href="{{ route('admin.stats.create') }}">Tambah sekarang</a>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
{{-- SortableJS untuk drag & drop urutan --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
const tbody = document.getElementById('sortableStats');
if (tbody) {
    Sortable.create(tbody, {
        handle: '.drag-handle',
        animation: 150,
        onEnd: function () {
            const ids = [...tbody.querySelectorAll('tr[data-id]')]
                .map(tr => tr.dataset.id);

            fetch('{{ route('admin.stats.update-order') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ order: ids }),
            })
            .then(r => r.json())
            .then(d => {
                const toast = document.createElement('div');
                toast.className = 'position-fixed bottom-0 end-0 m-3 alert alert-success py-2 px-3 shadow-sm';
                toast.style.zIndex = 9999;
                toast.textContent = d.message;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 2500);
            });
        },
    });
}
</script>
@endpush