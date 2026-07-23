@extends('frontend.layouts.app')

@section('title', 'Berita')

@section('content')

    {{-- HERO SECTION --}}
    <section class="hero-berita" style="margin-top: 80px;"></section>

    {{-- BERITA SECTION --}}
    <div class="container-berita">
        <h2 class="section-title-berita">
            Berita Terkini
        </h2>

        <div class="news-grid">
            @foreach($beritas as $berita)
            <div class="wrapper" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                <div class="news-card">
                    <div class="news-image">
                        @if ($berita->gambar)
                            <img src="{{ Storage::url($berita->gambar) }}" alt="{{ $berita->judul }}" />
                        @else
                            <img src="{{ asset('images/default-berita.jpg') }}" alt="{{ $berita->judul }}" />
                        @endif
                    </div>

                    <div class="news-content">
                        <div class="news-date">
                            {{ $berita->tanggal_publish->translatedFormat('d F Y') }}
                        </div>

                        <h3 class="news-title">
                            {{ $berita->judul }}
                        </h3>

                        <p class="news-excerpt">
                            {{ $berita->excerpt }}
                        </p>

                        <a href="{{ route('berita.show', $berita->slug) }}" class="read-more">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
            
        </div>

        {{-- PAGINATION --}}
        <div class="text-center mb-4 mt-5">
            {{ $beritas->links('frontend.partials.pagination') }}
        </div>
    </div>

@endsection