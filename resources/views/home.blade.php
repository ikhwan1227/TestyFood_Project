@extends('layouts.app')

@section('title', 'Home')
@section('header_class', 'home-hero')

@push('header_content')
    <div class="hero-copy">
        <hr>
        <h1>HEALTHY<br><strong>TASTY FOOD</strong></h1>
        <p>Gerbang utama untuk mengenal keanekaragaman kuliner asli Nusantara. Kami mengupas tuntas asal-usul, keunikan bumbu rempah, hingga cita rasa khas dari berbagai daerah yang menjadi kebanggaan bangsa.</p>
        <a class="button" href="{{ route('about') }}">TENTANG KAMI</a>
    </div>
    {{-- Hero image: TIDAK lazy load, prioritas tinggi --}}
    <img class="hero-food"
         src="{{ asset('assets/hero-food.png') }}"
         alt="Piring makanan sehat"
         width="800"
         height="800"
         fetchpriority="high">
@endpush

@section('content')
    {{-- Section Intro (Tentang Kami) --}}
    <section class="intro wrap">
        <h2>{{ $about->title_1 ?? 'TENTANG KAMI' }}</h2>
        <p>{{ $about->description_1a ?? 'Mulailah petualangan rasa dengan menjelajahi kelezatan autentik masakan tradisional dari berbagai penjuru Indonesia. Kami menghadirkan kisah menarik di balik setiap hidangan populer, rahasia racikan bumbu lokal, hingga keunikan tradisi memasak yang diwariskan dari generasi ke generasi.' }}</p>
        @if($about->description_1b)
            <p>{{ $about->description_1b }}</p>
        @endif
        <hr>
    </section>

    {{-- Section Food/Menu Card --}}
    <section class="food-section">
        <div class="wrap food-grid">
            
            {{-- Card 1 --}}
            <article class="food-card">
                <img src="{{ $about->getImageUrl('image_1a') }}" alt="Menu makanan 1" loading="lazy">
                <h2>{{ $about->card1_title ?? 'LOREM IPSUM' }}</h2>
                <p>{{ $about->card1_desc ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}</p>
            </article>

            {{-- Card 2 --}}
            <article class="food-card">
                <img src="{{ $about->getImageUrl('image_1b') }}" alt="Menu makanan 2" loading="lazy">
                <h2>{{ $about->card2_title ?? 'LOREM IPSUM' }}</h2>
                <p>{{ $about->card2_desc ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}</p>
            </article>

            {{-- Card 3 --}}
            <article class="food-card">
                <img src="{{ $about->getImageUrl('image_2a') }}" alt="Menu makanan 3" loading="lazy">
                <h2>{{ $about->card3_title ?? 'LOREM IPSUM' }}</h2>
                <p>{{ $about->card3_desc ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}</p>
            </article>

            {{-- Card 4 --}}
            <article class="food-card">
                <img src="{{ $about->getImageUrl('image_2b') }}" alt="Menu makanan 4" loading="lazy">
                <h2>{{ $about->card4_title ?? 'LOREM IPSUM' }}</h2>
                <p>{{ $about->card4_desc ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}</p>
            </article>

        </div>
    </section>

    <section class="section gray">
        <div class="wrap">
            <h2 class="center">BERITA KAMI</h2>
            <div class="home-news">
                @foreach($articles as $index => $article)
                    <article class="news-card {{ $index === 0 ? 'large' : '' }}">
                        <img src="{{ $article->thumbnail_url }}"
                             alt="{{ $article->plain_title }}"
                             width="600"
                             height="380"
                             loading="lazy"
                             decoding="async">
                        <div class="news-copy">
                            <h3>{!! $article->title !!}</h3>
                            <p>
                                @if($index === 0)
                                    {{ Str::limit($article->plain_excerpt, 300) }}
                                @else
                                    {{ Str::limit($article->plain_excerpt, 100) }}
                                @endif
                            </p>
                            <a href="{{ route('news.show', $article->slug) }}" class="read">Baca selengkapnya</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section wrap">
        <h2 class="center">GALERI KAMI</h2>
        <div class="gallery home-gallery">
            @foreach($galleries as $gallery)
                <button class="photo" aria-label="Perbesar foto">
                    <img src="{{ $gallery->image_url }}"
                         alt="{{ $gallery->title ?? 'Hidangan Tasty Food' }}"
                         width="400"
                         height="400"
                         loading="lazy"
                         decoding="async">
                </button>
            @endforeach
        </div>
        <div class="center"><a class="button more" href="{{ route('gallery.index') }}">LIHAT LEBIH BANYAK</a></div>
    </section>
@endsection