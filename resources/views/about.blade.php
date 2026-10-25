@extends('layouts.app')

@section('title', 'Tentang')
@section('page_title', 'TENTANG KAMI')

@section('content')
    <section class="section gray">
        <div class="wrap two-cols">
            <div>
                <h2>{{ $about->title_1 }}</h2>
                <p><b>{{ $about->description_1a }}</b></p>
                <p>{{ $about->description_1b }}</p>
            </div>
            <div class="image-pair portrait">
                <img src="{{ $about->getImageUrl('image_1a') }}" alt="{{ $about->title_1 }}" loading="lazy" width="400" height="600">
                <img src="{{ $about->getImageUrl('image_1b') }}" alt="{{ $about->title_1 }}" loading="lazy" width="400" height="600">
            </div>
        </div>
    </section>

    <section class="section wrap about">
        <div class="two-cols">
            <div class="image-pair">
                <img src="{{ $about->getImageUrl('image_2a') }}" alt="{{ $about->title_2 }}" loading="lazy" width="400" height="400">
                <img src="{{ $about->getImageUrl('image_2b') }}" alt="{{ $about->title_2 }}" loading="lazy" width="400" height="400">
            </div>
            <div>
                <h2>{{ $about->title_2 }}</h2>
                <p>{{ $about->description_2 }}</p>
            </div>
        </div>
        <div class="two-cols">
            <div>
                <h2>{{ $about->title_3 }}</h2>
                <p>{{ $about->description_3 }}</p>
            </div>
            <img class="wide" src="{{ $about->getImageUrl('image_3') }}" alt="{{ $about->title_3 }}" loading="lazy" width="800" height="400">
        </div>
    </section>
@endsection