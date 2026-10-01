<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Tasty Food') — Tasty Food</title>
    <meta name="description" content="Tasty Food — makanan sehat, berita, dan galeri kuliner.">
    <link rel="icon"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='6'/%3E%3Ctext x='5' y='23' fill='white' font-family='Arial' font-weight='bold' font-size='20'%3ETF%3C/text%3E%3C/svg%3E">
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
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="wrap footer-grid">
            <div class="footer-about">
                <h2>Tasty Food</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.</p>
                <div class="social">
                    <img src="{{ asset('assets/001-facebook.png') }}" alt="Facebook">
                    <img src="{{ asset('assets/002-twitter.png') }}" alt="Twitter">
                </div>
            </div>
            <div>
                <h3>Useful links</h3>
                <a href="{{ route('news.index') }}">Blog</a>
                <a href="{{ route('news.index') }}">Hewan</a>
                <a href="{{ route('gallery.index') }}">Galeri</a>
                <a href="{{ route('about') }}">Testimonial</a>
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
                <a href="mailto:tastyfood@gmail.com">✉ &nbsp; tastyfood@gmail.com</a>
                <a href="tel:+6281234567890">⌕ &nbsp; +62 812 3456 7890</a>
                <a href="https://www.google.com/maps/search/Bandung" target="_blank" rel="noopener">♧ &nbsp; Kota
                    Bandung, Jawa Barat</a>
            </div>
        </div>
        <p class="copyright">Copyright ©{{ date('Y') }} All rights reserved</p>
    </footer>

    <dialog id="lightbox">
        <button aria-label="Tutup foto" class="close">×</button>
        <img alt="Foto makanan diperbesar">
    </dialog>
</body>

</html>