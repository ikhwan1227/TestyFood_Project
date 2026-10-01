@extends('layouts.app')
@section('title', $article->title)
@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-4">{{ $article->title }}</h1>
    <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-96 object-cover rounded-lg mb-6">
    <div class="prose max-w-none">
        {!! $article->content !!}
    </div>
</div>
@endsection