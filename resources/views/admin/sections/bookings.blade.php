<div id="bookings" class="content-section {{ $section == 'bookings' ? '' : 'hidden' }} space-y-6">
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm flex items-center animate-fade-in-down">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-500 text-lg"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Data Booking</h2>
            <p class="text-gray-500 mt-1">Kelola pendaftaran dan status pembayaran jamaah.</p>
        </div>
        <button onclick="openCreateBookingModal()" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 ease-in-out transform hover:-translate-y-0.5">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <i class="fas fa-calendar-plus text-blue-300 group-hover:text-white transition-colors"></i>
            </span>
            <span class="ml-4">Tambah Booking</span>
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full whitespace-nowrap">
                <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4 w-12">ID</th>
                    <th class="px-6 py-4">Nama Jamaah</th>
                    <th class="px-6 py-4">Paket Pilihan</th>
                    <th class="px-6 py-4">Tgl Daftar</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50/80 transition-colors duration-150">
                        <td class="px-6 py-4 text-sm text-gray-500 font-mono">#{{ $booking->id }}</td>

                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-900">{{ $booking->user->fullName ?? 'Guest' }}</span>
                                <span class="text-xs text-gray-500">{{ $booking->user->phone ?? '-' }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-700">{{ $booking->package->title ?? 'Paket Dihapus' }}</div>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-600">
                                {{ $booking->registered_at ? $booking->registered_at->format('d M Y') : '-' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    'confirmed' => 'bg-green-100 text-green-800 border-green-200',
                                    'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                    'completed' => 'bg-blue-100 text-blue-800 border-blue-200',
                                ];
                                $currentClass = $statusClasses[$booking->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $currentClass }} capitalize">
                                {{ $booking->status }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-3">
                                <button onclick="openEditBookingModal({{ $booking->id }}, {{ $booking->user_id }}, {{ $booking->package_id }}, '{{ $booking->status }}', '{{ $booking->registered_at ? $booking->registered_at->format('Y-m-d') : '' }}')"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </button>

                                <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" class="inline-block" onsubmit="return confirm('Hapus data booking ini?');">
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
                                    <i class="far fa-calendar-times text-gray-400 text-3xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Belum ada booking masuk</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="createBookingModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity opacity-0" id="createBookingBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg scale-95 opacity-0" id="createBookingPanel">

                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-calendar-plus bg-white/20 p-1.5 rounded-md"></i>
                        Tambah Booking
                    </h3>
                    <button onclick="closeCreateBookingModal()" class="text-blue-100 hover:text-white transition-colors focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form action="{{ route('bookings.store') }}" method="POST" class="p-6 space-y-5">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Jamaah</label>
                            <select name="user_id" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5" required>
                                <option value="">-- Pilih Jamaah --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fullName }} ({{ $user->phone }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Paket</label>
                            <select name="package_id" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5" required>
                                <option value="">-- Pilih Paket --</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->title }} (Rp {{ number_format($package->price, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5">
                                    <option value="pending">Pending (Menunggu)</option>
                                    <option value="confirmed">Confirmed (Lunas)</option>
                                    <option value="cancelled">Cancelled (Batal)</option>
                                    <option value="completed">Completed (Selesai)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Daftar</label>
                                <input type="date" name="registered_at" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeCreateBookingModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm transition-colors">Simpan Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editBookingModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity opacity-0" id="editBookingBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg scale-95 opacity-0" id="editBookingPanel">

                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-edit bg-white/20 p-1.5 rounded-md"></i>
                        Update Booking
                    </h3>
                    <button onclick="closeEditBookingModal()" class="text-blue-100 hover:text-white transition-colors focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="editBookingForm" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jamaah</label>
                            <select name="user_id" id="edit_user_id" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 bg-gray-50" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fullName }} ({{ $user->phone }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Paket</label>
                            <select name="package_id" id="edit_package_id" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5" required>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->title }} (Rp {{ number_format($package->price, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="edit_status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5">
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Daftar</label>
                                <input type="date" name="registered_at" id="edit_registered_at" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeEditBookingModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm transition-colors">Update Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // --- Helper for Animations ---
    function animateBookingModal(modalId, backdropId, panelId, show) {
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

    // --- Create Functions ---
    function openCreateBookingModal() {
        animateBookingModal('createBookingModal', 'createBookingBackdrop', 'createBookingPanel', true);
    }

    function closeCreateBookingModal() {
        animateBookingModal('createBookingModal', 'createBookingBackdrop', 'createBookingPanel', false);
    }

    // --- Edit Functions ---
    function openEditBookingModal(id, userId, packageId, status, registeredAt) {
        document.getElementById('edit_user_id').value = userId;
        document.getElementById('edit_package_id').value = packageId;
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_registered_at').value = registeredAt;

        const baseUrl = '{{ url("bookings") }}';
        document.getElementById('editBookingForm').action = `${baseUrl}/${id}`;

        animateBookingModal('editBookingModal', 'editBookingBackdrop', 'editBookingPanel', true);
    }

    function closeEditBookingModal() {
        animateBookingModal('editBookingModal', 'editBookingBackdrop', 'editBookingPanel', false);
    }

    // --- Close on Outside Click ---
    window.addEventListener('click', function(e) {
        const createModal = document.getElementById('createBookingModal');
        const editModal = document.getElementById('editBookingModal');
        const createPanel = document.getElementById('createBookingPanel');
        const editPanel = document.getElementById('editBookingPanel');

        if (e.target === createModal || (createModal && createModal.contains(e.target) && !createPanel.contains(e.target))) {
            closeCreateBookingModal();
        }
        if (e.target === editModal || (editModal && editModal.contains(e.target) && !editPanel.contains(e.target))) {
            closeEditBookingModal();
        }
    });
</script>
