@extends('layouts.admin-full')

@section('title', 'Edit Artikel')
@section('page_title', 'Edit Artikel')

@section('content')
    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" id="articleForm">
        @csrf
        @method('PUT')

        <div class="article-form-grid">

            <div class="article-form-left">
                <div class="article-form-card">
                    <div class="article-form-card-header">
                        <h2 class="article-form-card-title">
                            <x-icon name="edit" size="18" />
                            <span>Konten Lengkap</span>
                            <p class="article-form-hint">
                                <x-icon name="calendar" :size="12" style="display:inline; vertical-align:middle; margin-right:4px;" />
                                Dipublikasikan: {{ $article->published_at->format('d F Y, H:i') }}
                            </p>
                        </h2>
                    </div>
                    <div class="article-form-card-body">
                        <div id="contentEditor" class="quill-editor-content"></div>
                        <input type="hidden" name="content" id="contentInput">
                        @error('content') <p class="article-form-error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="article-form-right">
                <div class="article-form-card">
                    <div class="article-form-card-header">
                        <h2 class="article-form-card-title">
                            <x-icon name="info" size="18" />
                            <span>Info Artikel</span>
                        </h2>
                    </div>
                    <div class="article-form-card-body">

                        <div class="article-form-group">
                            <label class="article-form-label flex items-center gap-1.5">
                                <x-icon name="type" size="14" />
                                <span>Judul</span> <span class="article-form-required">*</span>
                            </label>
                            <div id="titleEditor" class="quill-editor-title"></div>
                            <input type="hidden" name="title" id="titleInput">
                            @error('title') <p class="article-form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="article-form-group">
                            <label class="article-form-label flex items-center gap-1.5">
                                <x-icon name="tag" size="14" />
                                <span>Kategori</span> <span class="article-form-required">*</span>
                            </label>
                            <select name="category_id" required class="article-form-input">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="article-form-group">
                            <x-image-upload name="thumbnail" label="Thumbnail Saat Ini" :existingImage="$article->thumbnail_url" />
                            <p class="article-form-hint" style="margin-top: 8px;">Biarkan kosong jika tidak ingin mengganti.</p>
                        </div>

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

                <div class="article-form-card">
                    <div class="article-form-card-header">
                        <h2 class="article-form-card-title">
                            <x-icon name="send" size="18" />
                            <span>Publish</span>
                        </h2>
                    </div>
                    <div class="article-form-card-body">
                        <label class="article-form-checkbox">
                            <input type="checkbox" name="is_published" value="1" {{ $article->is_published ? 'checked' : '' }}>
                            <span>Publish artikel ini</span>
                        </label>
                    </div>
                </div>

                <div class="article-form-card">
                    <div class="article-form-card-body article-form-actions">
                        <button type="submit" class="article-btn-primary">
                            <x-icon name="save" size="16" />
                            <span>Update</span>
                        </button>
                        <a href="{{ route('admin.articles.index') }}" class="article-btn-secondary">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const contentToolbar = [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['blockquote', 'code-block'],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ];

            const titleToolbar = [['bold', 'italic', 'underline'], [{ 'align': [] }]];
            const excerptToolbar = [['bold', 'italic', 'underline'], ['link']];

            const contentQuill = new Quill('#contentEditor', {
                theme: 'snow', placeholder: 'Tulis konten artikel...', modules: { toolbar: contentToolbar }
            });
            const titleQuill = new Quill('#titleEditor', {
                theme: 'snow', placeholder: 'Judul artikel...', modules: { toolbar: titleToolbar }
            });
            const excerptQuill = new Quill('#excerptEditor', {
                theme: 'snow', placeholder: 'Ringkasan...', modules: { toolbar: excerptToolbar }
            });

            // Set nilai awal dari database
            titleQuill.root.innerHTML = `{!! old('title', $article->title) !!}`;
            excerptQuill.root.innerHTML = `{!! old('excerpt', $article->excerpt) !!}`;
            contentQuill.root.innerHTML = `{!! old('content', $article->content) !!}`;

            // Sync ke hidden input
            document.getElementById('articleForm').addEventListener('submit', (e) => {
                document.getElementById('titleInput').value = titleQuill.root.innerHTML;
                document.getElementById('excerptInput').value = excerptQuill.root.innerHTML;
                document.getElementById('contentInput').value = contentQuill.root.innerHTML;

                if (!titleQuill.getText().trim()) {
                    e.preventDefault(); alert('Judul tidak boleh kosong!'); return false;
                }
                if (!excerptQuill.getText().trim()) {
                    e.preventDefault(); alert('Ringkasan tidak boleh kosong!'); return false;
                }
                if (!contentQuill.getText().trim()) {
                    e.preventDefault(); alert('Konten tidak boleh kosong!'); return false;
                }
            });
        });
    </script>
@endsection