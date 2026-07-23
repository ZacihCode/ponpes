@extends('backend.layouts')

@section('title', 'Edit Stat')

@section('content')

    {{-- Content Header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Stat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.stats.index') }}">Stats</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Main content --}}
    <section class="content">
        <div class="container-fluid">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Terdapat kesalahan!</h5>
                    Periksa kembali isian formulir di bawah ini.
                </div>
            @endif

            <div class="row">

                {{-- Form --}}
                <div class="col-md-7">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit mr-1"></i> Form Edit Stat</h3>
                        </div>

                        <form action="{{ route('admin.stats.update', $stat) }}" method="POST" id="statForm">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                {{-- Icon --}}
                                <div class="form-group">
                                    <label>Kelas Ikon <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light">
                                                <i id="iconPreview" class="{{ $stat->icon }} text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="icon" id="iconInput"
                                               class="form-control @error('icon') is-invalid @enderror"
                                               value="{{ old('icon', $stat->icon) }}"
                                               placeholder="fas fa-user-graduate">
                                        @error('icon')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted">
                                        Gunakan kelas dari <a href="https://fontawesome.com/icons" target="_blank">Font Awesome</a>.
                                    </small>

                                    {{-- Quick pick icons --}}
                                    <div class="mt-2">
                                        @foreach ([
                                            'fas fa-user-graduate',
                                            'fas fa-book-quran',
                                            'fas fa-chalkboard-teacher',
                                            'fas fa-mosque',
                                            'fas fa-users',
                                            'fas fa-star',
                                            'fas fa-award',
                                            'fas fa-graduation-cap',
                                            'fas fa-heart',
                                            'fas fa-school',
                                            'fas fa-calendar-alt',
                                        ] as $ic)
                                            <button type="button"
                                                    class="btn btn-outline-secondary btn-sm icon-picker mb-1 {{ $stat->icon === $ic ? 'active' : '' }}"
                                                    data-icon="{{ $ic }}" title="{{ $ic }}">
                                                <i class="{{ $ic }}"></i>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

                                <hr>

                                {{-- Number --}}
                                <div class="form-group">
                                    <label>Angka / Nilai <span class="text-danger">*</span></label>
                                    <input type="text" name="number"
                                           class="form-control @error('number') is-invalid @enderror"
                                           value="{{ old('number', $stat->number) }}"
                                           placeholder="1200+">
                                    @error('number')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Label --}}
                                <div class="form-group">
                                    <label>Label / Keterangan <span class="text-danger">*</span></label>
                                    <input type="text" name="label"
                                           class="form-control @error('label') is-invalid @enderror"
                                           value="{{ old('label', $stat->label) }}"
                                           placeholder="Santri Aktif">
                                    @error('label')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Order --}}
                                <div class="form-group">
                                    <label>Urutan Tampil</label>
                                    <input type="number" name="order"
                                           class="form-control @error('order') is-invalid @enderror"
                                           value="{{ old('order', $stat->order) }}"
                                           min="0">
                                    @error('order')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Active --}}
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input"
                                               name="is_active" id="isActive" value="1"
                                               {{ old('is_active', $stat->is_active ? '1' : '0') === '1' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="isActive">
                                            Tampilkan di halaman
                                        </label>
                                    </div>
                                </div>

                            </div>

                            {{-- Card Footer --}}
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Perbarui
                                </button>
                                <a href="{{ route('admin.stats.index') }}" class="btn btn-default">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Live Preview --}}
                <div class="col-md-5">
                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-eye mr-1"></i> Preview Live</h3>
                        </div>
                        <div class="card-body">
                            <div class="text-center p-4 border rounded bg-light" id="livePreview">
                                <div class="mb-2" style="font-size:2.5rem;">
                                    <i id="previewIcon" class="{{ $stat->icon }} text-primary"></i>
                                </div>
                                <div class="font-weight-bold h4 mb-1" id="previewNumber">{{ $stat->number }}</div>
                                <div class="text-muted" id="previewLabel">{{ $stat->label }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- Meta info --}}
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-clock mr-1"></i> Informasi</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm mb-0">
                                <tbody>
                                    <tr>
                                        <td class="text-muted">Dibuat</td>
                                        <td class="text-right font-weight-semibold">
                                            {{ $stat->created_at->format('d M Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Diperbarui</td>
                                        <td class="text-right font-weight-semibold">
                                            {{ $stat->updated_at->format('d M Y') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    const iconInput    = document.getElementById('iconInput');
    const iconPreview  = document.getElementById('iconPreview');
    const previewIcon  = document.getElementById('previewIcon');
    const previewNum   = document.getElementById('previewNumber');
    const previewLabel = document.getElementById('previewLabel');

    function updateIcon(cls) {
        iconInput.value = cls;
        iconPreview.className = cls + ' text-primary';
        previewIcon.className = cls + ' text-primary';
    }

    iconInput.addEventListener('input', () => {
        iconPreview.className = iconInput.value + ' text-primary';
        previewIcon.className = iconInput.value + ' text-primary';
    });

    document.querySelectorAll('.icon-picker').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.icon-picker').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            updateIcon(btn.dataset.icon);
        });
    });

    document.querySelector('[name=number]').addEventListener('input', e => {
        previewNum.textContent = e.target.value || '—';
    });

    document.querySelector('[name=label]').addEventListener('input', e => {
        previewLabel.textContent = e.target.value || '—';
    });
</script>
@endpush