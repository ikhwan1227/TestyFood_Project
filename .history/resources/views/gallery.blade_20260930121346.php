@extends('layouts.app')

@section('title', 'Galeri')
@section('page_title', 'GALERI KAMI')

@section('content')
    <section class="section gray">
        <div class="wrap slider">
            <img id="slide" src="{{ asset('assets/ella-olsson-mmnKI8kMxpc-unsplash.webp') }}" alt="Pilihan makanan Tasty Food">
            <button class="prev" aria-label="Foto sebelumnya">‹</button>
            <button class="next" aria-label="Foto berikutnya">›</button>
        </div>
    </section>

    <section class="section wrap">
        <div class="gallery gallery-full">
            @foreach($galleries as $gallery)
                <button class="photo" aria-label="Perbesar foto">
                    <img src="{{ $gallery->image }}" alt="Hidangan Tasty Food" loading="lazy">
                </button>
            @endforeach
        </div>
        <div class="center" style="margin-top: 40px;">
            {{ $galleries->links() }}
        </div>
    </section>
@endsection