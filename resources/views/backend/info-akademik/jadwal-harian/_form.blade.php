{{-- resources/views/backend/info-akademik/jadwal-harian/_form.blade.php --}}
@csrf
@if (isset($jadwalHarian))
    @method('PUT')
@endif

{{-- Alert Error --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-1"></i> Mohon periksa kembali form di bawah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row g-4">
    <div class="col-md-3">
        <div class="form-group">
            <label for="jam_mulai">Jam Mulai</label>
            <input
                type="time"
                name="jam_mulai"
                id="jam_mulai"
                class="form-control @error('jam_mulai') is-invalid @enderror"
                value="{{ old('jam_mulai', $jadwalHarian->jam_mulai ?? '') }}"
                required
            >
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="jam_selesai">Jam Selesai</label>
            <input
                type="time"
                name="jam_selesai"
                id="jam_selesai"
                class="form-control @error('jam_selesai') is-invalid @enderror"
                value="{{ old('jam_selesai', $jadwalHarian->jam_selesai ?? '') }}"
                required
            >
        </div>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <label for="kegiatan">Kegiatan <span class="text-danger">*</span></label>
            <input
                type="text"
                name="kegiatan"
                id="kegiatan"
                class="form-control @error('kegiatan') is-invalid @enderror"
                value="{{ old('kegiatan', $jadwalHarian->kegiatan ?? '') }}"
                placeholder="cth. Shalat Subuh Berjamaah"
                required
            >
            @error('kegiatan')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

{{-- Submit --}}
<div class="mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i> {{ isset($jadwalHarian) ? 'Perbarui Data' : 'Simpan Data' }}
    </button>
    <a href="{{ route('admin.info-akademik.jadwal-harian.create') }}" class="btn btn-secondary">Batal</a>
</div>