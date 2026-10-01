@extends('layouts.app')

@section('title', 'Home')
@section('header_class', 'home-hero')

@section('content')
    <div class="hero-copy">
        <hr>
        <h1>HEALTHY<br><strong>TASTY FOOD</strong></h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,
            dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel
            luctus ex. Fusce sit amet viverra ante.</p>
        <a class="button" href="{{ route('about') }}">TENTANG KAMI</a>
    </div>
    {{-- Karena hero-food ada di dalam header, kita perlu trik khusus --}}
    <img class="hero-food" src="{{ asset('assets/img-4-2000x2000.png') }}" alt="Piring makanan sehat">
@endsection

@push('header_extra')
    {{-- Kosong, karena hero-food ditaruh di content --}}
@endpush