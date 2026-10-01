@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="bg-orange-500 text-white py-20">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-5xl font-bold mb-4">HEALTHY TASTY FOOD</h1>
        <p class="text-xl">Selamat datang di website kami.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold mb-6">Berita Terbaru</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach($articles as $article)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">{{ $article->title }}</h3>
                    <p class="text-gray-600 text-sm">{{ Str::limit($article->excerpt, 100) }}</p>
                    <a href="{{ route('news.show', $article->slug) }}" class="text-orange-600 font-semibold mt-2 inline-block">Baca Selengkapnya &rarr;</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection