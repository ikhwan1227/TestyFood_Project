<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasty Food - @yield('title', 'Home')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-orange-600">TASTY FOOD</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-600">Home</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-orange-600">Tentang</a>
                    <a href="{{ route('news.index') }}" class="text-gray-700 hover:text-orange-600">Berita</a>
                    <a href="{{ route('gallery.index') }}" class="text-gray-700 hover:text-orange-600">Galeri</a>
                    <a href="{{ route('contact.index') }}" class="text-gray-700 hover:text-orange-600">Kontak</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Tasty Food. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>