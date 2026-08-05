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

        @if($packages->isNotEmpty())
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
                    @foreach($packages as $package)
                        <div class="swiper-slide h-auto p-2">
                            <div class="group relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-2 flex flex-col h-full">

                                <div class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-orange-400 to-orange-600 rounded-t-3xl"></div>

                                <div class="mb-6">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-orange-600 transition-colors">{{ $package->name }}</h3>
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
                                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <span class="ml-3 text-gray-600 font-medium self-center">{{ $package->schedule ?? 'Jadwal belum ditentukan' }}</span>
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
                                    <button
                                        type="button"
                                        onclick="openModalPaket({{ $package->toJson() }})"
                                        style="display:block;width:100%;background-color:#ea580c;color:#fff;padding:12px 20px;border-radius:9999px;font-weight:600;font-size:1rem;text-align:center;border:none;cursor:pointer;transition:background-color 0.2s;"
                                        onmouseover="this.style.backgroundColor='#c2410c'"
                                        onmouseout="this.style.backgroundColor='#ea580c'"
                                    >
                                        Lihat Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-pagination paket-pagination"></div>
            </div>
        </div>
        @else
        <div class="text-center py-8">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Paket Umroh Belum Tersedia</h3>
            <p class="text-gray-500 text-sm mb-6 leading-relaxed">Saat ini kami sedang mempersiapkan paket ibadah terbaik untuk Anda. Silakan hubungi kami untuk mendapatkan informasi terbaru.</p>
            <a href="{{ $contact ? $contact->whatsapp_link : '#' }}" target="_blank" class="inline-flex items-center justify-center px-6 py-3.5 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-full shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                Hubungi Kami via WhatsApp
            </a>
        </div>
        @endif

        <div class="mt-24 pt-16 border-t border-gray-200 text-center">
            <h3 class="text-4xl font-bold text-gray-800 mb-4">Penawaran Khusus Rombongan</h3>
            <div class="w-20 h-1 bg-orange-600 mx-auto mb-4"></div>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                Tim konsultan kami siap membantu menyusun paket ibadah terbaik untuk keluarga, komunitas, atau perusahaan Anda.
            </p>
            <a href="{{ $contact ? $contact->whatsapp_link : '#' }}" target="_blank"
               class="inline-flex items-center justify-center bg-orange-600 text-white px-8 py-3.5 rounded-full font-bold hover:bg-orange-700 transition-colors shadow-md text-base">
                Hubungi Konsultan Kami
            </a>
        </div>
    </div>
</section>

<!-- Modal Detail Paket -->
<div id="modal-paket-sederhana" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.8);backdrop-filter:blur(4px);align-items:center;justify-content:center;padding:16px;">
    <div style="background:#fff;border-radius:24px;width:100%;max-width:680px;box-shadow:0 25px 50px rgba(0,0,0,0.3);overflow:hidden;display:flex;flex-direction:column;max-height:90vh;">
        <!-- Header -->
        <div style="padding:24px 28px;border-bottom:1px solid #f3f4f6;display:flex;justify-content:space-between;align-items:center;">
            <h3 style="font-size:1.25rem;font-weight:700;color:#1f2937;margin:0;">Detail Paket Umroh</h3>
            <button onclick="closeModalPaket()" style="background:none;border:none;cursor:pointer;color:#9ca3af;padding:4px;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#9ca3af'">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <!-- Body -->
        <div style="padding:28px;overflow-y:auto;flex:1;">
            <h4 id="m-title" style="font-size:1.75rem;font-weight:800;color:#ea580c;margin:0 0 4px 0;"></h4>
            <p style="font-size:2rem;font-weight:800;color:#1f2937;margin:0 0 24px 0;">Rp <span id="m-price"></span></p>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:24px;">
                <div style="border:1px solid #f3f4f6;padding:16px;border-radius:16px;">
                    <p style="font-size:11px;color:#6b7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 4px 0;">Durasi</p>
                    <p id="m-duration" style="font-weight:700;color:#1f2937;font-size:1rem;margin:0;"></p>
                </div>
                <div style="border:1px solid #f3f4f6;padding:16px;border-radius:16px;">
                    <p style="font-size:11px;color:#6b7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 4px 0;">Waktu Keberangkatan</p>
                    <p id="m-schedule" style="font-weight:700;color:#1f2937;font-size:1rem;margin:0;"></p>
                </div>
                <div style="border:1px solid #f3f4f6;padding:16px;border-radius:16px;">
                    <p style="font-size:11px;color:#6b7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 4px 0;">Hotel Makkah</p>
                    <p id="m-hotel-makkah" style="font-weight:700;color:#1f2937;font-size:1rem;margin:0;"></p>
                </div>
                <div style="border:1px solid #f3f4f6;padding:16px;border-radius:16px;">
                    <p style="font-size:11px;color:#6b7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 4px 0;">Hotel Madinah</p>
                    <p id="m-hotel-madinah" style="font-weight:700;color:#1f2937;font-size:1rem;margin:0;"></p>
                </div>
            </div>

            <div style="border:1px solid #f3f4f6;padding:20px;border-radius:16px;">
                <p style="font-size:11px;color:#6b7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 8px 0;">Deskripsi & Fasilitas Lengkap</p>
                <p id="m-desc" style="color:#374151;font-size:0.95rem;line-height:1.7;white-space:pre-wrap;margin:0;"></p>
            </div>
        </div>
        <!-- Footer -->
        <div style="padding:20px 28px;border-top:1px solid #f3f4f6;display:flex;gap:12px;flex-wrap:wrap;">
            <a href="#" id="m-link-konsultasi" target="_blank"
               style="flex:1;min-width:160px;display:block;padding:14px 20px;border:2px solid #ea580c;color:#ea580c;text-align:center;font-weight:700;border-radius:9999px;text-decoration:none;font-size:1rem;transition:background-color 0.2s;"
               onmouseover="this.style.backgroundColor='#fff7ed'"
               onmouseout="this.style.backgroundColor='transparent'">
                Konsultasi Paket
            </a>
            <a href="#" id="m-link-daftar"
               style="flex:1;min-width:160px;display:block;padding:14px 20px;background-color:#ea580c;color:#fff;text-align:center;font-weight:700;border-radius:9999px;text-decoration:none;font-size:1rem;transition:background-color 0.2s;"
               onmouseover="this.style.backgroundColor='#c2410c'"
               onmouseout="this.style.backgroundColor='#ea580c'">
                Daftar Sekarang
            </a>
        </div>
    </div>
</div>

@if($packages->isNotEmpty())
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

        window.openModalPaket = function(pkg) {
            var nama = pkg.title || pkg.name || '-';
            document.getElementById('m-title').textContent = nama;
            document.getElementById('m-price').textContent = Number(pkg.price || 0).toLocaleString('id-ID');
            document.getElementById('m-duration').textContent = (pkg.duration || '-') + ' Hari';
            document.getElementById('m-schedule').textContent = pkg.schedule || '-';
            document.getElementById('m-hotel-makkah').textContent = pkg.hotel_makkah || '-';
            document.getElementById('m-hotel-madinah').textContent = pkg.hotel_madinah || '-';
            document.getElementById('m-desc').textContent = pkg.description || '-';
            document.getElementById('m-link-daftar').href = '/daftar?package=' + pkg.id;

            // Build WhatsApp konsultasi link
            var waBase = "{{ $contact ? preg_replace('/[^0-9]/', '', $contact->whatsapp) : '62' }}";
            var waText = encodeURIComponent('Halo, saya ingin konsultasi terkait paket umroh "' + nama + '".');
            document.getElementById('m-link-konsultasi').href = 'https://wa.me/' + waBase + '?text=' + waText;

            var modal = document.getElementById('modal-paket-sederhana');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        };

        window.closeModalPaket = function() {
            document.getElementById('modal-paket-sederhana').style.display = 'none';
            document.body.style.overflow = '';
        };

        // Close on backdrop click
        document.getElementById('modal-paket-sederhana').addEventListener('click', function(e) {
            if (e.target === this) closeModalPaket();
        });
    });
</script>
@endif

<style>
    .paket-pagination .swiper-pagination-bullet-active {
        background-color: #ea580c !important;
    }
</style>
