<nav id="navbar" class="fixed w-full top-0 z-50 transition-all duration-300 bg-white/90 backdrop-blur-md shadow-sm border-b border-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="navbar-container" class="flex justify-between items-center h-20 transition-all duration-300">
            <!-- Kiri: Logo -->
            <div class="flex-1 lg:flex-initial lg:w-1/4 flex justify-start items-center">
                <a href="#home" class="flex items-center gap-3 group">
                    <img id="navbar-logo" src="{{ asset('img/img/vertical_logo.png') }}" alt="PT Fabi Abadi Logo" class="h-16 w-auto object-contain transition-all duration-300 group-hover:scale-105">
                </a>
            </div>

            <!-- Tengah: Menu Navigasi (Perfect Centering) -->
            <div class="hidden lg:flex lg:w-2/4 justify-center items-center gap-6 xl:gap-8">
                <a href="#home" class="nav-link text-sm font-medium text-gray-600 hover:text-orange-600 transition duration-300">Beranda</a>
                <a href="#tentang" class="nav-link text-sm font-medium text-gray-600 hover:text-orange-600 transition duration-300">Tentang</a>
                <a href="#paket" class="nav-link text-sm font-medium text-gray-600 hover:text-orange-600 transition duration-300">Paket</a>
                <a href="#testimoni" class="nav-link text-sm font-medium text-gray-600 hover:text-orange-600 transition duration-300">Testimoni</a>
                <a href="#kontak" class="nav-link text-sm font-medium text-gray-600 hover:text-orange-600 transition duration-300">Kontak</a>
            </div>

            <!-- Kanan: Tombol Daftar & Hamburger Menu -->
            <div class="flex-1 lg:flex-initial lg:w-1/4 flex justify-end items-center gap-4">
                <div class="hidden lg:block">
                    <a href="{{ route('registration.index') }}" class="bg-orange-600 text-white px-5 py-2.5 rounded-full font-medium hover:bg-orange-700 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 text-sm">
                        Daftar Sekarang
                    </a>
                </div>
                
                <button id="mobile-menu-button" class="lg:hidden text-gray-600 hover:text-orange-600 focus:outline-none p-2 rounded-md flex flex-col justify-center items-center gap-1.5 w-10 h-10" aria-label="Toggle Menu">
                    <span class="w-6 h-0.5 bg-current transition-all duration-300 origin-center" id="hamburger-line-1"></span>
                    <span class="w-6 h-0.5 bg-current transition-all duration-300" id="hamburger-line-2"></span>
                    <span class="w-6 h-0.5 bg-current transition-all duration-300 origin-center" id="hamburger-line-3"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden bg-white border-t border-gray-100 shadow-lg max-h-0 overflow-hidden transition-all duration-300 ease-in-out overflow-y-auto">
        <div class="px-4 pt-2 pb-6 space-y-1">
            <a href="#home" class="mobile-link block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition">Beranda</a>
            <a href="#tentang" class="mobile-link block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition">Tentang</a>
            <a href="#paket" class="mobile-link block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition">Paket</a>
            <a href="#testimoni" class="mobile-link block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition">Testimoni</a>
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
    /* Styling tambahan untuk Active State dan Hover Underline Effect */
    .nav-link {
        position: relative;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 50%;
        background-color: #ea580c; /* orange-600 */
        transition: all 0.3s ease-in-out;
        transform: translateX(-50%);
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }

    .nav-link.active {
        color: #ea580c; /* orange-600 */
        font-weight: 600;
    }

    .mobile-link {
        transition: all 0.2s ease-in-out;
    }

    .mobile-link.active {
        background-color: #fff7ed; /* orange-50 */
        color: #ea580c; /* orange-600 */
        font-weight: 600;
        border-left: 4px solid #ea580c;
    }

    /* Hamburger Menu Spans Animation styles */
    #mobile-menu-button.open #hamburger-line-1 {
        transform: rotate(45deg) translateY(8px);
    }
    
    #mobile-menu-button.open #hamburger-line-2 {
        opacity: 0;
    }
    
    #mobile-menu-button.open #hamburger-line-3 {
        transform: rotate(-45deg) translateY(-8px);
    }
    
    #mobile-menu.open {
        max-height: 500px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('navbar');
        const navbarContainer = document.getElementById('navbar-container');
        const navbarLogo = document.getElementById('navbar-logo');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        // 1. Toggle Mobile Menu dengan animasi
        function toggleMenu() {
            const isOpen = mobileMenu.classList.contains('open');
            if (!isOpen) {
                mobileMenu.classList.add('open');
                mobileMenuButton.classList.add('open');
            } else {
                mobileMenu.classList.remove('open');
                mobileMenuButton.classList.remove('open');
            }
        }

        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', function(e) {
                e.stopPropagation(); // Mencegah event bubbling ke document
                toggleMenu();
            });
        }

        // Tutup menu mobile saat klik di luar area menu
        document.addEventListener('click', function(e) {
            if (mobileMenu && mobileMenu.classList.contains('open') && !mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                toggleMenu();
            }
        });

        // 2. Optimasi Event Scroll (requestAnimationFrame) untuk Ukuran Navbar & Logo
        function handleScroll() {
            if (window.scrollY > 20) {
                navbar.classList.add('bg-white/95', 'shadow-md', 'border-gray-100');
                navbar.classList.remove('bg-white/90', 'shadow-sm', 'border-transparent');
                if (navbarContainer) {
                    navbarContainer.classList.remove('h-20');
                    navbarContainer.classList.add('h-16');
                }
                if (navbarLogo) {
                    navbarLogo.classList.remove('h-16');
                    navbarLogo.classList.add('h-12');
                }
            } else {
                navbar.classList.add('bg-white/90', 'shadow-sm', 'border-transparent');
                navbar.classList.remove('bg-white/95', 'shadow-md', 'border-gray-100');
                if (navbarContainer) {
                    navbarContainer.classList.remove('h-16');
                    navbarContainer.classList.add('h-20');
                }
                if (navbarLogo) {
                    navbarLogo.classList.remove('h-12');
                    navbarLogo.classList.add('h-16');
                }
            }
        }

        let ticking = false;
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    handleScroll();
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });

        // Jalankan sekali saat load untuk setting state awal
        handleScroll();

        // 3. Smooth Scroll dengan offset yang disesuaikan
        const allLinks = document.querySelectorAll('.nav-link, .mobile-link');
        allLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href && href.startsWith('#')) {
                    e.preventDefault();
                    const targetId = href.substring(1);
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        const offset = 64; // Menyesuaikan dengan tinggi navbar kompak (h-16 = 64px)
                        const bodyRect = document.body.getBoundingClientRect().top;
                        const elementRect = targetElement.getBoundingClientRect().top;
                        const elementPosition = elementRect - bodyRect;
                        const offsetPosition = elementPosition - offset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });

                        // Tutup menu mobile jika sedang terbuka
                        if (mobileMenu && mobileMenu.classList.contains('open')) {
                            toggleMenu();
                        }
                    }
                }
            });
        });

        // 4. ScrollSpy dengan Performa Tinggi menggunakan Intersection Observer
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        const mobileLinks = document.querySelectorAll('.mobile-link');

        if ('IntersectionObserver' in window && sections.length > 0) {
            const observerOptions = {
                root: null,
                rootMargin: '-30% 0px -50% 0px', // Aktif ketika seksi berada di area tengah viewport
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        
                        navLinks.forEach(link => {
                            const href = link.getAttribute('href');
                            if (href === `#${id}`) {
                                link.classList.add('active');
                            } else {
                                link.classList.remove('active');
                            }
                        });

                        mobileLinks.forEach(link => {
                            const href = link.getAttribute('href');
                            if (href === `#${id}`) {
                                link.classList.add('active');
                            } else {
                                link.classList.remove('active');
                                link.blur(); // Mengurangi shadow/focus ring yang tidak diinginkan di mobile
                            }
                        });
                    }
                });
            }, observerOptions);

            sections.forEach(section => observer.observe(section));
        } else {
            // Fallback scrollspy untuk browser lama
            window.addEventListener('scroll', function() {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    if (window.scrollY >= (sectionTop - 100)) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${current}`) {
                        link.classList.add('active');
                    }
                });

                mobileLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${current}`) {
                        link.classList.add('active');
                    }
                });
            }, { passive: true });
        }
    });
</script>
