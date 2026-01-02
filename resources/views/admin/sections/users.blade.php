<div id="users" class="content-section {{ $section == 'users' ? '' : 'hidden' }} space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Data Pendaftar</h2>
            <p class="text-gray-500 mt-1">Database lengkap calon jamaah umroh yang terdaftar.</p>
        </div>

        <div class="relative w-full md:w-64">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" placeholder="Cari nama jamaah..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-shadow">
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full whitespace-nowrap">
                <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4 w-16">ID</th>
                    <th class="px-6 py-4">Nama & Kontak</th>
                    <th class="px-6 py-4">Tgl Lahir</th>
                    <th class="px-6 py-4">Alamat Domisili</th>
                    <th class="px-6 py-4 text-center">Status Paspor</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50/80 transition-colors duration-150">
                        <td class="px-6 py-4 text-sm text-gray-500 font-mono">
                            #{{ $user->id }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-900">{{ $user->fullName }}</span>
                                <span class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                    <i class="fab fa-whatsapp text-green-500"></i> {{ $user->phone ?? '-' }}
                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-700 flex items-center gap-2">
                                <i class="far fa-calendar-alt text-gray-400"></i>
                                {{ $user->birthDate ? $user->birthDate->format('d M Y') : 'N/A' }}
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-600 block max-w-xs truncate" title="{{ $user->address }}">
                                {{ Str::limit($user->address, 35) ?? '-' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($user->hasPassport)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                    <i class="fas fa-check-circle mr-1.5"></i> Ada
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                    <i class="fas fa-times-circle mr-1.5"></i> Belum
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('users.show', $user->id) }}"
                                   class="group p-2 text-teal-600 hover:bg-teal-50 rounded-lg transition-all duration-200"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye text-lg group-hover:scale-110 transition-transform"></i>
                                </a>

                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="group p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200"
                                   title="Edit Data">
                                    <i class="fas fa-edit text-lg group-hover:scale-110 transition-transform"></i>
                                </a>

                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftar ini? Data yang terkait (seperti booking) mungkin akan terpengaruh.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="group p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200"
                                            title="Hapus Permanen">
                                        <i class="fas fa-trash-alt text-lg group-hover:scale-110 transition-transform"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <div class="p-4 bg-gray-50 rounded-full">
                                    <i class="fas fa-users-slash text-gray-400 text-3xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Belum ada data pendaftar umroh</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{--
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $users->links() }}
        </div>
        --}}
    </div>
</div>

<style>
    /* Styling Scrollbar Konsisten */
    .custom-scrollbar::-webkit-scrollbar {
        height: 6px;
        width: 6px;
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
