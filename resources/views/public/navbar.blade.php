<!-- Navbar -->
<nav class="bg-white shadow-lg fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <span class="text-2xl font-bold text-orange-600">PT Fabi Abadi</span>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="nav-link text-gray-700 hover:text-orange-600 transition">Beranda</a>
                <a href="#tentang" class="nav-link text-gray-700 hover:text-orange-600 transition">Tentang</a>
                <a href="#layanan" class="nav-link text-gray-700 hover:text-orange-600 transition">Layanan</a>
                <a href="#paket" class="nav-link text-gray-700 hover:text-orange-600 transition">Paket</a>
                <a href="#mutawwif" class="nav-link text-gray-700 hover:text-orange-600 transition">Mutawwif</a>
                <a href="#testimoni" class="nav-link text-gray-700 hover:text-orange-600 transition">Testimoni</a>
                <a href="#galeri" class="nav-link text-gray-700 hover:text-orange-600 transition">Galeri</a>
                <a href="#kontak" class="nav-link text-gray-700 hover:text-orange-600 transition">Kontak</a>
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
        <a href="#home" class="nav-link block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Beranda</a>
        <a href="#tentang" class="nav-link block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Tentang</a>
        <a href="#layanan" class="nav-link block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Layanan</a>
        <a href="#paket" class="nav-link block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Paket</a>
        <a href="#mutawwif" class="nav-link block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Mutawwif</a>
        <a href="#testimoni" class="nav-link block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Testimoni</a>
        <a href="#galeri" class="nav-link block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Galeri</a>
        <a href="#kontak" class="nav-link block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Kontak</a>
        <a href="{{ route('registration.form') }}" class="block px-4 py-3 bg-orange-600 text-white hover:bg-orange-700 text-center">Daftar Sekarang</a>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Smooth scrolling for nav links
    const navLinks = document.querySelectorAll('.nav-link');
    const navbarHeight = 64; // Height of fixed navbar (h-16 = 64px)

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');

            // Only handle anchor links
            if (href.startsWith('#')) {
                e.preventDefault();

                const targetId = href.substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Close mobile menu after clicking
                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                }
            }
        });
    });
});
</script>
