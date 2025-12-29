<aside id="sidebar" class="bg-slate-900 text-slate-300 flex flex-col h-screen transition-all duration-300 ease-in-out border-r border-slate-800 w-64 fixed md:relative z-30 hidden md:flex">

    <div class="h-20 flex items-center px-6 border-b border-slate-800 bg-slate-900/50 backdrop-blur-sm sticky top-0 z-10">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center shadow-lg shadow-orange-500/20">
                <i class="fas fa-kaaba text-white text-sm"></i>
            </div>
            <div>
                <h1 class="font-bold text-white text-lg tracking-tight">Fabi Abadi</h1>
                <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Admin Panel</p>
            </div>
        </div>
    </div>

    <nav class="flex-grow py-6 px-3 space-y-1 overflow-y-auto custom-scrollbar">

        <div class="px-3 mb-2 mt-2">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Main</p>
        </div>

        {{-- DASHBOARD (Logic: Active jika $section kosong/null) --}}
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ !$section ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-home w-5 {{ !$section ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="ml-3 font-medium">Dashboard</span>

            {{-- INDIKATOR AKTIF (Glowing Dot) --}}
            @if(!$section)
                <div class="ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)] animate-pulse"></div>
            @endif
        </a>

        <div class="px-3 mb-2 mt-6">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Management</p>
        </div>

        {{-- USERS --}}
        <a href="{{ route('admin.dashboard') }}?section=users"
           class="flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $section == 'users' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-users w-5 {{ $section == 'users' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="ml-3 font-medium">Jemaah / User</span>

            @if($section == 'users')
                <div class="ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)]"></div>
            @endif
        </a>

        {{-- BOOKINGS --}}
        <a href="{{ route('admin.dashboard') }}?section=bookings"
           class="flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $section == 'bookings' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-calendar-check w-5 {{ $section == 'bookings' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="ml-3 font-medium">Data Booking</span>

            @if($section == 'bookings')
                <div class="ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)]"></div>
            @endif
        </a>

        {{-- PACKAGES --}}
        <a href="{{ route('admin.dashboard') }}?section=packages"
           class="flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $section == 'packages' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-box-open w-5 {{ $section == 'packages' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="ml-3 font-medium">Paket Umroh</span>

            @if($section == 'packages')
                <div class="ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)]"></div>
            @endif
        </a>

        {{-- MUTAWWIFS --}}
        <a href="{{ route('admin.dashboard') }}?section=mutawwifs"
           class="flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $section == 'mutawwifs' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-user-tie w-5 {{ $section == 'mutawwifs' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="ml-3 font-medium">Data Mutawif</span>

            @if($section == 'mutawwifs')
                <div class="ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)]"></div>
            @endif
        </a>

        {{-- PARTNERS --}}
        <a href="{{ route('admin.dashboard') }}?section=partners"
           class="flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $section == 'partners' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-handshake w-5 {{ $section == 'partners' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="ml-3 font-medium">Partner</span>

            @if($section == 'partners')
                <div class="ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)]"></div>
            @endif
        </a>

        <div class="px-3 mb-2 mt-6">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Content</p>
        </div>

        {{-- GALLERIES --}}
        <a href="{{ route('admin.dashboard') }}?section=galleries"
           class="flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $section == 'galleries' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-images w-5 {{ $section == 'galleries' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="ml-3 font-medium">Galeri</span>

            @if($section == 'galleries')
                <div class="ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)]"></div>
            @endif
        </a>

        {{-- TESTIMONIALS --}}
        <a href="{{ route('admin.dashboard') }}?section=testimonials"
           class="flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $section == 'testimonials' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-star w-5 {{ $section == 'testimonials' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="ml-3 font-medium">Testimoni</span>

            @if($section == 'testimonials')
                <div class="ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)]"></div>
            @endif
        </a>
    </nav>

    <div class="p-4 border-t border-slate-800 bg-slate-900/50">
        <div class="flex items-center gap-3 mb-3 px-2">
            <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold text-white">
                AD
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-semibold text-white truncate">Administrator</p>
                <p class="text-xs text-slate-500 truncate">admin@fabiabadi.com</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center py-2 px-4 rounded-lg bg-slate-800 hover:bg-red-600 text-slate-300 hover:text-white transition-all duration-200 group">
                <i class="fas fa-sign-out-alt mr-2 group-hover:animate-pulse"></i>
                <span class="font-medium text-sm">Keluar</span>
            </button>
        </form>
    </div>
</aside>
