<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.organisasi-santri.ostdaqu.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Tambah Jabatan
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="width:50px">#</th>
                <th style="width:60px">Icon</th>
                <th>Jabatan</th>
                <th>Nama</th>
                <th>Tipe</th>
                <th style="width:80px">Urutan</th>
                <th style="width:90px">Status</th>
                <th style="width:140px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ostdaquPositions as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td class="text-center" style="font-size:1.4rem">{{ $item->icon }}</td>
                <td>{{ $item->jabatan }}</td>
                <td>{{ $item->nama }}</td>
                <td>
                    <span class="badge {{ $item->tipe === 'ketua' ? 'badge-warning' : 'badge-info' }}">
                        {{ ucfirst($item->tipe) }}
                    </span>
                </td>
                <td>{{ $item->urutan }}</td>
                <td>
                    <span class="badge {{ $item->aktif ? 'badge-success' : 'badge-secondary' }}">
                        {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.organisasi-santri.ostdaqu.edit', $item) }}"
                       class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.organisasi-santri.ostdaqu.destroy', $item) }}"
                          method="POST" class="d-inline"
                          onsubmit="return confirm('Hapus jabatan ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-3">Belum ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
