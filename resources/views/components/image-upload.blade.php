@props(['name', 'id' => null, 'existingImage' => null, 'label' => '', 'required' => false])

<div class="image-upload-wrapper" x-data="imageUpload('{{ $existingImage }}')">
    
    {{-- Label (Opsional) --}}
    @if($label)
        <label class="settings-label" style="margin-bottom: 8px; display: block;">
            {{ $label }} 
            @if($required) <span class="article-form-required">*</span> @endif
        </label>
    @endif

    {{-- Input File Tersembunyi --}}
    <input type="file" 
           name="{{ $name }}" 
           id="{{ $id ?? $name }}" 
           class="hidden-file-input" 
           x-ref="fileInput" 
           @change="handleFileSelect" 
           accept="image/*"
           {{ $required ? 'required' : '' }}>

    {{-- Area Preview (Muncul jika ada gambar) --}}
    <div class="image-upload-preview" x-show="previewUrl" style="display: none;">
        <img :src="previewUrl" alt="Preview">
        <button type="button" class="btn-remove-image" @click="removeImage" title="Hapus Gambar">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    {{-- Area Drag & Drop (Muncul jika belum ada gambar) --}}
    <div class="image-upload-dropzone" 
         x-show="!previewUrl" 
         @dragover.prevent="dragover = true" 
         @dragleave.prevent="dragover = false" 
         @drop.prevent="handleDrop" 
         :class="{ 'dragover': dragover }" 
         @click="$refs.fileInput.click()">
        
        <div class="upload-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
        </div>
        
        <p class="upload-title">Drag & drop files here</p>
        <p class="upload-subtitle">atau klik untuk memilih file (JPG, PNG, WEBP, AVIF - maks 2MB)</p>
        
        <button type="button" class="btn-choose-file">Pilih File dari Komputer</button>
    </div>

    {{-- Error Message --}}
    @error($name)
        <p class="article-form-error" style="margin-top: 8px;">{{ $message }}</p>
    @enderror
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('imageUpload', (existingImage) => ({
            previewUrl: existingImage ? existingImage : null,
            dragover: false,
            
            handleDrop(e) {
                this.dragover = false;
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    this.$refs.fileInput.files = files;
                    this.handleFileSelect({ target: this.$refs.fileInput });
                }
            },
            
            handleFileSelect(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB.');
                        this.$refs.fileInput.value = '';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.previewUrl = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },
            
            removeImage() {
                this.previewUrl = null;
                this.$refs.fileInput.value = '';
            },

            reset() {
                this.previewUrl = null;
                this.$refs.fileInput.value = '';
                this.dragover = false;
            }
        }));
    });
</script>