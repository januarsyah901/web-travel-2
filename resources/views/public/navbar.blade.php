<nav id="navbar" class="fixed w-full top-0 z-50 transition-all duration-300 bg-white/95 backdrop-blur-md shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20"> <div class="flex items-center">
                <a href="#home" class="flex items-center gap-3 group">
                    <img src="{{ asset('img/img/vertical_logo.png') }}" alt="PT Fabi Abadi Logo" class="h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
            
                </a>
            </div>

            <div class="hidden lg:flex items-center space-x-6">
                <a href="#home" class="nav-link text-sm font-medium text-gray-600 hover:text-orange-600 transition duration-300">Beranda</a>
                <a href="#tentang" class="nav-link text-sm font-medium text-gray-600 hover:text-orange-600 transition duration-300">Tentang</a>
                <a href="#layanan" class="nav-link text-sm font-medium text-gray-600 hover:text-orange-600 transition duration-300">Layanan</a>
                <a href="#paket" class="nav-link text-sm font-medium text-gray-600 hover:text-orange-600 transition duration-300">Paket</a>
                <a href="#mutawwif" class="nav-link text-sm font-medium text-gray-600 hover:text-orange-600 transition duration-300">Mutawwif</a>
                <a href="#testimoni" class="nav-link text-sm font-medium text-gray-600 hover:text-orange-600 transition duration-300">Testimoni</a>
                <a href="#galeri" class="nav-link text-sm font-medium text-gray-600 hover:text-orange-600 transition duration-300">Galeri</a>
                <a href="#kontak" class="nav-link text-sm font-medium text-gray-600 hover:text-orange-600 transition duration-300">Kontak</a>

                <a href="{{ route('registration.index') }}" class="bg-orange-600 text-white px-5 py-2.5 rounded-full font-medium hover:bg-orange-700 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                    Daftar Sekarang
                </a>
            </div>

            <div class="lg:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-600 hover:text-orange-600 focus:outline-none p-2 rounded-md">
                    <svg class="h-8 w-8 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="hamburger-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-100 shadow-lg max-h-[80vh] overflow-y-auto">
        <div class="px-4 pt-2 pb-6 space-y-1">
            <a href="#home" class="mobile-link block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition">Beranda</a>
            <a href="#tentang" class="mobile-link block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition">Tentang</a>
            <a href="#layanan" class="mobile-link block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition">Layanan</a>
            <a href="#paket" class="mobile-link block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition">Paket</a>
            <a href="#mutawwif" class="mobile-link block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition">Mutawwif</a>
            <a href="#testimoni" class="mobile-link block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition">Testimoni</a>
            <a href="#galeri" class="mobile-link block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition">Galeri</a>
            <a href="#kontak" class="mobile-link block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition">Kontak</a>

            <div class="pt-4 mt-4 border-t border-gray-100">
                <a href="{{ route('registration.index') }}" class="block w-full text-center px-6 py-3 bg-orange-600 text-white rounded-lg font-bold hover:bg-orange-700 shadow-md transition">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Styling tambahan untuk Active State */
    .nav-link.active {
        color: #ea580c; /* orange-600 */
        font-weight: 600;
    }
    .mobile-link.active {
        background-color: #fff7ed; /* orange-50 */
        color: #ea580c; /* orange-600 */
        font-weight: 600;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('navbar');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');

        // 1. Toggle Mobile Menu
        function toggleMenu() {
            const isHidden = mobileMenu.classList.contains('hidden');
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                // Ubah icon jadi X
                hamburgerIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
            } else {
                mobileMenu.classList.add('hidden');
                // Ubah icon jadi Burger
                hamburgerIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
            }
        }

        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', function(e) {
                e.stopPropagation(); // Mencegah event bubbling ke document
                toggleMenu();
            });
        }

        // 2. Close Mobile Menu on Link Click
        const allLinks = document.querySelectorAll('.nav-link, .mobile-link');
        allLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href.startsWith('#')) {
                    e.preventDefault();
                    const targetId = href.substring(1);
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        // Smooth scroll manual
                        const offset = 80; // Sesuaikan dengan tinggi navbar
                        const bodyRect = document.body.getBoundingClientRect().top;
                        const elementRect = targetElement.getBoundingClientRect().top;
                        const elementPosition = elementRect - bodyRect;
                        const offsetPosition = elementPosition - offset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });

                        // Tutup menu mobile jika terbuka
                        if (!mobileMenu.classList.contains('hidden')) {
                            toggleMenu();
                        }
                    }
                }
            });
        });

        // 3. Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenu.classList.contains('hidden') && !mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                toggleMenu();
            }
        });

        // 4. ScrollSpy (Highlight menu active saat scroll)
        const sections = document.querySelectorAll('section'); // Pastikan section anda punya ID yang sesuai
        const navItems = document.querySelectorAll('.nav-link');
        const mobileItems = document.querySelectorAll('.mobile-link');

        window.addEventListener('scroll', () => {
            let current = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                // 100px offset untuk trigger lebih awal sebelum mencapai garis atas
                if (pageYOffset >= (sectionTop - 150)) {
                    current = section.getAttribute('id');
                }
            });

            // Update Desktop Menu
            navItems.forEach(li => {
                li.classList.remove('active');
                if (li.getAttribute('href').includes(current)) {
                    li.classList.add('active');
                }
            });

            // Update Mobile Menu
            mobileItems.forEach(li => {
                li.classList.remove('active');
                if (li.getAttribute('href').includes(current)) {
                    li.classList.add('active');
                }
            });
        });
    });
</script>
