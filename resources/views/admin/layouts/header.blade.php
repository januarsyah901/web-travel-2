<header class="bg-white shadow-sm z-10 sticky top-0">
    <div class="flex items-center justify-between p-4">
        <div class="flex items-center gap-4">
            <!-- Hamburger Menu -->
            <button id="hamburger-btn" onclick="toggleSidebar()"
                    class="hamburger-menu text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 rounded-lg p-2 transition-colors">
                <div class="hamburger-icon">
                    <span class="line line-1"></span>
                    <span class="line line-2"></span>
                    <span class="line line-3"></span>
                </div>
            </button>

            <!-- Page Title -->
            <h2 class="text-xl font-bold text-gray-800 hidden sm:block">
                @yield('page-title', 'Dashboard Admin')
            </h2>
        </div>

        <div class="flex items-center space-x-4">
            <!-- User Name -->
            <span class="text-gray-700 hidden md:inline">
                Hello, {{ Auth::guard('admin')->user()->name }}
            </span>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                @csrf
                <button type="submit"
                        class="text-gray-600 hover:text-red-600 transition-colors p-2 rounded-lg hover:bg-gray-100"
                        title="Logout">
                    <i class="fas fa-sign-out-alt text-xl"></i>
                </button>
            </form>
        </div>
    </div>
</header>

