@extends('layouts.app')
@section('title', 'Galeri')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-4">GALERI KAMI</h1>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($galleries as $gallery)
            <img src="{{ $gallery->image }}" alt="Gallery" class="w-full h-48 object-cover rounded-lg">
        @endforeach
    </div>
</div>
@endsection