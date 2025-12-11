<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Fabi Abadi - Travel Umroh Terpercaya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-gray-50">
{{-- Tangkap Pesan Success atau Error --}}
    @if(session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif
    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-orange-600">PT Fabi Abadi</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-orange-600 transition">Beranda</a>
                    <a href="#tentang" class="text-gray-700 hover:text-orange-600 transition">Tentang</a>
                    <a href="#layanan" class="text-gray-700 hover:text-orange-600 transition">Layanan</a>
                    <a href="#paket" class="text-gray-700 hover:text-orange-600 transition">Paket</a>
                    <a href="#mutawwif" class="text-gray-700 hover:text-orange-600 transition">Mutawwif</a>
                    <a href="#testimoni" class="text-gray-700 hover:text-orange-600 transition">Testimoni</a>
                    <a href="#galeri" class="text-gray-700 hover:text-orange-600 transition">Galeri</a>
                    <a href="#kontak" class="text-gray-700 hover:text-orange-600 transition">Kontak</a>
                    <a href="{{ route('registration.form') }}" class="bg-orange-600 text-white px-6 py-2 rounded-lg hover:bg-orange-700 transition">Daftar Sekarang</a>
                </div>
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-orange-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <a href="#home" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Beranda</a>
            <a href="#tentang" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Tentang</a>
            <a href="#layanan" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Layanan</a>
            <a href="#paket" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Paket</a>
            <a href="#mutawwif" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Mutawwif</a>
            <a href="#testimoni" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Testimoni</a>
            <a href="#galeri" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Galeri</a>
            <a href="#kontak" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Kontak</a>
            <a href="{{ route('registration.form') }}" class="block px-4 py-3 bg-orange-600 text-white hover:bg-orange-700 text-center">Daftar Sekarang</a>
        </div>
    </nav>

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
                   class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-orange-600 transition">
                    Lihat Paket
                </a>
            </div>
        </div>
    </div>
</section>



<!-- Tentang Section -->
    <section id="tentang" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Tentang Kami</h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto"></div>
            </div>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">PT Fabi Abadi</h3>
                    <p class="text-gray-600 mb-4">
                        PT Fabi Abadi adalah perusahaan travel umroh terpercaya yang telah melayani ribuan jamaah dalam mewujudkan impian mereka untuk beribadah di Tanah Suci.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Dengan pengalaman bertahun-tahun, kami berkomitmen memberikan pelayanan terbaik dengan harga yang terjangkau dan fasilitas yang lengkap.
                    </p>
                    <p class="text-gray-600 mb-6">
                        Kepuasan dan kenyamanan jamaah adalah prioritas utama kami dalam setiap perjalanan umroh yang kami selenggarakan.
                    </p>
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div class="bg-orange-50 p-4 rounded-lg">
                            <div class="text-3xl font-bold text-orange-600">10+</div>
                            <div class="text-sm text-gray-600">Tahun Pengalaman</div>
                        </div>
                        <div class="bg-orange-50 p-4 rounded-lg">
                            <div class="text-3xl font-bold text-orange-600">5000+</div>
                            <div class="text-sm text-gray-600">Jamaah</div>
                        </div>
                        <div class="bg-orange-50 p-4 rounded-lg">
                            <div class="text-3xl font-bold text-orange-600">100%</div>
                            <div class="text-sm text-gray-600">Terpercaya</div>
                        </div>
                    </div>
                </div>
                <div class="bg-orange-100 rounded-lg h-96 flex items-center justify-center">
                    <span class="text-orange-600 text-xl">Gambar Tentang</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Section -->
    <section id="layanan" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Layanan Kami</h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto"></div>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Hotel Bintang 5</h3>
                    <p class="text-gray-600">Penginapan nyaman dan strategis dekat dengan Masjidil Haram dan Masjid Nabawi.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Pembimbingan Ibadah</h3>
                    <p class="text-gray-600">Mutawwif profesional dan berpengalaman siap membimbing ibadah Anda.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Katering Halal</h3>
                    <p class="text-gray-600">Makanan halal dan bergizi sesuai dengan selera Indonesia.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">City Tour</h3>
                    <p class="text-gray-600">Kunjungan ke tempat-tempat bersejarah di Mekkah dan Madinah.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Jadwal Fleksibel</h3>
                    <p class="text-gray-600">Berbagai pilihan jadwal keberangkatan sesuai kebutuhan Anda.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Pengurusan Visa</h3>
                    <p class="text-gray-600">Kami bantu pengurusan visa dan dokumen perjalanan Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Paket Umroh Section -->
    <section id="paket" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Paket Umroh</h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto mb-4"></div>
                <p class="text-gray-600">Pilih paket umroh yang sesuai dengan kebutuhan dan budget Anda</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @forelse($packages as $package)
                <div class="bg-white border-2 border-gray-200 rounded-lg overflow-hidden hover:border-orange-600 hover:shadow-xl transition">
                    <div class="bg-orange-600 text-white text-center py-4">
                        <h3 class="text-2xl font-bold">{{ $package->name }}</h3>
                    </div>
                    <div class="p-8">
                        <div class="text-center mb-6">
                            <div class="text-4xl font-bold text-orange-600">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                            <div class="text-gray-600">per orang</div>
                        </div>
                        <div class="space-y-3 mb-8">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-600">{{ $package->duration }} Hari</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-600">Hotel Bintang {{ $package->hotel_star ?? '4-5' }}</span>
                            </div>
                            @if($package->description)
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-600">{{ Str::limit($package->description, 50) }}</span>
                            </div>
                            @endif
                        </div>
                        <a href="{{ route('registration.form') }}" class="block w-full bg-orange-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-orange-700 transition">Daftar Paket Ini</a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-600">Belum ada paket umroh tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Mutawwif Section -->
    <section id="mutawwif" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Mutawwif Profesional</h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto mb-4"></div>
                <p class="text-gray-600">Dipandu oleh mutawwif berpengalaman dan bersertifikat</p>
            </div>
            <div class="grid md:grid-cols-4 gap-8">
                @php
                    $mutawwifs = \App\Models\Mutawwif::take(4)->get();
                @endphp
                @forelse($mutawwifs as $mutawwif)
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                    @if($mutawwif->photo_path)
                    <img src="{{ asset('storage/' . $mutawwif->photo_path) }}" alt="{{ $mutawwif->name }}" class="w-full h-96 object-cover">
                    @else
                    <div class="w-full h-64 bg-orange-100 flex items-center justify-center">
                        <svg class="w-24 h-24 text-orange-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    @endif
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $mutawwif->name }}</h3>
                        <p class="text-orange-600 mb-3">{{ $mutawwif->specialization ?? 'Mutawwif' }}</p>
                        @if($mutawwif->experience)
                        <p class="text-sm text-gray-600">{{ $mutawwif->experience }} tahun pengalaman</p>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-4 text-center py-12">
                    <p class="text-gray-600">Informasi mutawwif akan segera ditampilkan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Galeri Kegiatan</h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto mb-4"></div>
                <p class="text-gray-600">Dokumentasi perjalanan umroh bersama PT Fabi Abadi</p>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                @php
                    $galleries = \App\Models\Gallery::take(8)->get();
                @endphp
                @forelse($galleries as $gallery)
                <div class="relative overflow-hidden rounded-lg group cursor-pointer">
                    @if($gallery->image_path)
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="h-80 w-150 object-cover group-hover:scale-110 transition duration-300">
                    @else
                    <div class="w-full h-64 bg-orange-100 flex items-center justify-center">
                        <span class="text-orange-600">{{ $gallery->title }}</span>
                    </div>
                    @endif
                </div>
                @empty
                <div class="col-span-4 text-center py-12">
                    <p class="text-gray-600">Galeri akan segera ditampilkan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Form Pendaftaran Section -->
    <section id="pendaftaran" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Daftar Sekarang</h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto mb-4"></div>
                <p class="text-gray-600">Segera wujudkan impian ibadah umroh Anda bersama kami</p>
            </div>
            <div class="bg-orange-50 p-8 rounded-lg text-center">
                <p class="text-gray-700 mb-6">Untuk pendaftaran yang lebih lengkap dan detail, silakan klik tombol di bawah ini:</p>
                <a href="{{ route('registration.form') }}" class="inline-block bg-orange-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-orange-700 transition text-lg">
                    Formulir Pendaftaran Lengkap
                </a>
            </div>
        </div>
    </section>

    <!-- Partner & Testimoni Section -->
    <section id="testimoni" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Partner -->
            <div class="mb-20">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Partner Kami</h2>
                    <div class="w-20 h-1 bg-orange-600 mx-auto"></div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @php
                        $partners = \App\Models\Partner::take(8)->get();
                    @endphp
                    @forelse($partners as $partner)
                        <div class="bg-white border rounded-lg p-6 flex items-center justify-center hover:shadow-lg transition">
                            @if($partner->logo_path)
                                <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="max-h-20 object-contain">
                            @else
                                <span class="text-gray-400 text-center">{{ $partner->name }}</span>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-4 text-center py-12">
                            <p class="text-gray-600">Partner akan segera ditampilkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>


            <!-- Testimoni -->
            <div>
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Testimoni Jamaah</h2>
                    <div class="w-20 h-1 bg-orange-600 mx-auto mb-4"></div>
                    <p class="text-gray-600">Apa kata mereka yang telah bergabung bersama kami</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    @php
                        $testimonials = \App\Models\Testimonial::latest()->take(3)->get();
                    @endphp
                    @forelse($testimonials as $testimonial)
                        <div class="bg-orange-50 p-8 rounded-lg">
                            <div class="flex items-center mb-4">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-gray-700 mb-4">"{{ $testimonial->content }}"</p>
                            <div class="flex items-center">
                                @if($testimonial->photo)
                                    <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover mr-4">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-orange-200 flex items-center justify-center mr-4">
                                        <span class="text-orange-600 font-bold">{{ substr($testimonial->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <div class="font-bold text-gray-800">{{ $testimonial->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $testimonial->city ?? 'Jamaah' }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <p class="text-gray-600">Testimoni akan segera ditampilkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links Section -->
    <section class="py-20 bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 text-orange-400">PT Fabi Abadi</h3>
                    <p class="text-gray-300">Travel umroh terpercaya dengan pelayanan terbaik untuk perjalanan ibadah Anda.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4 text-orange-400">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-300 hover:text-orange-400 transition">Beranda</a></li>
                        <li><a href="#tentang" class="text-gray-300 hover:text-orange-400 transition">Tentang Kami</a></li>
                        <li><a href="#paket" class="text-gray-300 hover:text-orange-400 transition">Paket Umroh</a></li>
                        <li><a href="#testimoni" class="text-gray-300 hover:text-orange-400 transition">Testimoni</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4 text-orange-400">Layanan</h3>
                    <ul class="space-y-2">
                        <li><a href="#layanan" class="text-gray-300 hover:text-orange-400 transition">Layanan Kami</a></li>
                        <li><a href="#mutawwif" class="text-gray-300 hover:text-orange-400 transition">Mutawwif</a></li>
                        <li><a href="#galeri" class="text-gray-300 hover:text-orange-400 transition">Galeri</a></li>
                        <li><a href="{{ route('registration.form') }}" class="text-gray-300 hover:text-orange-400 transition">Pendaftaran</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4 text-orange-400">Kontak</h3>
                    @if($contact)
                    <ul class="space-y-2 text-gray-300">
                        <li>{{ $contact->phone }}</li>
                        <li>{{ $contact->email }}</li>
                        <li>{{ Str::limit($contact->address, 50) }}</li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; {{ date('Y') }} PT Fabi Abadi. All Rights Reserved.</p>
        </div>
    </footer>
    @push('scripts')
        <script>
            <!-- Mobile Menu Toggle Script -->

            document.getElementById('mobile-menu-button').addEventListener('click', function() {
                const mobileMenu = document.getElementById('mobile-menu');
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu when clicking on a link
            document.querySelectorAll('#mobile-menu a').forEach(link => {
                link.addEventListener('click', function() {
                    document.getElementById('mobile-menu').classList.add('hidden');
                });
            });
        </script>
    @endpush
</body>
</html>

