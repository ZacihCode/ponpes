@extends('backend.layouts')

@section('title', 'Kelola Produk')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="m-0">Kelola Produk</h4>
        <a href="{{ route('admin.produk.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Produk
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
                        <th width="80">Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th width="100">Badge</th>
                        <th width="80">Urutan</th>
                        <th width="100">Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody id="sortable-produk">
                    @forelse($produks as $produk)
                        <tr data-id="{{ $produk->id }}" style="cursor: grab;">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                <img
                                    src="{{ asset('storage/' . $produk->gambar) }}"
                                    alt="{{ $produk->nama }}"
                                    style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;"
                                />
                            </td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->kategori }}</td>
                            <td>{{ $produk->harga_format }}</td>
                            <td class="text-center">
                                @if($produk->badge)
                                    <span class="badge badge-info">{{ $produk->badge }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $produk->urutan }}</td>
                            <td class="text-center">
                                <button
                                    class="btn btn-sm toggle-active {{ $produk->is_active ? 'btn-success' : 'btn-secondary' }}"
                                    data-id="{{ $produk->id }}"
                                    data-url="{{ route('admin.produk.toggle-active', $produk) }}"
                                >
                                    {{ $produk->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.produk.edit', $produk) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
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
                            <td colspan="9" class="text-center text-muted py-4">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($produks->hasPages())
            <div class="card-footer">
                {{ $produks->links() }}
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
    const el = document.getElementById('sortable-produk');
    if (el) {
        Sortable.create(el, {
            animation: 150,
            onEnd: function () {
                const orders = [...el.querySelectorAll('tr')].map(tr => tr.dataset.id);
                fetch('{{ route('admin.produk.update-order') }}', {
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