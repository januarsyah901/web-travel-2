<section id="paket" class="py-24 bg-gray-50 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 opacity-30 pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-orange-200 blur-3xl"></div>
        <div class="absolute top-1/2 -left-24 w-72 h-72 rounded-full bg-blue-100 blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Pilihan Paket Umroh</h2>
            <div class="w-20 h-1 bg-orange-600 mx-auto mb-4"></div>
            <p class="text-gray-600">Temukan paket ibadah yang sesuai dengan kebutuhan spiritual dan budget Anda</p>
        </div>

        <div class="relative">
            <!-- Navigation Buttons -->
            <button class="paket-prev absolute -left-4 lg:-left-12 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-orange-600 hover:bg-orange-600 hover:text-white transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button class="paket-next absolute -right-4 lg:-right-12 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-orange-600 hover:bg-orange-600 hover:text-white transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <div class="swiper paketSwiper !pb-12">
                <div class="swiper-wrapper">
                    @forelse($packages as $package)
                        <div class="swiper-slide h-auto p-2">
                            <div class="group relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-2 flex flex-col h-full">

                                <div class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-orange-400 to-orange-600 rounded-t-3xl"></div>

                                <div class="mb-6">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-orange-600 transition-colors">{{ $package->name }}</h3>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-sm text-gray-500 font-medium">Mulai dari</span>
                                    </div>
                                    <div class="mt-2 flex items-baseline text-orange-600">
                                        <span class="text-lg font-semibold mr-1">Rp</span>
                                        <span class="text-4xl font-extrabold tracking-tight">{{ number_format($package->price, 0, ',', '.') }}</span>
                                    </div>
                                    <p class="text-sm text-gray-400 mt-1">per jamaah</p>
                                </div>

                                <div class="w-full h-px bg-gray-100 mb-6"></div>

                                <ul class="space-y-4 mb-8 flex-grow">
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center mt-0.5">
                                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <span class="ml-3 text-gray-600 font-medium self-center">{{ $package->duration }} Hari Perjalanan</span>
                                    </li>

                                    <li class="flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center mt-0.5">
                                            <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        </div>
                                        <span class="ml-3 text-gray-600 font-medium self-center">Fasilitas Hotel Bintang {{ $package->hotel_star ?? '4' }}</span>
                                    </li>

                                    @if($package->description)
                                        <li class="flex items-start">
                                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-50 flex items-center justify-center mt-0.5">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                            <span class="ml-3 text-gray-600 text-sm leading-relaxed">{{ Str::limit($package->description, 80) }}</span>
                                        </li>
                                    @endif
                                </ul>

                                <div class="mt-auto">
                                    <a href="{{ route('registration.form', ['package' => $package->id]) }}"
                                       class="block w-full py-4 px-6 bg-orange-600 border-2 border-orange-600 text-white font-bold rounded-xl text-center hover:bg-orange-700 hover:border-orange-700 transition-all duration-300 shadow-md hover:shadow-lg focus:ring-4 focus:ring-orange-200">
                                        Pilih Paket Ini
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-300">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada paket tersedia</h3>
                                <p class="mt-1 text-sm text-gray-500">Silakan hubungi admin untuk informasi lebih lanjut.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="swiper-pagination paket-pagination"></div>
            </div>
        </div>

        <div class="mt-16 text-center">
            <p class="text-gray-500">Butuh penawaran khusus untuk rombongan?</p>
            <a href="#" class="inline-flex items-center mt-2 text-orange-600 font-semibold hover:text-orange-700">
                Hubungi Konsultan Kami
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var paketSwiper = new Swiper(".paketSwiper", {
            slidesPerView: 1,
            spaceBetween: 16,
            loop: true,
            grabCursor: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".paket-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: ".paket-next",
                prevEl: ".paket-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 24,
                },
            },
        });
    });
</script>

<style>
    .paket-pagination .swiper-pagination-bullet-active {
        background-color: #ea580c !important;
    }
</style>
