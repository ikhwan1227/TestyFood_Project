@extends('layouts.app')

@section('title', $article->title)
@section('page_title', 'BERITA')

@section('content')
    <section class="section wrap">
        <div class="two-cols feature">
            <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" loading="lazy">
            <div>
                <h2>{{ $article->title }}</h2>
                <p class="text-gray-500 mb-4">{{ $article->published_at->format('d F Y') }} | {{ $article->category->name }}</p>
                
                <div class="content">
                    {!! $article->content !!}
                </div>
            </div>
        </div>
    </section>

    @if($relatedArticles->count() > 0)
        <section class="section gray">
            <div class="wrap">
                <h2>BERITA TERKAIT</h2>
                <div class="news-grid">
                    @foreach($relatedArticles as $related)
                        <article class="news-card">
                            <img src="{{ $related->thumbnail }}" alt="{{ $related->title }}" loading="lazy">
                            <div class="news-copy">
                                <h3>{{ $related->title }}</h3>
                                <a href="{{ route('news.show', $related->slug) }}" class="read">Baca selengkapnya</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection