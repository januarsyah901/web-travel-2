<aside id="sidebar" class="bg-gradient-to-b from-blue-900 to-blue-800 text-white w-64 flex-shrink-0 transition-all duration-300">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-8 flex items-center">
            Admin Panel
        </h1>
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ !$section ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-home w-6"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=users" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'users' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-users w-6"></i>
                        <span>Pendaftar Umroh</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=galleries" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'galleries' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-images w-6"></i>
                        <span>Galeri</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=mutawwifs" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'mutawwifs' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-user-tie w-6"></i>
                        <span>Mutawifs</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=partners" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'partners' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-handshake w-6"></i>
                        <span>Partner</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=testimonials" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'testimonials' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-star w-6"></i>
                        <span>Testimoni</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=bookings" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'bookings' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-calendar-check w-6"></i>
                        <span>Bookings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=packages" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'packages' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-box w-6"></i>
                        <span>Packages</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="absolute bottom-0 w-64 p-6 border-t border-blue-700">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                <i class="fas fa-user"></i>
            </div>
            <div class="ml-3">
                <p class="font-semibold">{{ Auth::guard('admin')->user()->name }}</p>
                <p class="text-xs text-blue-300">{{ Auth::guard('admin')->user()->role }}</p>
            </div>
        </div>
    </div>
</aside>
