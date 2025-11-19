<div id="partner" class="content-section {{ $section == 'partners' ? '' : 'hidden' }}">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Partner</h2>
        <a href="{{ route('partners.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Partner
        </a>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Logo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($partners as $partner)
                <tr>
                    <td class="px-6 py-4">{{ $partner->id }}</td>
                    <td class="px-6 py-4">{{ $partner->name }}</td>
                    <td class="px-6 py-4">
                        @if($partner->logo_path)
                            <a href="{{ asset('storage/' . $partner->logo_path) }}" target="_blank" class="text-blue-600 hover:underline">View</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('partners.edit', $partner->id) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('partners.destroy', $partner->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data partner</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
