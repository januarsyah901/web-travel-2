@php
    $currentSection = request()->get('section');
    $currentRoute = request()->route()->getName() ?? '';

    $navItems = [
        'main' => [
            [
                'label'   => 'Dashboard',
                'icon'    => 'fas fa-home',
                'href'    => route('admin.dashboard'),
                'active'  => !$currentSection && $currentRoute == 'admin.dashboard',
                'title'   => 'Dashboard',
            ],
        ],
        'management' => [
            [
                'label'   => 'Jemaah',
                'icon'    => 'fas fa-users',
                'href'    => route('admin.dashboard') . '?section=users',
                'active'  => $currentSection == 'users' || str_contains($currentRoute, 'users'),
                'title'   => 'Jemaah / User',
            ],
            [
                'label'   => 'Data Pelunasan',
                'icon'    => 'fas fa-calendar-check',
                'href'    => route('admin.dashboard') . '?section=bookings',
                'active'  => $currentSection == 'bookings',
                'title'   => 'Data Pelunasan',
            ],
            [
                'label'   => 'Paket Umroh',
                'icon'    => 'fas fa-box-open',
                'href'    => route('admin.dashboard') . '?section=packages',
                'active'  => $currentSection == 'packages',
                'title'   => 'Paket Umroh',
            ],
            [
                'label'   => 'Data Mutawif',
                'icon'    => 'fas fa-user-tie',
                'href'    => route('admin.dashboard') . '?section=mutawwifs',
                'active'  => $currentSection == 'mutawwifs',
                'title'   => 'Data Mutawif',
            ],
            [
                'label'   => 'Partner',
                'icon'    => 'fas fa-handshake',
                'href'    => route('admin.dashboard') . '?section=partners',
                'active'  => $currentSection == 'partners',
                'title'   => 'Partner',
            ],
        ],
        'content' => [
            [
                'label'   => 'Galeri',
                'icon'    => 'fas fa-images',
                'href'    => route('admin.dashboard') . '?section=galleries',
                'active'  => $currentSection == 'galleries',
                'title'   => 'Galeri',
            ],
        ],
        'settings' => [
            [
                'label'   => 'Kontak',
                'icon'    => 'fas fa-address-book',
                'href'    => route('contact.index'),
                'active'  => str_contains($currentRoute, 'contact'),
                'title'   => 'Kontak Perusahaan',
            ],
            [
                'label'   => 'Activity Logs',
                'icon'    => 'fas fa-history',
                'href'    => route('activity-logs.index'),
                'active'  => str_contains($currentRoute, 'activity-logs'),
                'title'   => 'Activity Logs (Read Only)',
            ],
        ],
    ];
@endphp

<aside id="sidebar" class="dub-sidebar">

    <!-- Logo / Brand -->
    <div class="dub-sidebar-brand">
        <div class="dub-sidebar-logo">
            <img src="{{ asset('img/img/logo.png') }}" alt="Logo" style="width:100%;height:100%;object-fit:contain;padding:2px;">
        </div>
        <div class="dub-sidebar-brand-text">
            <span class="dub-sidebar-brand-name">Fabi Abadi</span>
            <span class="dub-sidebar-brand-sub">Admin Panel</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="dub-sidebar-nav">

        <!-- Main -->
        <div class="dub-sidebar-group">
            <p class="dub-sidebar-group-label dub-sidebar-label-text">Main</p>
            @foreach($navItems['main'] as $item)
                <a href="{{ $item['href'] }}" title="{{ $item['title'] }}"
                   class="dub-sidebar-link {{ $item['active'] ? 'active' : '' }}">
                    <i class="{{ $item['icon'] }} dub-sidebar-icon"></i>
                    <span class="dub-sidebar-label-text">{{ $item['label'] }}</span>
                    @if($item['active'])
                        <span class="dub-sidebar-active-dot dub-sidebar-label-text"></span>
                    @endif
                </a>
            @endforeach
        </div>

        <!-- Management -->
        <div class="dub-sidebar-group">
            <p class="dub-sidebar-group-label dub-sidebar-label-text">Management</p>
            @foreach($navItems['management'] as $item)
                <a href="{{ $item['href'] }}" title="{{ $item['title'] }}"
                   class="dub-sidebar-link {{ $item['active'] ? 'active' : '' }}">
                    <i class="{{ $item['icon'] }} dub-sidebar-icon"></i>
                    <span class="dub-sidebar-label-text">{{ $item['label'] }}</span>
                    @if($item['active'])
                        <span class="dub-sidebar-active-dot dub-sidebar-label-text"></span>
                    @endif
                </a>
            @endforeach
        </div>

        <!-- Content -->
        <div class="dub-sidebar-group">
            <p class="dub-sidebar-group-label dub-sidebar-label-text">Content</p>
            @foreach($navItems['content'] as $item)
                <a href="{{ $item['href'] }}" title="{{ $item['title'] }}"
                   class="dub-sidebar-link {{ $item['active'] ? 'active' : '' }}">
                    <i class="{{ $item['icon'] }} dub-sidebar-icon"></i>
                    <span class="dub-sidebar-label-text">{{ $item['label'] }}</span>
                    @if($item['active'])
                        <span class="dub-sidebar-active-dot dub-sidebar-label-text"></span>
                    @endif
                </a>
            @endforeach
        </div>

        <!-- Settings -->
        <div class="dub-sidebar-group">
            <p class="dub-sidebar-group-label dub-sidebar-label-text">Settings</p>
            @foreach($navItems['settings'] as $item)
                <a href="{{ $item['href'] }}" title="{{ $item['title'] }}"
                   class="dub-sidebar-link {{ $item['active'] ? 'active' : '' }}">
                    <i class="{{ $item['icon'] }} dub-sidebar-icon"></i>
                    <span class="dub-sidebar-label-text">{{ $item['label'] }}</span>
                    @if($item['active'])
                        <span class="dub-sidebar-active-dot dub-sidebar-label-text"></span>
                    @endif
                </a>
            @endforeach
        </div>

    </nav>

    <!-- Footer / Logout -->
    <div class="dub-sidebar-footer">
        <div class="dub-sidebar-user dub-sidebar-label-text">
            <div class="dub-sidebar-user-avatar">
                {{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'A', 0, 2)) }}
            </div>
            <div class="dub-sidebar-user-info">
                <span class="dub-sidebar-user-name">{{ Auth::guard('admin')->user()->name }}</span>
                <span class="dub-sidebar-user-role">Administrator</span>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="dub-sidebar-logout" title="Keluar">
                <i class="fas fa-sign-out-alt"></i>
                <span class="dub-sidebar-label-text">Keluar</span>
            </button>
        </form>
    </div>

</aside>

<style>
    /* =====================================================
       DUB SIDEBAR
       ===================================================== */
    .dub-sidebar {
        width: var(--sidebar-width);
        min-width: var(--sidebar-width);
        max-width: var(--sidebar-width);
        display: flex;
        flex-direction: column;
        height: 100vh;
        background: var(--color-canvas-white);
        border-right: 1px solid var(--color-ash);
        overflow: hidden;
        flex-shrink: 0;
        transition: width 0.25s cubic-bezier(0.4, 0, 0.2, 1),
                    min-width 0.25s cubic-bezier(0.4, 0, 0.2, 1),
                    max-width 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Brand */
    .dub-sidebar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 16px 16px;
        border-bottom: 1px solid var(--color-ash);
        height: 57px;
        flex-shrink: 0;
        overflow: hidden;
    }

    .dub-sidebar-logo {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        background: var(--color-paper-mist);
        border: 1px solid var(--color-ash);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
    }

    .dub-sidebar-brand-text {
        display: flex;
        flex-direction: column;
        min-width: 0;
        overflow: hidden;
    }

    .dub-sidebar-brand-name {
        font-size: 14px;
        font-weight: 600;
        color: var(--color-charcoal);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dub-sidebar-brand-sub {
        font-size: 11px;
        color: var(--color-fog);
        white-space: nowrap;
    }

    /* Nav */
    .dub-sidebar-nav {
        flex: 1;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 12px 8px;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .dub-sidebar-group {
        display: flex;
        flex-direction: column;
        gap: 1px;
        margin-bottom: 8px;
    }

    .dub-sidebar-group-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--color-silver);
        text-transform: uppercase;
        letter-spacing: 0.07em;
        padding: 8px 10px 4px;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
    }

    .dub-sidebar-link {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 7px 10px;
        border-radius: var(--radius-buttons);
        color: var(--color-steel);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.15s ease;
        white-space: nowrap;
        overflow: hidden;
        position: relative;
    }

    .dub-sidebar-link:hover {
        background: var(--color-paper-mist);
        color: var(--color-charcoal);
    }

    .dub-sidebar-link.active {
        background: var(--color-soft-blue);
        color: var(--color-electric-blue);
    }

    .dub-sidebar-link.active .dub-sidebar-icon {
        color: var(--color-electric-blue);
    }

    .dub-sidebar-icon {
        width: 16px;
        font-size: 13px;
        flex-shrink: 0;
        text-align: center;
        color: var(--color-silver);
        transition: color 0.15s ease;
    }

    .dub-sidebar-link:hover .dub-sidebar-icon {
        color: var(--color-graphite);
    }

    .dub-sidebar-active-dot {
        display: block;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--color-electric-blue);
        margin-left: auto;
        flex-shrink: 0;
    }

    /* Footer */
    .dub-sidebar-footer {
        border-top: 1px solid var(--color-ash);
        padding: 12px 8px;
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex-shrink: 0;
        overflow: hidden;
    }

    .dub-sidebar-user {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 6px 10px;
        overflow: hidden;
    }

    .dub-sidebar-user-avatar {
        width: 28px;
        height: 28px;
        border-radius: 9999px;
        background: var(--color-paper-mist);
        border: 1px solid var(--color-ash);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
        color: var(--color-steel);
        flex-shrink: 0;
    }

    .dub-sidebar-user-info {
        display: flex;
        flex-direction: column;
        min-width: 0;
        overflow: hidden;
    }

    .dub-sidebar-user-name {
        font-size: 13px;
        font-weight: 500;
        color: var(--color-charcoal);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dub-sidebar-user-role {
        font-size: 11px;
        color: var(--color-fog);
        white-space: nowrap;
    }

    .dub-sidebar-logout {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        width: 100%;
        padding: 8px 14px;
        border-radius: 9999px;
        border: 1px solid #fecaca;
        background: #fef2f2;
        color: #dc2626;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.15s ease;
        white-space: nowrap;
        overflow: hidden;
    }

    .dub-sidebar-logout:hover {
        background: #fee2e2;
        border-color: #fca5a5;
        color: #b91c1c;
    }

    .dub-sidebar-logout i {
        font-size: 13px;
        flex-shrink: 0;
        width: 16px;
        text-align: center;
    }

    /* =====================================================
       COLLAPSED STATE
       ===================================================== */
    @media (min-width: 768px) {
        #sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
            min-width: var(--sidebar-collapsed-width);
            max-width: var(--sidebar-collapsed-width);
        }

        #sidebar.collapsed .dub-sidebar-label-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        #sidebar.collapsed .dub-sidebar-brand {
            justify-content: center;
        }

        #sidebar.collapsed .dub-sidebar-brand-text {
            display: none;
        }

        #sidebar.collapsed .dub-sidebar-link {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        #sidebar.collapsed .dub-sidebar-icon {
            width: auto;
        }

        #sidebar.collapsed .dub-sidebar-group-label {
            text-align: center;
            overflow: hidden;
            height: 0;
            padding: 0;
            margin: 0;
        }

        #sidebar.collapsed .dub-sidebar-footer {
            padding: 10px 6px;
        }

        #sidebar.collapsed .dub-sidebar-user {
            justify-content: center;
        }

        #sidebar.collapsed .dub-sidebar-logout {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        /* Tooltip on collapsed hover */
        #sidebar.collapsed .dub-sidebar-link {
            position: relative;
        }

        #sidebar.collapsed .dub-sidebar-link:hover::after {
            content: attr(title);
            position: absolute;
            left: calc(100% + 10px);
            top: 50%;
            transform: translateY(-50%);
            padding: 5px 10px;
            background: var(--color-charcoal);
            color: #fff;
            border-radius: var(--radius-buttons);
            white-space: nowrap;
            font-size: 13px;
            font-weight: 500;
            z-index: 100;
            box-shadow: var(--shadow-sm);
            animation: tooltip-in 0.15s ease forwards;
        }

        @keyframes tooltip-in {
            from { opacity: 0; transform: translateY(-50%) translateX(-4px); }
            to   { opacity: 1; transform: translateY(-50%) translateX(0); }
        }
    }

    /* =====================================================
       MOBILE SIDEBAR
       ===================================================== */
    @media (max-width: 767px) {
        .dub-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 40;
            transform: translateX(-100%);
            box-shadow: var(--shadow-md);
        }

        .dub-sidebar.open {
            transform: translateX(0);
        }
    }

    @media (min-width: 768px) {
        .dub-sidebar {
            position: static;
            transform: none !important;
        }
    }
</style>
