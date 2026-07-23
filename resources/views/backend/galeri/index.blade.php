@extends('backend.layouts')

@section('title', 'Kelola Galeri')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="m-0">Kelola Galeri</h4>
        <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Foto
        </a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    {{-- Table --}}
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th width="40">#</th>
                        <th width="80">Foto</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th width="80">Urutan</th>
                        <th width="100">Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody id="sortable-galeri">
                    @forelse($galeris as $galeri)
                        <tr data-id="{{ $galeri->id }}" style="cursor: grab;">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                <img
                                    src="{{ asset('storage/' . $galeri->foto) }}"
                                    alt="{{ $galeri->judul }}"
                                    style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;"
                                />
                            </td>
                            <td>{{ $galeri->judul }}</td>
                            <td>{{ $galeri->deskripsi ?? '-' }}</td>
                            <td class="text-center">{{ $galeri->urutan }}</td>
                            <td class="text-center">
                                <button
                                    class="btn btn-sm toggle-active {{ $galeri->is_active ? 'btn-success' : 'btn-secondary' }}"
                                    data-id="{{ $galeri->id }}"
                                    data-url="{{ route('admin.galeri.toggle-active', $galeri) }}"
                                >
                                    {{ $galeri->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.galeri.edit', $galeri) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada foto galeri.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($galeris->hasPages())
            <div class="card-footer">
                {{ $galeris->links() }}
            </div>
        @endif
    </div>

</div>
@endsection

@push('scripts')
{{-- SortableJS --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    // Drag to reorder
    const el = document.getElementById('sortable-galeri');
    if (el) {
        Sortable.create(el, {
            animation: 150,
            onEnd: function () {
                const orders = [...el.querySelectorAll('tr')].map(tr => tr.dataset.id);
                fetch('{{ route('admin.galeri.update-order') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ orders }),
                });
            }
        });
    }

    // Toggle active
    document.querySelectorAll('.toggle-active').forEach(btn => {
        btn.addEventListener('click', function () {
            const url = this.dataset.url;
            const button = this;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (data.is_active) {
                        button.classList.remove('btn-secondary');
                        button.classList.add('btn-success');
                        button.textContent = 'Aktif';
                    } else {
                        button.classList.remove('btn-success');
                        button.classList.add('btn-secondary');
                        button.textContent = 'Nonaktif';
                    }
                }
            });
        });
    });
</script>
@endpush