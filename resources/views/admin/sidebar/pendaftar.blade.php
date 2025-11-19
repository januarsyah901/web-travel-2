<div id="users" class="content-section {{ $section == 'users' ? '' : 'hidden' }}">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Pendaftar Umroh</h2>
        <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Pendaftar
        </a>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
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
                    <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
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
                        <button onclick="showUserDetail({{ $user->id }}, '{{ $user->fullName }}', '{{ $user->birthDate ? $user->birthDate->format('d/m/Y') : 'N/A' }}', '{{ $user->address }}', '{{ $user->phone }}', {{ $user->hasPassport ? 'true' : 'false' }})" class="text-green-600 hover:text-green-800 mr-3" title="Detail">
                            <i class="fas fa-eye"></i>
                        </button>
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

<!-- Modal Detail Pendaftar -->
<div id="userDetailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">Detail Pendaftar Umroh</h3>
            <button onclick="closeUserDetailModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">ID Pendaftar</label>
                    <p class="mt-1 text-sm text-gray-900" id="modal-user-id">-</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <p class="mt-1 text-sm text-gray-900" id="modal-user-name">-</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <p class="mt-1 text-sm text-gray-900" id="modal-user-birthdate">-</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <p class="mt-1 text-sm text-gray-900" id="modal-user-phone">-</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                <p class="mt-1 text-sm text-gray-900" id="modal-user-address">-</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status Paspor</label>
                <p class="mt-1" id="modal-user-passport">
                    <span class="px-2 py-1 rounded text-sm">-</span>
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Dokumen yang Diupload</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border rounded-lg p-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium">KTP</span>
                            <span id="modal-ktp-status" class="text-xs px-2 py-1 rounded">-</span>
                        </div>
                        <div id="modal-ktp-link" class="mt-2 hidden">
                            <a href="#" target="_blank" class="text-blue-600 hover:underline text-sm">
                                <i class="fas fa-external-link-alt mr-1"></i>Lihat Dokumen
                            </a>
                        </div>
                    </div>

                    <div class="border rounded-lg p-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium">Kartu Keluarga</span>
                            <span id="modal-kk-status" class="text-xs px-2 py-1 rounded">-</span>
                        </div>
                        <div id="modal-kk-link" class="mt-2 hidden">
                            <a href="#" target="_blank" class="text-blue-600 hover:underline text-sm">
                                <i class="fas fa-external-link-alt mr-1"></i>Lihat Dokumen
                            </a>
                        </div>
                    </div>

                    <div class="border rounded-lg p-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium">Dokumen Pendukung</span>
                            <span id="modal-supporting-status" class="text-xs px-2 py-1 rounded">-</span>
                        </div>
                        <div id="modal-supporting-links" class="mt-2 hidden">
                            <!-- Links will be populated by JavaScript -->
                        </div>
                    </div>

                    <div class="border rounded-lg p-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium">Foto Paspor</span>
                            <span id="modal-passport-status" class="text-xs px-2 py-1 rounded">-</span>
                        </div>
                        <div id="modal-passport-link" class="mt-2 hidden">
                            <a href="#" target="_blank" class="text-blue-600 hover:underline text-sm">
                                <i class="fas fa-external-link-alt mr-1"></i>Lihat Foto
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button onclick="closeUserDetailModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>
