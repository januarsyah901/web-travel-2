<div id="galleries" class="content-section {{ $section == 'galleries' ? '' : 'hidden' }}">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:20px;flex-wrap:wrap;">
        <div>
            <h1 style="font-size:20px;font-weight:600;color:var(--color-charcoal);margin:0 0 4px;">Galeri Foto</h1>
            <p style="font-size:14px;color:var(--color-fog);margin:0;">Kelola dokumentasi kegiatan dan momen umroh.</p>
        </div>
        <button onclick="openCreateGalleryModal()" class="dub-btn dub-btn-primary" style="gap:8px;">
            <i class="fas fa-camera" style="font-size:13px;"></i>
            Tambah Foto Baru
        </button>
    </div>

    <div class="dub-table-wrapper">
        <div style="overflow-x:auto;">
            <table class="dub-table" style="white-space:nowrap;">
                <thead>
                    <tr>
                        <th>Preview</th>
                        <th>Judul &amp; Deskripsi</th>
                        <th>Tanggal Upload</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($galleries as $gallery)
                    <tr>
                        <td style="width:100px;">
                            <div style="width:80px;height:52px;border-radius:var(--radius-buttons);overflow:hidden;border:1px solid var(--color-ash);flex-shrink:0;">
                                @if($gallery->image_path)
                                    <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}"
                                         style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <div style="width:100%;height:100%;background:var(--color-paper-mist);display:flex;align-items:center;justify-content:center;color:var(--color-silver);">
                                        <i class="fas fa-image" style="font-size:16px;"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td style="white-space:normal;max-width:300px;">
                            <p style="font-size:14px;font-weight:500;color:var(--color-charcoal);margin:0 0 4px;">{{ $gallery->title }}</p>
                            <p style="font-size:12px;color:var(--color-fog);margin:0;line-height:1.5;">{{ Str::limit($gallery->description, 80) }}</p>
                        </td>
                        <td>
                            <span class="dub-badge dub-badge-neutral">
                                {{ $gallery->created_at->format('d M Y') }}
                            </span>
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;justify-content:center;gap:4px;">
                                <button onclick="openEditGalleryModal({{ $gallery->id }}, '{{ e($gallery->title) }}', '{{ e($gallery->description) }}', '{{ $gallery->image_path ? asset('storage/' . $gallery->image_path) : '' }}')"
                                        class="dub-action-btn edit" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <form method="POST" action="{{ route('galleries.destroy', $gallery->id) }}" class="inline-block"
                                      onsubmit="return handleDeleteGallery(event, '{{ e($gallery->title) }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dub-action-btn delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="dub-empty">
                                <div class="dub-empty-icon"><i class="fas fa-images"></i></div>
                                <p>Galeri masih kosong</p>
                                <span>Tambahkan foto kegiatan umroh pertama Anda.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="createGalleryModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/25 backdrop-blur-xs transition-opacity opacity-0" id="createGalleryBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left border border-[var(--color-ash)] shadow-lg transition-all w-full max-w-md scale-95 opacity-0" id="createGalleryPanel">

                <div class="px-6 py-4 border-b border-[var(--color-ash)] flex justify-between items-center bg-white">
                    <h3 class="text-base font-semibold text-[var(--color-charcoal)] flex items-center gap-2">
                        <i class="fas fa-camera text-[var(--color-electric-blue)]"></i>
                        Upload Foto Baru
                    </h3>
                    <button onclick="closeCreateGalleryModal()" class="text-[var(--color-fog)] hover:text-[var(--color-charcoal)] transition-colors focus:outline-none">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form id="createGalleryForm" method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">File Gambar <span class="text-red-500">*</span></label>
                        <div class="flex items-center justify-center w-full">
                            <label for="createImageInput" class="flex flex-col items-center justify-center w-full h-36 border border-dashed border-[var(--color-ash)] rounded-xl cursor-pointer bg-[var(--color-paper-mist)] hover:bg-white hover:border-[var(--color-smoke)] transition-colors relative overflow-hidden group">
                                <img id="createImagePreview" class="absolute inset-0 w-full h-full object-cover hidden" />

                                <div id="createImagePlaceholder" class="flex flex-col items-center justify-center py-4">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-[var(--color-silver)] mb-1 group-hover:text-[var(--color-electric-blue)] transition-colors"></i>
                                    <p class="text-xs text-[var(--color-charcoal)] font-medium">Klik untuk upload gambar</p>
                                    <p class="text-[11px] text-[var(--color-fog)] mt-0.5">PNG, JPG (MAX. 2MB)</p>
                                </div>
                                <input id="createImageInput" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'createImagePreview', 'createImagePlaceholder')" required />
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Judul Foto <span class="text-red-500">*</span></label>
                        <input type="text" name="title" class="dub-input" placeholder="Contoh: Keberangkatan Kloter 1" required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Deskripsi</label>
                        <textarea name="description" rows="3" class="dub-input resize-none" placeholder="Keterangan foto..."></textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4 border-t border-[var(--color-ash)]">
                        <button type="button" onclick="closeCreateGalleryModal()" class="dub-btn dub-btn-outline">Batal</button>
                        <button type="submit" class="dub-btn dub-btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editGalleryModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/25 backdrop-blur-xs transition-opacity opacity-0" id="editGalleryBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left border border-[var(--color-ash)] shadow-lg transition-all w-full max-w-md scale-95 opacity-0" id="editGalleryPanel">

                <div class="px-6 py-4 border-b border-[var(--color-ash)] flex justify-between items-center bg-white">
                    <h3 class="text-base font-semibold text-[var(--color-charcoal)] flex items-center gap-2">
                        <i class="fas fa-edit text-[var(--color-electric-blue)]"></i>
                        Edit Foto
                    </h3>
                    <button onclick="closeEditGalleryModal()" class="text-[var(--color-fog)] hover:text-[var(--color-charcoal)] transition-colors focus:outline-none">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form id="editGalleryForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Ganti Gambar (Opsional)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="editImageInput" class="flex flex-col items-center justify-center w-full h-36 border border-dashed border-[var(--color-ash)] rounded-xl cursor-pointer bg-[var(--color-paper-mist)] hover:bg-white hover:border-[var(--color-smoke)] transition-colors relative overflow-hidden group">
                                <img id="editImagePreview" class="absolute inset-0 w-full h-full object-cover" />

                                <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <p class="text-white text-xs font-medium"><i class="fas fa-camera mr-1.5"></i>Ganti Foto</p>
                                </div>

                                <input id="editImageInput" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'editImagePreview', null)" />
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Judul Foto <span class="text-red-500">*</span></label>
                        <input type="text" id="editGalleryTitle" name="title" class="dub-input" required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Deskripsi</label>
                        <textarea id="editGalleryDesc" name="description" rows="3" class="dub-input resize-none"></textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4 border-t border-[var(--color-ash)]">
                        <button type="button" onclick="closeEditGalleryModal()" class="dub-btn dub-btn-outline">Batal</button>
                        <button type="submit" class="dub-btn dub-btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // --- Helper for Modal Animations ---
    function animateGalleryModal(modalId, backdropId, panelId, show) {
        const modal = document.getElementById(modalId);
        const backdrop = document.getElementById(backdropId);
        const panel = document.getElementById(panelId);

        if (show) {
            modal.classList.remove('hidden');
            requestAnimationFrame(() => {
                backdrop.classList.remove('opacity-0');
                panel.classList.remove('opacity-0', 'scale-95');
                panel.classList.add('opacity-100', 'scale-100');
            });
        } else {
            backdrop.classList.add('opacity-0');
            panel.classList.remove('opacity-100', 'scale-100');
            panel.classList.add('opacity-0', 'scale-95');
            setTimeout(() => { modal.classList.add('hidden'); }, 300);
        }
    }

    // --- Image Preview Logic ---
    function previewImage(input, previewId, placeholderId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                preview.src = e.target.result;
                preview.classList.remove('hidden');

                if(placeholderId) {
                    document.getElementById(placeholderId).classList.add('hidden');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // --- Create Modal ---
    function openCreateGalleryModal() {
        document.getElementById('createGalleryForm').reset();
        // Reset preview
        document.getElementById('createImagePreview').classList.add('hidden');
        document.getElementById('createImagePlaceholder').classList.remove('hidden');
        animateGalleryModal('createGalleryModal', 'createGalleryBackdrop', 'createGalleryPanel', true);
    }

    function closeCreateGalleryModal() {
        animateGalleryModal('createGalleryModal', 'createGalleryBackdrop', 'createGalleryPanel', false);
    }

    // --- Edit Modal ---
    function openEditGalleryModal(id, title, description, imageUrl) {
        document.getElementById('editGalleryTitle').value = title;
        document.getElementById('editGalleryDesc').value = description;

        const preview = document.getElementById('editImagePreview');
        if (imageUrl) {
            preview.src = imageUrl;
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden'); // Should ideally handle no-image case
        }

        // Dynamic Action URL
        const baseUrl = '{{ url("galleries") }}';
        document.getElementById('editGalleryForm').action = `${baseUrl}/${id}`;

        animateGalleryModal('editGalleryModal', 'editGalleryBackdrop', 'editGalleryPanel', true);
    }

    function closeEditGalleryModal() {
        animateGalleryModal('editGalleryModal', 'editGalleryBackdrop', 'editGalleryPanel', false);
    }

    // Close on click outside
    window.addEventListener('click', function(e) {
        const createModal = document.getElementById('createGalleryModal');
        const editModal = document.getElementById('editGalleryModal');
        const createPanel = document.getElementById('createGalleryPanel');
        const editPanel = document.getElementById('editGalleryPanel');

        if (e.target === createModal || (createModal && createModal.contains(e.target) && !createPanel.contains(e.target))) {
            closeCreateGalleryModal();
        }
        if (e.target === editModal || (editModal && editModal.contains(e.target) && !editPanel.contains(e.target))) {
            closeEditGalleryModal();
        }
    });
</script>
