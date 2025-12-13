<!-- Galeri Section -->
<section id="galeri" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Galeri Kegiatan</h2>
            <div class="w-20 h-1 bg-orange-600 mx-auto mb-4"></div>
            <p class="text-gray-600">Dokumentasi perjalanan umroh bersama PT Fabi Abadi</p>
        </div>

        @php
            $galleries = \App\Models\Gallery::take(8)->get();
        @endphp

        <div class="relative">
            <!-- Navigation Buttons -->
            <button type="button" class="galeri-prev absolute -left-4 lg:-left-12 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-orange-600 hover:bg-orange-600 hover:text-white transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button type="button" class="galeri-next absolute -right-4 lg:-right-12 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-orange-600 hover:bg-orange-600 hover:text-white transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <div class="swiper galeriSwiper overflow-hidden rounded-xl">
                <div class="swiper-wrapper">
                    @forelse($galleries as $gallery)
                        <div class="swiper-slide">
                            <div class="relative h-56 md:h-96">
                                @if($gallery->image_path)
                                    <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                         class="w-full h-full object-cover"
                                         alt="{{ $gallery->title }}">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-orange-100 to-orange-200 flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-orange-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-orange-600 text-lg font-semibold">{{ $gallery->title ?? 'Galeri' }}</span>
                                        <span class="text-orange-400 text-sm mt-1">Gambar tidak tersedia</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="relative h-56 md:h-96 bg-gradient-to-br from-gray-100 to-gray-200 flex flex-col items-center justify-center rounded-xl">
                                <svg class="w-20 h-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-gray-500 text-lg font-medium">Galeri Kosong</p>
                                <p class="text-gray-400 text-sm mt-1">Dokumentasi perjalanan akan segera ditampilkan</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="swiper-pagination galeri-pagination mt-4"></div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var galeriSwiper = new Swiper(".galeriSwiper", {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        grabCursor: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".galeri-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: ".galeri-next",
            prevEl: ".galeri-prev",
        },
    });
});
</script>

<style>
    .galeri-pagination .swiper-pagination-bullet-active {
        background-color: #ea580c !important;
    }
</style>
