<div id="dashboard" class="content-section {{ $section ? 'hidden' : '' }} space-y-8 animate-fade-in-up">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pendaftar</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($counts['users']) }}</h3>
                </div>
                <div class="p-3 bg-blue-50 rounded-xl text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-400">
                <span class="text-blue-600 font-semibold bg-blue-50 px-2 py-0.5 rounded mr-2">
                    <i class="fas fa-database mr-1"></i> Data
                </span>
                <span>Calon Jamaah</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Bookings</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($counts['bookings']) }}</h3>
                </div>
                <div class="p-3 bg-green-50 rounded-xl text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-400">
                <span class="text-green-600 font-semibold bg-green-50 px-2 py-0.5 rounded mr-2">
                    <i class="fas fa-check mr-1"></i> Aktif
                </span>
                <span>Transaksi Masuk</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Paket Tersedia</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($counts['packages']) }}</h3>
                </div>
                <div class="p-3 bg-purple-50 rounded-xl text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <i class="fas fa-box text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-400">
                <span class="text-purple-600 font-semibold bg-purple-50 px-2 py-0.5 rounded mr-2">
                    <i class="fas fa-plane mr-1"></i> Umroh
                </span>
                <span>Pilihan Paket</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Partner</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($counts['partners']) }}</h3>
                </div>
                <div class="p-3 bg-orange-50 rounded-xl text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                    <i class="fas fa-handshake text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-400">
                <span class="text-orange-600 font-semibold bg-orange-50 px-2 py-0.5 rounded mr-2">
                    <i class="fas fa-star mr-1"></i> Mitra
                </span>
                <span>Kerjasama</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gray-50/50">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Pendaftar Terbaru</h3>
                <p class="text-sm text-gray-500">Daftar akun jamaah yang baru mendaftar.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}?section=users" class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center group">
                Lihat Semua <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
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

                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline-block" onsubmit="return handleDeleteUser(event, '{{ addslashes($user->fullName) }}');">
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

        @if(isset($recentUsers) && method_exists($recentUsers, 'links'))
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $recentUsers->links() }}
            </div>
        @endif
    </div>
</div>
