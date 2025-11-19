<div id="packages" class="content-section {{ $section == 'packages' ? '' : 'hidden' }}">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Packages</h2>
        <a href="{{ route('packages.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Paket
        </a>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Paket</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durasi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
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
                    <td class="px-6 py-4">
                        <a href="{{ route('packages.edit', $package->id) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('packages.destroy', $package->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data paket</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
