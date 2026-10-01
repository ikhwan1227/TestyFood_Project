@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-4">DASHBOARD ADMIN</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>
</div>
@endsection