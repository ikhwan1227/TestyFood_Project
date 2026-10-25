@extends('layouts.admin')

@section('title', 'Galeri')
@section('page_title', 'Galeri')

@section('searchbar')
    <x-admin-search
        :route="route('admin.galleries.index')"
        :value="request('q')"
        placeholder="Cari foto..." />
@endsection

@section('page_actions')
    <button type="button" class="admin-topbar-btn-primary" onclick="openGalleryModal()">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        <span>Tambah Foto</span>
    </button>
@endsection

@section('content')

    @if($errors->any())
        <div class="admin-alert admin-alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(request('q'))
        <div class="admin-search-info">
            Hasil pencarian untuk <strong>"{{ request('q') }}"</strong> · {{ $galleries->total() }} foto ditemukan
        </div>
    @endif

    {{-- Grid Galeri --}}
    <div class="bg-white rounded-lg shadow">
        <div class="gallery-grid">
            @forelse($galleries as $gallery)
                <div class="gallery-item">
                    <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title ?? 'Galeri' }}" class="gallery-item-img">
                    <div class="gallery-item-info">
                        @if($gallery->title)
                            <p class="gallery-item-title">{{ $gallery->title }}</p>
                        @endif
                        @if($gallery->category)
                            <span class="gallery-item-category">{{ $gallery->category }}</span>
                        @endif
                    </div>
                    <div class="gallery-item-overlay">
                        <div class="gallery-overlay-actions">
                            <button type="button"
                                    class="gallery-overlay-btn"
                                    onclick="openDetailModal({{ $gallery->id }}, '{{ addslashes($gallery->title ?? '') }}', '{{ $gallery->image_url }}', '{{ $gallery->category ?? '' }}', '{{ $gallery->created_at->format('d M Y') }}')"
                                    title="Lihat Detail">
                                <x-icon name="eye" :size="16" />
                                <span>Detail</span>
                            </button>

                            <button type="button"
                                    class="gallery-overlay-btn"
                                    onclick="openEditModal({{ $gallery->id }}, '{{ addslashes($gallery->title ?? '') }}', '{{ addslashes($gallery->category ?? '') }}')"
                                    title="Edit">
                                <x-icon name="edit" :size="16" />
                                <span>Edit</span>
                            </button>

                            <button type="button" 
                                    class="gallery-overlay-btn gallery-overlay-btn-danger" 
                                    onclick="openDeleteModal('{{ route('admin.galleries.destroy', $gallery) }}', 'foto {{ addslashes($gallery->title ?? 'ini') }}')"
                                    title="Hapus">
                                <x-icon name="trash" :size="16" />
                                <span>Hapus</span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="gallery-empty">
                    @if(request('q'))
                        Tidak ada foto dengan judul "<strong>{{ request('q') }}</strong>".
                    @else
                        Belum ada foto.
                    @endif
                </p>
            @endforelse
        </div>
        <div class="p-4">{{ $galleries->withQueryString()->links() }}</div>
    </div>

    {{-- MODAL: TAMBAH GALERI --}}
    <div id="galleryModal" class="gallery-modal">
        <div class="gallery-modal-content">
            <div class="gallery-modal-header">
                <h2 class="gallery-modal-title" id="modalTitle">Tambah Foto Galeri</h2>
                <button type="button" class="gallery-modal-close" onclick="closeGalleryModal()">×</button>
            </div>

            <div id="gallerySuccessView" class="gallery-success-view" style="display: none;">
                <div class="gallery-success-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="8 12 11 15 16 9"></polyline>
                    </svg>
                </div>
                <h3 class="gallery-success-title">Berhasil!</h3>
                <p class="gallery-success-message" id="gallerySuccessMessage">Foto berhasil ditambahkan.</p>
                <div class="gallery-success-loading">
                    <span class="gallery-success-dot"></span>
                    <span class="gallery-success-dot"></span>
                    <span class="gallery-success-dot"></span>
                </div>
                <p class="gallery-success-hint">Modal akan tertutup otomatis...</p>
            </div>

            <form id="galleryForm" method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="gallery-modal-body" id="galleryFormBody">
                    <div class="gallery-modal-group">
                        <label class="gallery-modal-label">Judul <span class="gallery-modal-optional">(Opsional)</span></label>
                        <input type="text" name="title" id="galleryTitle" placeholder="Contoh: Salad Buah Segar" class="gallery-modal-input">
                    </div>

                    <div class="gallery-modal-group">
                        <label class="gallery-modal-label">Kategori</label>
                        <select name="category" id="galleryCategory" class="gallery-modal-input">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="gallery-modal-group">
                        <x-image-upload name="image" label="Gambar" :required="true" />
                        <p class="gallery-modal-hint" style="margin-top: 8px;">Format: JPG, PNG, WEBP, AVIF. Maks: 2MB.</p>
                    </div>
                </div>

                <div class="gallery-modal-footer" id="galleryFormFooter">
                    <button type="button" class="gallery-btn-cancel" onclick="closeGalleryModal()">Batal</button>
                    <button type="submit" class="gallery-btn-save">💾 Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL: DETAIL GALERI --}}
    <div id="galleryDetailModal" class="gallery-modal">
        <div class="gallery-modal-content gallery-detail-content">
            <div class="gallery-modal-header">
                <h2 class="gallery-modal-title">Detail Foto</h2>
                <button type="button" class="gallery-modal-close" onclick="closeDetailModal()">×</button>
            </div>

            <div class="gallery-detail-body">
                <img id="detailImage" src="" alt="Detail" class="gallery-detail-img">

                <div class="gallery-detail-info">
                    <div class="gallery-detail-row">
                        <span class="gallery-detail-label">Judul</span>
                        <span class="gallery-detail-value" id="detailTitle">-</span>
                    </div>
                    <div class="gallery-detail-row">
                        <span class="gallery-detail-label">Kategori</span>
                        <span class="gallery-detail-value" id="detailCategory">-</span>
                    </div>
                    <div class="gallery-detail-row">
                        <span class="gallery-detail-label">Ukuran</span>
                        <span class="gallery-detail-value" id="detailDimension">-</span>
                    </div>
                    <div class="gallery-detail-row">
                        <span class="gallery-detail-label">Diunggah</span>
                        <span class="gallery-detail-value" id="detailDate">-</span>
                    </div>
                </div>
            </div>

            <div class="gallery-modal-footer">
                <button type="button" class="gallery-btn-cancel" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    {{-- MODAL: EDIT GALERI --}}
    <div id="galleryEditModal" class="gallery-modal">
        <div class="gallery-modal-content">
            <div class="gallery-modal-header">
                <h2 class="gallery-modal-title">Edit Foto Galeri</h2>
                <button type="button" class="gallery-modal-close" onclick="closeEditModal()">×</button>
            </div>
            <form id="galleryEditForm" method="POST">
                @csrf
                @method('PUT')
                <div class="gallery-modal-body">
                    <div class="gallery-modal-group">
                        <label class="gallery-modal-label">Judul</label>
                        <input type="text" name="title" id="editTitle" class="gallery-modal-input">
                    </div>
                    <div class="gallery-modal-group">
                        <label class="gallery-modal-label">Kategori</label>
                        <select name="category" id="editCategory" class="gallery-modal-input">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="gallery-modal-footer">
                    <button type="button" class="gallery-btn-cancel" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="gallery-btn-save">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const galleryModal = document.getElementById('galleryModal');
        const galleryForm = document.getElementById('galleryForm');
        const modalTitle = document.getElementById('modalTitle');
        const gallerySuccessView = document.getElementById('gallerySuccessView');
        const gallerySuccessMessage = document.getElementById('gallerySuccessMessage');
        const galleryFormBody = document.getElementById('galleryFormBody');
        const galleryFormFooter = document.getElementById('galleryFormFooter');

        function openGalleryModal() {
            galleryForm.reset();
            modalTitle.textContent = 'Tambah Foto Galeri';
            gallerySuccessView.style.display = 'none';
            galleryFormBody.style.display = 'block';
            galleryFormFooter.style.display = 'flex';
            const uploadComponent = document.querySelector('#galleryModal [x-data]');
            if (uploadComponent) {
                Alpine.$data(uploadComponent).reset();
            }
            galleryModal.classList.add('show');
        }

        function closeGalleryModal() {
            galleryModal.classList.remove('show');
        }

        function showSuccessInModal(message) {
            modalTitle.textContent = 'Sukses';
            galleryFormBody.style.display = 'none';
            galleryFormFooter.style.display = 'none';
            gallerySuccessView.style.display = 'block';
            gallerySuccessMessage.textContent = message;
            galleryModal.classList.add('show');
            setTimeout(() => closeGalleryModal(), 2500);
        }

        galleryModal.addEventListener('click', e => {
            if (e.target === galleryModal) closeGalleryModal();
        });

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape' && galleryModal.classList.contains('show')) closeGalleryModal();
        });

        @if($errors->any())
            openGalleryModal();
        @endif

        @if(session('gallery_success'))
            (function() {
                showSuccessInModal('{{ session('gallery_success') }}');
            })();
        @endif

        const updateUrlTemplate = "{{ route('admin.galleries.update', ':id') }}";

        function openDetailModal(id, title, image, category, date) {
            const img = document.getElementById('detailImage');
            img.src = image;
            document.getElementById('detailTitle').textContent = title || '-';
            document.getElementById('detailCategory').textContent = category || '-';
            document.getElementById('detailDate').textContent = date;
            
            // Setelah gambar dimuat, ambil ukurannya
            img.onload = function() {
                document.getElementById('detailDimension').textContent = img.naturalWidth + ' x ' + img.naturalHeight + ' px';
            };
            
            document.getElementById('galleryDetailModal').classList.add('show');
        }

        function closeDetailModal() {
            document.getElementById('galleryDetailModal').classList.remove('show');
        }

        document.getElementById('galleryDetailModal').addEventListener('click', function (e) {
            if (e.target === this) closeDetailModal();
        });

        document.getElementById('galleryDetailModal').addEventListener('click', function (e) {
            if (e.target === this) closeDetailModal();
        });

        // Fungsi Edit
        function openEditModal(id, title, category) {
            document.getElementById('galleryEditForm').action = updateUrlTemplate.replace(':id', id);
            document.getElementById('editTitle').value = title;
            document.getElementById('editCategory').value = category;
            document.getElementById('galleryEditModal').classList.add('show');
        }

        function closeEditModal() {
            document.getElementById('galleryEditModal').classList.remove('show');
        }

        document.getElementById('galleryEditModal').addEventListener('click', function(e) {
            if (e.target === this) closeEditModal();
        });

    </script>

@endsection