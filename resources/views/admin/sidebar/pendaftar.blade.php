<div id="users" class="content-section {{ $section == 'users' ? '' : 'hidden' }}">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Lengkap</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Lahir</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telepon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paspor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($users as $user)
                    <tr>
                        <td class="px-6 py-4">{{ $user->id }}</td>
                        <td class="px-6 py-4 font-medium">{{ $user->fullName }}</td>
                        <td class="px-6 py-4">{{ $user->birthDate ? $user->birthDate->format('d/m/Y') : 'N/A' }}</td>
                        <td class="px-6 py-4">{{ Str::limit($user->address, 30) }}</td>
                        <td class="px-6 py-4">{{ $user->phone }}</td>
                        <td class="px-6 py-4">
                            @if($user->hasPassport)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                            <i class="fas fa-check"></i> Ada
                                        </span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">
                                            <i class="fas fa-times"></i> Belum
                                        </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('users.show', $user->id) }}" class="text-green-600 hover:text-green-800 mr-3" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800 mr-3" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus pendaftar ini?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data pendaftar umroh</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
