<div id="partners" class="content-section {{ $section == 'partners' ? '' : 'hidden' }} space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Data Partner</h2>
            <p class="text-gray-500 mt-1">Kelola daftar mitra kerja sama dan sponsorship.</p>
        </div>
        <button onclick="openCreatePartnerModal()" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 ease-in-out transform hover:-translate-y-0.5">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <i class="fas fa-handshake text-blue-300 group-hover:text-white transition-colors"></i>
            </span>
            <span class="ml-4">Tambah Partner</span>
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full whitespace-nowrap">
                <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4 text-center">Logo</th>
                    <th class="px-6 py-4">Nama Partner</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($partners as $partner)
                    <tr class="hover:bg-gray-50/80 transition-colors duration-150">
                        <td class="px-6 py-4">
                            <div class="flex justify-center h-12 w-24 mx-auto">
                                @if($partner->logo_path)
                                    <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="h-full w-full object-contain filter hover:brightness-110 transition-all">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-gray-100 rounded text-gray-400 text-xs">
                                        No Logo
                                    </div>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900">{{ $partner->name }}</div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-3">
                                <button onclick="openEditPartnerModal({{ $partner->id }}, '{{ addslashes($partner->name) }}', '{{ $partner->logo_path ? asset('storage/' . $partner->logo_path) : '' }}')"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </button>

                                <form method="POST" action="{{ route('partners.destroy', $partner->id) }}" class="inline-block" onsubmit="return handleDeletePartner(event, '{{ addslashes($partner->name) }}');">
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
                        <td colspan="3" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <div class="p-3 bg-gray-100 rounded-full">
                                    <i class="far fa-handshake text-gray-400 text-3xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Belum ada partner terdaftar</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="createPartnerModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity opacity-0" id="createPartnerBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md scale-95 opacity-0" id="createPartnerPanel">

                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-plus-circle bg-white/20 p-1.5 rounded-md"></i>
                        Tambah Partner
                    </h3>
                    <button onclick="closeCreatePartnerModal()" class="text-blue-100 hover:text-white transition-colors focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="createPartnerForm" method="POST" action="{{ route('partners.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Logo Partner</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="createPartnerLogo" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors relative overflow-hidden group">
                                <img id="createPartnerPreview" class="absolute inset-0 w-full h-full object-contain p-4 hidden" />
                                <div id="createPartnerPlaceholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2 group-hover:text-blue-500 transition-colors"></i>
                                    <p class="text-xs text-gray-500">Klik untuk upload logo</p>
                                </div>
                                <input id="createPartnerLogo" name="logo" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'createPartnerPreview', 'createPartnerPlaceholder')" />
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Partner</label>
                        <input type="text" name="name" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5" placeholder="Contoh: Garuda Indonesia" required>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeCreatePartnerModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editPartnerModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity opacity-0" id="editPartnerBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md scale-95 opacity-0" id="editPartnerPanel">

                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-edit bg-white/20 p-1.5 rounded-md"></i>
                        Edit Partner
                    </h3>
                    <button onclick="closeEditPartnerModal()" class="text-blue-100 hover:text-white transition-colors focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="editPartnerForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Logo (Klik untuk ganti)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="editPartnerLogoInput" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors relative overflow-hidden group">
                                <img id="editPartnerPreview" class="absolute inset-0 w-full h-full object-contain p-4" />
                                <div id="editPartnerPlaceholder" class="flex flex-col items-center justify-center pt-5 pb-6 hidden">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                    <p class="text-xs text-gray-500">Upload logo baru</p>
                                </div>
                                <input id="editPartnerLogoInput" name="logo" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'editPartnerPreview', 'editPartnerPlaceholder')" />
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Partner</label>
                        <input type="text" id="editPartnerName" name="name" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5" required>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeEditPartnerModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // --- Animation Helper ---
    function animatePartnerModal(modalId, backdropId, panelId, show) {
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
    function openCreatePartnerModal() {
        document.getElementById('createPartnerForm').reset();
        document.getElementById('createPartnerPreview').classList.add('hidden');
        document.getElementById('createPartnerPlaceholder').classList.remove('hidden');
        animatePartnerModal('createPartnerModal', 'createPartnerBackdrop', 'createPartnerPanel', true);
    }

    function closeCreatePartnerModal() {
        animatePartnerModal('createPartnerModal', 'createPartnerBackdrop', 'createPartnerPanel', false);
    }

    // --- Edit Modal Functions ---
    function openEditPartnerModal(id, name, logoUrl) {
        document.getElementById('editPartnerName').value = name;

        const preview = document.getElementById('editPartnerPreview');
        const placeholder = document.getElementById('editPartnerPlaceholder');

        if (logoUrl) {
            preview.src = logoUrl;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        } else {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }

        const baseUrl = '{{ url("partners") }}';
        document.getElementById('editPartnerForm').action = `${baseUrl}/${id}`;

        animatePartnerModal('editPartnerModal', 'editPartnerBackdrop', 'editPartnerPanel', true);
    }

    function closeEditPartnerModal() {
        animatePartnerModal('editPartnerModal', 'editPartnerBackdrop', 'editPartnerPanel', false);
    }

    // --- Close on Click Outside ---
    window.addEventListener('click', function(e) {
        const createModal = document.getElementById('createPartnerModal');
        const editModal = document.getElementById('editPartnerModal');
        const createPanel = document.getElementById('createPartnerPanel');
        const editPanel = document.getElementById('editPartnerPanel');

        if (e.target === createModal || (createModal && createModal.contains(e.target) && !createPanel.contains(e.target))) {
            closeCreatePartnerModal();
        }
        if (e.target === editModal || (editModal && editModal.contains(e.target) && !editPanel.contains(e.target))) {
            closeEditPartnerModal();
        }
    });
</script>
