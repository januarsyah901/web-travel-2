<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        /* Sidebar collapse styles */
        #sidebar.collapsed {
            width: 80px !important;
        }

        #sidebar.collapsed .sidebar-text,
        #sidebar.collapsed #sidebar-title {
            opacity: 0;
            display: none;
        }

        #sidebar.collapsed .nav-link {
            justify-content: center;
        }

        #sidebar.collapsed .nav-link i {
            margin: 0;
        }

        /* Smooth transition for all elements */
        .sidebar-text, #sidebar-title {
            transition: opacity 0.3s ease-in-out;
        }

        /* Rotate icon when sidebar collapsed */
        #toggle-icon {
            transition: transform 0.3s ease-in-out;
        }

        #toggle-icon.rotated {
            transform: rotate(180deg);
        }

        /* Mobile Menu Overlay */
        #mobile-menu-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
            transition: opacity 0.3s ease-in-out;
        }

        #mobile-menu-overlay.show {
            display: block;
            opacity: 1;
        }

        /* Mobile responsive styles */
        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                left: -256px;
                top: 0;
                height: 100vh;
                z-index: 50;
                transition: left 0.3s ease-in-out;
                -webkit-overflow-scrolling: touch;
                overflow-y: auto;
            }

            #sidebar.mobile-open {
                left: 0;
            }

            #sidebar.collapsed {
                left: -256px;
            }

            /* Main content takes full width on mobile */
            .flex-1 {
                width: 100%;
            }

            /* Adjust card grid for mobile */
            .grid.grid-cols-1.md\:grid-cols-2.lg\:grid-cols-4 {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }

            /* Make tables scrollable on mobile */
            .overflow-x-auto {
                -webkit-overflow-scrolling: touch;
                overflow-x: auto;
                max-width: 100%;
            }

            /* Ensure tables don't break layout on mobile */
            table {
                min-width: 600px;
                width: 100%;
            }

            /* Make all content sections scrollable horizontally if needed */
            .content-section {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            /* Prevent content from overflowing */
            main {
                overflow-x: hidden;
            }

            /* Make action buttons stack on mobile */
            .flex.gap-2,
            .flex.space-x-2 {
                flex-wrap: wrap;
            }

            /* Stack header items on mobile */
            header .flex.items-center.justify-between {
                flex-wrap: wrap;
            }

            /* Reduce padding on mobile */
            main {
                padding: 1rem;
            }

            /* Make cards more compact on mobile */
            .bg-white.rounded-lg.shadow-md {
                padding: 1rem;
            }

            /* Adjust font sizes for mobile */
            h2.text-3xl {
                font-size: 1.5rem;
            }

            h3.text-xl {
                font-size: 1.125rem;
            }

            /* Make images responsive */
            img {
                max-width: 100%;
                height: auto;
            }

            /* Adjust modal width on mobile */
            .modal-content {
                width: 95%;
                max-width: 95%;
            }

            /* Make form inputs full width on mobile */
            input[type="text"],
            input[type="email"],
            input[type="tel"],
            input[type="date"],
            select,
            textarea {
                width: 100%;
            }

            /* Stack buttons on mobile */
            .btn-group {
                flex-direction: column;
                width: 100%;
            }

            .btn-group button,
            .btn-group a {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }

        @media (max-width: 640px) {
            /* Further adjustments for small screens */
            .text-3xl.font-bold {
                font-size: 1.5rem;
            }

            .text-2xl {
                font-size: 1.25rem;
            }

            /* Stack stat cards */
            .grid-cols-1 {
                gap: 1rem;
            }

            /* Compact table on very small screens */
            table {
                font-size: 0.875rem;
                min-width: 500px;
            }

            th, td {
                padding: 0.5rem;
                white-space: nowrap;
            }

            /* Reduce padding further on very small screens */
            main {
                padding: 0.5rem;
            }

            .bg-white.rounded-lg.shadow-md {
                padding: 0.75rem;
            }

            /* Make text smaller */
            body {
                font-size: 14px;
            }

            /* Adjust alert padding */
            #success-alert,
            #error-alert,
            #warning-alert {
                padding: 0.75rem;
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
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
                    <i class="fas fa-bars text-xl"></i>
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
                <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 flex items-center justify-between shadow-md animate-fade-in">
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
                <div id="error-alert" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 flex items-center justify-between shadow-md animate-fade-in">
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
                <div id="warning-alert" class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg mb-6 flex items-center justify-between shadow-md animate-fade-in">
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
            <div id="dashboard" class="content-section {{ $section ? 'hidden' : '' }}">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Pendaftar Umroh</p>
                                <p class="text-3xl font-bold text-blue-600">{{ $counts['users'] }}</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-full">
                                <i class="fas fa-users text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Total Bookings</p>
                                <p class="text-3xl font-bold text-blue-600">{{ $counts['bookings'] }}</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-full">
                                <i class="fas fa-calendar-check text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Packages</p>
                                <p class="text-3xl font-bold text-blue-600">{{ $counts['packages'] }}</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-full">
                                <i class="fas fa-box text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Partners</p>
                                <p class="text-3xl font-bold text-blue-600">{{ $counts['partners'] }}</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-full">
                                <i class="fas fa-handshake text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 10 pendaftar terbaru dengan pagination -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-xl font-semibold mb-4">Pendaftar Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Daftar</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Telepon</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($recentUsers ?? $users ?? collect() as $user)
                                <tr>
                                    <td class="px-4 py-3">{{ $user->id }}</td>
                                    <td class="px-4 py-3">{{ $user->fullName }}</td>
                                    <td class="px-4 py-3">{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}</td>
                                    <td class="px-4 py-3">{{ $user->phone }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-3 text-center text-gray-500">Tidak ada pendaftar terbaru</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(isset($recentUsers) && method_exists($recentUsers, 'links'))
                    <div class="mt-4">
                        {{ $recentUsers->links() }}
                    </div>
                    @endif
                </div>
            </div>

            <!-- Users Section (Pendaftar Umroh) -->
            @include('admin.sidebar.pendaftar')

            <!-- Galeri Section -->
            @include('admin.sidebar.galeri')

            <!-- Mutawifs Section -->
            @include('admin.sidebar.mutawif')

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
    window.addEventListener('resize', function() {
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
    document.addEventListener('DOMContentLoaded', function() {
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
            link.addEventListener('click', function() {
                if (isMobile()) {
                    closeMobileSidebar();
                }
            });
        });
    });
</script>
</body>
</html>
