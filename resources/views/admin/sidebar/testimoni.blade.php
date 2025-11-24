<div id="testimoni" class="content-section {{ $section == 'testimonials' ? '' : 'hidden' }}">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Testimoni</h2>
        <a href="{{ route('testimonials.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Testimoni
        </a>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rating</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Komentar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($testimonials as $testimonial)
                    <tr>
                        <td class="px-6 py-4">{{ $testimonial->id }}</td>
                        <td class="px-6 py-4">{{ $testimonial->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ Str::limit($testimonial->content, 50) }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('testimonials.destroy', $testimonial->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data testimoni</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
