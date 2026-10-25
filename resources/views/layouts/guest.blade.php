<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Login Admin') — Tasty Food</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="login-body">

    <div class="login-split">

        {{-- SISI KIRI: GAMBAR --}}
        <div class="login-image-side"
             style="background-image: url('{{ asset('assets/hero-food.png') }}');">
            <div class="login-image-overlay"></div>
            <div class="login-image-content">
                <a href="{{ route('home') }}" class="login-image-brand">
                    TASTY <span>FOOD</span>
                </a>
                <h1 class="login-image-title">
                    Selamat Datang<br>Kembali, Admin!
                </h1>
                <p class="login-image-subtitle">
                    Kelola artikel, galeri, dan konten website Tasty Food dari satu dashboard.
                </p>

                <div class="login-image-footer">
                    © {{ date('Y') }} Tasty Food Admin Panel
                </div>
            </div>
        </div>

        {{-- SISI KANAN: FORM --}}
        <div class="login-form-side">
            <div class="login-form-wrapper">

                {{-- Brand untuk mobile --}}
                <a href="{{ route('home') }}" class="login-form-brand">
                    TASTY <span>FOOD</span>
                </a>

                <div class="login-form-header">
                    <h2 class="login-form-title">Login Admin</h2>
                    <p class="login-form-subtitle">Masukkan kredensial Anda untuk melanjutkan.</p>
                </div>

                {{ $slot }}
            </div>
        </div>

    </div>

</body>
</html>