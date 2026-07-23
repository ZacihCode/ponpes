{{-- Toolbar --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted small">
        Total: <strong>{{ $kurikulum_kiri->count() + $kurikulum_kanan->count() }}</strong> record
    </span>
    <a href="{{ route('admin.info-akademik.kurikulum.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i> Tambah Kurikulum
    </a>
</div>

<div class="row g-4">

    {{-- Kolom Kiri --}}
    <div class="col-md-6">
        <div class="d-flex align-items-center mb-2">
            <span class="fw-semibold text-muted small text-uppercase">
                <i class="fas fa-arrow-left me-1"></i> Kolom Kiri
            </span>
            <span class="badge badge-info ml-2">{{ $kurikulum_kiri->count() }}</span>
        </div>

        @forelse ($kurikulum_kiri as $item)
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1 mr-2">
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge badge-secondary mr-2">#{{ $item->urutan }}</span>
                                <p class="fw-semibold mb-0">{{ $item->judul }}</p>
                            </div>
                            <ul class="text-muted small pl-3 mb-0">
                                @foreach (array_slice($item->poin_poin, 0, 3) as $poin)
                                    <li>{{ Str::limit($poin, 70) }}</li>
                                @endforeach
                                @if (count($item->poin_poin) > 3)
                                    <li class="text-muted font-italic">+{{ count($item->poin_poin) - 3 }} poin lainnya...</li>
                                @endif
                            </ul>
                        </div>
                        <div class="d-flex flex-column gap-1" style="gap: 4px;">
                            <a href="{{ route('admin.info-akademik.kurikulum.edit', $item) }}"
                               class="btn btn-warning btn-xs">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.info-akademik.kurikulum.destroy', $item) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus kurikulum ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-4 text-muted">
                    <i class="fas fa-folder-open fa-2x mb-2 d-block opacity-25"></i>
                    Belum ada data kolom kiri.
                </div>
            </div>
        @endforelse
    </div>

    {{-- Kolom Kanan --}}
    <div class="col-md-6">
        <div class="d-flex align-items-center mb-2">
            <span class="fw-semibold text-muted small text-uppercase">
                <i class="fas fa-arrow-right me-1"></i> Kolom Kanan
            </span>
            <span class="badge badge-info ml-2">{{ $kurikulum_kanan->count() }}</span>
        </div>

        @forelse ($kurikulum_kanan as $item)
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1 mr-2">
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge badge-secondary mr-2">#{{ $item->urutan }}</span>
                                <p class="fw-semibold mb-0">{{ $item->judul }}</p>
                            </div>
                            <ul class="text-muted small pl-3 mb-0">
                                @foreach (array_slice($item->poin_poin, 0, 3) as $poin)
                                    <li>{{ Str::limit($poin, 70) }}</li>
                                @endforeach
                                @if (count($item->poin_poin) > 3)
                                    <li class="text-muted font-italic">+{{ count($item->poin_poin) - 3 }} poin lainnya...</li>
                                @endif
                            </ul>
                        </div>
                        <div class="d-flex flex-column" style="gap: 4px;">
                            <a href="{{ route('admin.info-akademik.kurikulum.edit', $item) }}"
                               class="btn btn-warning btn-xs">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.info-akademik.kurikulum.destroy', $item) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus kurikulum ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-4 text-muted">
                    <i class="fas fa-folder-open fa-2x mb-2 d-block opacity-25"></i>
                    Belum ada data kolom kanan.
                </div>
            </div>
        @endforelse
    </div>

</div>