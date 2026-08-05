<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil | Fabi Abadi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Animasi Pop untuk icon centang */
        @keyframes popIn {
            0% { transform: scale(0); opacity: 0; }
            70% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-pop {
            animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center px-4 py-10 font-sans">

<div class="max-w-2xl w-full mx-auto">

    <div class="text-center mb-8">
        <img src="{{ asset('img/img/vertical_logo.png') }}"
             alt="Logo Fabi Abadi"
             class="h-16 mx-auto object-contain mb-2">
    </div>

    <div class="bg-white rounded-2xl shadow-xl shadow-orange-100 border border-orange-50 overflow-hidden relative">

        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-orange-400 to-orange-600"></div>

        <div class="p-8 md:p-10 text-center">
            <div class="animate-pop inline-flex items-center justify-center w-24 h-24 bg-orange-50 rounded-full mb-6 ring-8 ring-orange-50/50">
                <i class="fas fa-check text-orange-600 text-5xl"></i>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3 tracking-tight">Alhamdulillah!</h1>
            <h2 class="text-xl font-medium text-orange-600 mb-4">Pendaftaran Berhasil Terkirim</h2>

            @if(session('success'))
                <p class="text-gray-600 mb-8 leading-relaxed max-w-lg mx-auto">{{ session('success') }}</p>
            @else
                <p class="text-gray-600 mb-8 leading-relaxed max-w-lg mx-auto">
                    Terima kasih telah mempercayakan perjalanan ibadah Anda kepada kami. Data Anda telah kami terima dengan aman.
                </p>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 text-left">
                <div class="bg-orange-50/50 border border-orange-100 rounded-xl p-4 transition hover:bg-orange-50">
                    <div class="bg-white w-10 h-10 rounded-lg flex items-center justify-center shadow-sm mb-3 text-orange-600">
                        <i class="fas fa-clock text-lg"></i>
                    </div>
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Respon Kami</p>
                    <p class="font-bold text-gray-800">1x24 Jam Kerja</p>
                </div>

                <div class="bg-orange-50/50 border border-orange-100 rounded-xl p-4 transition hover:bg-orange-50">
                    <div class="bg-white w-10 h-10 rounded-lg flex items-center justify-center shadow-sm mb-3 text-orange-600">
                        <i class="fas fa-whatsapp text-lg"></i>
                    </div>
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Dihubungi Via</p>
                    <p class="font-bold text-gray-800">WhatsApp / Telp</p>
                </div>

                <div class="bg-orange-50/50 border border-orange-100 rounded-xl p-4 transition hover:bg-orange-50">
                    <div class="bg-white w-10 h-10 rounded-lg flex items-center justify-center shadow-sm mb-3 text-orange-600">
                        <i class="fas fa-file-shield text-lg"></i>
                    </div>
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Status Data</p>
                    <p class="font-bold text-gray-800">Menunggu Verifikasi</p>
                </div>
            </div>

            <div class="text-left bg-gray-50 rounded-2xl p-6 border border-gray-100 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-list-check text-orange-500 mr-2.5"></i>
                    Langkah Selanjutnya
                </h3>
                <div class="space-y-4">
                    <div class="flex">
                        <div class="flex-shrink-0 mr-4 flex flex-col items-center">
                            <div class="w-8 h-8 bg-orange-600 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md shadow-orange-200">1</div>
                            <div class="h-full w-0.5 bg-orange-200 my-1"></div>
                        </div>
                        <div class="pb-4">
                            <p class="font-semibold text-gray-800">Cek WhatsApp & Email</p>
                            <p class="text-sm text-gray-600 mt-1">Kami akan mengirimkan detail paket dan tagihan booking seat.</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 mr-4 flex flex-col items-center">
                            <div class="w-8 h-8 bg-orange-100 text-orange-600 border border-orange-200 rounded-full flex items-center justify-center font-bold text-sm">2</div>
                            <div class="h-full w-0.5 bg-gray-200 my-1"></div>
                        </div>
                        <div class="pb-4">
                            <p class="font-semibold text-gray-800">Pembayaran DP</p>
                            <p class="text-sm text-gray-600 mt-1">Lakukan pembayaran uang muka sesuai instruksi untuk mengamankan seat.</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 mr-4 flex flex-col items-center">
                            <div class="w-8 h-8 bg-orange-100 text-orange-600 border border-orange-200 rounded-full flex items-center justify-center font-bold text-sm">3</div>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Penyerahan Dokumen Fisik</p>
                            <p class="text-sm text-gray-600 mt-1">Tim kami akan memandu Anda untuk pengumpulan paspor asli & dokumen lain.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" class="w-full sm:w-auto px-8 py-3 bg-gray-100 text-gray-700 font-semibold rounded-full hover:bg-gray-200 transition-colors flex items-center justify-center">
                    <i class="fas fa-home mr-2 text-gray-500"></i>
                    Ke Beranda
                </a>
                <a href="{{ route('registration.index') }}" class="w-full sm:w-auto px-8 py-3 bg-orange-600 text-white font-bold rounded-full hover:bg-orange-700 transition-all shadow-lg shadow-orange-200 flex items-center justify-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar Jemaah Lain
                </a>
            </div>
        </div>

        <div class="bg-orange-50 px-8 py-4 border-t border-orange-100">
            <div class="flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500 gap-2">
                <p class="flex items-center">
                    <i class="fas fa-shield-alt text-orange-500 mr-2"></i>
                    Data aman & terlindungi
                </p>
                <p>Butuh bantuan? <a href="#" class="text-orange-600 font-semibold hover:underline">0812-3456-7890</a></p>
            </div>
        </div>
    </div>

    <p class="text-center text-gray-400 text-sm mt-8">
        &copy; {{ date('Y') }} PT Fabi Abadi. All rights reserved.
    </p>
</div>
</body>
</html>
