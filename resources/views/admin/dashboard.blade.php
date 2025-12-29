<!DOCTYPE html>
<html lang="id">
@include('public.head')
<body class="bg-gray-100">
<!-- Mobile Menu Overlay -->
<div id="mobile-menu-overlay" onclick="closeMobileSidebar()"></div>

<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    @include('admin.sidebar')
    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="bg-white shadow-sm z-10">
            <div class="flex items-center justify-between p-4">
                <button onclick="toggleSidebar()" class="text-gray-600 hover:text-gray-900">
                </button>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Hello, {{ Auth::guard('admin')->user()->name }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-sign-out-alt text-xl"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="flex-1 overflow-y-auto p-6">
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
<script>
    function isMobile() {
        return window.innerWidth <= 768;
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-menu-overlay');

        if (isMobile()) {
            // Mobile behavior
            const isOpen = sidebar.classList.toggle('mobile-open');
            if (isOpen) {
                overlay.classList.add('show');
                sidebar.classList.remove('collapsed');
            } else {
                overlay.classList.remove('show');
            }
        } else {
            // Desktop behavior
            sidebar.classList.toggle('collapsed');
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('show');
        }
    }

    function closeMobileSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-menu-overlay');
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('show');
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
    window.addEventListener('resize', function () {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-menu-overlay');

        if (!isMobile()) {
            // When switching to desktop, remove mobile classes
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('show');
        } else {
            // When switching to mobile, remove collapsed class
            sidebar.classList.remove('collapsed');
        }
    });

    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function () {
        const alerts = ['success-alert', 'error-alert', 'warning-alert'];
        alerts.forEach(alertId => {
            const alert = document.getElementById(alertId);
            if (alert) {
                setTimeout(() => closeAlert(alertId), 5000);
            }
        });

        // Close mobile sidebar when clicking on nav links
        const navLinks = document.querySelectorAll('#sidebar .nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                if (isMobile()) {
                    closeMobileSidebar();
                }
            });
        });
    });
</script>
</body>
</html>
