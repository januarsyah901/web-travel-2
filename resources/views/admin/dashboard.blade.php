<!DOCTYPE html>
<html lang="id">
@include('public.head')
<body class="bg-gray-100">

<!-- Mobile Menu Overlay -->
<div id="mobile-menu-overlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    @include('admin.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden w-full">
        <!-- Header -->
        <header class="bg-white shadow-sm z-10 sticky top-0">
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center gap-4">
                    <button id="hamburger-btn" onclick="toggleSidebar()" class="hamburger-menu text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 rounded-lg p-2 transition-colors">
                        <div class="hamburger-icon">
                            <span class="line line-1"></span>
                            <span class="line line-2"></span>
                            <span class="line line-3"></span>
                        </div>
                    </button>
                    <h2 class="text-xl font-bold text-gray-800 hidden sm:block">Dashboard Admin</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700 hidden md:inline">Hello, {{ Auth::guard('admin')->user()->name }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-red-600 transition-colors p-2 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt text-xl"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
            <!-- Success Alert -->
            @if(session('success'))
                <div id="success-alert"
                     class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 flex items-center justify-between shadow-md animate-fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-2xl mr-3"></i>
                        <div>
                            <p class="font-semibold">Berhasil!</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button onclick="closeAlert('success-alert')" class="text-green-700 hover:text-green-900">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            @endif

            <!-- Error Alert -->
            @if(session('error'))
                <div id="error-alert"
                     class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 flex items-center justify-between shadow-md animate-fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-2xl mr-3"></i>
                        <div>
                            <p class="font-semibold">Error!</p>
                            <p class="text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                    <button onclick="closeAlert('error-alert')" class="text-red-700 hover:text-red-900">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            @endif

            <!-- Warning Alert -->
            @if(session('warning'))
                <div id="warning-alert"
                     class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg mb-6 flex items-center justify-between shadow-md animate-fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-2xl mr-3"></i>
                        <div>
                            <p class="font-semibold">Peringatan!</p>
                            <p class="text-sm">{{ session('warning') }}</p>
                        </div>
                    </div>
                    <button onclick="closeAlert('warning-alert')" class="text-yellow-700 hover:text-yellow-900">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            @endif

            <!-- Dashboard Section -->
            @include('admin.sidebar.dashboard')
            <!-- Users Section (Pendaftar Umroh) -->
            @include('admin.sidebar.pendaftar')
            <!-- Galeri Section -->
            @include('admin.sidebar.galeri')
            <!-- Mutawifs Section -->
            @include('admin.sidebar.mutawwif')
            <!-- Partner Section -->
            @include('admin.sidebar.partner')
            <!-- Testimoni Section -->
            @include('admin.sidebar.testimoni')
            <!-- Bookings Section -->
            @include('admin.sidebar.booking')
            <!-- Packages Section -->
            @include('admin.sidebar.package')
        </main>
    </div>
</div>

<style>
    /* Hamburger Menu Styles */
    .hamburger-menu {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .hamburger-icon {
        width: 24px;
        height: 18px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .hamburger-icon .line {
        width: 100%;
        height: 2px;
        background-color: currentColor;
        border-radius: 2px;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        transform-origin: center;
    }

    /* Hamburger Active State (X) */
    .hamburger-menu.active .line-1 {
        transform: translateY(8px) rotate(45deg);
    }

    .hamburger-menu.active .line-2 {
        opacity: 0;
        transform: scaleX(0);
    }

    .hamburger-menu.active .line-3 {
        transform: translateY(-8px) rotate(-45deg);
    }

    /* Overlay Styling */
    .sidebar-overlay {
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 30;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        backdrop-filter: blur(2px);
    }

    .sidebar-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    /* Prevent body scroll when sidebar is open on mobile */
    body.sidebar-open {
        overflow: hidden;
    }

    @media (min-width: 768px) {
        .sidebar-overlay {
            display: none;
        }
    }
</style>

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('mobile-menu-overlay');
    const hamburgerBtn = document.getElementById('hamburger-btn');
    let isDesktop = window.innerWidth >= 1024;
    let isTablet = window.innerWidth >= 768 && window.innerWidth < 1024;
    let isMobile = window.innerWidth < 768;

    function updateDeviceType() {
        isDesktop = window.innerWidth >= 1024;
        isTablet = window.innerWidth >= 768 && window.innerWidth < 1024;
        isMobile = window.innerWidth < 768;
    }

    function toggleSidebar() {
        updateDeviceType();

        if (isMobile) {
            // Mobile: Toggle slide in/out with overlay
            const isOpen = sidebar.classList.contains('open');
            if (isOpen) {
                closeSidebar();
            } else {
                openSidebar();
            }
        } else if (isTablet || isDesktop) {
            // Tablet & Desktop: Toggle collapsed state
            sidebar.classList.toggle('collapsed');
            hamburgerBtn.classList.toggle('active');
            if (isDesktop) {
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            }
        }
    }

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('show');
        hamburgerBtn.classList.add('active');
        document.body.classList.add('sidebar-open');
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
        hamburgerBtn.classList.remove('active');
        document.body.classList.remove('sidebar-open');
    }

    function closeAlert(alertId) {
        const alertElement = document.getElementById(alertId);
        if (alertElement) {
            alertElement.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
            alertElement.style.opacity = '0';
            alertElement.style.transform = 'translateX(100%)';
            setTimeout(() => alertElement.remove(), 300);
        }
    }

    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const wasDesktop = isDesktop;
            const wasTablet = isTablet;
            const wasMobile = isMobile;
            updateDeviceType();

            // Transitioning from mobile to tablet/desktop
            if (wasMobile && !isMobile) {
                closeSidebar();
                // Restore collapsed state if transitioning to desktop
                if (isDesktop) {
                    const wasCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                    if (wasCollapsed) {
                        sidebar.classList.add('collapsed');
                        hamburgerBtn.classList.add('active');
                    }
                }
            }

            // Transitioning from tablet/desktop to mobile
            if (!wasMobile && isMobile) {
                sidebar.classList.remove('collapsed');
                hamburgerBtn.classList.remove('active');
                closeSidebar();
            }

            // Restore collapsed state when transitioning to desktop
            if (!wasDesktop && isDesktop) {
                const wasCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                if (wasCollapsed) {
                    sidebar.classList.add('collapsed');
                    hamburgerBtn.classList.add('active');
                }
            }

            // Remove collapsed state when transitioning from desktop to tablet
            if (wasDesktop && isTablet) {
                const isCollapsed = sidebar.classList.contains('collapsed');
                if (isCollapsed) {
                    hamburgerBtn.classList.add('active');
                }
            }
        }, 150);
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function () {
        updateDeviceType();

        // Debug: Force sidebar visible on desktop
        if (!isMobile) {
            console.log('Desktop mode detected - ensuring sidebar is visible');
            sidebar.style.display = 'flex';
            sidebar.style.position = 'static';
            sidebar.style.transform = 'translateX(0)';
        }

        // Restore sidebar state on desktop
        if (isDesktop) {
            const wasCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (wasCollapsed) {
                sidebar.classList.add('collapsed');
                hamburgerBtn.classList.add('active');
            }
        }

        // Auto-dismiss alerts after 5 seconds
        const alerts = ['success-alert', 'error-alert', 'warning-alert'];
        alerts.forEach(alertId => {
            const alert = document.getElementById(alertId);
            if (alert) {
                setTimeout(() => closeAlert(alertId), 5000);
            }
        });

        // Close mobile sidebar when clicking on nav links
        const navLinks = document.querySelectorAll('#sidebar a');
        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                if (isMobile) {
                    closeSidebar();
                }
            });
        });
    });
</script>
</body>
</html>
