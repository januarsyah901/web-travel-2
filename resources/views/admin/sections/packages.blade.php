<div id="packages" class="content-section {{ $section == 'packages' ? '' : 'hidden' }} space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Manajemen Paket Umroh</h2>
            <p class="text-gray-500 mt-1">Kelola daftar paket perjalanan ibadah yang tersedia.</p>
        </div>
        <button onclick="openCreateModal()" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 ease-in-out transform hover:-translate-y-0.5">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <i class="fas fa-plus text-blue-300 group-hover:text-white transition-colors"></i>
            </span>
            <span class="ml-4">Tambah Paket Baru</span>
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full whitespace-nowrap">
                <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Nama Paket</th>
                    <th class="px-6 py-4">Durasi / Jadwal</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4">Deskripsi Singkat</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($packages as $package)
                    <tr class="hover:bg-gray-50/80 transition-colors duration-150">
                        <td class="px-6 py-4 text-sm text-gray-500 font-mono">#{{ $package->id }}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $package->title }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col space-y-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 w-fit">
                                    {{ $package->duration }} Hari
                                </span>
                                <span class="text-xs text-gray-500 flex items-center gap-1">
                                    <i class="far fa-calendar-alt"></i> {{ $package->schedule }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 font-semibold">
                            Rp {{ number_format($package->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                             <span class="text-sm text-gray-500 block max-w-xs truncate" title="{{ $package->description }}">
                                {{ Str::limit($package->description, 50) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-3">
                                <button onclick="openEditModal({{ $package->id }}, '{{ addslashes($package->title) }}', '{{ addslashes($package->schedule) }}', '{{ addslashes($package->duration) }}', {{ $package->price }}, '{{ addslashes($package->description) }}')"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </button>
                                <form method="POST" action="{{ route('packages.destroy', $package->id) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini? Data yang dihapus tidak dapat dikembalikan.');">
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
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <div class="p-3 bg-gray-100 rounded-full">
                                    <i class="fas fa-box-open text-gray-400 text-3xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Belum ada data paket tersedia</p>
                                <button onclick="openCreateModal()" class="text-blue-600 hover:text-blue-700 text-sm font-medium hover:underline">
                                    Tambah paket pertama Anda
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{-- <div class="px-6 py-4 border-t border-gray-200">
            {{ $packages->links() }}
        </div> --}}
    </div>
</div>

<div id="editModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity opacity-0" id="editBackdrop"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg scale-95 opacity-0" id="editPanel">

                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2" id="modal-title">
                        <i class="fas fa-edit bg-white/20 p-1.5 rounded-md"></i>
                        Edit Paket Perjalanan
                    </h3>
                    <button onclick="closeEditModal()" class="text-blue-100 hover:text-white transition-colors focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="editForm" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">

                    <div class="space-y-4">
                        <div>
                            <label for="editTitle" class="block text-sm font-medium text-gray-700 mb-1">Nama Paket</label>
                            <input type="text" id="editTitle" name="title" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 transition-shadow" placeholder="Contoh: Paket Umroh Hemat 9 Hari" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="editSchedule" class="block text-sm font-medium text-gray-700 mb-1">Jadwal Keberangkatan</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="far fa-calendar"></i>
                                    </span>
                                    <input type="text" id="editSchedule" name="schedule" class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2.5" placeholder="YYYY-MM-DD" required>
                                </div>
                            </div>
                            <div>
                                <label for="editDuration" class="block text-sm font-medium text-gray-700 mb-1">Durasi (Hari)</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="far fa-clock"></i>
                                    </span>
                                    <input type="text" id="editDuration" name="duration" class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2.5" placeholder="Contoh: 9 Hari" required>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="editPrice" class="block text-sm font-medium text-gray-700 mb-1">Harga Paket (Rp)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 font-bold">Rp</span>
                                <input type="number" id="editPrice" name="price" class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2.5 font-mono" placeholder="0" required>
                            </div>
                        </div>

                        <div>
                            <label for="editDescription" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap</label>
                            <textarea id="editDescription" name="description" rows="3" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 resize-none" placeholder="Jelaskan fasilitas dan detail paket..."></textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-all hover:shadow-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="createModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity opacity-0" id="createBackdrop"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg scale-95 opacity-0" id="createPanel">

                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-plus-circle bg-white/20 p-1.5 rounded-md"></i>
                        Tambah Paket Baru
                    </h3>
                    <button onclick="closeCreateModal()" class="text-green-100 hover:text-white transition-colors focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="createForm" method="POST" action="{{ route('packages.store') }}" class="p-6 space-y-5">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label for="createTitle" class="block text-sm font-medium text-gray-700 mb-1">Nama Paket</label>
                            <input type="text" id="createTitle" name="title" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm px-4 py-2.5 transition-shadow" placeholder="Contoh: Paket Umroh VIP Ramadhan" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="createSchedule" class="block text-sm font-medium text-gray-700 mb-1">Jadwal Keberangkatan</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="far fa-calendar"></i>
                                    </span>
                                    <input type="text" id="createSchedule" name="schedule" class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm py-2.5" placeholder="YYYY-MM-DD" required>
                                </div>
                            </div>
                            <div>
                                <label for="createDuration" class="block text-sm font-medium text-gray-700 mb-1">Durasi (Hari)</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="far fa-clock"></i>
                                    </span>
                                    <input type="text" id="createDuration" name="duration" class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm py-2.5" placeholder="Contoh: 12 Hari" required>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="createPrice" class="block text-sm font-medium text-gray-700 mb-1">Harga Paket (Rp)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 font-bold">Rp</span>
                                <input type="number" id="createPrice" name="price" class="block w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm py-2.5 font-mono" placeholder="0" required>
                            </div>
                        </div>

                        <div>
                            <label for="createDescription" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap</label>
                            <textarea id="createDescription" name="description" rows="3" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm px-4 py-2.5 resize-none" placeholder="Jelaskan fasilitas hotel, maskapai, dan itinerary..."></textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeCreateModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-sm transition-all hover:shadow-md">
                            Simpan Paket Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // --- Helper for Modal Animations ---
    function animateModal(modalId, backdropId, panelId, show) {
        const modal = document.getElementById(modalId);
        const backdrop = document.getElementById(backdropId);
        const panel = document.getElementById(panelId);

        if (show) {
            modal.classList.remove('hidden');
            // Allow browser to render 'block' before starting opacity transition
            requestAnimationFrame(() => {
                backdrop.classList.remove('opacity-0');
                panel.classList.remove('opacity-0', 'scale-95');
                panel.classList.add('opacity-100', 'scale-100');
            });
        } else {
            backdrop.classList.add('opacity-0');
            panel.classList.remove('opacity-100', 'scale-100');
            panel.classList.add('opacity-0', 'scale-95');

            // Wait for transition to finish before hiding
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Matches transition duration
        }
    }

    // --- Edit Modal Functions ---
    function openEditModal(id, title, schedule, duration, price, description) {
        document.getElementById('editId').value = id;
        document.getElementById('editTitle').value = title;
        document.getElementById('editSchedule').value = schedule;
        document.getElementById('editDuration').value = duration;
        document.getElementById('editPrice').value = price;
        document.getElementById('editDescription').value = description;

        // Update Action URL dynamically
        const baseUrl = '{{ url("packages") }}';
        document.getElementById('editForm').action = `${baseUrl}/${id}`;

        animateModal('editModal', 'editBackdrop', 'editPanel', true);
    }

    function closeEditModal() {
        animateModal('editModal', 'editBackdrop', 'editPanel', false);
    }

    // --- Create Modal Functions ---
    function openCreateModal() {
        // Reset form (optional but good practice)
        document.getElementById('createForm').reset();
        animateModal('createModal', 'createBackdrop', 'createPanel', true);
    }

    function closeCreateModal() {
        animateModal('createModal', 'createBackdrop', 'createPanel', false);
    }

    // --- Close on Outside Click ---
    window.addEventListener('click', function(e) {
        const editModal = document.getElementById('editModal');
        const createModal = document.getElementById('createModal');
        const editPanel = document.getElementById('editPanel');
        const createPanel = document.getElementById('createPanel');

        // Check if click is outside the panel but inside the modal wrapper
        // Note: The structure puts the click on the flex container wrapper, not the modal div itself directly usually.
        // A safer way is checking if the target is the backdrop or wrapper

        // Simplified approach for this structure:
        // The modal wrapper has padding, clicking that padding triggers this.
        if (e.target === editModal || (editModal && editModal.contains(e.target) && !editPanel.contains(e.target))) {
            closeEditModal();
        }
        if (e.target === createModal || (createModal && createModal.contains(e.target) && !createPanel.contains(e.target))) {
            closeCreateModal();
        }
    });
</script>

<style>
    /* Custom Scrollbar for Table Wrapper */
    .custom-scrollbar::-webkit-scrollbar {
        height: 8px;
        width: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
