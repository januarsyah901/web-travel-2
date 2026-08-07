<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan (404) - PT Fabi Abadi</title>
    <link rel="icon" href="{{ asset('img/icon/favicon.png') }}" type="image/png">
    
    <!-- Tailwind CSS Play CDN as fallback, plus fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Background patterns -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-orange-200 blur-3xl opacity-40"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full bg-blue-100 blur-3xl opacity-40"></div>
        
        <!-- Grid pattern overlay -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#e5e7eb_1px,transparent_1px),linear-gradient(to_bottom,#e5e7eb_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] opacity-20"></div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 max-w-lg w-full mx-4 text-center">
        <!-- Logo -->
        <div class="mb-10 flex justify-center">
            @if(file_exists(public_path('img/img/vertical_logo.png')))
                <img src="{{ asset('img/img/vertical_logo.png') }}" alt="PT Fabi Abadi Logo" class="h-20 w-auto object-contain">
            @else
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-bold bg-gradient-to-r from-orange-500 to-orange-700 bg-clip-text text-transparent">PT FABI ABADI</span>
                </div>
            @endif
        </div>

        <!-- 404 Illustration / Card -->
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl border border-gray-100 backdrop-blur-sm bg-white/90">
            <!-- Animated 404 number -->
            <div class="relative mb-6">
                <h1 class="text-8xl md:text-9xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-700 tracking-wider">
                    404
                </h1>
                <div class="absolute inset-0 flex items-center justify-center opacity-10">
                    <i class="fa-solid fa-compass text-9xl animate-spin" style="animation-duration: 20s"></i>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-3">Halaman Tidak Ditemukan</h2>
            <p class="text-gray-600 mb-8 leading-relaxed">
                Maaf, halaman yang Anda cari tidak ditemukan atau telah dipindahkan ke alamat lain.
            </p>

            <!-- Navigation Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-6 py-3.5 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-house mr-2"></i>
                    Kembali ke Beranda
                </a>
                <a href="{{ App\Models\Contact::getMainContact()?->whatsapp_link ?? '#' }}" target="_blank" class="inline-flex items-center justify-center px-6 py-3.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold rounded-xl shadow-sm hover:shadow transition-all duration-300 transform hover:-translate-y-0.5">
                    <i class="fa-brands fa-whatsapp text-green-500 mr-2"></i>
                    Hubungi Bantuan
                </a>
            </div>
        </div>

        <!-- Footer Note -->
        <p class="text-gray-400 text-xs mt-8">
            &copy; {{ date('Y') }} PT Fabi Abadi. All Rights Reserved.
        </p>
    </div>
</body>
</html>
