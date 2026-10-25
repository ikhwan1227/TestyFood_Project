@extends('layouts.admin')

@section('title', 'Tentang Kami')
@section('page_title', 'Tentang Kami')

@section('content')

    @if(session('success'))
        <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="admin-alert admin-alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TAB NAVIGATION --}}
    <div class="about-tabs">
        <button type="button" class="about-tab-btn active" onclick="openTab(event, 'tab-home')">
            Halaman Beranda (Home)
        </button>
        <button type="button" class="about-tab-btn" onclick="openTab(event, 'tab-about')">
            Halaman Tentang Kami
        </button>
    </div>

    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ========================================== --}}
        {{-- KONTEN TAB 1: HALAMAN BERANDA (HOME)      --}}
        {{-- ========================================== --}}
        <div id="tab-home" class="about-tab-content active">
            <div class="settings-card settings-card-full">
                <div class="settings-card-header">
                    <div class="settings-card-icon settings-card-icon-blue">
                        <x-icon name="image" :size="20" />
                    </div>
                    <div>
                        <h2 class="settings-card-title">Menu Spesial Beranda (4 Kartu)</h2>
                        <p class="settings-card-desc">Kelola teks dan gambar untuk keempat kartu menu di halaman utama.</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    {{-- FORM KARTU 1 --}}
                    <div id="form-card-1" class="card-form-grid" style="display: grid;">
                        <div class="settings-field">
                            <label class="settings-label">Pilih Kartu</label>
                            <select id="cardSelector1" class="settings-input" onchange="changeCardForm(1)" style="font-weight: bold; border-color: #ea580c; cursor: pointer;">
                                <option value="1" selected>Kartu Menu 1</option>
                                <option value="2">Kartu Menu 2</option>
                                <option value="3">Kartu Menu 3</option>
                                <option value="4">Kartu Menu 4</option>
                            </select>
                        </div>
                        <div class="settings-field">
                            <label class="settings-label">Judul Kartu 1</label>
                            <input type="text" name="card1_title" value="{{ old('card1_title', $about->card1_title) }}" class="settings-input" placeholder="Contoh: LOREM IPSUM">
                        </div>
                        <div class="settings-field">
                            <label class="settings-label">Deskripsi Kartu 1</label>
                            <textarea name="card1_desc" rows="3" class="settings-textarea">{{ old('card1_desc', $about->card1_desc) }}</textarea>
                        </div>
                        <div class="settings-field">
                            <x-image-upload name="image_1a" existingImage="{{ $about->getImageUrl('image_1a') }}" label="Gambar Kartu 1" />
                            <small style="color: #6b7280; font-size: 11px; margin-top: 4px; display: block;">Disarankan Format: JPG, PNG, WEBP, AVIF. Maks: 2MB, transparan.</small>
                        </div>
                    </div>

                    {{-- FORM KARTU 2 --}}
                    <div id="form-card-2" class="card-form-grid" style="display: none;">
                        <div class="settings-field">
                            <label class="settings-label">Pilih Kartu</label>
                            <select id="cardSelector2" class="settings-input" onchange="changeCardForm(2)" style="font-weight: bold; border-color: #ea580c; cursor: pointer;">
                                <option value="1">Kartu Menu 1</option>
                                <option value="2" selected>Kartu Menu 2</option>
                                <option value="3">Kartu Menu 3</option>
                                <option value="4">Kartu Menu 4</option>
                            </select>
                        </div>
                        <div class="settings-field">
                            <label class="settings-label">Judul Kartu 2</label>
                            <input type="text" name="card2_title" value="{{ old('card2_title', $about->card2_title) }}" class="settings-input" placeholder="Contoh: LOREM IPSUM">
                        </div>
                        <div class="settings-field">
                            <label class="settings-label">Deskripsi Kartu 2</label>
                            <textarea name="card2_desc" rows="3" class="settings-textarea">{{ old('card2_desc', $about->card2_desc) }}</textarea>
                        </div>
                        <div class="settings-field">
                            <x-image-upload name="image_1b" existingImage="{{ $about->getImageUrl('image_1b') }}" label="Gambar Kartu 2" />
                            <small style="color: #6b7280; font-size: 11px; margin-top: 4px; display: block;">Disarankan Format: JPG, PNG, WEBP, AVIF. Maks: 2MB, transparan.</small>
                        </div>
                    </div>

                    {{-- FORM KARTU 3 --}}
                    <div id="form-card-3" class="card-form-grid" style="display: none;">
                        <div class="settings-field">
                            <label class="settings-label">Pilih Kartu</label>
                            <select id="cardSelector3" class="settings-input" onchange="changeCardForm(3)" style="font-weight: bold; border-color: #ea580c; cursor: pointer;">
                                <option value="1">Kartu Menu 1</option>
                                <option value="2">Kartu Menu 2</option>
                                <option value="3" selected>Kartu Menu 3</option>
                                <option value="4">Kartu Menu 4</option>
                            </select>
                        </div>
                        <div class="settings-field">
                            <label class="settings-label">Judul Kartu 3</label>
                            <input type="text" name="card3_title" value="{{ old('card3_title', $about->card3_title) }}" class="settings-input" placeholder="Contoh: LOREM IPSUM">
                        </div>
                        <div class="settings-field">
                            <label class="settings-label">Deskripsi Kartu 3</label>
                            <textarea name="card3_desc" rows="3" class="settings-textarea">{{ old('card3_desc', $about->card3_desc) }}</textarea>
                        </div>
                        <div class="settings-field">
                            <x-image-upload name="image_2a" existingImage="{{ $about->getImageUrl('image_2a') }}" label="Gambar Kartu 3" />
                            <small style="color: #6b7280; font-size: 11px; margin-top: 4px; display: block;">Disarankan Format: JPG, PNG, WEBP, AVIF. Maks: 2MB, transparan.</small>
                        </div>
                    </div>

                    {{-- FORM KARTU 4 --}}
                    <div id="form-card-4" class="card-form-grid" style="display: none;">
                        <div class="settings-field">
                            <label class="settings-label">Pilih Kartu</label>
                            <select id="cardSelector4" class="settings-input" onchange="changeCardForm(4)" style="font-weight: bold; border-color: #ea580c; cursor: pointer;">
                                <option value="1">Kartu Menu 1</option>
                                <option value="2">Kartu Menu 2</option>
                                <option value="3">Kartu Menu 3</option>
                                <option value="4" selected>Kartu Menu 4</option>
                            </select>
                        </div>
                        <div class="settings-field">
                            <label class="settings-label">Judul Kartu 4</label>
                            <input type="text" name="card4_title" value="{{ old('card4_title', $about->card4_title) }}" class="settings-input" placeholder="Contoh: LOREM IPSUM">
                        </div>
                        <div class="settings-field">
                            <label class="settings-label">Deskripsi Kartu 4</label>
                            <textarea name="card4_desc" rows="3" class="settings-textarea">{{ old('card4_desc', $about->card4_desc) }}</textarea>
                        </div>
                        <div class="settings-field">
                            <x-image-upload name="image_2b" existingImage="{{ $about->getImageUrl('image_2b') }}" label="Gambar Kartu 4" />
                            <small style="color: #6b7280; font-size: 11px; margin-top: 4px; display: block;">Disarankan Format: JPG, PNG, WEBP, AVIF. Maks: 2MB, transparan.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- KONTEN TAB 2: HALAMAN TENTANG KAMI (ABOUT)--}}
        {{-- ========================================== --}}
        <div id="tab-about" class="about-tab-content">
            <div class="settings-grid">
                
                {{-- SECTION 1: INFORMASI UTAMA (Lebar Penuh) --}}
                <div class="settings-card settings-card-full">
                    <div class="settings-card-header">
                        <div class="settings-card-icon settings-card-icon-orange">
                            <x-icon name="article" :size="20" />
                        </div>
                        <div>
                            <h2 class="settings-card-title">Section 1 — Informasi Utama</h2>
                            <p class="settings-card-desc">Teks paragraf pengantar di halaman Tentang Kami.</p>
                        </div>
                    </div>
                    <div class="settings-card-body">
                        <div class="settings-field">
                            <label class="settings-label">Judul Pengantar</label>
                            <input type="text" name="title_1" value="{{ old('title_1', $about->title_1) }}" class="settings-input" placeholder="Contoh: TENTANG KAMI" required>
                        </div>
                        <div class="settings-field">
                            <label class="settings-label">Deskripsi Paragraf 1 (Bold/Tebal)</label>
                            <textarea name="description_1a" rows="3" class="settings-textarea">{{ old('description_1a', $about->description_1a) }}</textarea>
                        </div>
                        <div class="settings-field">
                            <label class="settings-label">Deskripsi Paragraf 2</label>
                            <textarea name="description_1b" rows="3" class="settings-textarea">{{ old('description_1b', $about->description_1b) }}</textarea>
                        </div>
                        
                        {{-- Gambar Bersebelahan --}}
                        <div class="about-image-grid">
                            <div class="settings-field">
                                <x-image-upload name="about_image_1a" existingImage="{{ $about->getImageUrl('about_image_1a') }}" label="Gambar 1A (Kiri)" />
                            </div>
                            <div class="settings-field">
                                <x-image-upload name="about_image_1b" existingImage="{{ $about->getImageUrl('about_image_1b') }}" label="Gambar 1B (Kanan)" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: VISI (Lebar Penuh) --}}
                <div class="settings-card settings-card-full">
                    <div class="settings-card-header">
                        <div class="settings-card-icon settings-card-icon-blue">
                            <x-icon name="eye" :size="20" />
                        </div>
                        <div>
                            <h2 class="settings-card-title">Section 2 — Visi</h2>
                            <p class="settings-card-desc">Konten visi perusahaan.</p>
                        </div>
                    </div>
                    <div class="settings-card-body">
                        <div class="settings-field">
                            <label class="settings-label">Teks Visi</label>
                            <textarea name="description_2" rows="6" class="settings-textarea">{{ old('description_2', $about->description_2) }}</textarea>
                        </div>
                        
                        {{-- Gambar Bersebelahan --}}
                        <div class="about-image-grid">
                            <div class="settings-field">
                                <x-image-upload name="about_image_2a" existingImage="{{ $about->getImageUrl('about_image_2a') }}" label="Gambar Visi 2A" />
                            </div>
                            <div class="settings-field">
                                <x-image-upload name="about_image_2b" existingImage="{{ $about->getImageUrl('about_image_2b') }}" label="Gambar Visi 2B" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: MISI + BANNER (Lebar Penuh) --}}
                <div class="settings-card settings-card-full">
                    <div class="settings-card-header">
                        <div class="settings-card-icon settings-card-icon-purple">
                            <x-icon name="check" :size="20" />
                        </div>
                        <div>
                            <h2 class="settings-card-title">Section 3 — Misi & Banner</h2>
                            <p class="settings-card-desc">Konten misi perusahaan dan gambar banner pendukung.</p>
                        </div>
                    </div>
                    <div class="settings-card-body">
                        <div class="settings-field">
                            <label class="settings-label">Teks Misi</label>
                            <textarea name="description_3" rows="6" class="settings-textarea">{{ old('description_3', $about->description_3) }}</textarea>
                        </div>

                        {{-- Gambar Banner dipindah ke sini --}}
                        <div class="settings-field" style="margin-top: 16px;">
                            <x-image-upload name="image_3" existingImage="{{ $about->getImageUrl('image_3') }}" label="Gambar Banner Tambahan (Rasio 21:9)" />
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- STICKY ACTION BAR --}}
        <div class="settings-action-bar">
            <div class="settings-action-info">
                <x-icon name="info" :size="16" style="color: #ea580c;" />
                <span>Pastikan Anda menekan tombol simpan setelah melakukan perubahan.</span>
            </div>
            <button type="submit" class="settings-btn-save">
                <x-icon name="save" :size="16" />
                Simpan Perubahan
            </button>
        </div>

    </form>

    {{-- SCRIPT UNTUK TAB & DROPDOWN KARTU --}}
    <script>
        // Fungsi untuk Tab Utama
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("about-tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove("active");
            }
            tablinks = document.getElementsByClassName("about-tab-btn");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.classList.add("active");
        }

        // Fungsi untuk Dropdown Kartu 1-4
        function changeCardForm(cardIndex) {
            var selectedCard = document.getElementById('cardSelector' + cardIndex).value;
            
            // Sembunyikan semua form kartu
            for (let i = 1; i <= 4; i++) {
                document.getElementById('form-card-' + i).style.display = 'none';
            }
            
            // Tampilkan form kartu yang dipilih
            document.getElementById('form-card-' + selectedCard).style.display = 'grid';
        }
    </script>

@endsection