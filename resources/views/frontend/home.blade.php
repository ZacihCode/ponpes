@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

{{-- =========================
     CAROUSEL UTAMA
========================= --}}
<div id="carouselExampleIndicators" class="carousel carousel-home slide" data-bs-ride="carousel" data-bs-interval="5000" data-bs-wrap="true" data-bs-pause="false">
    <div class="carousel-indicators">
        @foreach ($carousels as $carousel)
        <button type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide-to="{{ $loop->index }}"
            class="{{ $loop->first ? 'active' : '' }}"
            {{ $loop->first ? 'aria-current=true' : '' }}
            aria-label="Slide {{ $loop->iteration }}"></button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @foreach ($carousels as $carousel)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            <img src="{{ asset('storage/' . $carousel->image) }}"
                class="d-block w-100"
                alt="Kegiatan Pesantren Assanadiyah {{ $loop->iteration }}"
                @if(!$loop->first) loading="lazy" @endif>
        </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Sebelumnya</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Berikutnya</span>
    </button>
</div>

{{-- =========================
     SELAMAT DATANG
========================= --}}
<section class="home-section" id="home-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="home-title text-center">
                <h4 data-aos="fade-up">Selamat Datang di</h4>
                <h2 data-aos="zoom-in" data-aos-delay="150">Assanadiyah</h2>
                <p class="home-tagline" data-aos="fade-up" data-aos-delay="300">
                    Pondok pesantren yang membekali santri dengan ilmu agama, akhlak mulia, dan kemandirian.
                </p>
                <div class="home-cta" data-aos="fade-up" data-aos-delay="450">
                    <a href="https://wa.me/6281288674507?text=Halo%20saya%20ingin%20bertanya%20tentang%20pendaftaran"
                        target="_blank" rel="noopener" class="btn btn-karakter">
                        <i class="fab fa-whatsapp me-1"></i> Tanya Pendaftaran
                    </a>
                    <a href="#pendidikan-daqu" class="btn btn-outline-gold">
                        Kenali Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================
     BENEFIT
========================= --}}
<section class="daqu-benefit-section py-5">
    <div class="container">
        <div class="row align-items-center g-5">

            {{-- Konten Benefit --}}
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-section">
                    <h3>Kenapa sih, Harus Mondok Di Assanadiyah?</h3>
                </div>

                <ul class="list-unstyled benefit-list">
                    @forelse($benefits as $index => $benefit)
                    <li data-aos="fade-right"
                        data-aos-delay="{{ 100 + ($index * 150) }}"
                        data-aos-duration="1000">
                        <strong>{{ $benefit->title }}</strong>
                        &mdash; {{ $benefit->description }}
                    </li>
                    @empty
                    <li class="text-muted">Data benefit belum tersedia.</li>
                    @endforelse
                </ul>
            </div>

            {{-- Gambar Benefit --}}
            <div class="col-lg-6" data-aos="fade-left">
                <div class="photo-stack-wrapper">

                    @if(isset($images['right']))
                    <div class="photo photo-right zoom-hover fly-floating">
                        <img src="{{ asset('storage/' . $images['right']->image) }}"
                            alt="Suasana pesantren" loading="lazy">
                    </div>
                    @endif

                    @if(isset($images['left']))
                    <div class="photo photo-left zoom-hover fly-floating">
                        <img src="{{ asset('storage/' . $images['left']->image) }}"
                            alt="Kegiatan santri" loading="lazy">
                    </div>
                    @endif

                    @if(isset($images['center']))
                    <div class="photo photo-center zoom-hover fly-floating">
                        <img src="{{ asset('storage/' . $images['center']->image) }}"
                            alt="Lingkungan pesantren" loading="lazy">
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</section>

{{-- =========================
     PENDIDIKAN / KURIKULUM
========================= --}}
<section class="pendidikan-daqu" id="pendidikan-daqu">
    <div class="container">

        <h2 class="pendidikan-title" data-aos="fade-up">
            {{ $curiculumSection->title ?? 'Sistem Kurikulum' }}
        </h2>

        @if (!empty($curiculumSection->intro))
        <p class="pendidikan-intro text-center" data-aos="fade-up" data-aos-delay="100">
            {{ $curiculumSection->intro }}
        </p>
        @endif

        <div class="row pendidikan-row g-4 mt-2">
            @forelse($curiculumItems as $index => $item)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ min($index, 2) * 200 }}">
                <div class="pendidikan-card">
                    <div class="pendidikan-header">
                        <div class="pendidikan-icon-container">
                            <i class="{{ $item->icon }}" aria-hidden="true"></i>
                        </div>
                        <h4>{{ $item->title }}</h4>
                    </div>
                    <p>{{ $item->description }}</p>
                    <div class="pendidikan-cta">
                        <a href="#">Lanjut baca &raquo;</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="empty-state">Data kurikulum belum tersedia.</p>
            </div>
            @endforelse
        </div>

    </div>
</section>

{{-- =========================
     EKSTRAKURIKULER
========================= --}}
<section class="ekskul-section" id="ekskul">
    <div class="container">

        <h2 class="mb-5" data-aos="fade-up">Kegiatan Ekstrakurikuler</h2>

        {{-- Tabs --}}
        <ul class="nav nav-pills justify-content-center mb-5" id="ekskulTab" role="tablist">
            @foreach ($ekskulCategories as $index => $cat)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                    data-bs-toggle="pill"
                    data-bs-target="#cat-{{ $cat->slug }}"
                    type="button" role="tab">
                    {{ $cat->name }}
                </button>
            </li>
            @endforeach
        </ul>

        {{-- Isi Tab --}}
        <div class="tab-content">
            @foreach ($ekskulCategories as $index => $cat)
            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                id="cat-{{ $cat->slug }}" role="tabpanel">

                <div class="row g-4">
                    @forelse ($cat->extracurriculars as $ekskul)
                    <div class="col-md-6" data-aos="flip-left" data-aos-delay="{{ min($loop->index, 3) * 150 }}">
                        <button type="button" class="ekskul-card"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-{{ $ekskul->slug }}">
                            <i class="{{ $ekskul->icon }}" aria-hidden="true"></i>
                            <h5>{{ $ekskul->title }}</h5>
                            <p>{{ $ekskul->short_description }}</p>
                        </button>
                    </div>
                    @empty
                    <div class="col-12 text-center empty-state empty-state-light">
                        Belum ada ekstrakurikuler di kategori ini.
                    </div>
                    @endforelse
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- Modal Ekskul --}}
@foreach ($ekskulCategories as $cat)
@foreach ($cat->extracurriculars as $ekskul)
<div class="modal fade" id="modal-{{ $ekskul->slug }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="{{ $ekskul->icon }} me-2" aria-hidden="true"></i>
                    {{ $ekskul->title }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <div>{!! $ekskul->description !!}</div>

                @if ($ekskul->galleries->isNotEmpty())
                <div class="text-center mt-3">
                    @foreach ($ekskul->galleries as $gallery)
                    <img src="{{ Storage::url($gallery->image) }}"
                        class="img-fluid rounded shadow m-2"
                        style="max-width: 400px;"
                        alt="{{ $ekskul->title }}" loading="lazy">
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endforeach
@endforeach

{{-- =========================
     STATISTIK
========================= --}}
<section class="stats">
    <div class="stats-container">
        @foreach($stats as $index => $stat)
        <div class="wrapper" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
            <div class="stat-card">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="{{ $stat->icon }}" aria-hidden="true"></i>
                    </div>
                    <div class="stat-number">{{ $stat->number }}</div>
                    <p>{{ $stat->label }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- =========================
     BERITA
========================= --}}
<section id="berita" class="news-section">
    <div class="container-berita">
        <h2 class="section-title-berita" data-aos="fade-up">Berita Terbaru</h2>

        <div class="news-grid">
            @forelse ($beritaTerbaru as $index => $berita)
            <div class="wrapper" data-aos="fade-up" data-aos-delay="{{ min($index, 3) * 150 }}">
                <article class="news-card">
                    <div class="news-image">
                        <img src="{{ $berita->gambar ? Storage::url($berita->gambar) : asset('images/default-berita.jpg') }}"
                            alt="{{ $berita->judul }}" loading="lazy">
                    </div>
                    <div class="news-content">
                        <time class="news-date" datetime="{{ $berita->tanggal_publish->toDateString() }}">
                            {{ $berita->tanggal_publish->translatedFormat('d F Y') }}
                        </time>
                        <h3 class="news-title">{{ $berita->judul }}</h3>
                        <p class="news-excerpt">{{ $berita->excerpt }}</p>
                        <a href="{{ route('berita.show', $berita->slug) }}" class="read-more">
                            Baca Selengkapnya
                        </a>
                    </div>
                </article>
            </div>
            @empty
            <p class="empty-state">Belum ada berita.</p>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="/berita" class="btn btn-karakter">Berita Lainnya</a>
        </div>
    </div>
</section>

{{-- =========================
     ALAMAT / LOKASI KAMPUS
========================= --}}
@php
$campuses = [
[
'name' => 'Kampus A',
'title' => 'Pesantren Assanadiyah',
'address' => "Jl. Simpang Jaya 7 Lrg, Lematang Keca. Seberang Ulu II Kel.16 Ulu",
'whatsapp' => '081278862929',
'maps' => '',
],
[
'name' => 'Kampus B',
'title' => 'Pesantren Assanadiyah',
'address' => "Jl. KH. Balhki Lr. Banten 5 Kel.16 Ulu Kec. Seberang Ulu II Kel.16 Ulu",
'whatsapp' => '085382802223',
'maps' => '',
],
[
'name' => 'Kampus C',
'title' => 'Pesantren Assanadiyah',
'address' => "Jl. KH. Balhki Lr. Banten 5 Kel.16 Ulu Kec. Seberang Ulu II Kel.16 Ulu",
'whatsapp' => '089629080734',
'maps' => '',
],
];
@endphp

<section id="alamat" class="alamat-section">
    <div class="container">

        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="alamat-title">Lokasi Kampus</h2>
            <p class="alamat-subtitle">Pilih kampus yang ingin kamu kunjungi atau tanyakan.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach ($campuses as $i => $campus)
            @php
            $mapsUrl = $campus['maps'] ?: 'https://www.google.com/maps/search/?api=1&query='
            . urlencode(str_replace("\n", ' ', $campus['address']));
            $waUrl = 'https://wa.me/' . $campus['whatsapp'] . '?text='
            . rawurlencode('Halo, saya ingin bertanya tentang ' . $campus['name']);
            @endphp
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $i * 150 }}">
                <div class="campus-card">
                    <span class="campus-badge">{{ $campus['name'] }}</span>
                    <h3 class="campus-name">{{ $campus['title'] }}</h3>
                    <p class="campus-address">
                        <i class="fas fa-location-dot" aria-hidden="true"></i>
                        <span>{!! nl2br(e($campus['address'])) !!}</span>
                    </p>
                    <div class="campus-actions">
                        <a href="{{ $mapsUrl }}" target="_blank" rel="noopener" class="btn-campus btn-campus-map">
                            <i class="fas fa-map-location-dot me-1" aria-hidden="true"></i> Lihat Peta
                        </a>
                        <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="btn-campus btn-campus-wa">
                            <i class="fab fa-whatsapp me-1" aria-hidden="true"></i> Chat
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

@endsection