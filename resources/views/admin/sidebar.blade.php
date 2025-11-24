<aside id="sidebar" class="bg-gradient-to-b from-blue-900 to-blue-800 text-white flex-shrink-0 transition-all duration-300 ease-in-out overflow-hidden" style="width: 256px;">
    <div class="p-6">
        <h1 id="sidebar-title" class="text-2xl font-bold mb-8 flex items-center transition-opacity duration-300">
            Admin Panel
        </h1>
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ !$section ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-home w-6"></i>
                        <span class="sidebar-text ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=users" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'users' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-users w-6"></i>
                        <span class="sidebar-text ml-3">Pendaftar Umroh</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=galleries" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'galleries' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-images w-6"></i>
                        <span class="sidebar-text ml-3">Galeri</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=mutawwifs" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'mutawwifs' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-user-tie w-6"></i>
                        <span class="sidebar-text ml-3">Mutawifs</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=partners" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'partners' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-handshake w-6"></i>
                        <span class="sidebar-text ml-3">Partner</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=testimonials" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'testimonials' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-star w-6"></i>
                        <span class="sidebar-text ml-3">Testimoni</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=bookings" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'bookings' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-calendar-check w-6"></i>
                        <span class="sidebar-text ml-3">Bookings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}?section=packages" class="nav-link flex items-center p-3 rounded-lg hover:bg-blue-700 transition-colors {{ $section == 'packages' ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-box w-6"></i>
                        <span class="sidebar-text ml-3">Packages</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
