@extends('layouts.admin')

@section('title', 'Kategori')
@section('page_title', 'Kategori')

@section('page_actions')
    <button type="button" class="admin-topbar-btn-primary" onclick="openCreateModal()">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        <span>Tambah</span>
    </button>
@endsection

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

    {{-- Tabel --}}
    <div class="bg-white rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="text-left p-4" style="width: 60px;">No</th>
                        <th class="text-left p-4">Nama</th>
                        <th class="text-left p-4">Slug</th>
                        <th class="text-left p-4">Jumlah Artikel</th>
                        <th class="text-right p-4" style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">{{ $categories->firstItem() + $index }}</td>
                            <td class="p-4 font-medium">{{ $category->name }}</td>
                            <td class="p-4 text-gray-500" style="font-family: monospace;">{{ $category->slug }}</td>
                            <td class="p-4">
                                <span class="category-badge-count">{{ $category->articles_count }}</span>
                            </td>
                            <td class="p-4">
                                <div class="action-buttons">
                                    <button type="button"
                                            class="action-btn action-btn-edit"
                                            onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->name) }}')"
                                            title="Edit">
                                        <x-icon name="edit" :size="14" />
                                    </button>
                                    <form action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST" style="display: inline;"
                                        onsubmit="return confirm('Yakin hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                class="action-btn action-btn-delete" 
                                                onclick="openDeleteModal('{{ route('admin.categories.destroy', $category) }}', 'kategori {{ addslashes($category->name) }}')"
                                                title="Hapus">
                                            <x-icon name="trash" :size="14" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4">{{ $categories->links() }}</div>
    </div>

    {{-- MODAL --}}
    <div id="categoryModal" class="category-modal">
        <div class="category-modal-content">
            <div class="category-modal-header">
                <h2 id="categoryModalTitle" class="category-modal-title">Tambah Kategori</h2>
                <button type="button" class="category-modal-close" onclick="closeCategoryModal()">×</button>
            </div>

            <form id="categoryForm" method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <input type="hidden" name="_method" id="categoryMethod" value="POST">
                <div class="category-modal-body">
                    <label class="category-modal-label">Nama Kategori <span style="color:#dc2626;">*</span></label>
                    <input type="text" name="name" id="categoryName" required
                           placeholder="Contoh: Makanan Khas Nusantara" class="category-modal-input">
                    <p class="category-modal-hint">Slug akan dibuat otomatis dari nama kategori.</p>
                </div>
                <div class="category-modal-footer">
                    <button type="button" class="category-btn-cancel" onclick="closeCategoryModal()">Batal</button>
                    <button type="submit" class="category-btn-save" id="categorySubmitBtn">💾 Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const categoryModal = document.getElementById('categoryModal');
        const categoryForm = document.getElementById('categoryForm');
        const categoryModalTitle = document.getElementById('categoryModalTitle');
        const categoryName = document.getElementById('categoryName');
        const categoryMethod = document.getElementById('categoryMethod');
        const categorySubmitBtn = document.getElementById('categorySubmitBtn');
        const storeUrl = "{{ route('admin.categories.store') }}";
        const updateUrlTemplate = "{{ route('admin.categories.update', ':id') }}";

        function openCreateModal() {
            categoryModalTitle.textContent = 'Tambah Kategori';
            categoryForm.action = storeUrl;
            categoryMethod.value = 'POST';
            categoryName.value = '';
            categorySubmitBtn.textContent = '💾 Simpan';
            categoryModal.classList.add('show');
            setTimeout(() => categoryName.focus(), 100);
        }

        function openEditModal(id, name) {
            categoryModalTitle.textContent = 'Edit Kategori';
            categoryForm.action = updateUrlTemplate.replace(':id', id);
            categoryMethod.value = 'PUT';
            categoryName.value = name;
            categorySubmitBtn.textContent = '💾 Update';
            categoryModal.classList.add('show');
            setTimeout(() => categoryName.focus(), 100);
        }

        function closeCategoryModal() {
            categoryModal.classList.remove('show');
        }

        categoryModal.addEventListener('click', function (e) {
            if (e.target === categoryModal) closeCategoryModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && categoryModal.classList.contains('show')) closeCategoryModal();
        });

        @if($errors->any())
            @if(old('_method') !== 'PUT')
                openCreateModal();
                categoryName.value = "{{ old('name') }}";
            @endif
        @endif
    </script>

@endsection