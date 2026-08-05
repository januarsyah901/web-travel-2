<section id="testimoni" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-24">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Partner Kami</h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto mb-4 rounded-full"></div>
                <p class="text-gray-600">Bekerjasama dengan mitra terpercaya untuk layanan terbaik</p>
            </div>

            @php
                $partners = \App\Models\Partner::take(8)->get();
            @endphp

            @if($partners->isNotEmpty())
            <div class="swiper partnerSwiper !pb-12"> 
                <div class="swiper-wrapper items-center">
                    @foreach($partners as $partner)
                        <div class="swiper-slide">
                            <div class="bg-white border border-gray-100 rounded-lg p-6 flex items-center justify-center hover:shadow-lg transition h-32 mx-2">
                                @if($partner->logo_path)
                                    <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="max-h-16 w-auto object-contain transition duration-300">
                                @else
                                    <span class="text-gray-400 font-bold text-center">{{ $partner->name }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            @else
            <div class="text-center py-8">
                <h3 class="text-lg font-bold text-gray-800 mb-1">Partner Belum Tersedia</h3>
                <p class="text-gray-500 text-sm">Daftar mitra terpercaya akan segera diperbarui.</p>
            </div>
            @endif
        </div>


        <div>
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Testimoni Jamaah</h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto mb-4 rounded-full"></div>
                <p class="text-gray-600">Apa kata mereka yang telah bergabung bersama kami</p>
            </div>

            @php
                $testimonials = \App\Models\Testimonial::orderBy('created_at', 'desc')->get();
            @endphp

            @if($testimonials->isNotEmpty())
            <div class="swiper testimoniSwiper !pb-12">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="bg-white border border-gray-200 rounded-lg p-8 shadow-md hover:shadow-lg transition h-full flex flex-col">
                                <!-- Star Rating -->
                                <div class="flex items-center gap-1 mb-4">
                                    @for ($i = 0; $i < $testimonial->rating; $i++)
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"></path>
                                        </svg>
                                    @endfor
                                </div>

                                <!-- Testimoni Text -->
                                <p class="text-gray-700 mb-6 flex-grow text-sm md:text-base leading-relaxed italic">
                                    "{{ $testimonial->content }}"
                                </p>

                                <!-- Author Info -->
                                <div class="flex items-center gap-3 border-t border-gray-100 pt-4">
                                    @if($testimonial->author_photo)
                                        <img src="{{ asset('storage/' . $testimonial->author_photo) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white font-bold text-lg">
                                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $testimonial->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $testimonial->review_time ?? 'Recently' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            @else
            <div class="text-center py-8">
                <h3 class="text-base font-bold text-gray-800 mb-1">Belum Ada Testimoni</h3>
                <p class="text-gray-500 text-sm">Ulasan dan cerita perjalanan dari jamaah kami akan segera ditampilkan.</p>
            </div>
            @endif
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
        if (document.querySelector('.partnerSwiper')) {
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
        }

        // 2. Konfigurasi Testimoni Carousel
        if (document.querySelector('.testimoniSwiper')) {
            new Swiper(".testimoniSwiper", {
                slidesPerView: 1,       // HP: 1 Testimoni (Fokus)
                spaceBetween: 20,
                loop: true,
                autoHeight: true,       // Menyesuaikan tinggi di HP
                autoplay: {
                    delay: 5000,        // Gulir setiap 5 detik
                    disableOnInteraction: false,
                },
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
        }
    });
</script>
