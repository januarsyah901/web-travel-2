<!-- Hero Section -->
<section id="home"
         class="pt-16 bg-cover bg-center text-white relative min-h-screen flex items-center"
         style="background-image: url('{{ asset('img/img/hero.png') }}'); background-attachment: fixed;">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32 relative z-10 w-full">
        <div class="text-center">
            <h1 class="text-4xl text-orange-500 md:text-6xl font-bold mb-6">Wujudkan Impian Umroh Anda</h1>
            <p class="text-xl md:text-2xl mb-8">
                Bersama PT Fabi Abadi, perjalanan ibadah Anda adalah prioritas kami
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('registration.form') }}"
                   class="bg-white text-orange-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Daftar Sekarang
                </a>
                <a href="#paket"
                   class="nav-link bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-orange-700 transition shadow-lg">
                    Lihat Paket
                </a>
            </div>
        </div>
    </div>
</section>

