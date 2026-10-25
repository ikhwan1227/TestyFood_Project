<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Tasty Food') — Tasty Food</title>
    <meta name="description" content="Tasty Food — makanan sehat, berita, dan galeri kuliner.">

    <link rel="icon"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='6'/%3E%3Ctext x='5' y='23' fill='white' font-family='Arial' font-weight='bold' font-size='20'%3ETF%3C/text%3E%3C/svg%3E">

    {{-- Preconnect untuk Google Fonts (mempercepat loading font) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Load Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:ital,wght@0,400;0,500;0,600;1,400&family=Playfair+Display:wght@400;700;900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Preload hero image (LCP image) --}}
    <link rel="preload" as="image" href="{{ asset('assets/hero-food.png') }}" fetchpriority="high">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="@yield('header_class', 'inner-hero')">
        <div class="wrap">
            <div class="topbar">
                <a class="brand" href="{{ route('home') }}">TASTY FOOD</a>
                <button class="menu" aria-label="Buka menu" aria-expanded="false">☰</button>
                <nav>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">HOME</a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">TENTANG</a>
                    <a href="{{ route('news.index') }}" class="{{ request()->routeIs('news.*') ? 'active' : '' }}">BERITA</a>
                    <a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.*') ? 'active' : '' }}">GALERI</a>
                    <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">KONTAK</a>
                </nav>
            </div>
            @hasSection('page_title')
                <h1>@yield('page_title')</h1>
            @endif
            @stack('header_content')
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="wrap footer-grid">
            <div class="footer-about">
                <h2>Tasty Food</h2>
                <p>Gerbang utama untuk mengenal keanekaragaman kuliner asli Nusantara. Kami mengupas tuntas asal-usul, keunikan bumbu rempah, hingga cita rasa khas dari berbagai daerah yang menjadi kebanggaan bangsa.</p>
                <div class="social">
                    <img src="{{ asset('assets/icon-facebook.png') }}" alt="Facebook" width="48" height="48" loading="lazy">
                    <img src="{{ asset('assets/icon-twitter.png') }}" alt="Twitter" width="48" height="48" loading="lazy">
                </div>
            </div>
            <div>
                <h3>Useful links</h3>
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a>
                <a href="{{ route('news.index') }}" class="{{ request()->routeIs('news.*') ? 'active' : '' }}">Berita</a>
                <a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.*') ? 'active' : '' }}">Galeri</a>
                <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">Kontak</a>
            </div>
            <div>
                <h3>Privacy</h3>
                <a href="{{ route('contact.index') }}">Karir</a>
                <a href="{{ route('about') }}">Tentang Kami</a>
                <a href="{{ route('contact.index') }}">Kontak Kami</a>
                <a href="{{ route('contact.index') }}">Servis</a>
            </div>
            <div>
                <h3>Contact Info</h3>
                <a href="mailto:{{ $globalSettings['contact_email'] ?? 'tastyfood@gmail.com' }}">
                    ✉ &nbsp; {{ $globalSettings['contact_email'] ?? 'tastyfood@gmail.com' }}
                </a>
                <a href="tel:{{ $globalSettings['contact_phone'] ?? '+6281234567890' }}">
                    ⌕ &nbsp; {{ $globalSettings['contact_phone'] ?? '+62 812 3456 7890' }}
                </a>
                <a href="{{ $globalSettings['maps_url'] ?? 'https://www.google.com/maps/search/Bandung' }}" target="_blank" rel="noopener">
                    ♧ &nbsp; {{ $globalSettings['address'] ?? 'Kota Bandung, Jawa Barat' }}
                </a>
            </div>
        </div>
        <p class="copyright">Copyright ©{{ date('Y') }} All rights reserved</p>
    </footer>

    <dialog id="lightbox">
        <button aria-label="Tutup foto" class="close">×</button>
        <img alt="Foto makanan diperbesar">
    </dialog>

    {{-- STICKY NAVBAR (muncul saat scroll) --}}
    <div class="sticky-navbar" id="stickyNavbar">
        <div class="sticky-navbar-inner">
            <a class="sticky-brand" href="{{ route('home') }}">TASTY FOOD</a>
            <nav class="sticky-nav">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">HOME</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">TENTANG</a>
                <a href="{{ route('news.index') }}" class="{{ request()->routeIs('news.*') ? 'active' : '' }}">BERITA</a>
                <a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.*') ? 'active' : '' }}">GALERI</a>
                <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">KONTAK</a>
            </nav>
        </div>
    </div>

    {{-- BACK TO TOP BUTTON WITH PROGRESS RING --}}
    <button type="button" class="back-to-top" id="backToTop" aria-label="Kembali ke atas">
        <!-- SVG Progress Ring -->
        <svg class="progress-circle" width="50" height="50" viewBox="0 0 50 50">
            <circle class="progress-circle-bg" cx="25" cy="25" r="22"></circle>
            <circle class="progress-circle-path" cx="25" cy="25" r="22"></circle>
        </svg>
        <!-- SVG Arrow Icon -->
        <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </button>
</body>

</html>