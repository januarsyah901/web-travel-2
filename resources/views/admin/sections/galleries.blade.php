<div id="galleries" class="content-section {{ $section == 'galleries' ? '' : 'hidden' }} space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Galeri Foto</h2>
            <p class="text-gray-500 mt-1">Kelola dokumentasi kegiatan dan momen umroh.</p>
        </div>
        <button onclick="openCreateGalleryModal()" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 ease-in-out transform hover:-translate-y-0.5">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <i class="fas fa-camera text-blue-300 group-hover:text-white transition-colors"></i>
            </span>
            <span class="ml-4">Tambah Foto Baru</span>
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full whitespace-nowrap">
                <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4">Preview</th>
                    <th class="px-6 py-4">Judul & Deskripsi</th>
                    <th class="px-6 py-4">Tanggal Upload</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($galleries as $gallery)
                    <tr class="hover:bg-gray-50/80 transition-colors duration-150 group">
                        <td class="px-6 py-4 w-32">
                            <div class="relative w-24 h-16 rounded-lg overflow-hidden border border-gray-200 shadow-sm group-hover:shadow-md transition-all">
                                @if($gallery->image_path)
                                    <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="max-w-md whitespace-normal">
                                <div class="text-sm font-bold text-gray-900 mb-1">{{ $gallery->title }}</div>
                                <p class="text-xs text-gray-500 leading-relaxed">{{ Str::limit($gallery->description, 80) }}</p>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                {{ $gallery->created_at->format('d M Y') }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-3">
                                <button onclick="openEditGalleryModal({{ $gallery->id }}, '{{ addslashes($gallery->title) }}', '{{ addslashes($gallery->description) }}', '{{ $gallery->image_path ? asset('storage/' . $gallery->image_path) : '' }}')"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </button>

                                <form method="POST" action="{{ route('galleries.destroy', $gallery->id) }}" class="inline-block" onsubmit="return handleDeleteGallery(event, '{{ addslashes($gallery->title) }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200" title="Hapus">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <div class="p-3 bg-gray-100 rounded-full">
                                    <i class="far fa-images text-gray-400 text-3xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Galeri masih kosong</p>
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
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity opacity-0" id="createGalleryBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg scale-95 opacity-0" id="createGalleryPanel">

                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-plus-circle bg-white/20 p-1.5 rounded-md"></i>
                        Upload Foto Baru
                    </h3>
                    <button onclick="closeCreateGalleryModal()" class="text-blue-100 hover:text-white transition-colors focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="createGalleryForm" method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">File Gambar <span class="text-red-500">*</span></label>
                        <div class="flex items-center justify-center w-full">
                            <label for="createImageInput" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors relative overflow-hidden group">
                                <img id="createImagePreview" class="absolute inset-0 w-full h-full object-cover hidden" />

                                <div id="createImagePlaceholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2 group-hover:text-blue-500 transition-colors"></i>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span></p>
                                    <p class="text-xs text-gray-500">PNG, JPG (MAX. 2MB)</p>
                                </div>
                                <input id="createImageInput" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'createImagePreview', 'createImagePlaceholder')" required />
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Foto <span class="text-red-500">*</span></label>
                        <input type="text" name="title" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5" placeholder="Contoh: Keberangkatan Kloter 1" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" rows="3" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 resize-none" placeholder="Keterangan foto..."></textarea>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeCreateGalleryModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editGalleryModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity opacity-0" id="editGalleryBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg scale-95 opacity-0" id="editGalleryPanel">

                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-edit bg-white/20 p-1.5 rounded-md"></i>
                        Edit Foto
                    </h3>
                    <button onclick="closeEditGalleryModal()" class="text-blue-100 hover:text-white transition-colors focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="editGalleryForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Ganti Gambar (Opsional)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="editImageInput" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors relative overflow-hidden group">
                                <img id="editImagePreview" class="absolute inset-0 w-full h-full object-cover" />

                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <p class="text-white text-sm font-medium"><i class="fas fa-camera mr-2"></i>Ganti Foto</p>
                                </div>

                                <input id="editImageInput" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'editImagePreview', null)" />
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Foto <span class="text-red-500">*</span></label>
                        <input type="text" id="editGalleryTitle" name="title" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="editGalleryDesc" name="description" rows="3" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 resize-none"></textarea>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeEditGalleryModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm">Update</button>
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
