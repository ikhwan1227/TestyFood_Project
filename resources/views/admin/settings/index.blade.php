@extends('layouts.admin')

@section('title', 'Pengaturan')
@section('page_title', 'Pengaturan')
@section('hide_topbar', true)

@section('content')

    @if(session('success'))
        <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="settings-grid">

            {{-- ============================================ --}}
            {{-- SECTION 1: INFORMASI UMUM --}}
            {{-- ============================================ --}}
            <div class="settings-card">
                <div class="settings-card-header">
                    <div class="settings-card-icon settings-card-icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="settings-card-title">Informasi Umum</h2>
                        <p class="settings-card-desc">Nama dan identitas website</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <div class="settings-field">
                        <label class="settings-label">Nama Website</label>
                        <input type="text"
                               name="site_name"
                               value="{{ $settings['site_name'] ?? '' }}"
                               placeholder="Contoh: Tasty Food"
                               class="settings-input">
                    </div>
                </div>
            </div>

            {{-- ============================================ --}}
            {{-- SECTION 2: KONTAK --}}
            {{-- ============================================ --}}
            <div class="settings-card">
                <div class="settings-card-header">
                    <div class="settings-card-icon settings-card-icon-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="settings-card-title">Informasi Kontak</h2>
                        <p class="settings-card-desc">Email, telepon, dan alamat</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <div class="settings-field">
                        <label class="settings-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            Email
                        </label>
                        <input type="email"
                               name="contact_email"
                               value="{{ $settings['contact_email'] ?? '' }}"
                               placeholder="marketing@example.com"
                               class="settings-input">
                    </div>

                    <div class="settings-field">
                        <label class="settings-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            Telepon
                        </label>
                        <input type="text"
                               name="contact_phone"
                               value="{{ $settings['contact_phone'] ?? '' }}"
                               placeholder="+62 812 3456 7890"
                               class="settings-input">
                    </div>

                    <div class="settings-field">
                        <label class="settings-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            Alamat
                        </label>
                        <textarea name="address"
                                  rows="2"
                                  placeholder="Jl. Contoh No. 123, Kota Bandung, Jawa Barat"
                                  class="settings-textarea">{{ $settings['address'] ?? '' }}</textarea>
                    </div>
                    <div class="settings-field">
                        <label class="settings-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                            </svg>
                            Link Google Maps
                        </label>
                        <input type="url"
                               name="maps_url"
                               value="{{ $settings['maps_url'] ?? '' }}"
                               placeholder="https://maps.app.goo.gl/xxxx atau https://maps.google.com/?q=..."
                               class="settings-input">
                        <p style="font-size: 11px; color: #6b7280; margin-top: 4px;">
                            Buka Google Maps &rarr; Cari lokasi &rarr; Klik "Share" &rarr; Salin link dan tempel di sini.
                        </p>
                    </div>
                </div>
            </div>

            {{-- ============================================ --}}
            {{-- SECTION 3: MEDIA SOSIAL --}}
            {{-- ============================================ --}}
            <div class="settings-card settings-card-full">
                <div class="settings-card-header">
                    <div class="settings-card-icon settings-card-icon-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="settings-card-title">Media Sosial</h2>
                        <p class="settings-card-desc">Link ke akun sosial media</p>
                    </div>
                </div>
                <div class="settings-card-body settings-card-body-grid">
                    <div class="settings-field">
                        <label class="settings-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                            Facebook
                        </label>
                        <input type="url"
                               name="facebook_url"
                               value="{{ $settings['facebook_url'] ?? '' }}"
                               placeholder="https://facebook.com/username"
                               class="settings-input">
                    </div>

                    <div class="settings-field">
                        <label class="settings-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                            </svg>
                            Twitter
                        </label>
                        <input type="url"
                               name="twitter_url"
                               value="{{ $settings['twitter_url'] ?? '' }}"
                               placeholder="https://twitter.com/username"
                               class="settings-input">
                    </div>
                </div>
            </div>

        </div>

        {{-- ============================================ --}}
        {{-- FLOATING ACTION BAR --}}
        {{-- ============================================ --}}
        <div class="settings-action-bar">
            <div class="settings-action-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <span>Perubahan akan langsung diterapkan ke seluruh halaman website.</span>
            </div>
            <button type="submit" class="settings-btn-save">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>
                </svg>
                Simpan Pengaturan
            </button>
        </div>

    </form>

@endsection