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
    </style>
</head>
<body class="bg-gray-100">
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
                                <p class="text-3xl font-bold text-indigo-600">{{ $counts['users'] }}</p>
                            </div>
                            <div class="bg-indigo-100 p-4 rounded-full">
                                <i class="fas fa-users text-indigo-600 text-2xl"></i>
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
                                <p class="text-3xl font-bold text-green-600">{{ $counts['packages'] }}</p>
                            </div>
                            <div class="bg-green-100 p-4 rounded-full">
                                <i class="fas fa-box text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Partners</p>
                                <p class="text-3xl font-bold text-purple-600">{{ $counts['partners'] }}</p>
                            </div>
                            <div class="bg-purple-100 p-4 rounded-full">
                                <i class="fas fa-handshake text-purple-600 text-2xl"></i>
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
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
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

    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = ['success-alert', 'error-alert', 'warning-alert'];
        alerts.forEach(alertId => {
            const alert = document.getElementById(alertId);
            if (alert) {
                setTimeout(() => closeAlert(alertId), 5000);
            }
        });
    });
</script>
</body>
</html>
