@extends('layouts.app')
@section('title', 'Berita')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-4">BERITA KAMI</h1>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach($articles as $article)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">{{ $article->title }}</h3>
                    <a href="{{ route('news.show', $article->slug) }}" class="text-orange-600 font-semibold">Baca &rarr;</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-8">
        {{ $articles->links() }}
    </div>
</div>
@endsection