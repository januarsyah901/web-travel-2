<div id="packages" class="content-section {{ $section == 'packages' ? '' : 'hidden' }}">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Packages</h2>
        <button onclick="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Paket
        </button>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Paket</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($packages as $package)
                    <tr>
                        <td class="px-6 py-4">{{ $package->id }}</td>
                        <td class="px-6 py-4">{{ $package->title }}</td>
                        <td class="px-6 py-4">{{ $package->duration }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $package->description }}</td>
                        <td class="px-6 py-4">
                            <a href="#" onclick="openEditModal({{ $package->id }}, '{{ addslashes($package->title) }}', '{{ addslashes($package->schedule) }}', '{{ addslashes($package->duration) }}', {{ $package->price }}, '{{ addslashes($package->description) }}')" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('packages.destroy', $package->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data paket</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 transition-opacity duration-300 ease-out">
    <div class="relative top-20 mx-auto p-6 border shadow-2xl rounded-xl bg-white max-w-lg transform transition-all duration-300 ease-out scale-95 opacity-0" id="modalContent">
        <!-- Close Button -->
        <button onclick="closeEditModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors duration-200">
            <i class="fas fa-times text-xl"></i>
        </button>

        <div class="mt-3">
            <h3 class="text-2xl font-bold bg-gradient-to-r bg-blue-600 bg-clip-text text-transparent mb-6 flex items-center">
                <i class="fas fa-edit mr-3 text-blue-600"></i>
                Edit Package
            </h3>
            <form id="editForm" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                <input type="hidden" id="editId" name="id">

                <div>
                    <label for="editTitle" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Paket
                    </label>
                    <input type="text" id="editTitle" name="title" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                </div>

                <div>
                    <label for="editSchedule" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jadwal
                    </label>
                    <input type="text" id="editSchedule" name="schedule" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200" required>
                </div>

                <div>
                    <label for="editDuration" class="block text-sm font-semibold text-gray-700 mb-2">
                        Durasi
                    </label>
                    <input type="text" id="editDuration" name="duration" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200" required>
                </div>

                <div>
                    <label for="editPrice" class="block text-sm font-semibold text-gray-700 mb-2">
                        Harga
                    </label>
                    <input type="number" id="editPrice" name="price" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200" required>
                </div>

                <div>
                    <label for="editDescription" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea id="editDescription" name="description" rows="4" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 resize-none"></textarea>
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeEditModal()" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-all duration-200 shadow-lg">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r bg-blue-600 text-white rounded-lg font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 transition-opacity duration-300 ease-out">
    <div class="relative top-20 mx-auto p-6 border shadow-2xl rounded-xl bg-white max-w-lg transform transition-all duration-300 ease-out scale-95 opacity-0" id="createModalContent">
        <!-- Close Button -->
        <button onclick="closeCreateModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors duration-200">
            <i class="fas fa-times text-xl"></i>
        </button>

        <div class="mt-3">
            <h3 class="text-2xl font-bold bg-gradient-to-r bg-blue-600 bg-clip-text text-transparent mb-6 flex items-center">
                <i class="fas fa-plus mr-3 text-blue-600"></i>
                Tambah Paket Baru
            </h3>
            <form id="createForm" method="POST" action="{{ route('packages.store') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="createTitle" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Paket
                    </label>
                    <input type="text" id="createTitle" name="title" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                </div>

                <div>
                    <label for="createSchedule" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jadwal
                    </label>
                    <input type="text" id="createSchedule" name="schedule" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200" required>
                </div>

                <div>
                    <label for="createDuration" class="block text-sm font-semibold text-gray-700 mb-2">
                        Durasi
                    </label>
                    <input type="text" id="createDuration" name="duration" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200" required>
                </div>

                <div>
                    <label for="createPrice" class="block text-sm font-semibold text-gray-700 mb-2">
                        Harga
                    </label>
                    <input type="number" id="createPrice" name="price" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200" required>
                </div>

                <div>
                    <label for="createDescription" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea id="createDescription" name="description" rows="4" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 resize-none"></textarea>
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeCreateModal()" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-all duration-200 shadow-lg">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r bg-blue-600 text-white rounded-lg font-medium hover:from-green-700 hover:to-teal-700 transition-all duration-200 shadow-lg transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Paket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditModal(id, title, schedule, duration, price, description) {
    document.getElementById('editId').value = id;
    document.getElementById('editTitle').value = title;
    document.getElementById('editSchedule').value = schedule;
    document.getElementById('editDuration').value = duration;
    document.getElementById('editPrice').value = price;
    document.getElementById('editDescription').value = description;
    document.getElementById('editForm').action = '{{ url("packages") }}/' + id;
    document.getElementById('editModal').classList.remove('hidden');
    // Trigger animation
    setTimeout(() => {
        document.getElementById('modalContent').classList.remove('scale-95', 'opacity-0');
        document.getElementById('modalContent').classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeEditModal() {
    document.getElementById('modalContent').classList.remove('scale-100', 'opacity-100');
    document.getElementById('modalContent').classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        document.getElementById('editModal').classList.add('hidden');
    }, 300);
}

function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
    // Trigger animation
    setTimeout(() => {
        document.getElementById('createModalContent').classList.remove('scale-95', 'opacity-0');
        document.getElementById('createModalContent').classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeCreateModal() {
    document.getElementById('createModalContent').classList.remove('scale-100', 'opacity-100');
    document.getElementById('createModalContent').classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        document.getElementById('createModal').classList.add('hidden');
    }, 300);
}

// Close modal when clicking outside
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});
document.getElementById('createModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCreateModal();
    }
});
</script>
