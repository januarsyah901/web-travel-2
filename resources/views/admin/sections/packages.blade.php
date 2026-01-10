<div id="packages" class="content-section {{ $section == 'packages' ? '' : 'hidden' }} space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Manajemen Paket Umroh</h2>
            <p class="text-gray-500 mt-1">Kelola daftar paket perjalanan ibadah yang tersedia.</p>
        </div>
        <a href="{{ route('packages.create') }}" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 ease-in-out transform hover:-translate-y-0.5">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <i class="fas fa-plus text-blue-300 group-hover:text-white transition-colors"></i>
            </span>
            <span class="ml-4">Tambah Paket Baru</span>
        </a>
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
                                <a href="{{ route('packages.edit', $package->id) }}"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
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
                                <a href="{{ route('packages.create') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium hover:underline">
                                    Tambah paket pertama Anda
                                </a>
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
