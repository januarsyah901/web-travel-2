<div id="bookings" class="content-section {{ $section == 'bookings' ? '' : 'hidden' }} space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Data Booking</h2>
            <p class="text-gray-500 mt-1">Kelola pendaftaran dan status pembayaran jamaah.</p>
        </div>
        <a href="{{ route('bookings.create') }}" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 ease-in-out transform hover:-translate-y-0.5">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <i class="fas fa-calendar-plus text-blue-300 group-hover:text-white transition-colors"></i>
            </span>
            <span class="ml-4">Tambah Booking</span>
        </a>
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
                                ];
                                $statusLabels = [
                                    'pending' => 'Pending',
                                    'confirmed' => 'Confirmed',
                                    'cancelled' => 'Cancelled',
                                ];
                                $currentClass = $statusClasses[$booking->status] ?? 'bg-gray-100 text-gray-800';
                                $statusLabel = $statusLabels[$booking->status] ?? ucfirst($booking->status);
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $currentClass }}">
                                {{ $statusLabel }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-3">
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>

                                <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" class="inline-block" onsubmit="return handleDeleteBooking(event, '{{ addslashes($booking->user->fullName ?? \"Booking\") }}');">
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
