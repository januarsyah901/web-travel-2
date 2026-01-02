<div id="mutawwifs" class="content-section {{ $section == 'mutawwifs' ? '' : 'hidden' }} space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Data Mutawwif</h2>
            <p class="text-gray-500 mt-1">Kelola data pembimbing ibadah (Ustadz/Mutawwif).</p>
        </div>
        <button onclick="openCreateMutawwifModal()" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 ease-in-out transform hover:-translate-y-0.5">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <i class="fas fa-user-plus text-blue-300 group-hover:text-white transition-colors"></i>
            </span>
            <span class="ml-4">Tambah Mutawwif</span>
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full whitespace-nowrap">
                <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4">Profil</th>
                    <th class="px-6 py-4">Nama Lengkap</th>
                    <th class="px-6 py-4">Spesialisasi</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($mutawwifs as $mutawwif)
                    <tr class="hover:bg-gray-50/80 transition-colors duration-150">
                        <td class="px-6 py-4 w-20">
                            <div class="relative w-12 h-12">
                                @if($mutawwif->photo_path)
                                    <img src="{{ asset('storage/' . $mutawwif->photo_path) }}" alt="{{ $mutawwif->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-gray-100 shadow-sm">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg border-2 border-white shadow-sm">
                                        {{ substr($mutawwif->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900">{{ $mutawwif->name }}</div>
                        </td>

                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600 max-w-xs truncate" title="{{ $mutawwif->specialization }}">
                                {{ $mutawwif->specialization ?? '-' }}
                            </p>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-3">
                                <button onclick="openEditMutawwifModal({{ $mutawwif->id }}, '{{ addslashes($mutawwif->name) }}', '{{ addslashes($mutawwif->specialization) }}', '{{ $mutawwif->photo_path ? asset('storage/' . $mutawwif->photo_path) : '' }}')"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </button>

                                <form method="POST" action="{{ route('mutawwifs.destroy', $mutawwif->id) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mutawwif ini?');">
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
                                    <i class="fas fa-user-slash text-gray-400 text-3xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Belum ada data mutawwif</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="createMutawwifModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity opacity-0" id="createMutawwifBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg scale-95 opacity-0" id="createMutawwifPanel">

                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-user-plus bg-white/20 p-1.5 rounded-md"></i>
                        Tambah Mutawwif Baru
                    </h3>
                    <button onclick="closeCreateMutawwifModal()" class="text-blue-100 hover:text-white transition-colors focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="createMutawwifForm" method="POST" action="{{ route('mutawwifs.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf

                    <div class="flex flex-col items-center justify-center space-y-3">
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-gray-100 shadow-md bg-gray-50 flex items-center justify-center">
                                <img id="createMutawwifPreview" src="" alt="Preview Foto Mutawwif" class="w-full h-full object-cover hidden" />
                                <i id="createMutawwifPlaceholder" class="fas fa-camera text-4xl text-gray-300"></i>
                            </div>
                            <label for="createMutawwifPhoto" class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full shadow-lg cursor-pointer hover:bg-blue-700 transition-colors transform hover:scale-110">
                                <i class="fas fa-pencil-alt text-xs"></i>
                            </label>
                            <input id="createMutawwifPhoto" name="photo" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'createMutawwifPreview', 'createMutawwifPlaceholder')" />
                        </div>
                        <span class="text-xs text-gray-500">Upload Foto Profil (Opsional)</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap<span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="fas fa-user"></i></span>
                            <input type="text" name="name" class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2.5" placeholder="Contoh: Ustadz Ahmad" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Spesialisasi</label>
                        <textarea name="specialization" rows="3" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 resize-none" placeholder="Contoh: Tour Leader..."></textarea>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeCreateMutawwifModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editMutawwifModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity opacity-0" id="editMutawwifBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg scale-95 opacity-0" id="editMutawwifPanel">

                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-user-edit bg-white/20 p-1.5 rounded-md"></i>
                        Edit Data Mutawwif
                    </h3>
                    <button onclick="closeEditMutawwifModal()" class="text-blue-100 hover:text-white transition-colors focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="editMutawwifForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col items-center justify-center space-y-3">
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-gray-100 shadow-md bg-gray-50 flex items-center justify-center">
                                <img id="editMutawwifPreview" src="" alt="Preview Edit Foto Mutawwif" class="w-full h-full object-cover hidden" />
                                <i id="editMutawwifPlaceholder" class="fas fa-user text-4xl text-gray-300"></i>
                            </div>
                            <label for="editMutawwifPhotoInput" class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full shadow-lg cursor-pointer hover:bg-blue-700 transition-colors transform hover:scale-110">
                                <i class="fas fa-camera text-xs"></i>
                            </label>
                            <input id="editMutawwifPhotoInput" name="photo" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'editMutawwifPreview', 'editMutawwifPlaceholder')" />
                        </div>
                        <span class="text-xs text-gray-500">Ganti Foto Profil</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="fas fa-user"></i></span>
                            <input type="text" id="editMutawwifName" name="name" class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2.5" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Spesialisasi</label>
                        <textarea id="editMutawwifSpecialization" name="specialization" rows="3" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 resize-none"></textarea>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeEditMutawwifModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // --- Helper for Modal Animations (Reused) ---
    function animateMutawwifModal(modalId, backdropId, panelId, show) {
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

    // --- Create Modal Functions ---
    function openCreateMutawwifModal() {
        document.getElementById('createMutawwifForm').reset();
        // Reset preview
        document.getElementById('createMutawwifPreview').classList.add('hidden');
        document.getElementById('createMutawwifPlaceholder').classList.remove('hidden');
        animateMutawwifModal('createMutawwifModal', 'createMutawwifBackdrop', 'createMutawwifPanel', true);
    }

    function closeCreateMutawwifModal() {
        animateMutawwifModal('createMutawwifModal', 'createMutawwifBackdrop', 'createMutawwifPanel', false);
    }

    // --- Edit Modal Functions ---
    function openEditMutawwifModal(id, name, specialization, photoUrl) {
        document.getElementById('editMutawwifName').value = name;
        document.getElementById('editMutawwifSpecialization').value = specialization;

        const preview = document.getElementById('editMutawwifPreview');
        const placeholder = document.getElementById('editMutawwifPlaceholder');

        if (photoUrl) {
            preview.src = photoUrl;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        } else {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }

        // Dynamic Action URL
        const baseUrl = '{{ url("mutawwifs") }}';
        document.getElementById('editMutawwifForm').action = `${baseUrl}/${id}`;

        animateMutawwifModal('editMutawwifModal', 'editMutawwifBackdrop', 'editMutawwifPanel', true);
    }

    function closeEditMutawwifModal() {
        animateMutawwifModal('editMutawwifModal', 'editMutawwifBackdrop', 'editMutawwifPanel', false);
    }

    // --- Close on Click Outside ---
    window.addEventListener('click', function(e) {
        const createModal = document.getElementById('createMutawwifModal');
        const editModal = document.getElementById('editMutawwifModal');
        const createPanel = document.getElementById('createMutawwifPanel');
        const editPanel = document.getElementById('editMutawwifPanel');

        if (e.target === createModal || (createModal && createModal.contains(e.target) && !createPanel.contains(e.target))) {
            closeCreateMutawwifModal();
        }
        if (e.target === editModal || (editModal && editModal.contains(e.target) && !editPanel.contains(e.target))) {
            closeEditMutawwifModal();
        }
    });
</script>
