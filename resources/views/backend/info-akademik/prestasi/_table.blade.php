{{-- Toolbar --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted small">
        Total: <strong>{{ $prestasis->count() }}</strong> record
    </span>
    <a href="{{ route('admin.info-akademik.prestasi.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i> Tambah Prestasi
    </a>
</div>

@if ($prestasis->isEmpty())
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5 text-muted">
            <i class="fas fa-trophy fa-2x mb-2 d-block opacity-25"></i>
            Belum ada data prestasi.
        </div>
    </div>
@else
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="thead-light">
                <tr>
                    <th width="60">#</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th width="100" class="text-center">Status</th>
                    <th width="100" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prestasis as $item)
                    <tr>
                        <td>
                            <span class="badge badge-secondary">{{ $item->urutan }}</span>
                        </td>
                        <td class="fw-semibold">{{ $item->judul }}</td>
                        <td class="text-muted small">{{ Str::limit($item->deskripsi, 100) }}</td>
                        <td class="text-center">
                            @if ($item->is_active)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.info-akademik.prestasi.edit', $item) }}"
                               class="btn btn-warning btn-xs">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.info-akademik.prestasi.destroy', $item) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Hapus prestasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif