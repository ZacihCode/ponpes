@csrf
@if(isset($ostdaqu))
    @method('PUT')
@endif

@php
    // Daftar jabatan -> icon. "Ketua OSTDAQU" ditandai khusus agar tipe otomatis "ketua".
    $daftarJabatan = [
        'Ketua OSTDAQU'          => ['icon' => '🕌', 'tipe' => 'ketua'],
        'Wakil Ketua'            => ['icon' => '🤝', 'tipe' => 'anggota'],
        'Sekretaris'             => ['icon' => '📝', 'tipe' => 'anggota'],
        'Bendahara'              => ['icon' => '💰', 'tipe' => 'anggota'],
        'Bagian Keamanan'        => ['icon' => '🛡️', 'tipe' => 'anggota'],
        "Bagian Ta'mir Masjid"   => ['icon' => '🕌', 'tipe' => 'anggota'],
        'Bagian Bahasa'          => ['icon' => '🌐', 'tipe' => 'anggota'],
        'Bagian Kebersihan'      => ['icon' => '🧹', 'tipe' => 'anggota'],
        'Bagian Dapur'           => ['icon' => '🍳', 'tipe' => 'anggota'],
        'Bagian Koperasi'        => ['icon' => '🛒', 'tipe' => 'anggota'],
        'Bagian Olahraga'        => ['icon' => '🏀', 'tipe' => 'anggota'],
        'Bagian Maintenance'     => ['icon' => '🛠️', 'tipe' => 'anggota'],
        'Bagian Basatino'        => ['icon' => '🌳', 'tipe' => 'anggota'],
        'Bagian Perpustakaan'    => ['icon' => '📚', 'tipe' => 'anggota'],
    ];

    $selectedJabatan = old('jabatan', $ostdaqu->jabatan ?? '');
@endphp

<div class="form-group">
    <label for="jabatan">Jabatan</label>
    <select name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
        <option value="" disabled {{ $selectedJabatan === '' ? 'selected' : '' }}>-- Pilih Jabatan --</option>
        @foreach($daftarJabatan as $namaJabatan => $data)
            <option value="{{ $namaJabatan }}"
                    data-icon="{{ $data['icon'] }}"
                    data-tipe="{{ $data['tipe'] }}"
                    {{ $selectedJabatan === $namaJabatan ? 'selected' : '' }}>
                {{ $data['icon'] }} {{ $namaJabatan }}
            </option>
        @endforeach
    </select>
    @error('jabatan')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama"
           class="form-control @error('nama') is-invalid @enderror"
           value="{{ old('nama', $ostdaqu->nama ?? '') }}"
           placeholder="Nama santri yang menjabat">
    @error('nama')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

{{-- Icon dan Tipe diisi otomatis berdasarkan Jabatan yang dipilih --}}
<input type="hidden" name="icon" id="icon" value="{{ old('icon', $ostdaqu->icon ?? '🕌') }}">
<input type="hidden" name="tipe" id="tipe" value="{{ old('tipe', $ostdaqu->tipe ?? 'anggota') }}">

<div class="form-group">
    <label>Preview</label>
    <div class="border rounded p-2 d-flex align-items-center" style="gap:8px;">
        <span id="preview-icon" style="font-size:1.4rem;">{{ $ostdaqu->icon ?? '🕌' }}</span>
        <span id="preview-tipe" class="badge {{ ($ostdaqu->tipe ?? 'anggota') === 'ketua' ? 'badge-warning' : 'badge-info' }}">
            {{ ucfirst($ostdaqu->tipe ?? 'anggota') }}
        </span>
    </div>
</div>

<div class="form-group">
    <label for="urutan">Urutan</label>
    <input type="number" name="urutan" id="urutan" min="0"
           class="form-control @error('urutan') is-invalid @enderror"
           value="{{ old('urutan', $ostdaqu->urutan ?? 0) }}">
    @error('urutan')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group form-check">
    <input type="checkbox" name="aktif" id="aktif" value="1" class="form-check-input"
           {{ old('aktif', $ostdaqu->aktif ?? true) ? 'checked' : '' }}>
    <label for="aktif" class="form-check-label">Aktif (tampilkan di halaman frontend)</label>
</div>

<div class="mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> {{ isset($ostdaqu) ? 'Update' : 'Simpan' }}
    </button>
    <a href="{{ route('admin.organisasi-santri.index') }}" class="btn btn-secondary">Batal</a>
</div>

@push('scripts')
<script>
    document.getElementById('jabatan').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const icon = selected.getAttribute('data-icon') || '🕌';
        const tipe = selected.getAttribute('data-tipe') || 'anggota';

        document.getElementById('icon').value = icon;
        document.getElementById('tipe').value = tipe;

        document.getElementById('preview-icon').textContent = icon;

        const previewTipe = document.getElementById('preview-tipe');
        previewTipe.textContent = tipe.charAt(0).toUpperCase() + tipe.slice(1);
        previewTipe.className = 'badge ' + (tipe === 'ketua' ? 'badge-warning' : 'badge-info');
    });
</script>
@endpush