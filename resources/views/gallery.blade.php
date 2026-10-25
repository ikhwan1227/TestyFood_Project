@extends('layouts.app')

@section('title', 'Galeri')
@section('page_title', 'GALERI KAMI')

@section('content')
    <section class="section gray">
        <div class="wrap slider">
            <img id="slide"
                src="{{ $sliderGalleries->first() ? $sliderGalleries->first()->image_url : asset('assets/article-7.webp') }}"
                alt="Pilihan makanan Tasty Food"
                width="1200"
                height="600"
                fetchpriority="high"
                decoding="async">
            <button class="prev" aria-label="Foto sebelumnya">‹</button>
            <button class="next" aria-label="Foto berikutnya">›</button>
        </div>
    </section>

    <section class="section wrap">
        <div class="gallery gallery-full">
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
        <div class="center" style="margin-top: 40px;">
            {{ $galleries->links() }}
        </div>
    </section>

    <script>
        const sliderImages = {!! json_encode($sliderGalleries->map(function($item) { return $item->image_url; })->toArray()) !!};
    </script>
@endsection