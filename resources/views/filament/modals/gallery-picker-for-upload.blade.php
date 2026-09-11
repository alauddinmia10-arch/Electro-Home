<div
    x-data="{
        selected: [],
        allMedia: {{ json_encode($media, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) }},
        searchQuery: '',
        get filteredMedia() {
            if (!this.searchQuery) return this.allMedia;
            const q = this.searchQuery.toLowerCase();
            return this.allMedia.filter(m => (m.title || m.name || '').toLowerCase().includes(q));
        },
        toggleSelect(media) {
            const idx = this.selected.findIndex(s => s.id === media.id);
            if (idx > -1) {
                this.selected.splice(idx, 1);
            } else {
                this.selected.push(media);
            }
        },
        isSelected(id) {
            return this.selected.some(s => s.id === id);
        },
        addToGallery() {
            if (this.selected.length === 0) return;
            // Dispatch event for the Livewire component to handle
            const paths = this.selected.map(m => m.path);
            $wire.mountAction('addGalleryFromPicker', { paths: paths });
        }
    }"
    style="max-height: 75vh; overflow: hidden; display: flex; flex-direction: column; padding: 16px;"
>
    <style>
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
        }
        @media (max-width: 1024px) {
            .gallery-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
    </style>
    {{-- Top bar --}}
    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px; flex-shrink: 0;">
        <div style="flex: 1;">
            <input 
                type="text" 
                x-model="searchQuery" 
                placeholder="Search images..." 
                style="width: 100%; padding: 10px 16px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; outline: none;"
                onfocus="this.style.borderColor='#3b82f6'" 
                onblur="this.style.borderColor='#d1d5db'"
            />
        </div>
        <div style="display: flex; align-items: center; gap: 8px; flex-shrink: 0;">
            <span 
                x-show="selected.length > 0" 
                x-text="selected.length + ' selected'" 
                style="font-size: 13px; color: #6b7280;"
                x-cloak
            ></span>
            <button 
                type="button"
                x-on:click="addToGallery()" 
                x-bind:disabled="selected.length === 0"
                style="padding: 10px 24px; border-radius: 8px; font-weight: 600; font-size: 14px; border: none; cursor: pointer; transition: all 0.2s;"
                x-bind:style="selected.length > 0 
                    ? 'background: linear-gradient(135deg, #10b981, #059669); color: white; box-shadow: 0 2px 8px rgba(16,185,129,0.3);' 
                    : 'background: #e5e7eb; color: #9ca3af; cursor: not-allowed;'"
            >
                ✓ Add to Gallery Images
            </button>
        </div>
    </div>

    {{-- Grid --}}
    <div style="flex: 1; overflow-y: auto; border-radius: 8px;">
        <div class="gallery-grid">
            <template x-for="media in filteredMedia" :key="media.id">
                <div 
                    x-on:click="toggleSelect(media)"
                    style="position: relative; aspect-ratio: 1; border-radius: 8px; overflow: hidden; cursor: pointer; transition: all 0.2s; border: 3px solid transparent;"
                    x-bind:style="isSelected(media.id) 
                        ? 'border-color: #10b981; box-shadow: 0 0 0 2px rgba(16,185,129,0.3); transform: scale(0.95);' 
                        : 'border-color: #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.1);'"
                >
                    <img 
                        x-bind:src="media.url" 
                        x-bind:alt="media.title || media.name"
                        style="width: 100%; height: 100%; object-fit: cover; background: #f3f4f6;"
                        loading="lazy"
                    />
                    <div 
                        x-show="isSelected(media.id)" 
                        x-cloak
                        style="position: absolute; inset: 0; background: rgba(16,185,129,0.25); display: flex; align-items: center; justify-content: center;"
                    >
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: #10b981; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                    </div>
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 4px 6px; background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                        <p x-text="(media.title || media.name || '').substring(0, 30)" style="color: white; font-size: 10px; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"></p>
                    </div>
                </div>
            </template>
        </div>
        <div x-show="filteredMedia.length === 0" style="text-align: center; padding: 60px 20px; color: #9ca3af;">
            <p style="margin: 0; font-size: 14px;">No images found</p>
        </div>
    </div>

    {{-- Bottom --}}
    <div style="flex-shrink: 0; padding-top: 8px; border-top: 1px solid #e5e7eb; margin-top: 8px;">
        <p style="margin: 0; font-size: 12px; color: #9ca3af;">
            Total: <span x-text="allMedia.length"></span> images &bull; <span x-text="selected.length"></span> selected
        </p>
    </div>
</div>
