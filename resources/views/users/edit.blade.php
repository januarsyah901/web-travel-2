<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pendaftar - {{ $user->fullName }}</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
<div class="max-w-4xl mx-auto py-8 px-4">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-edit text-indigo-600 text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Edit Data Pendaftar</h1>
                    <p class="text-gray-600">ID Pendaftar: {{ $user->id }}</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('users.show', $user->id) }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Error Messages -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span class="font-semibold">Terdapat kesalahan pada form:</span>
            </div>
            <ul class="list-disc list-inside ml-6">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Edit -->
    <form method="POST" action="{{ route('users.update', $user->id) }}" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <!-- Informasi Pribadi -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center border-b pb-2">
                    <i class="fas fa-user-circle text-indigo-600 mr-2"></i>
                    Informasi Pribadi
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="fullName"
                               id="fullName"
                               value="{{ old('fullName', $user->fullName) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('fullName') border-red-500 @enderror"
                               required>
                        @error('fullName')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="birthDate" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date"
                               name="birthDate"
                               id="birthDate"
                               value="{{ old('birthDate', $user->birthDate ? $user->birthDate->format('Y-m-d') : '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('birthDate') border-red-500 @enderror"
                               required>
                        @error('birthDate')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="tel"
                               name="phone"
                               id="phone"
                               value="{{ old('phone', $user->phone) }}"
                               placeholder="08123456789"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                               required>
                        @error('phone')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email (Opsional)
                        </label>
                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email', $user->email) }}"
                               placeholder="email@example.com"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Alamat -->
                <div class="mt-6">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea name="address"
                              id="address"
                              rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('address') border-red-500 @enderror"
                              required>{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Paspor -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status Paspor
                    </label>
                    <div class="flex items-center space-x-6">
                        <label class="inline-flex items-center">
                            <input type="radio"
                                   name="hasPassport"
                                   value="1"
                                   {{ old('hasPassport', $user->hasPassport) == 1 ? 'checked' : '' }}
                                   class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">Sudah memiliki paspor</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio"
                                   name="hasPassport"
                                   value="0"
                                   {{ old('hasPassport', $user->hasPassport) == 0 ? 'checked' : '' }}
                                   class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">Belum memiliki paspor</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                <a href="{{ route('users.show', $user->id) }}"
                   class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors flex items-center">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>

    <!-- Info Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-6">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-600 text-xl mr-3 mt-1"></i>
            <div>
                <h3 class="font-semibold text-blue-900 mb-1">Informasi</h3>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>• Pastikan semua data yang diisi sudah benar sebelum menyimpan</li>
                    <li>• Field yang bertanda <span class="text-red-500">*</span> wajib diisi</li>
                    <li>• Perubahan data akan langsung tersimpan ke database</li>
                    <li>• Untuk mengubah dokumen (KTP, KK, dll), gunakan menu dokumen terpisah</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-dismiss success message after 5 seconds
    setTimeout(function() {
        const successAlert = document.querySelector('.bg-green-100');
        if (successAlert) {
            successAlert.style.transition = 'opacity 0.5s';
            successAlert.style.opacity = '0';
            setTimeout(() => successAlert.remove(), 500);
        }
    }, 5000);
</script>
</body>
</html>
