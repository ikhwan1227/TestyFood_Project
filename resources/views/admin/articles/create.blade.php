@extends('layouts.admin-full')

@section('title', 'Tambah Artikel')
@section('page_title', 'Tambah Artikel')

@section('content')
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
        @csrf

        <div class="article-form-grid">

            {{-- KOLOM KIRI: KONTEN LENGKAP --}}
            <div class="article-form-left">
                <div class="article-form-card">
                    <div class="article-form-card-header">
                        <h2 class="article-form-card-title">
                            <x-icon name="edit" size="18" />
                            <span>Konten Lengkap</span>
                        </h2>
                    </div>
                    <div class="article-form-card-body">
                        {{-- Editor Quill --}}
                        <div id="contentEditor" class="quill-editor-content"></div>
                        {{-- Hidden input untuk menyimpan HTML --}}
                        <input type="hidden" name="content" id="contentInput">
                        @error('content') <p class="article-form-error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: METADATA --}}
            <div class="article-form-right">

                {{-- Card: Info Artikel --}}
                <div class="article-form-card">
                    <div class="article-form-card-header">
                        <h2 class="article-form-card-title">
                            <x-icon name="info" size="18" />
                            <span>Info Artikel</span>
                        </h2>
                    </div>
                    <div class="article-form-card-body">

                        {{-- Judul --}}
                        <div class="article-form-group">
                            <label class="article-form-label flex items-center gap-1.5">
                                <x-icon name="type" size="14" />
                                <span>Judul</span> <span class="article-form-required">*</span>
                            </label>
                            <div id="titleEditor" class="quill-editor-title"></div>
                            <input type="hidden" name="title" id="titleInput">
                            @error('title') <p class="article-form-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="article-form-group">
                            <label class="article-form-label flex items-center gap-1.5">
                                <x-icon name="tag" size="14" />
                                <span>Kategori</span> <span class="article-form-required">*</span>
                            </label>
                            <select name="category_id" required class="article-form-input">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="article-form-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- Thumbnail dengan Preview --}}
                        <div class="article-form-group">
                            <x-image-upload name="thumbnail" label="Thumbnail" :required="true" />
                            <p class="article-form-hint" style="margin-top: 8px;">Format: JPG, PNG, WEBP, AVIF. Maks: 2MB.</p>
                        </div>

                        {{-- Ringkasan --}}
                        <div class="article-form-group">
                            <label class="article-form-label flex items-center gap-1.5">
                                <x-icon name="align-left" size="14" />
                                <span>Ringkasan (Excerpt)</span> <span class="article-form-required">*</span>
                            </label>
                            <div id="excerptEditor" class="quill-editor-excerpt"></div>
                            <input type="hidden" name="excerpt" id="excerptInput">
                            @error('excerpt') <p class="article-form-error">{{ $message }}</p> @enderror
                        </div>

                    </div>
                </div>

                {{-- Card: Publish --}}
                <div class="article-form-card">
                    <div class="article-form-card-header">
                        <h2 class="article-form-card-title">
                            <x-icon name="send" size="18" />
                            <span>Publish</span>
                        </h2>
                    </div>
                    <div class="article-form-card-body">
                        <label class="article-form-checkbox">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                            <span>Publish sekarang</span>
                        </label>
                        <p class="article-form-hint">Jika tidak dicentang, artikel disimpan sebagai <strong>Draft</strong>.</p>
                    </div>
                </div>

                {{-- Card: Aksi --}}
                <div class="article-form-card">
                    <div class="article-form-card-body article-form-actions">
                        <button type="submit" class="article-btn-primary">
                            <x-icon name="save" size="16" />
                            <span>Simpan</span>
                        </button>
                        <a href="{{ route('admin.articles.index') }}" class="article-btn-secondary">
                            Batal
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </form>

    {{-- SCRIPT QUILL --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Konfigurasi toolbar untuk KONTEN (lengkap)
            const contentToolbar = [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['blockquote', 'code-block'],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ];

            // Konfigurasi toolbar untuk JUDUL (minimal)
            const titleToolbar = [
                ['bold', 'italic', 'underline'],
                [{ 'align': [] }]
            ];

            // Konfigurasi toolbar untuk EXCERPT
            const excerptToolbar = [
                ['bold', 'italic', 'underline'],
                ['link']
            ];

            // Inisialisasi Quill untuk KONTEN
            const contentQuill = new Quill('#contentEditor', {
                theme: 'snow',
                placeholder: 'Tulis konten artikel di sini...',
                modules: { toolbar: contentToolbar }
            });

            // Inisialisasi Quill untuk JUDUL
            const titleQuill = new Quill('#titleEditor', {
                theme: 'snow',
                placeholder: 'Masukkan judul artikel...',
                modules: { toolbar: titleToolbar }
            });

            // Inisialisasi Quill untuk EXCERPT
            const excerptQuill = new Quill('#excerptEditor', {
                theme: 'snow',
                placeholder: 'Ringkasan singkat untuk card berita...',
                modules: { toolbar: excerptToolbar }
            });

            // Set nilai lama jika ada (untuk old input)
            @if(old('title'))
                titleQuill.root.innerHTML = `{!! old('title') !!}`;
            @endif
            @if(old('excerpt'))
                excerptQuill.root.innerHTML = `{!! old('excerpt') !!}`;
            @endif
            @if(old('content'))
                contentQuill.root.innerHTML = `{!! old('content') !!}`;
            @endif

            // Sync ke hidden input saat form disubmit
            document.getElementById('articleForm').addEventListener('submit', (e) => {
                document.getElementById('titleInput').value = titleQuill.root.innerHTML;
                document.getElementById('excerptInput').value = excerptQuill.root.innerHTML;
                document.getElementById('contentInput').value = contentQuill.root.innerHTML;

                // Validasi manual karena input hidden tidak trigger required
                if (!titleQuill.getText().trim()) {
                    e.preventDefault();
                    alert('Judul tidak boleh kosong!');
                    return false;
                }
                if (!excerptQuill.getText().trim()) {
                    e.preventDefault();
                    alert('Ringkasan tidak boleh kosong!');
                    return false;
                }
                if (!contentQuill.getText().trim()) {
                    e.preventDefault();
                    alert('Konten tidak boleh kosong!');
                    return false;
                }
            });
        });
    </script>
@endsection