<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Umroh</title>
    <link rel="icon" href="{{ asset('img/icon/favicon.png') }}" type="image/png">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen py-12 px-4">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-block bg-white rounded-full p-4 shadow-lg mb-4">

            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Pendaftaran Umroh</h1>
            <p class="text-gray-600">Daftar sekarang untuk perjalanan spiritual Anda</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <div class="flex items-center mb-2">

                        <p class="font-bold">Terdapat kesalahan dalam pengisian form:</p>
                    </div>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('registration.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Personal Information Section -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                        Informasi Pribadi
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div class="md:col-span-2">
                            <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap Sesuai KTP <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                                </div>
                                <input type="text" name="fullName" id="fullName" value="{{ old('fullName') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="Masukkan nama lengkap sesuai KTP" required>
                            </div>
                        </div>

                        <!-- Birth Place -->
                        <div>
                            <label for="birthPlace" class="block text-sm font-medium text-gray-700 mb-2">
                                Tempat Lahir <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                                </div>
                                <input type="text" name="birthPlace" id="birthPlace" value="{{ old('birthPlace') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="Contoh: Jakarta" required>
                            </div>
                        </div>

                        <!-- Birth Date -->
                        <div>
                            <label for="birthDate" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                                </div>
                                <input type="date" name="birthDate" id="birthDate" value="{{ old('birthDate') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat Lengkap Sesuai KTP <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 pointer-events-none">

                                </div>
                                <textarea name="address" id="address" rows="3"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="Masukkan alamat lengkap sesuai KTP" required>{{ old('address') }}</textarea>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="md:col-span-2">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Telepon (WhatsApp) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                                </div>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="08xxxxxxxxxx" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package Selection -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">

                        Jadwal & Program Umroh <span class="text-red-500">*</span>
                    </h2>
                    <div class="grid grid-cols-1 gap-4">
                        @forelse($packages as $package)
                            <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-indigo-500 transition-colors">
                                <input type="radio" name="package_id" value="{{ $package->id }}"
                                    {{ old('package_id') == $package->id ? 'checked' : '' }}
                                    class="w-5 h-5 text-indigo-600 focus:ring-indigo-500" required>
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

                <!-- Documents Upload -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">

                        Upload Dokumen
                    </h2>
                    <div class="space-y-4">
                        <!-- KTP -->
                        <div>
                            <label for="ktp" class="block text-sm font-medium text-gray-700 mb-2">

                                KTP (Kartu Tanda Penduduk) <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="ktp" id="ktp" accept="image/*,.pdf" required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, atau PDF (Max 2MB)</p>
                        </div>

                        <!-- KK -->
                        <div>
                            <label for="kk" class="block text-sm font-medium text-gray-700 mb-2">

                                KK (Kartu Keluarga) <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="kk" id="kk" accept="image/*,.pdf" required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, atau PDF (Max 2MB)</p>
                        </div>

                        <!-- Akte/Buku Nikah/Ijazah -->
                        <div>
                            <label for="supporting_docs" class="block text-sm font-medium text-gray-700 mb-2">

                                Akte Lahir / Buku Nikah / Ijazah <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="supporting_docs[]" id="supporting_docs" accept="image/*,.pdf" multiple required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="mt-1 text-xs text-gray-500">Upload salah satu atau lebih. Format: JPG, PNG, atau PDF</p>
                        </div>

                        <!-- Pas Foto -->
                        <div>
                            <label for="pas_foto" class="block text-sm font-medium text-gray-700 mb-2">

                                Pas Foto Background Putih 80% Tampak Muka
                            </label>
                            <input type="file" name="pas_foto" id="pas_foto" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="mt-1 text-xs text-gray-500">Format: JPG atau PNG. Ukuran 4x6 dengan background putih</p>
                        </div>
                    </div>
                </div>

                <!-- Passport Information -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-passport text-indigo-600 mr-2"></i>
                        Informasi Paspor
                    </h2>
                    <div class="space-y-4">
                        <!-- Has Passport -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Sudah pernah memiliki Paspor? <span class="text-red-500">*</span>
                            </label>
                            <div class="flex space-x-4">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="hasPassport" value="1" {{ old('hasPassport') == '1' ? 'checked' : '' }}
                                        class="w-5 h-5 text-indigo-600 focus:ring-indigo-500" required
                                        onchange="togglePassportFields(true)">
                                    <span class="ml-2 text-gray-700">Ya, sudah memiliki paspor</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="hasPassport" value="0" {{ old('hasPassport') == '0' ? 'checked' : '' }}
                                        class="w-5 h-5 text-indigo-600 focus:ring-indigo-500" required
                                        onchange="togglePassportFields(false)">
                                    <span class="ml-2 text-gray-700">Belum memiliki paspor</span>
                                </label>
                            </div>
                        </div>

                        <!-- Passport Details (Conditional) -->
                        <div id="passportDetails" class="space-y-4" style="display: {{ old('hasPassport') == '1' ? 'block' : 'none' }};">
                            <!-- Passport Name -->
                            <div>
                                <label for="passportName" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama di Paspor
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                                    </div>
                                    <input type="text" name="passportName" id="passportName" value="{{ old('passportName') }}"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Nama sesuai paspor">
                                </div>
                            </div>

                            <!-- Passport Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    Masa Berlaku Paspor
                                </label>
                                <div class="space-y-2">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="passportStatus" value="valid" {{ old('passportStatus') == 'valid' ? 'checked' : '' }}
                                            class="w-4 h-4 text-indigo-600 focus:ring-indigo-500">
                                        <span class="ml-2 text-gray-700">Masih berlaku</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="passportStatus" value="expired" {{ old('passportStatus') == 'expired' ? 'checked' : '' }}
                                            class="w-4 h-4 text-indigo-600 focus:ring-indigo-500">
                                        <span class="ml-2 text-gray-700">Habis masa berlaku</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Passport Photo Upload -->
                            <div>
                                <label for="passportPhoto" class="block text-sm font-medium text-gray-700 mb-2">

                                    Upload Foto Paspor
                                </label>
                                <input type="file" name="passportPhoto" id="passportPhoto" accept="image/*,.pdf"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                <p class="mt-1 text-xs text-gray-500">Upload foto halaman identitas paspor. Format: JPG, PNG, atau PDF</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <a href="{{ route('home') }}" class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors text-center">

                        Kembali
                    </a>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-indigo-600 to-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-blue-700 transition-colors shadow-lg">

                        Daftar Sekarang
                    </button>
                </div>
            </form>
        </div>

        <!-- Additional Info -->
        <div class="mt-8 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
            <div class="flex">
                <div class="flex-shrink-0">

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

    <script>
        function togglePassportFields(show) {
            const passportDetails = document.getElementById('passportDetails');
            if (show) {
                passportDetails.style.display = 'block';
            } else {
                passportDetails.style.display = 'none';
                // Clear passport fields when hidden
                document.getElementById('passportName').value = '';
                document.querySelectorAll('input[name="passportStatus"]').forEach(el => el.checked = false);
                document.getElementById('passportPhoto').value = '';
            }
        }

        // Initialize on page load if old value exists
        document.addEventListener('DOMContentLoaded', function() {
            const hasPassportYes = document.querySelector('input[name="hasPassport"][value="1"]');
            if (hasPassportYes && hasPassportYes.checked) {
                togglePassportFields(true);
            }
        });
    </script>
</body>
</html>
