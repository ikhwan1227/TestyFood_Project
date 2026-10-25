@extends('layouts.admin')

@section('title', 'Notifikasi')
@section('page_title', 'Notifikasi')

@section('page_actions')
    @if($unreadCount > 0)
        <form action="{{ route('admin.notifications.markAllRead') }}" method="POST">
            @csrf
            <button type="submit" class="admin-topbar-btn-outline" title="Tandai Semua Dibaca">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>Tandai Dibaca</span>
            </button>
        </form>
    @endif

    @if($totalCount > 0)
        <form action="{{ route('admin.notifications.clearAll') }}" method="POST"
              onsubmit="return confirm('Hapus SEMUA notifikasi?')">
            @csrf
            <button type="submit" class="admin-topbar-btn-outline" title="Bersihkan Semua">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                </svg>
                <span>Bersihkan</span>
            </button>
        </form>
    @endif
@endsection

@section('page_subheader')
    <div class="notif-tabs">
        <a href="{{ route('admin.notifications.index', ['filter' => 'all']) }}"
           class="notif-tab {{ $filter === 'all' ? 'active' : '' }}">
            Semua
            <span class="notif-tab-count">{{ $totalCount }}</span>
        </a>
        <a href="{{ route('admin.notifications.index', ['filter' => 'unread']) }}"
           class="notif-tab {{ $filter === 'unread' ? 'active' : '' }}">
            Belum Dibaca
            @if($unreadCount > 0)
                <span class="notif-tab-count notif-tab-count-alert">{{ $unreadCount }}</span>
            @endif
        </a>
        <a href="{{ route('admin.notifications.index', ['filter' => 'contact']) }}"
           class="notif-tab {{ $filter === 'contact' ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
            </svg>
            Pesan Kontak
            @if($contactCount > 0)
                <span class="notif-tab-count">{{ $contactCount }}</span>
            @endif
        </a>
    </div>
@endsection

@section('content')

    @if(session('success'))
        <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
    @endif

    {{-- DAFTAR NOTIFIKASI --}}
    <div class="notif-list">
        @forelse($notifications as $notif)
            @php
                $isContact = str_contains($notif->type, 'contact');
                $icon = 'bell';
                $color = 'gray';
                $label = 'Aktivitas';
                if (str_contains($notif->type, 'created')) { $icon = 'plus'; $color = 'green'; $label = 'Dibuat'; }
                elseif (str_contains($notif->type, 'updated')) { $icon = 'edit'; $color = 'blue'; $label = 'Diubah'; }
                elseif (str_contains($notif->type, 'deleted')) { $icon = 'trash'; $color = 'red'; $label = 'Dihapus'; }
                elseif ($isContact) { $icon = 'mail'; $color = 'purple'; $label = 'Pesan Kontak'; }
                elseif (str_contains($notif->type, 'setting')) { $icon = 'settings'; $color = 'orange'; $label = 'Pengaturan'; }
            @endphp

            <div class="notif-item {{ !$notif->is_read ? 'notif-item-unread' : '' }} {{ $isContact ? 'notif-item-contact' : '' }}">
                @if(!$notif->is_read)
                    <div class="notif-unread-bar"></div>
                @endif

                <div class="notif-icon notif-icon-{{ $color }}">
                    @if($icon === 'plus')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    @elseif($icon === 'edit')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    @elseif($icon === 'trash')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                    @elseif($icon === 'mail')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    @elseif($icon === 'settings')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    @endif
                </div>

                <div class="notif-body">
                    <div class="notif-title-row">
                        <div class="notif-title">{{ $notif->title }}</div>
                        <div class="notif-badge notif-badge-{{ $color }}">{{ $label }}</div>
                    </div>

                    @if($isContact)
                        {{-- Tampilan khusus untuk pesan kontak --}}
                        <div class="notif-contact-preview">
                            {!! nl2br(e($notif->message)) !!}
                        </div>
                    @else
                        <p class="notif-message">{{ $notif->message }}</p>
                    @endif

                    <div class="notif-meta">
                        <span class="notif-meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            {{ $notif->actor->name ?? 'Sistem' }}
                        </span>
                        <span class="notif-meta-dot">·</span>
                        <span class="notif-meta-item" title="{{ $notif->created_at->format('d M Y, H:i') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            {{ $notif->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>

                <div class="notif-actions">
                    @if(!$notif->is_read)
                        <form action="{{ route('admin.notifications.read', $notif) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="notif-action-icon notif-action-check" title="Tandai dibaca">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </button>
                        </form>
                    @endif
                    @if($notif->url)
                        <a href="{{ $notif->url }}" class="notif-action-icon notif-action-open" title="Buka">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    @endif
                    <form action="{{ route('admin.notifications.destroy', $notif) }}" method="POST"
                          style="display:inline;" onsubmit="return confirm('Hapus notifikasi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="notif-action-icon notif-action-delete" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="notif-empty">
                <div class="notif-empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </div>
                <p class="notif-empty-text">Belum ada aktivitas</p>
                <p class="notif-empty-hint">
                    Notifikasi akan muncul saat ada admin menambah, mengubah, atau menghapus data.
                </p>
            </div>
        @endforelse
    </div>

    @if($notifications->hasPages())
        <div class="notif-pagination">
            {{ $notifications->links() }}
        </div>
    @endif

@endsection