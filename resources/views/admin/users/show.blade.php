@extends('admin.layouts.app')

@section('title', 'Detail Pendaftar - ' . $user->fullName)

@section('page-title', 'Detail Pendaftar')

@push('styles')
<style>
    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #f1f1f1; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto">

    @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm flex items-start animate-fade-in-down">
            <i class="fas fa-check-circle text-green-500 mt-0.5 mr-3"></i>
            <div>
                <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 p-4 opacity-10 pointer-events-none">
            <i class="fas fa-kaaba text-9xl text-gray-800"></i>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative z-10">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center text-white shadow-lg">
                    <span class="text-2xl font-bold">{{ substr($user->fullName, 0, 1) }}</span>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 tracking-tight">{{ $user->fullName }}</h1>
                    <div class="flex items-center gap-3 mt-1 text-sm text-gray-500">
                        <span><i class="far fa-clock mr-1"></i> Terdaftar: {{ $user->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-3 w-full md:w-auto">
                <a href="{{ route('admin.dashboard') }}?section=users"
                   class="px-4 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition-colors flex items-center justify-center shadow-sm">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <a href="{{ route('users.edit', $user->id) }}"
                   class="px-4 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 font-medium transition-colors flex items-center justify-center shadow-md hover:shadow-lg">
                    <i class="fas fa-edit mr-2"></i> Edit Data
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-user text-blue-500"></i> Data Pribadi
                    </h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Nama Lengkap</label>
                        <p class="text-gray-800 font-medium">{{ $user->fullName }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Tanggal Lahir</label>
                        <p class="text-gray-800 font-medium">
                            {{ $user->birthDate ? $user->birthDate->format('d F Y') : '-' }}
                            <span class="text-gray-400 text-xs font-normal">({{ $user->birthDate ? $user->birthDate->age . ' Tahun' : '' }})</span>
                        </p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Nomor WhatsApp</label>
                        <div class="flex items-center gap-2">
                            <p class="text-gray-800 font-medium">{{ $user->phone }}</p>
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $user->phone)) }}" target="_blank" class="text-green-500 hover:text-green-600 text-sm">
                                <i class="fab fa-whatsapp"></i> Chat
                            </a>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Status Paspor</label>
                        @if($user->hasPassport)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                <i class="fas fa-check-circle mr-1.5"></i> Sudah Ada
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                <i class="fas fa-times-circle mr-1.5"></i> Belum Ada
                            </span>
                        @endif
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Alamat Domisili</label>
                        <p class="text-gray-800 font-medium leading-relaxed">{{ $user->address }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-history text-orange-500"></i> Riwayat Paket
                    </h2>
                </div>
                <div class="p-6">
                    @if($user->bookings && $user->bookings->count() > 0)
                        <div class="space-y-4">
                            @foreach($user->bookings as $booking)
                                <div class="border border-gray-200 rounded-xl p-4 hover:border-blue-300 transition-colors bg-white">
                                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-lg">{{ $booking->package->title ?? 'Paket Tidak Ditemukan' }}</h4>
                                            <div class="flex items-center gap-3 text-sm text-gray-500 mt-1">
                                                <span><i class="far fa-calendar-alt mr-1"></i> {{ $booking->package->schedule ?? '-' }}</span>
                                                <span class="text-gray-300">|</span>
                                                <span>Booking: {{ $booking->registered_at ? $booking->registered_at->format('d M Y') : '-' }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            @php
                                                $statusColor = match($booking->status) {
                                                    'confirmed' => 'bg-green-100 text-green-800 border-green-200',
                                                    'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                    'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                                    default => 'bg-gray-100 text-gray-800 border-gray-200',
                                                };
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusColor }} uppercase tracking-wide">
                                                {{ $booking->status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-box-open text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-500 text-sm">Belum ada riwayat booking paket.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <div class="space-y-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-folder-open text-yellow-500"></i> Berkas Dokumen
                    </h2>
                </div>

                <div class="p-6 space-y-6">

                    @foreach([
                        ['label' => 'KTP', 'file' => $user->documents->ktp ?? null, 'icon' => 'fa-id-card'],
                        ['label' => 'Kartu Keluarga', 'file' => $user->documents->kk ?? null, 'icon' => 'fa-users'],
                    ] as $doc)
                        <div class="border border-gray-200 rounded-xl p-4 bg-gray-50/50">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <i class="fas {{ $doc['icon'] }} text-gray-400"></i>
                                    <span class="font-semibold text-gray-700 text-sm">{{ $doc['label'] }}</span>
                                </div>
                                @if($doc['file'])
                                    <span class="text-xs text-green-600 font-bold flex items-center gap-1">
                                        <i class="fas fa-check-circle"></i> Ada
                                    </span>
                                @else
                                    <span class="text-xs text-red-500 font-bold flex items-center gap-1">
                                        <i class="fas fa-times-circle"></i> Kosong
                                    </span>
                                @endif
                            </div>

                            @if($doc['file'])
                                @php
                                    $ext = pathinfo($doc['file'], PATHINFO_EXTENSION);
                                    $isImg = in_array(strtolower($ext), ['jpg','jpeg','png']);
                                @endphp

                                @if($isImg)
                                    <div class="mb-3 rounded-lg overflow-hidden border border-gray-200 h-32 bg-gray-200 flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $doc['file']) }}" class="h-full w-full object-cover cursor-pointer hover:opacity-90 transition" onclick="window.open(this.src)">
                                    </div>
                                @else
                                    <div class="mb-3 flex items-center justify-center h-20 bg-gray-100 rounded-lg border border-dashed border-gray-300">
                                        <span class="text-gray-500 text-sm font-medium uppercase">{{ $ext }} FILE</span>
                                    </div>
                                @endif

                                <div class="grid grid-cols-2 gap-2">
                                    <a href="{{ asset('storage/' . $doc['file']) }}" target="_blank" class="flex items-center justify-center px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs font-medium hover:bg-gray-50 text-gray-700 transition">
                                        <i class="fas fa-external-link-alt mr-1"></i> Buka
                                    </a>
                                    <a href="{{ asset('storage/' . $doc['file']) }}" download class="flex items-center justify-center px-3 py-2 bg-blue-50 border border-blue-200 rounded-lg text-xs font-medium hover:bg-blue-100 text-blue-700 transition">
                                        <i class="fas fa-download mr-1"></i> Unduh
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach

                    @if($user->documents && $user->documents->dokumen_pendukung)
                        @php $pendukung = json_decode($user->documents->dokumen_pendukung, true); @endphp
                        @if(is_array($pendukung))
                            <div class="pt-4 border-t border-gray-200">
                                <h3 class="text-sm font-bold text-gray-700 mb-3">Dokumen Tambahan</h3>
                                <div class="grid grid-cols-2 gap-3">
                                    @foreach($pendukung as $idx => $path)
                                        <a href="{{ asset('storage/' . $path) }}" target="_blank" class="flex flex-col items-center justify-center p-3 border border-gray-200 rounded-xl hover:border-blue-400 hover:bg-blue-50 transition bg-white text-center group">
                                            <i class="fas fa-file-alt text-2xl text-gray-400 group-hover:text-blue-500 mb-2"></i>
                                            <span class="text-xs font-medium text-gray-600 group-hover:text-blue-700 truncate w-full">Dokumen {{ $idx + 1 }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif

                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden">
                <div class="p-6">
                    <h3 class="text-sm font-bold text-red-600 mb-2">Hapus Akun Pendaftar</h3>
                    <p class="text-xs text-gray-500 mb-4">
                        Tindakan ini akan menghapus semua data pendaftar termasuk riwayat booking dan dokumen yang tersimpan secara permanen.
                    </p>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('APAKAH ANDA YAKIN? Data akan hilang permanen!')"
                                class="w-full py-2.5 bg-red-50 text-red-600 border border-red-200 rounded-xl hover:bg-red-600 hover:text-white font-medium transition-colors text-sm flex items-center justify-center">
                            <i class="fas fa-trash-alt mr-2"></i> Hapus Permanen
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
