<aside id="sidebar" class="bg-gray-800 text-gray-100 flex flex-col h-screen transition-all duration-300 ease-in-out" style="width: 256px;">
    <div class="p-4 border-b border-gray-700">
        <h1 id="sidebar-title" class="text-xl font-bold flex items-center transition-opacity duration-300">
            <i class="fas fa-user-shield mr-3"></i>
            Admin Panel
        </h1>
    </div>
    <nav class="flex-grow p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors transform hover:scale-105 hover:shadow-lg {{ !$section ? 'bg-blue-600 text-white' : '' }}">
            <i class="fas fa-home w-6"></i>
            <span class="sidebar-text ml-3">Dashboard</span>
        </a>
        <a href="{{ route('admin.dashboard') }}?section=users" class="nav-link flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors transform hover:scale-105 hover:shadow-lg {{ $section == 'users' ? 'bg-blue-600 text-white' : '' }}">
            <i class="fas fa-users w-6"></i>
            <span class="sidebar-text ml-3">Pendaftar Umroh</span>
        </a>
        <a href="{{ route('admin.dashboard') }}?section=packages" class="nav-link flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors transform hover:scale-105 hover:shadow-lg {{ $section == 'packages' ? 'bg-blue-600 text-white' : '' }}">
            <i class="fas fa-box w-6"></i>
            <span class="sidebar-text ml-3">Paket</span>
        </a>
        <a href="{{ route('admin.dashboard') }}?section=galleries" class="nav-link flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors transform hover:scale-105 hover:shadow-lg {{ $section == 'galleries' ? 'bg-blue-600 text-white' : '' }}">
            <i class="fas fa-images w-6"></i>
            <span class="sidebar-text ml-3">Galeri</span>
        </a>
        <a href="{{ route('admin.dashboard') }}?section=mutawwifs" class="nav-link flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors transform hover:scale-105 hover:shadow-lg {{ $section == 'mutawwifs' ? 'bg-blue-600 text-white' : '' }}">
            <i class="fas fa-user-tie w-6"></i>
            <span class="sidebar-text ml-3">Mutawif</span>
        </a>
        <a href="{{ route('admin.dashboard') }}?section=partners" class="nav-link flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors transform hover:scale-105 hover:shadow-lg {{ $section == 'partners' ? 'bg-blue-600 text-white' : '' }}">
            <i class="fas fa-handshake w-6"></i>
            <span class="sidebar-text ml-3">Partner</span>
        </a>
        <a href="{{ route('admin.dashboard') }}?section=testimonials" class="nav-link flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors transform hover:scale-105 hover:shadow-lg {{ $section == 'testimonials' ? 'bg-blue-600 text-white' : '' }}">
            <i class="fas fa-star w-6"></i>
            <span class="sidebar-text ml-3">Testimoni</span>
        </a>
        <a href="{{ route('admin.dashboard') }}?section=bookings" class="nav-link flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors transform hover:scale-105 hover:shadow-lg {{ $section == 'bookings' ? 'bg-blue-600 text-white' : '' }}">
            <i class="fas fa-calendar-check w-6"></i>
            <span class="sidebar-text ml-3">Bookings</span>
        </a>
        <a href="{{ route('admin.dashboard') }}?section=contacts" class="nav-link flex items-center py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors transform hover:scale-105 hover:shadow-lg {{ $section == 'contacts' ? 'bg-blue-600 text-white' : '' }}">
            <i class="fas fa-envelope w-6"></i>
            <span class="sidebar-text ml-3">Kontak Masuk</span>
        </a>
    </nav>
    <div class="p-4 border-t border-gray-700">
        <a href="#" id="logout-button" class="flex items-center py-2 px-4 rounded-lg hover:bg-red-600 transition-colors transform hover:scale-105 hover:shadow-lg">
            <i class="fas fa-sign-out-alt w-6"></i>
            <span class="sidebar-text ml-3">Logout</span>
        </a>
    </div>
</aside>
