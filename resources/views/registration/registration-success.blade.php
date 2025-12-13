<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-green-50 to-emerald-100 min-h-screen flex items-center justify-center px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
            <!-- Success Icon -->
            <div class="inline-flex items-center justify-center w-24 h-24 bg-green-100 rounded-full mb-6">
                <i class="fas fa-check-circle text-green-600 text-6xl"></i>
            </div>

            <!-- Success Message -->
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Pendaftaran Berhasil!</h1>

            @if(session('success'))
                <p class="text-lg text-gray-600 mb-6">{{ session('success') }}</p>
            @else
                <p class="text-lg text-gray-600 mb-6">
                    Terima kasih telah mendaftar program umroh kami. Tim kami akan segera menghubungi Anda untuk konfirmasi dan informasi lebih lanjut.
                </p>
            @endif

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8 mb-8">
                <div class="bg-blue-50 rounded-lg p-4">
                    <i class="fas fa-phone-alt text-blue-600 text-2xl mb-2"></i>
                    <p class="text-sm text-gray-600">Kami akan menghubungi</p>
                    <p class="font-semibold text-gray-800">1-2 Hari Kerja</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-4">
                    <i class="fas fa-envelope text-purple-600 text-2xl mb-2"></i>
                    <p class="text-sm text-gray-600">Cek email Anda</p>
                    <p class="font-semibold text-gray-800">Untuk Konfirmasi</p>
                </div>
                <div class="bg-indigo-50 rounded-lg p-4">
                    <i class="fas fa-clipboard-check text-indigo-600 text-2xl mb-2"></i>
                    <p class="text-sm text-gray-600">Proses selanjutnya</p>
                    <p class="font-semibold text-gray-800">Verifikasi Data</p>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-list-check text-indigo-600 mr-2"></i>
                    Langkah Selanjutnya:
                </h3>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <span class="flex-shrink-0 w-6 h-6 bg-indigo-600 text-white rounded-full flex items-center justify-center text-sm mr-3 mt-0.5">1</span>
                        <span class="text-gray-700">Pastikan nomor telepon Anda aktif dan dapat dihubungi</span>
                    </li>
                    <li class="flex items-start">
                        <span class="flex-shrink-0 w-6 h-6 bg-indigo-600 text-white rounded-full flex items-center justify-center text-sm mr-3 mt-0.5">2</span>
                        <span class="text-gray-700">Cek email Anda secara berkala untuk informasi lebih lanjut</span>
                    </li>
                    <li class="flex items-start">
                        <span class="flex-shrink-0 w-6 h-6 bg-indigo-600 text-white rounded-full flex items-center justify-center text-sm mr-3 mt-0.5">3</span>
                        <span class="text-gray-700">Siapkan dokumen yang diperlukan (KTP, KK, Paspor jika ada)</span>
                    </li>
                    <li class="flex items-start">
                        <span class="flex-shrink-0 w-6 h-6 bg-indigo-600 text-white rounded-full flex items-center justify-center text-sm mr-3 mt-0.5">4</span>
                        <span class="text-gray-700">Tunggu konfirmasi dari tim kami</span>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-3">Butuh Bantuan?</h3>
                <p class="text-sm mb-4">Hubungi kami jika ada pertanyaan:</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-phone mr-2"></i>
                        <span>0812-3456-7890</span>
                    </div>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-envelope mr-2"></i>
                        <span>info@umroh.com</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('home') }}" class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                    <i class="fas fa-home mr-2"></i>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('registration.form') }}" class="flex-1 bg-white border-2 border-indigo-600 text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Daftar Lagi
                </a>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-8 text-center">
            <p class="text-gray-600 text-sm">
                <i class="fas fa-shield-alt text-green-600 mr-2"></i>
                Data Anda aman dan terlindungi
            </p>
        </div>
    </div>
</body>
</html>
