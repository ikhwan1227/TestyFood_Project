@extends('layouts.app')

@section('title', 'Berita')
@section('page_title', 'BERITA KAMI')

@section('content')
    <section id="artikel" class="section gray">
        <div class="wrap two-cols feature">
            <img src="{{ asset('assets/eiliv-aceron-ZuIDLSz3XLg-unsplash.webp') }}" alt="Hidangan Tasty Food" loading="lazy">
            <div>
                <h2>APA SAJA MAKANAN KHAS NUSANTARA?</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum
                    commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim
                    neque, vel luctus ex. Fusce sit amet viverra ante.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum
                    commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim
                    neque, vel luctus ex. Fusce sit amet viverra ante.</p>
                <div id="article-extra" hidden>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque magna aliquet
                        cursus tempus. Duis viverra metus et turpis elementum elementum. Aliquam rutrum placerat
                        tellus et suscipit. Curabitur facilisis lectus vitae eros malesuada eleifend. Mauris eget
                        tellus odio. Phasellus vestibulum turpis ac sem commodo, at posuere eros consequat. Duis nec
                        ex at ante volutpat posuere. Morbi vel nunc tortor. Nulla facilisi. Nulla accumsan
                        ullamcorper purus nec venenatis. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Integer imperdiet erat vel leo rutrum lobortis.</p>
                </div>
                <button class="button" id="article-open">BACA SELENGKAPNYA</button>
            </div>
        </div>
    </section>

    <section class="section wrap">
        <h2>BERITA LAINNYA</h2>
        <div class="news-grid">
            @foreach($articles as $article)
                <article class="news-card">
                    <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" loading="lazy">
                    <div class="news-copy">
                        <h3>{{ $article->title }}</h3>
                        <p>{{ Str::limit($article->excerpt, 100) }}</p>
                        <a href="{{ route('news.show', $article->slug) }}" class="read">Baca selengkapnya</a>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="center" style="margin-top: 40px;">
            {{ $articles->links() }}
        </div>
    </section>
@endsection