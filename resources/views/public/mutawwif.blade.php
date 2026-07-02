<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<section id="mutawwif" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Tour Leader</h2>
            <div class="w-20 h-1 bg-orange-600 mx-auto mb-4"></div>
            <p class="text-gray-600">Dipandu oleh pembimbing ibadah berpengalaman dan bersertifikat</p>
        </div>

        @php
            $mutawwifs = \App\Models\Mutawwif::take(8)->get();
        @endphp

        @if($mutawwifs->isNotEmpty())
        <div class="relative">
            <!-- Navigation Buttons - Outside Swiper -->
            <button class="swiper-button-prev-custom absolute -left-4 lg:-left-12 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-orange-600 hover:bg-orange-600 hover:text-white transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button class="swiper-button-next-custom absolute -right-4 lg:-right-12 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-orange-600 hover:bg-orange-600 hover:text-white transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <div class="swiper mySwiper !pb-12 !px-2">
                <div class="swiper-wrapper">
                    @foreach($mutawwifs as $mutawwif)
                        <div class="swiper-slide h-auto p-2">
                            <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div class="relative w-full aspect-square">
                                    @if($mutawwif->photo_path)
                                        <img src="{{ asset('storage/' . $mutawwif->photo_path) }}"
                                             alt="{{ $mutawwif->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-orange-100 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-orange-300" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4 text-center">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $mutawwif->name }}</h3>
                                    <p class="text-sm text-orange-600">{{ $mutawwif->specialization ?? 'Pembimbing Ibadah' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </div>
        @else
        <div class="max-w-md mx-auto text-center py-12 px-6 bg-white rounded-2xl border border-dashed border-orange-200 shadow-sm">
            <div class="w-14 h-14 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">Tour Leader Belum Tersedia</h3>
            <p class="text-gray-500 text-sm">Pembimbing ibadah dan tour leader berpengalaman akan segera kami rilis.</p>
        </div>
        @endif
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@if($mutawwifs->isNotEmpty())
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 16,
        loop: true,
        grabCursor: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: ".swiper-button-next-custom",
            prevEl: ".swiper-button-prev-custom",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 16,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        },
    });
</script>
@endif

<style>
    .swiper-pagination-bullet-active {
        background-color: #ea580c !important;
    }
</style>
