@extends('layouts.app')

@section('title', strip_tags($article->title))
@section('page_title', 'BERITA')

@section('content')
    <section class="section wrap">
        <div class="two-cols feature">
            {{-- Featured image: tidak lazy load karena above the fold --}}
            <img src="{{ $article->thumbnail_url }}"
                 alt="{{ $article->plain_title }}"
                 width="600"
                 height="600"
                 fetchpriority="high"
                 decoding="async">
            <div>
                <h2>{!! $article->title !!}</h2>
                <p class="text-gray-500 mb-4">
                    {{ $article->published_at->format('d F Y') }} | {{ $article->category->name }}
                </p>

                <div class="content-scroll">
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
                            <img src="{{ $related->thumbnail_url }}"
                                 alt="{{ $related->plain_title }}"
                                 width="600"
                                 height="380"
                                 loading="lazy"
                                 decoding="async">
                            <div class="news-copy">
                                <h3>{!! $related->title !!}</h3>
                                <a href="{{ route('news.show', $related->slug) }}" class="read">Baca selengkapnya</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection