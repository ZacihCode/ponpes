{{-- Toolbar --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted small">
        Total: <strong>{{ $agendas->count() }}</strong> record
    </span>
    <a href="{{ route('admin.info-akademik.agenda.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i> Tambah Agenda
    </a>
</div>

@if ($agendas->isEmpty())
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5 text-muted">
            <i class="fas fa-bullhorn fa-2x mb-2 d-block opacity-25"></i>
            Belum ada data agenda.
        </div>
    </div>
@else
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="thead-light">
                <tr>
                    <th width="60">#</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th width="110" class="text-center">Tipe</th>
                    <th width="100" class="text-center">Status</th>
                    <th width="100" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agendas as $item)
                    <tr>
                        <td>
                            <span class="badge badge-secondary">{{ $item->urutan }}</span>
                        </td>
                        <td class="fw-semibold">{{ $item->judul }}</td>
                        <td class="text-muted small">{{ Str::limit($item->isi, 100) }}</td>
                        <td class="text-center">
                            <span class="badge {{ $item->tipe_badge_class }}">
                                {{ $item->tipe_label }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if ($item->is_active)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.info-akademik.agenda.edit', $item) }}"
                               class="btn btn-warning btn-xs">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.info-akademik.agenda.destroy', $item) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Hapus agenda ini?')">
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