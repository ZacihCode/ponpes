{{-- resources/views/backend/info-akademik/jadwal-harian/_table.blade.php --}}
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.info-akademik.jadwal-harian.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i> Tambah Jadwal
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-light border-0 py-3 d-flex justify-content-between align-items-center">
        <span class="fw-semibold text-muted small text-uppercase">
            <i class="fas fa-clock me-1"></i> Daftar Jadwal Harian
        </span>
        <small class="text-muted">
            <i class="fas fa-grip-vertical me-1"></i> Drag untuk mengurutkan
        </small>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th width="40"></th>
                    <th width="120">Waktu</th>
                    <th>Kegiatan</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="jadwal-sortable">
                @forelse ($jadwals as $item)
                <tr data-id="{{ $item->id }}">
                    <td class="text-center text-muted">
                        <i class="fas fa-grip-vertical" style="cursor: grab;"></i>
                    </td>
                    <td>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                    <td>{{ $item->kegiatan }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.info-akademik.jadwal-harian.edit', $item) }}"
                           class="btn btn-sm btn-warning" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.info-akademik.jadwal-harian.destroy', $item) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        <i class="fas fa-calendar-times fa-2x mb-2 d-block opacity-25"></i>
                        Belum ada jadwal harian.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    const jadwalSortable = document.getElementById('jadwal-sortable');
    if (jadwalSortable) {
        Sortable.create(jadwalSortable, {
            handle: '.fa-grip-vertical',
            animation: 150,
            onEnd: function () {
                const order = [...jadwalSortable.querySelectorAll('tr[data-id]')]
                    .map(row => row.dataset.id);

                fetch('{{ route('admin.info-akademik.jadwal-harian.order') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order })
                });
            }
        });
    }
</script>
@endpush