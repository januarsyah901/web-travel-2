<div id="bookings" class="content-section {{ $section == 'bookings' ? '' : 'hidden' }}">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Bookings</h2>
        <button onclick="openCreateBookingModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Booking
        </button>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paket</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($bookings as $booking)
                    <tr>
                        <td class="px-6 py-4">{{ $booking->id }}</td>
                        <td class="px-6 py-4">{{ $booking->user->fullName ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $booking->package->title ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $booking->registered_at ? $booking->registered_at->format('Y-m-d') : 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">{{ $booking->status }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" onclick="openEditBookingModal({{ $booking->id }}, {{ $booking->user_id }}, {{ $booking->package_id }}, '{{ $booking->status }}', '{{ $booking->registered_at ? $booking->registered_at->format('Y-m-d') : '' }}')" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data booking</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Booking Modal -->
<div id="createBookingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 transition-opacity duration-300 ease-out">
    <div class="relative top-20 mx-auto p-6 border shadow-2xl rounded-xl bg-white max-w-lg transform transition-all duration-300 ease-out scale-95 opacity-0" id="createBookingModalContent">
        <button onclick="closeCreateBookingModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors duration-200">
            <i class="fas fa-times text-xl"></i>
        </button>

        <div class="mt-3">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Tambah Booking Baru</h3>
            <form action="{{ route('bookings.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="create_user_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        User <span class="text-red-500">*</span>
                    </label>
                    <select name="user_id" id="create_user_id" required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->fullName }} ({{ $user->phone }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="create_package_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Paket <span class="text-red-500">*</span>
                    </label>
                    <select name="package_id" id="create_package_id" required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Paket</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->title }} - Rp {{ number_format($package->price, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="create_status" class="block text-sm font-semibold text-gray-700 mb-2">
                        Status
                    </label>
                    <select name="status" id="create_status"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

                <div>
                    <label for="create_registered_at" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal Registrasi
                    </label>
                    <input type="date" name="registered_at" id="create_registered_at"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeCreateBookingModal()" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-all duration-200 shadow-lg transform hover:scale-105">
                        Tambah Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Booking Modal -->
<div id="editBookingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 transition-opacity duration-300 ease-out">
    <div class="relative top-20 mx-auto p-6 border shadow-2xl rounded-xl bg-white max-w-lg transform transition-all duration-300 ease-out scale-95 opacity-0" id="editBookingModalContent">
        <button onclick="closeEditBookingModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors duration-200">
            <i class="fas fa-times text-xl"></i>
        </button>

        <div class="mt-3">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Edit Booking</h3>
            <form id="editBookingForm" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="edit_user_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        User <span class="text-red-500">*</span>
                    </label>
                    <select name="user_id" id="edit_user_id" required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->fullName }} ({{ $user->phone }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="edit_package_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Paket <span class="text-red-500">*</span>
                    </label>
                    <select name="package_id" id="edit_package_id" required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Paket</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->title }} - Rp {{ number_format($package->price, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="edit_status" class="block text-sm font-semibold text-gray-700 mb-2">
                        Status
                    </label>
                    <select name="status" id="edit_status"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

                <div>
                    <label for="edit_registered_at" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal Registrasi
                    </label>
                    <input type="date" name="registered_at" id="edit_registered_at"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeEditBookingModal()" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-all duration-200 shadow-lg transform hover:scale-105">
                        Update Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Create Booking Modal Functions
function openCreateBookingModal() {
    document.getElementById('createBookingModal').classList.remove('hidden');
    setTimeout(() => {
        document.getElementById('createBookingModalContent').classList.remove('scale-95', 'opacity-0');
        document.getElementById('createBookingModalContent').classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeCreateBookingModal() {
    document.getElementById('createBookingModalContent').classList.remove('scale-100', 'opacity-100');
    document.getElementById('createBookingModalContent').classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        document.getElementById('createBookingModal').classList.add('hidden');
    }, 300);
}

// Edit Booking Modal Functions
function openEditBookingModal(id, userId, packageId, status, registeredAt) {
    document.getElementById('edit_user_id').value = userId;
    document.getElementById('edit_package_id').value = packageId;
    document.getElementById('edit_status').value = status;
    document.getElementById('edit_registered_at').value = registeredAt;
    document.getElementById('editBookingForm').action = '{{ url("bookings") }}/' + id;
    document.getElementById('editBookingModal').classList.remove('hidden');
    setTimeout(() => {
        document.getElementById('editBookingModalContent').classList.remove('scale-95', 'opacity-0');
        document.getElementById('editBookingModalContent').classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeEditBookingModal() {
    document.getElementById('editBookingModalContent').classList.remove('scale-100', 'opacity-100');
    document.getElementById('editBookingModalContent').classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        document.getElementById('editBookingModal').classList.add('hidden');
    }, 300);
}

// Close modal when clicking outside
document.getElementById('createBookingModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeCreateBookingModal();
    }
});

document.getElementById('editBookingModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditBookingModal();
    }
});
</script>
