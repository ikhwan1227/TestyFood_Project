@extends('layouts.app')

@section('title', 'Home')
@section('header_class', 'home-hero')

{{-- Masukkan hero-copy DAN hero-food ke dalam header --}}
@push('header_content')
    <div class="hero-copy">
        <hr>
        <h1>HEALTHY<br><strong>TASTY FOOD</strong></h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,
            dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel
            luctus ex. Fusce sit amet viverra ante.</p>
        <a class="button" href="{{ route('about') }}">TENTANG KAMI</a>
    </div>
    <img class="hero-food" src="{{ asset('assets/img-4-2000x2000.png') }}" alt="Piring makanan sehat">
@endpush

@section('content')
    <section class="intro wrap">
        <h2>TENTANG KAMI</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui
            diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex.
            Fusce sit amet viverra ante.</p>
        <hr>
    </section>

    <section class="food-section">
        <div class="wrap food-grid">
            <article class="food-card"><img src="{{ asset('assets/img-1.png') }}" alt="Menu makanan 1">
                <h2>LOREM IPSUM</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum
                    commodo,</p>
            </article>
            <article class="food-card"><img src="{{ asset('assets/img-2.png') }}" alt="Menu makanan 2">
                <h2>LOREM IPSUM</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum
                    commodo,</p>
            </article>
            <article class="food-card"><img src="{{ asset('assets/img-3.png') }}" alt="Menu makanan 3">
                <h2>LOREM IPSUM</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum
                    commodo,</p>
            </article>
            <article class="food-card"><img src="{{ asset('assets/img-4.png') }}" alt="Menu makanan 4">
                <h2>LOREM IPSUM</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum
                    commodo,</p>
            </article>
        </div>
    </section>

    <section class="section gray">
        <div class="wrap">
            <h2 class="center">BERITA KAMI</h2>
            <div class="home-news">
                @foreach($articles as $index => $article)
                    <article class="news-card {{ $index === 0 ? 'large' : '' }}">
                        <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" loading="lazy">
                        <div class="news-copy">
                            <h3>{{ $article->title }}</h3>
                            <p>{{ Str::limit($article->excerpt, 150) }}</p>
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
                    <img src="{{ $gallery->image }}" alt="Hidangan Tasty Food" loading="lazy">
                </button>
            @endforeach
        </div>
        <div class="center"><a class="button more" href="{{ route('gallery.index') }}">LIHAT LEBIH BANYAK</a></div>
    </section>
@endsection