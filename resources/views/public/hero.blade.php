<!-- Hero Section -->
<section id="home"
         class="pt-20 bg-cover bg-center text-white relative min-h-screen flex items-center bg-scroll md:bg-fixed"
         style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.35) 60%, rgba(0, 0, 0, 0.05) 100%), url('{{ asset('img/img/hero.png') }}');">

    <!-- Gradasi Gelap dari Bawah Ke Atas Terang -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/35 to-transparent pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-32 relative z-10 w-full">
        <div class="text-center max-w-4xl mx-auto flex flex-col items-center justify-center">
            
            <h1 class="text-3xl sm:text-5xl md:text-6xl font-extrabold text-orange-500 mb-4 sm:mb-6 tracking-tight leading-tight drop-shadow-[0_4px_10px_rgba(0,0,0,0.8)]">
                Wujudkan Impian Umroh Anda
            </h1>

            <p class="text-base sm:text-xl md:text-2xl text-gray-100 mb-8 font-normal leading-relaxed max-w-2xl mx-auto drop-shadow-[0_2px_6px_rgba(0,0,0,0.8)]">
                Bersama PT Fabi Abadi, perjalanan ibadah Anda adalah prioritas kami
            </p>

            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center w-full sm:w-auto px-4 sm:px-0">
                <a href="{{ route('registration.index') }}"
                   class="w-full sm:w-auto bg-white text-orange-600 px-8 py-3.5 rounded-full font-semibold hover:bg-gray-100 transition duration-300 shadow-lg transform hover:-translate-y-0.5 text-center">
                    Daftar Sekarang
                </a>
                <a href="#paket"
                   class="w-full sm:w-auto bg-orange-600 text-white px-8 py-3.5 rounded-full font-semibold hover:bg-orange-700 transition duration-300 shadow-lg transform hover:-translate-y-0.5 text-center">
                    Lihat Paket
                </a>
            </div>

        </div>
    </div>
</section>



