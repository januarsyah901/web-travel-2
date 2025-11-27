<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pendaftar - {{ $user->fullName }}</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
<div class="max-w-4xl mx-auto py-8 px-4">
    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6 relative">
        <!-- Mobile close button (X) -->
        <a href="{{ route('admin.dashboard') }}?section=users"
           class="sm:hidden absolute top-3 right-3 hover:bg-gray-700 text-gray-500 p-4   rounded-full flex items-center justify-center"
           aria-label="Close">
            <i class="fas fa-times"></i>
        </a>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-user text-indigo-600 text-xl md:text-2xl"></i>
                </div>
                <div class="min-w-0">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-800 truncate">{{ $user->fullName }}</h1>
                    <p class="text-gray-600 text-sm md:text-base">ID Pendaftar: {{ $user->id }}</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-2 w-full sm:w-auto">
                <a href="{{ route('users.edit', $user->id) }}"
                   class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('admin.dashboard') }}?section=users"
                   class="hidden sm:inline-flex w-full sm:w-auto bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informasi Pribadi -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Detail Pribadi -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-circle text-indigo-600 mr-2"></i>
                    Informasi Pribadi
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->fullName }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->birthDate ? $user->birthDate->format('d F Y') : 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->phone }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status Paspor</label>
                        <p class="mt-1">
                            @if($user->hasPassport)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i>Sudah memiliki paspor
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times mr-1"></i>Belum memiliki paspor
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->address }}</p>
                </div>
            </div>

            <!-- Informasi Akun -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-cog text-indigo-600 mr-2"></i>
                    Informasi Akun
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->email ?? 'Belum diatur' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Registrasi</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('d F Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Terakhir Update</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('d F Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status Akun</label>
                        <p class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>Aktif
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Riwayat Booking -->
            @if($user->bookings && $user->bookings->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-calendar-check text-indigo-600 mr-2"></i>
                    Riwayat Booking
                </h2>
                <div class="space-y-3">
                    @foreach($user->bookings as $booking)
                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-gray-800">{{ $booking->package->title ?? 'N/A' }}</h3>
                                <p class="text-sm text-gray-600">{{ $booking->package->schedule ?? '' }}</p>
                                <p class="text-sm text-gray-500">Tanggal: {{ $booking->registered_at ? $booking->registered_at->format('d F Y') : 'N/A' }}</p>
                            </div>
                            <span class="px-2 py-1 rounded text-xs font-medium
                                @if($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($booking->status == 'confirmed') bg-green-100 text-green-800
                                @elseif($booking->status == 'cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar Dokumen -->
        <div class="space-y-6">
            <!-- Dokumen KTP -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-id-card text-indigo-600 mr-2"></i>
                    Dokumen KTP
                </h3>
                @if($user->documents && $user->documents->ktp)
                    <div class="space-y-3">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            <span class="text-sm text-green-800 font-medium">Dokumen Tersedia</span>
                        </div>

                        @php
                            $ktpPath = $user->documents->ktp;
                            $ktpExtension = pathinfo($ktpPath, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($ktpExtension), ['jpg', 'jpeg', 'png', 'gif']);
                        @endphp

                            @if($isImage)
                                <div class="border rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $ktpPath) }}" alt="KTP" class="w-full h-auto">
                                </div>
                            @endif

                        <div class="flex gap-2">
                            <a href="{{ asset('storage/' . $ktpPath) }}" target="_blank"
                               class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
                                <i class="fas fa-eye mr-2"></i>Lihat
                            </a>
                            <a href="{{ asset('storage/' . $ktpPath) }}" download
                               class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg">
                                <i class="fas fa-download mr-2"></i>Download
                            </a>
                        </div>
                    </div>
                @else
                    <div class="text-center">
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <i class="fas fa-times-circle text-red-600 text-2xl mb-2"></i>
                            <p class="text-sm text-red-800 font-medium">Belum Upload</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Dokumen KK -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-home text-indigo-600 mr-2"></i>
                    Kartu Keluarga
                </h3>
                @if($user->documents && $user->documents->kk)
                    <div class="space-y-3">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            <span class="text-sm text-green-800 font-medium">Dokumen Tersedia</span>
                        </div>

                        @php
                            $kkPath = $user->documents->kk;
                            $kkExtension = pathinfo($kkPath, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($kkExtension), ['jpg', 'jpeg', 'png', 'gif']);
                        @endphp

                        @if($isImage)
                            <div class="border rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $kkPath) }}" alt="KK" class="w-full h-auto">
                            </div>
                        @endif

                        <div class="flex gap-2">
                            <a href="{{ asset('storage/' . $kkPath) }}" target="_blank"
                               class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
                                <i class="fas fa-eye mr-2"></i>Lihat
                            </a>
                            <a href="{{ asset('storage/' . $kkPath) }}" download
                               class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg">
                                <i class="fas fa-download mr-2"></i>Download
                            </a>
                        </div>
                    </div>
                @else
                    <div class="text-center">
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <i class="fas fa-times-circle text-red-600 text-2xl mb-2"></i>
                            <p class="text-sm text-red-800 font-medium">Belum Upload</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Dokumen Pendukung -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-file-alt text-indigo-600 mr-2"></i>
                    Dokumen Pendukung
                </h3>
                @if($user->documents && $user->documents->dokumen_pendukung)
                    <div class="space-y-3">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            <span class="text-sm text-green-800 font-medium">Dokumen Tersedia</span>
                        </div>

                        @php
                            $supportingDocs = json_decode($user->documents->dokumen_pendukung, true);
                        @endphp

                        @if(is_array($supportingDocs) && count($supportingDocs) > 0)
                            <div class="space-y-3">
                                @foreach($supportingDocs as $index => $doc)
                                    @php
                                        $docExtension = pathinfo($doc, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($docExtension), ['jpg', 'jpeg', 'png', 'gif']);
                                    @endphp

                                    <div class="border rounded-lg p-3">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm font-medium text-gray-700">
                                                <i class="fas fa-file mr-1"></i>Dokumen {{ $index + 1 }}
                                            </span>
                                            <span class="text-xs text-gray-500 uppercase">{{ $docExtension }}</span>
                                        </div>

                                        @if($isImage)
                                            <div class="border rounded overflow-hidden mb-2">
                                                <img src="{{ asset('storage/' . $doc) }}" alt="Dokumen {{ $index + 1 }}" class="w-full h-auto">
                                            </div>
                                        @endif

                                        <div class="flex gap-2">
                                            <a href="{{ asset('storage/' . $doc) }}" target="_blank"
                                               class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded">
                                                <i class="fas fa-eye mr-1"></i>Lihat
                                            </a>
                                            <a href="{{ asset('storage/' . $doc) }}" download
                                               class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded">
                                                <i class="fas fa-download mr-1"></i>Download
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center">
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <i class="fas fa-times-circle text-red-600 text-2xl mb-2"></i>
                            <p class="text-sm text-red-800 font-medium">Belum Upload</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pas Foto & Foto Paspor -->
            @if($user->passport && $user->passport->passportPhotos && $user->passport->passportPhotos->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-camera text-indigo-600 mr-2"></i>
                    Foto Paspor
                </h3>
                <div class="space-y-3">
                    @foreach($user->passport->passportPhotos as $index => $photo)
                        @php
                            $photoExtension = pathinfo($photo->file_path, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($photoExtension), ['jpg', 'jpeg', 'png', 'gif']);
                        @endphp

                        <div class="border rounded-lg p-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">
                                    <i class="fas fa-image mr-1"></i>Foto {{ $index + 1 }}
                                </span>
                            </div>

                            @if($isImage)
                                <div class="border rounded overflow-hidden mb-2">
                                    <img src="{{ asset('storage/' . $photo->file_path) }}" alt="Foto Paspor" class="w-full h-auto">
                                </div>
                            @endif

                            <div class="flex gap-2">
                                <a href="{{ asset('storage/' . $photo->file_path) }}" target="_blank"
                                   class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded">
                                    <i class="fas fa-eye mr-1"></i>Lihat
                                </a>
                                <a href="{{ asset('storage/' . $photo->file_path) }}" download
                                   class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded">
                                    <i class="fas fa-download mr-1"></i>Download
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Aksi Cepat -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="space-y-2">
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline-block w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus pendaftar ini?')"
                                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                            <i class="fas fa-trash mr-2"></i>Hapus Pendaftar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
