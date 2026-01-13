<section id="testimoni" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-24">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Partner Kami</h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto mb-4 rounded-full"></div>
                <p class="text-gray-600">Bekerjasama dengan mitra terpercaya untuk layanan terbaik</p>
            </div>

            <div class="swiper partnerSwiper !pb-12"> <div class="swiper-wrapper items-center">
                    @php
                        $partners = \App\Models\Partner::take(8)->get();
                    @endphp
                    @forelse($partners as $partner)
                        <div class="swiper-slide">
                            <div class="bg-white border border-gray-100 rounded-lg p-6 flex items-center justify-center hover:shadow-lg transition h-32 mx-2">
                                @if($partner->logo_path)
                                    <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="max-h-16 w-auto object-contain  transition duration-300">
                                @else
                                    <span class="text-gray-400 font-bold text-center">{{ $partner->name }}</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center w-full">
                            <p class="text-gray-600">Partner akan segera ditampilkan.</p>
                        </div>
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>


        <div>
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Testimoni Jamaah</h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto mb-4 rounded-full"></div>
                <p class="text-gray-600">Apa kata mereka yang telah bergabung bersama kami</p>
            </div>
            <script defer async src='https://cdn.trustindex.io/loader.js?c4afbcf618479654c27611e8e23'></script>
        </div>
    </div>
</section>

<style>
    .swiper-pagination-bullet-active {
        background-color: #ea580c !important; /* Orange-600 */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Konfigurasi Partner Carousel
        new Swiper(".partnerSwiper", {
            slidesPerView: 2,       // HP: 2 Logo
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4, // Desktop: 4 Logo
                    spaceBetween: 30,
                },
            },
        });

        // 2. Konfigurasi Testimoni Carousel
        new Swiper(".testimoniSwiper", {
            slidesPerView: 1,       // HP: 1 Testimoni (Fokus)
            spaceBetween: 20,
            loop: true,
            autoHeight: true,       // Menyesuaikan tinggi di HP
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2, // Tablet: 2 Testimoni
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3, // Desktop: 3 Testimoni
                    spaceBetween: 30,
                },
            },
        });
    });
</script>
