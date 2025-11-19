<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Umroh</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen py-12 px-4">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-block bg-white rounded-full p-4 shadow-lg mb-4">
                <i class="fas fa-kaaba text-indigo-600 text-5xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Pendaftaran Umroh</h1>
            <p class="text-gray-600">Daftar sekarang untuk perjalanan spiritual Anda</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <p class="font-bold">Terdapat kesalahan dalam pengisian form:</p>
                    </div>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('registration.submit') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Personal Information Section -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-user-circle text-indigo-600 mr-2"></i>
                        Informasi Pribadi
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div class="md:col-span-2">
                            <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" name="fullName" id="fullName" value="{{ old('fullName') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="Masukkan nama lengkap sesuai KTP" required>
                            </div>
                        </div>

                        <!-- Birth Date -->
                        <div>
                            <label for="birthDate" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar text-gray-400"></i>
                                </div>
                                <input type="date" name="birthDate" id="birthDate" value="{{ old('birthDate') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                No. Telepon <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-400"></i>
                                </div>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="08xxxxxxxxxx" required>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 pointer-events-none">
                                    <i class="fas fa-home text-gray-400"></i>
                                </div>
                                <textarea name="address" id="address" rows="3"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="Masukkan alamat lengkap" required>{{ old('address') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Passport Information -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-passport text-indigo-600 mr-2"></i>
                        Informasi Paspor
                    </h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Apakah Anda sudah memiliki paspor? <span class="text-red-500">*</span>
                        </label>
                        <div class="flex space-x-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="hasPassport" value="1" {{ old('hasPassport') == '1' ? 'checked' : '' }}
                                    class="w-5 h-5 text-indigo-600 focus:ring-indigo-500" required>
                                <span class="ml-2 text-gray-700">Ya, sudah memiliki paspor</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="hasPassport" value="0" {{ old('hasPassport') == '0' ? 'checked' : '' }}
                                    class="w-5 h-5 text-indigo-600 focus:ring-indigo-500" required>
                                <span class="ml-2 text-gray-700">Belum memiliki paspor</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Package Selection -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-box-open text-indigo-600 mr-2"></i>
                        Pilih Paket Umroh (Opsional)
                    </h2>
                    <div class="grid grid-cols-1 gap-4">
                        @forelse($packages as $package)
                            <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-indigo-500 transition-colors">
                                <input type="radio" name="package_id" value="{{ $package->id }}"
                                    {{ old('package_id') == $package->id ? 'checked' : '' }}
                                    class="w-5 h-5 text-indigo-600 focus:ring-indigo-500">
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-semibold text-gray-800">{{ $package->title }}</h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ $package->schedule }}</p>
                                            <p class="text-sm text-gray-500">Durasi: {{ $package->duration }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xl font-bold text-indigo-600">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        @empty
                            <p class="text-gray-500 text-center py-4">Belum ada paket tersedia</p>
                        @endforelse
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <a href="{{ route('home') }}" class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors text-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-indigo-600 to-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-blue-700 transition-colors shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Daftar Sekarang
                    </button>
                </div>
            </form>
        </div>

        <!-- Additional Info -->
        <div class="mt-8 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Informasi Penting</h3>
                    <p class="mt-2 text-sm text-blue-700">
                        Setelah mendaftar, tim kami akan menghubungi Anda untuk konfirmasi dan informasi lebih lanjut.
                        Pastikan nomor telepon yang Anda masukkan aktif dan dapat dihubungi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
