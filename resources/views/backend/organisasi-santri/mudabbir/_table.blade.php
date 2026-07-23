<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.organisasi-santri.mudabbir.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Tambah Mudabbir
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="width:50px">#</th>
                <th>Kamar</th>
                <th>Nama</th>
                <th style="width:80px">Urutan</th>
                <th style="width:90px">Status</th>
                <th style="width:140px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($mudabbir as $kamar => $items)
                @foreach($items as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td><span class="badge badge-light border">{{ $kamar }}</span></td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->urutan }}</td>
                    <td>
                        <span class="badge {{ $item->aktif ? 'badge-success' : 'badge-secondary' }}">
                            {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.organisasi-santri.mudabbir.edit', $item) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.organisasi-santri.mudabbir.destroy', $item) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus mudabbir ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-3">Belum ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
