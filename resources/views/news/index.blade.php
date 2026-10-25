@extends('layouts.app')

@section('title', 'Berita')
@section('page_title', 'BERITA KAMI')

@section('content')
    {{-- SECTION UTAMA: BERITA TERBARU --}}
    <section id="artikel" class="section gray">
        <div class="wrap two-cols feature">
            @if($latestArticle)
                <img src="{{ $latestArticle->thumbnail_url }}"
                     alt="{{ $latestArticle->plain_title }}"
                     width="600"
                     height="600"
                     loading="lazy"
                     decoding="async">
                <div>
                    <h2>{!! $latestArticle->title !!}</h2>
                    
                    {{-- Info Tanggal & Kategori --}}
                    <p class="text-gray-500 mb-4" style="font-size: 14px; color: #6b7280; margin-bottom: 16px;">
                        {{ $latestArticle->published_at->format('d F Y') }} | {{ $latestArticle->category->name ?? 'Umum' }}
                    </p>

                    {{-- Ringkasan Konten (Ambil 300 karakter pertama tanpa tag HTML) --}}
                    <p>
                        {{ Str::limit(strip_tags($latestArticle->content), 300) }}
                    </p>

                    {{-- Tombol Link ke Halaman Detail --}}
                    <a href="{{ route('news.show', $latestArticle->slug) }}" class="button" style="margin-top: 20px; display: inline-flex;">
                        BACA SELENGKAPNYA
                    </a>
                </div>
            @else
                {{-- Tampilan jika belum ada berita sama sekali --}}
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px 0;">
                    <h2 style="color: #6b7280; font-size: 20px;">Belum ada berita yang dipublikasikan.</h2>
                </div>
            @endif
        </div>
    </section>

    {{-- SECTION BAWAH: BERITA LAINNYA --}}
    <section class="section wrap">
        <h2>BERITA LAINNYA</h2>
        <div class="news-grid">
            @forelse($articles as $article)
                <article class="news-card">
                    <img src="{{ $article->thumbnail_url }}"
                         alt="{{ $article->plain_title }}"
                         width="600"
                         height="380"
                         loading="lazy"
                         decoding="async">
                    <div class="news-copy">
                        <h3>{!! $article->title !!}</h3>
                        <p>{{ Str::limit($article->plain_excerpt, 100) }}</p>
                        <a href="{{ route('news.show', $article->slug) }}" class="read">Baca selengkapnya</a>
                    </div>
                </article>
            @empty
                <p style="grid-column: 1 / -1; text-align: center; color: #6b7280;">Tidak ada berita lain untuk ditampilkan.</p>
            @endforelse
        </div>
        <div class="center" style="margin-top: 40px;">
            {{ $articles->links() }}
        </div>
    </section>
@endsection