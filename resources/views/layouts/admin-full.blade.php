<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin</title>
    
    {{-- Sesuaikan dengan cara Anda memanggil CSS (Vite atau Asset biasa) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- CDN Quill CSS (untuk editor teks) --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<body class="admin-body">

    {{-- Wrapper Full Width --}}
    <div class="admin-content" style="max-width: 100%; padding: 30px 40px; margin: 0;">
        
        {{-- HEADER: Tombol Kembali & Judul Halaman --}}
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px;">
            <a href="{{ route('admin.articles.index') }}" class="admin-topbar-btn-outline" title="Kembali ke Daftar Artikel" style="padding: 10px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                {{-- Menggunakan icon arrow-right yang diputar 180 derajat --}}
                <x-icon name="arrow-right" size="20" style="transform: rotate(180deg);" />
            </a>
            <h1 style="font-size: 22px; font-weight: 700; color: #1f2937; margin: 0;">
                @yield('page_title')
            </h1>
        </div>

        {{-- Konten Form --}}
        @yield('content')
    </div>

    {{-- CDN Quill JS (untuk editor teks) --}}
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
</body>
</html>