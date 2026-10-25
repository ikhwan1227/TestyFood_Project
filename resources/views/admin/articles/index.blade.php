@extends('layouts.admin')

@section('title', 'Artikel')
@section('page_title', 'Artikel')

@section('searchbar')
    <x-admin-search
        :route="route('admin.articles.index')"
        :value="request('q')"
        placeholder="Cari artikel..." />
@endsection

@section('page_actions')
    <button type="button"
            class="admin-topbar-btn-outline"
            id="filterToggleBtn"
            onclick="toggleFilterPanel(event)">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
        </svg>
        <span>Filter</span>
        @if(request()->hasAny(['date', 'status', 'category']))
            <span class="admin-topbar-btn-dot"></span>
        @endif
    </button>

    <a href="{{ route('admin.articles.create') }}" class="admin-topbar-btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        <span>Tambah</span>
    </a>
@endsection

@section('content')

    {{-- Info hasil pencarian --}}
    @if(request('q'))
        <div class="admin-search-info">
            Hasil pencarian untuk <strong>"{{ request('q') }}"</strong> · {{ $articles->total() }} artikel ditemukan
        </div>
    @endif

    {{-- Card Container --}}
    <div class="bg-white rounded-lg shadow">
        
        {{-- ============================================ --}}
        {{-- FILTER PANEL (Dipindahkan ke dalam card)     --}}
        {{-- ============================================ --}}
        <form method="GET"
              action="{{ route('admin.articles.index') }}"
              class="admin-filter-panel {{ request()->hasAny(['date', 'status', 'category']) ? 'show' : '' }}"
              id="articleFilterPanel"
              style="border-top: none; border-bottom: 1px solid #e5e7eb; box-shadow: none;">
            
            {{-- Pertahankan search keyword saat submit filter --}}
            @if(request('q'))
                <input type="hidden" name="q" value="{{ request('q') }}">
            @endif

            <div class="admin-filter-panel-inner">
                <div class="article-filter-item">
                    <label>Tanggal</label>
                    <input type="date" name="date" value="{{ request('date') }}">
                </div>

                <div class="article-filter-item">
                    <label>Status</label>
                    <select name="status">
                        <option value="">Semua</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div class="article-filter-item">
                    <label>Kategori</label>
                    <select name="category">
                        <option value="">Semua</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="admin-filter-panel-actions">
                    <button type="submit" class="article-filter-apply">Terapkan</button>
                    @if(request()->hasAny(['date', 'status', 'category', 'q']))
                        <a href="{{ route('admin.articles.index') }}" class="article-filter-clear">Reset</a>
                    @endif
                </div>
            </div>
        </form>

        {{-- Tabel --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="text-left p-4" style="width: 80px;">Gambar</th>
                        <th class="text-left p-4">Judul</th>
                        <th class="text-left p-4">Kategori</th>
                        <th class="text-left p-4">Status</th>
                        <th class="text-left p-4">Tanggal</th>
                        <th class="text-center p-4" style="width: 60px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">
                                <img src="{{ $article->thumbnail_url }}"
                                     alt="{{ $article->plain_title }}"
                                     class="w-16 h-12 object-cover rounded">
                            </td>
                            <td class="p-4">
                                <div class="font-medium">{{ Str::limit($article->plain_title, 60) }}</div>
                                <div class="text-xs text-gray-400" style="font-family: monospace;">
                                    {{ $article->slug }}
                                </div>
                            </td>
                            <td class="p-4">{{ $article->category->name ?? '-' }}</td>
                            <td class="p-4">
                                @if($article->is_published)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">Published</span>
                                @else
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-semibold">Draft</span>
                                @endif
                            </td>
                            <td class="p-4 text-gray-500">
                                {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                            </td>
                            <td class="p-4 text-center">
                                <div class="article-dropdown">
                                    <button type="button" class="article-dropdown-btn" onclick="toggleArticleDropdown(event)">⋮</button>
                                    <div class="article-dropdown-menu">
                                        <a href="{{ route('news.show', $article->slug) }}" target="_blank" class="article-dropdown-item"> 
                                            <x-icon name="eye" :size="14" />
                                            <span>Lihat</span>
                                        </a>
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="article-dropdown-item"> 
                                            <x-icon name="edit" :size="14" />
                                            <span>Edit</span>
                                        </a>
                                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus artikel ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    class="article-dropdown-item article-dropdown-danger"
                                                    onclick="openDeleteModal('{{ route('admin.articles.destroy', $article) }}', 'artikel ini')">
                                                <x-icon name="trash" :size="14" />
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">
                                @if(request('q'))
                                    Tidak ada artikel dengan judul "<strong>{{ request('q') }}</strong>".
                                    <br><a href="{{ route('admin.articles.index') }}" class="text-orange-600 hover:underline mt-2 inline-block">Reset pencarian</a>
                                @else
                                    Belum ada artikel.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4">{{ $articles->withQueryString()->links() }}</div>
    </div>

    <script>
        function toggleFilterPanel(event) {
            event.stopPropagation();
            const btn = document.getElementById('filterToggleBtn');
            const panel = document.getElementById('articleFilterPanel');
            const isOpen = panel.classList.contains('show');

            btn.setAttribute('aria-expanded', !isOpen);
            panel.classList.toggle('show');
        }

        function toggleArticleDropdown(event) {
            event.stopPropagation();
            const btn = event.currentTarget;
            const menu = btn.nextElementSibling;
            const isOpen = menu.classList.contains('show');

            // Tutup semua dropdown lain
            document.querySelectorAll('.article-dropdown-menu').forEach(m => m.classList.remove('show'));

            if (!isOpen) {
                // Hitung posisi agar tidak keluar layar
                const btnRect = btn.getBoundingClientRect();
                const menuWidth = 160;
                const menuHeight = 140;

                let left = btnRect.right - menuWidth;
                let top = btnRect.bottom + 4;

                // Jika keluar kanan layar
                if (left + menuWidth > window.innerWidth - 8) {
                    left = window.innerWidth - menuWidth - 8;
                }
                // Jika keluar kiri
                if (left < 8) left = 8;

                // Jika keluar bawah layar, tampilkan di atas
                if (top + menuHeight > window.innerHeight - 8) {
                    top = btnRect.top - menuHeight - 4;
                }

                menu.style.left = left + 'px';
                menu.style.top = top + 'px';
                menu.classList.add('show');
            }
        }

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.article-dropdown')) {
                document.querySelectorAll('.article-dropdown-menu').forEach(m => m.classList.remove('show'));
            }
        });
    </script>

@endsection