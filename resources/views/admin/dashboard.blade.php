@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', '')
@section('hide_topbar', true)

@section('content')

    {{-- ============================================ --}}
    {{-- WELCOME HEADER (ULTRA COMPACT) --}}
    {{-- ============================================ --}}
    <div class="dash-welcome">
        <div class="dash-welcome-text">
            <h1 class="dash-welcome-title">
                Hai, {{ Auth::user()->name }}
            </h1>
            <p class="dash-welcome-sub">
                {{ Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </p>
        </div>
        <div class="dash-welcome-actions">
            <a href="{{ route('admin.articles.create') }}" class="dash-quick-btn dash-quick-btn-primary">
                <x-icon name="plus" size="14" />
                <span>Artikel</span>
            </a>
            <a href="{{ route('admin.galleries.index') }}" class="dash-quick-btn">
                <x-icon name="image" size="14" />
                <span>Foto</span>
            </a>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- STAT CARDS --}}
    {{-- ============================================ --}}
    <div class="dash-grid-4">

        {{-- Artikel --}}
        <div class="dash-stat">
            <div class="dash-stat-icon dash-stat-icon-blue">
                <x-icon name="article" style="width: 30px; height: 30px;" />
            </div>
            <div class="dash-stat-body">
                <p class="dash-stat-label">Total Artikel</p>
                <p class="dash-stat-value">{{ $stats['articles_total'] }}</p>
                <p class="dash-stat-meta">
                    <span class="dash-dot dash-dot-green"></span>
                    {{ $stats['articles_published'] }} Published
                    <span class="dash-sep">·</span>
                    {{ $stats['articles_draft'] }} Draft
                </p>
            </div>
        </div>

        {{-- Galeri --}}
        <div class="dash-stat">
            <div class="dash-stat-icon dash-stat-icon-green">
                <x-icon name="image" style="width: 30px; height: 30px;" />
            </div>
            <div class="dash-stat-body">
                <p class="dash-stat-label">Total Galeri</p>
                <p class="dash-stat-value">{{ $stats['galleries'] }}</p>
                <p class="dash-stat-meta">
                    <span class="dash-dot dash-dot-green"></span>
                    Foto terpublikasi
                </p>
            </div>
        </div>

        {{-- Trend Artikel --}}
        <div class="dash-stat">
            <div class="dash-stat-icon dash-stat-icon-purple">
                <x-icon name="chart" style="width: 30px; height: 30px;" />
            </div>
            <div class="dash-stat-body">
                <p class="dash-stat-label">Artikel Bulan Ini</p>
                <p class="dash-stat-value">{{ $trend['this_month'] }}</p>
                <p class="dash-stat-meta">
                    @if($trend['is_up'])
                        <span class="dash-trend dash-trend-up">▲ {{ $trend['percentage'] }}%</span>
                    @else
                        <span class="dash-trend dash-trend-down">▼ {{ abs($trend['percentage']) }}%</span>
                    @endif
                    <span class="dash-sep">vs bulan lalu</span>
                </p>
            </div>
        </div>

        {{-- Notifikasi --}}
        <div class="dash-stat">
            <div class="dash-stat-icon dash-stat-icon-orange">
                <x-icon name="bell" style="width: 30px; height: 30px;" />
            </div>
            <div class="dash-stat-body">
                <p class="dash-stat-label">Notifikasi Baru</p>
                <p class="dash-stat-value">{{ $stats['notifications'] }}</p>
                <p class="dash-stat-meta">
                    @if($stats['notifications'] > 0)
                        <span class="dash-dot dash-dot-orange"></span>
                        Perlu diperiksa
                    @else
                        <span class="dash-dot dash-dot-green"></span>
                        Semua terbaca
                    @endif
                </p>
            </div>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- TOP KATEGORI + AKTIVITAS --}}
    {{-- ============================================ --}}
    <div class="dash-grid-2">

        {{-- KIRI: Top Kategori --}}
        <div class="dash-card">
            <div class="dash-card-header">
                <h2 class="dash-card-title" style="display: flex; align-items: center; gap: 8px;">
                    <x-icon name="article" style="width: 20px; height: 20px;" />
                    <span>Artikel Perkategori</span>
                </h2>
                <a href="{{ route('admin.categories.index') }}" class="dash-card-link">
                    Kelola →
                </a>
            </div>
            <div class="dash-card-body">
                @forelse($topCategories as $category)
                    @php
                        // Hitung persentase dari total artikel
                        $totalArticles = $stats['articles_total'] ?: 1;
                        $percentage = round(($category->articles_count / $totalArticles) * 100);
                    @endphp
                    <div class="dash-cat-row">
                        <div class="dash-cat-info">
                            <span class="dash-cat-name">{{ $category->name }}</span>
                            <span class="dash-cat-count">{{ $category->articles_count }} artikel</span>
                        </div>
                        <div class="dash-cat-bar">
                            <div class="dash-cat-bar-fill" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span class="dash-cat-percent">{{ $percentage }}%</span>
                    </div>
                @empty
                    <p class="dash-empty">Belum ada kategori.</p>
                @endforelse
            </div>
        </div>

        {{-- KANAN: Aktivitas Terbaru --}}
        <div class="dash-card">
            <div class="dash-card-header">
                <h2 class="dash-card-title" style="display: flex; align-items: center; gap: 8px;">
                    <x-icon name="bell" style="width: 20px; height: 20px;" />
                    <span>Aktivitas Terbaru</span>
                </h2>
                <a href="{{ route('admin.notifications.index') }}" class="dash-card-link">
                    Lihat Semua →
                </a>
            </div>
            <div class="dash-card-body">
                @forelse($latest_notifications as $notif)
                    @php
                        $iconName = 'bell';
                        if (str_contains($notif->type, 'created')) { $iconName = 'plus'; }
                        elseif (str_contains($notif->type, 'updated')) { $iconName = 'edit'; }
                        elseif (str_contains($notif->type, 'deleted')) { $iconName = 'trash'; }
                        elseif (str_contains($notif->type, 'contact')) { $iconName = 'mail'; }
                        elseif (str_contains($notif->type, 'setting')) { $iconName = 'settings'; }
                    @endphp
                    <div class="dash-activity">
                        <div class="dash-activity-icon">
                            <x-icon :name="$iconName" size="18" />
                        </div>
                        <div class="dash-activity-body">
                            <p class="dash-activity-title">{{ $notif->title }}</p>
                            <p class="dash-activity-message">{{ Str::limit($notif->message, 80) }}</p>
                            <p class="dash-activity-meta">
                                {{ $notif->actor->name ?? 'Sistem' }} ·
                                {{ $notif->created_at->diffForHumans() }}
                            </p>
                        </div>
                        @if(!$notif->is_read)
                            <span class="dash-activity-badge">Baru</span>
                        @endif
                    </div>
                @empty
                    <div class="dash-empty-state">
                        <p class="dash-empty-icon">
                            <x-icon name="bell" style="width: 40px; height: 40px; opacity: 0.35;" />
                        </p>
                        <p class="dash-empty-title">Belum ada aktivitas</p>
                        <p class="dash-empty-sub">
                            Notifikasi akan muncul saat ada perubahan data.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection