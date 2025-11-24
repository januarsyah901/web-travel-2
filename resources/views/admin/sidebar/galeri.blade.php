<div id="galeri" class="content-section {{ $section == 'galleries' ? '' : 'hidden' }}">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Galeri</h2>
        <a href="{{ route('galleries.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Foto
        </a>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($galleries as $gallery)
                    <tr>
                        <td class="px-6 py-4">{{ $gallery->id }}</td>
                        <td class="px-6 py-4">{{ $gallery->title }}</td>
                        <td class="px-6 py-4">{{ Str::limit($gallery->description, 50) }}</td>
                        <td class="px-6 py-4">
                            @if($gallery->image_path)
                                <a href="{{ asset('storage/' . $gallery->image_path) }}" target="_blank" class="text-blue-600 hover:underline">View</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('galleries.edit', $gallery->id) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('galleries.destroy', $gallery->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data galeri</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
