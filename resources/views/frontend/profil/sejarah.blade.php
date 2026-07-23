@extends('frontend.layouts.app')

@section('title', 'Sejarah Pesantren')

@section('content')

    @if (isset($sejarahs['pesantren']))
        @php
            $pesantren = $sejarahs['pesantren']; 
        @endphp

        <section class="container py-5 sejarah-section" style="margin-top: 70px;">
            <div class="sejarah-content sejarah-wrap" data-aos="fade-up">
                <h2 class="mb-3">{{ $pesantren->judul }}</h2>

                <div class="sejarah-image float-left-img">

                    @if ($pesantren->images->isNotEmpty())

                        <div id="carouselPesantren" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">

                                @foreach ($pesantren->images as $image)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <img src="{{ $image->url }}" class="d-block w-100 rounded" alt="{{ $pesantren->judul }} {{ $loop->iteration }}">
                                    </div>
                                @endforeach

                            </div>

                            @if ($pesantren->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselPesantren" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselPesantren" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            @endif
                        </div>

                    @endif
                </div>

                <p>{!! nl2br($pesantren->konten) !!}</p>
            </div>
        </section>
    @endif

    @if (isset($sejarahs['yayasan']))
        @php $yayasan = $sejarahs['yayasan']; @endphp

        <section class="container py-5 sejarah-section">
            <div class="sejarah-content sejarah-wrap" data-aos="fade-up">
                <h2 class="mb-3">{{ $yayasan->judul }}</h2>

                {{-- Gambar mengambang di KANAN, teks mengalir di kiri & bawah --}}
                <div class="sejarah-image float-right-img">
                    @if ($yayasan->images->isNotEmpty())
                        <div id="carouselYayasan" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($yayasan->images as $image)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <img src="{{ $image->url }}" class="d-block w-100 rounded"
                                             alt="{{ $yayasan->judul }} {{ $loop->iteration }}">
                                    </div>
                                @endforeach
                            </div>

                            @if ($yayasan->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselYayasan" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselYayasan" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            @endif
                        </div>
                    @endif
                </div>

                <p>{!! nl2br($yayasan->konten) !!}</p>
            </div>
        </section>
    @endif

@endsection