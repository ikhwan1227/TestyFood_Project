<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin Tasty Food</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lora:ital,wght@0,400;0,500;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="admin-body">

    {{-- ========================================
         SIDEBAR
         ======================================== --}}
    <aside class="admin-sidebar" id="adminSidebar">

        {{-- Brand --}}
        <div class="admin-sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <span class="admin-sidebar-brand-name">TASTY FOOD</span>
                <span class="admin-sidebar-brand-tag">Admin</span>
            </a>
            <button type="button" class="admin-sidebar-close" onclick="toggleSidebar()" aria-label="Tutup menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="admin-sidebar-nav">

            <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="9"></rect>
                    <rect x="14" y="3" width="7" height="5"></rect>
                    <rect x="14" y="12" width="7" height="9"></rect>
                    <rect x="3" y="16" width="7" height="5"></rect>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.articles.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
                <span>Artikel</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                </svg>
                <span>Kategori</span>
            </a>

            <a href="{{ route('admin.galleries.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
                <span>Galeri</span>
            </a>

            <a href="{{ route('admin.notifications.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                <span>Notifikasi</span>
                @php $unreadCount = \App\Services\NotificationService::unreadCount(); @endphp
                @if($unreadCount > 0)
                    <span class="admin-sidebar-badge">{{ $unreadCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.about.edit') }}" class="admin-sidebar-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <span>Tentang Kami</span>
            </a>

            <a href="{{ route('admin.settings.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                </svg>
                <span>Pengaturan</span>
            </a>

        </nav>

        {{-- Footer user --}}
        <div class="admin-sidebar-footer">
            <div class="admin-sidebar-user">
                <div class="admin-sidebar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div class="admin-sidebar-user-info">
                    <p class="admin-sidebar-user-name">{{ Auth::user()->name }}</p>
                    <p class="admin-sidebar-user-email">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="admin-sidebar-logout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>

    {{-- OVERLAY (mobile) --}}
    <div class="admin-sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    {{-- ========================================
         MAIN WRAPPER
         ======================================== --}}
        <div class="admin-wrapper">

            {{-- ============================================
                DYNAMIC TOPBAR (munculkan hanya jika perlu)
                ============================================ --}}
            @if(!View::hasSection('hide_topbar'))
            <header class="admin-topbar">
                <div class="admin-topbar-main">

                    {{-- Toggle Sidebar (mobile) --}}
                    <button type="button" class="admin-topbar-toggle" onclick="toggleSidebar()" aria-label="Buka menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>

                    {{-- Page Title --}}
                    @hasSection('page_title')
                        <h1 class="admin-topbar-title">@yield('page_title')</h1>
                    @endif

                    {{-- Searchbar --}}
                    @hasSection('searchbar')
                        <div class="admin-topbar-search">
                            @yield('searchbar')
                        </div>
                    @endif

                    {{-- Page Actions (Tombol) --}}
                    @hasSection('page_actions')
                        <div class="admin-topbar-actions">
                            @yield('page_actions')
                        </div>
                    @endif

                </div>

                {{-- Subheader (Filter Panel / Tabs) --}}
                @hasSection('page_subheader')
                    <div class="admin-topbar-sub">
                        @yield('page_subheader')
                    </div>
                @endif
            </header>
            @endif

            {{-- ============================================
                MAIN CONTENT
                ============================================ --}}
            <main class="admin-content">

                @if(session('success'))
                    <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="admin-alert admin-alert-error">{{ session('error') }}</div>
                @endif

                @yield('content')
            </main>

            <footer class="admin-footer">
                <div class="admin-footer-inner">
                    <div class="admin-footer-brand">
                        <span class="admin-footer-logo">TASTY FOOD</span>
                        <span>© {{ date('Y') }}</span>
                    </div>
                    <div class="admin-footer-links">
                        <a href="{{ route('home') }}" target="_blank">Website</a>
                        <span class="admin-footer-sep">·</span>
                        <a href="{{ route('admin.settings.index') }}">Pengaturan</a>
                    </div>
                    <span class="admin-footer-version-badge">
                        <span class="admin-footer-version-dot"></span>
                        v1.0.0
                    </span>
                </div>

                {{-- Global Delete Modal --}}
                <x-delete-modal />
            </footer>

        </div>

    {{-- JAVASCRIPT --}}
    <script>
        // === TOGGLE SIDEBAR (mobile) ===
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        }

        // === CLOSE SIDEBAR ON OVERLAY CLICK ===
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('adminSidebar');
                if (sidebar.classList.contains('open')) {
                    toggleSidebar();
                }
            }
        });

        // === AUTO DISMISS ALERT ===
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                document.querySelectorAll('.admin-alert').forEach(function (alert) {
                    alert.style.transition = 'opacity 0.4s ease, max-height 0.4s ease, padding 0.4s ease, margin 0.4s ease';
                    alert.style.opacity = '0';
                    alert.style.maxHeight = '0';
                    alert.style.paddingTop = '0';
                    alert.style.paddingBottom = '0';
                    alert.style.marginBottom = '0';
                    alert.style.overflow = 'hidden';
                    setTimeout(() => alert.remove(), 400);
                });
            }, 3000);
        });

        // === GLOBAL DELETE MODAL ===
        function openDeleteModal(actionUrl, itemName = 'data ini') {
            const modal = document.getElementById('globalDeleteModal');
            const form = document.getElementById('globalDeleteForm');
            const message = document.getElementById('confirmMessage');

            // Set form action
            form.action = actionUrl;

            // Set custom message
            message.innerHTML = `Apakah Anda yakin ingin menghapus <strong>${itemName}</strong>? Tindakan ini tidak bisa dibatalkan.`;

            modal.classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('globalDeleteModal').classList.remove('show');
        }

        // Close on backdrop click
        document.getElementById('globalDeleteModal')?.addEventListener('click', function (e) {
            if (e.target === this) closeDeleteModal();
        });

        // Close on ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeDeleteModal();
        });
    </script>
@stack('scripts')
</body>
</html>