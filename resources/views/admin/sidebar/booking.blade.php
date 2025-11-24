<div id="bookings" class="content-section {{ $section == 'bookings' ? '' : 'hidden' }}">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Bookings</h2>
        <a href="{{ route('bookings.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Booking
        </a>
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
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
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
