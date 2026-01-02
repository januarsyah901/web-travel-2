@php
    $currentSection = request()->get('section');
    $currentRoute = request()->route()->getName() ?? '';
@endphp

<aside id="sidebar" class="sidebar bg-slate-900 text-slate-300 flex flex-col h-screen transition-all duration-300 ease-in-out border-r border-slate-800">

    <!-- Header Section -->
    <div class="sidebar-header h-20 flex items-center px-6 border-b border-slate-800 bg-slate-900/50 backdrop-blur-sm sticky top-0 z-10">
        <div class="flex items-center gap-3 min-w-0">
            <div class="sidebar-icon w-10 h-10 rounded-lg bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center shadow-lg shadow-orange-500/20 flex-shrink-0">
                <i class="fas fa-kaaba text-white text-base"></i>
            </div>
            <div class="sidebar-text min-w-0">
                <h1 class="font-bold text-white text-lg tracking-tight truncate">Fabi Abadi</h1>
                <p class="text-xs text-slate-500 font-medium uppercase tracking-wider truncate">Admin Panel</p>
            </div>
        </div>
    </div>

    <!-- Navigation Section -->
    <nav class="flex-grow py-6 px-3 space-y-1 overflow-y-auto custom-scrollbar">

        <!-- Main Menu Group -->
        <div class="px-3 mb-2 mt-2">
            <p class="sidebar-text text-xs font-bold text-slate-500 uppercase tracking-wider">Main</p>
        </div>

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" title="Dashboard"
           class="sidebar-link flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ !$currentSection && $currentRoute == 'admin.dashboard' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-home w-5 flex-shrink-0 {{ !$currentSection && $currentRoute == 'admin.dashboard' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="sidebar-text ml-3 font-medium">Dashboard</span>
            @if(!$currentSection && $currentRoute == 'admin.dashboard')
                <div class="sidebar-text ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)] animate-pulse flex-shrink-0"></div>
            @endif
        </a>

        <!-- Management Group -->
        <div class="px-3 mb-2 mt-6">
            <p class="sidebar-text text-xs font-bold text-slate-500 uppercase tracking-wider">Management</p>
        </div>

        <!-- Users -->
        <a href="{{ route('admin.dashboard') }}?section=users" title="Jemaah / User"
           class="sidebar-link flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $currentSection == 'users' || str_contains($currentRoute, 'users') ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-users w-5 flex-shrink-0 {{ $currentSection == 'users' || str_contains($currentRoute, 'users') ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="sidebar-text ml-3 font-medium">Jemaah / User</span>
            @if($currentSection == 'users' || str_contains($currentRoute, 'users'))
                <div class="sidebar-text ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)] flex-shrink-0"></div>
            @endif
        </a>

        <!-- Bookings -->
        <a href="{{ route('admin.dashboard') }}?section=bookings" title="Data Booking"
           class="sidebar-link flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $currentSection == 'bookings' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-calendar-check w-5 flex-shrink-0 {{ $currentSection == 'bookings' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="sidebar-text ml-3 font-medium">Data Booking</span>
            @if($currentSection == 'bookings')
                <div class="sidebar-text ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)] flex-shrink-0"></div>
            @endif
        </a>

        <!-- Packages -->
        <a href="{{ route('admin.dashboard') }}?section=packages" title="Paket Umroh"
           class="sidebar-link flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $currentSection == 'packages' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-box-open w-5 flex-shrink-0 {{ $currentSection == 'packages' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="sidebar-text ml-3 font-medium">Paket Umroh</span>
            @if($currentSection == 'packages')
                <div class="sidebar-text ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)] flex-shrink-0"></div>
            @endif
        </a>

        <!-- Mutawwifs -->
        <a href="{{ route('admin.dashboard') }}?section=mutawwifs" title="Data Mutawif"
           class="sidebar-link flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $currentSection == 'mutawwifs' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-user-tie w-5 flex-shrink-0 {{ $currentSection == 'mutawwifs' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="sidebar-text ml-3 font-medium">Data Mutawif</span>
            @if($currentSection == 'mutawwifs')
                <div class="sidebar-text ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)] flex-shrink-0"></div>
            @endif
        </a>

        <!-- Partners -->
        <a href="{{ route('admin.dashboard') }}?section=partners" title="Partner"
           class="sidebar-link flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $currentSection == 'partners' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-handshake w-5 flex-shrink-0 {{ $currentSection == 'partners' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="sidebar-text ml-3 font-medium">Partner</span>
            @if($currentSection == 'partners')
                <div class="sidebar-text ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)] flex-shrink-0"></div>
            @endif
        </a>

        <!-- Content Group -->
        <div class="px-3 mb-2 mt-6">
            <p class="sidebar-text text-xs font-bold text-slate-500 uppercase tracking-wider">Content</p>
        </div>

        <!-- Galleries -->
        <a href="{{ route('admin.dashboard') }}?section=galleries" title="Galeri"
           class="sidebar-link flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $currentSection == 'galleries' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-images w-5 flex-shrink-0 {{ $currentSection == 'galleries' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="sidebar-text ml-3 font-medium">Galeri</span>
            @if($currentSection == 'galleries')
                <div class="sidebar-text ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)] flex-shrink-0"></div>
            @endif
        </a>

        <!-- Testimonials -->
        <a href="{{ route('admin.dashboard') }}?section=testimonials" title="Testimoni"
           class="sidebar-link flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 group relative
           {{ $currentSection == 'testimonials' ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-md shadow-orange-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-star w-5 flex-shrink-0 {{ $currentSection == 'testimonials' ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors"></i>
            <span class="sidebar-text ml-3 font-medium">Testimoni</span>
            @if($currentSection == 'testimonials')
                <div class="sidebar-text ml-auto w-2 h-2 bg-white rounded-full shadow-[0_0_8px_rgba(255,255,255,0.8)] flex-shrink-0"></div>
            @endif
        </a>
    </nav>

    <!-- Footer Section -->
    <div class="sidebar-footer p-4 border-t border-slate-800 bg-slate-900/50">
        <div class="flex items-center gap-3 mb-3 px-2">
            <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold text-white flex-shrink-0">
                AD
            </div>
            <div class="sidebar-text overflow-hidden min-w-0">
                <p class="text-sm font-semibold text-white truncate">Administrator</p>
                <p class="text-xs text-slate-500 truncate">admin@fabiabadi.com</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center py-2.5 px-4 rounded-lg bg-slate-800 hover:bg-red-600 text-slate-300 hover:text-white transition-all duration-200 group">
                <i class="fas fa-sign-out-alt mr-2 group-hover:animate-pulse"></i>
                <span class="sidebar-text font-medium text-sm">Keluar</span>
            </button>
        </form>
    </div>
</aside>

<style>
    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(51, 65, 85, 0.3);
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, 0.5);
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(148, 163, 184, 0.7);
    }

    /* Sidebar Base Styles - FORCE VISIBLE ON DESKTOP */
    #sidebar {
        width: 280px;
        min-width: 280px;
        max-width: 280px;
        flex-shrink: 0;
        overflow-x: hidden;
    }

    #sidebar nav {
        overflow-x: hidden;
    }

    /* Mobile: Hidden by default */
    @media (max-width: 767px) {
        #sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 40;
            transform: translateX(-100%);
        }

        #sidebar.open {
            transform: translateX(0);
        }
    }

    /* Tablet & Desktop: ALWAYS VISIBLE - NO EXCEPTIONS */
    @media (min-width: 768px) {
        #sidebar {
            position: static;
            transform: none;
            display: flex;
            flex-direction: column;
        }

        /* Override any conflicting styles */
        body #sidebar.sidebar {
            position: static !important;
            transform: translateX(0) !important;
        }
    }

    /* Collapsed State for Desktop */
    @media (min-width: 768px) {
        #sidebar.collapsed {
            width: 80px;
            min-width: 80px;
            max-width: 80px;
            overflow-x: hidden;
        }

        #sidebar.collapsed nav {
            overflow-x: hidden;
        }

        #sidebar.collapsed .sidebar-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
            white-space: nowrap;
        }

        #sidebar.collapsed .sidebar-header {
            justify-content: center;
            padding-left: 1rem;
            padding-right: 1rem;
            overflow: hidden;
        }

        #sidebar.collapsed .sidebar-icon {
            margin: 0 auto;
        }

        #sidebar.collapsed .sidebar-link {
            justify-content: center;
            padding-left: 1rem;
            padding-right: 1rem;
            overflow: hidden;
        }

        #sidebar.collapsed .sidebar-footer {
            padding: 1rem 0.5rem;
            overflow: hidden;
        }

        #sidebar.collapsed nav > div {
            text-align: center;
            overflow: hidden;
        }

        /* Tooltip on hover when collapsed */
        #sidebar.collapsed .sidebar-link {
            position: relative;
        }

        #sidebar.collapsed .sidebar-link:hover::after {
            content: attr(title);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: #1e293b;
            color: white;
            border-radius: 0.5rem;
            white-space: nowrap;
            z-index: 50;
            font-size: 0.875rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            opacity: 0;
            animation: fadeIn 0.2s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    }

    /* Smooth transitions */
    #sidebar,
    #sidebar * {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
</style>
