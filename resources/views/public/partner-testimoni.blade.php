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

            <div class="swiper testimoniSwiper !pb-12">
                <div class="swiper-wrapper">
                    @php
                        $testimonials = \App\Models\Testimonial::latest()->take(6)->get(); // Ambil lebih dari 3 agar carousel desktop juga jalan
                    @endphp
                    @forelse($testimonials as $testimonial)
                        <div class="swiper-slide h-auto"> <div class="bg-orange-50 p-8 rounded-2xl h-full flex flex-col justify-between border border-orange-100/50">
                                <div>
                                    <div class="flex items-center mb-4">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364 1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-gray-700 mb-6 italic">"{{ Str::limit($testimonial->content, 150) }}"</p>
                                </div>

                                <div class="flex items-center pt-4 border-t border-orange-200/50">
                                    @if($testimonial->photo)
                                        <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover mr-4 ring-2 ring-white">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-orange-200 flex items-center justify-center mr-4 ring-2 ring-white">
                                            <span class="text-orange-600 font-bold text-lg">{{ substr($testimonial->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-bold text-gray-800">{{ $testimonial->name }}</div>
                                        <div class="text-sm text-gray-600">{{ $testimonial->city ?? 'Jamaah' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 w-full">
                            <p class="text-gray-600">Testimoni akan segera ditampilkan.</p>
                        </div>
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
            </div>
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
