<header class="dub-header">
    <div class="dub-header-left">
        <!-- Hamburger / Toggle -->
        <button id="hamburger-btn" onclick="toggleSidebar()"
                class="hamburger-menu" aria-label="Toggle sidebar">
            <div class="hamburger-icon">
                <span class="line line-1"></span>
                <span class="line line-2"></span>
                <span class="line line-3"></span>
            </div>
        </button>

        <!-- Page Title -->
        <div class="dub-header-breadcrumb">
            <h2 class="dub-page-title">
                @yield('page-title', 'Dashboard')
            </h2>
        </div>
    </div>

    <div class="dub-header-right">
        <!-- User greeting -->
        <span class="dub-header-user">
            {{ Auth::guard('admin')->user()->name }}
        </span>

        <!-- User avatar -->
        <div class="dub-avatar" style="background: var(--color-soft-blue); color: var(--color-electric-blue); border-color: #bfdbfe;">
            {{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'A', 0, 2)) }}
        </div>

        <!-- Divider -->
        <div style="width:1px; height:20px; background: var(--color-ash);"></div>

        <!-- Logout -->
        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
            @csrf
            <button type="submit" class="dub-btn-logout" title="Logout">
                <i class="fas fa-sign-out-alt" style="font-size:12px;"></i>
                <span class="dub-header-logout-label">Keluar</span>
            </button>
        </form>
    </div>
</header>

<style>
    /* =====================================================
       DUB HEADER
       ===================================================== */
    .dub-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 57px;
        padding: 0 20px;
        background: var(--color-canvas-white);
        border-bottom: 1px solid var(--color-ash);
        flex-shrink: 0;
        gap: 16px;
        position: sticky;
        top: 0;
        z-index: 20;
    }

    .dub-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .dub-header-breadcrumb {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .dub-header-right {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .dub-header-user {
        font-size: 14px;
        color: var(--color-steel);
        font-weight: 500;
        white-space: nowrap;
    }

    .dub-btn-logout {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-family: var(--font-inter);
        font-size: 13px;
        font-weight: 500;
        line-height: 1.2;
        border-radius: 9999px;
        padding: 7px 14px;
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
        cursor: pointer;
        transition: all 0.15s ease;
        text-decoration: none;
        white-space: nowrap;
    }

    .dub-btn-logout:hover {
        background: #fee2e2;
        color: #b91c1c;
        border-color: #fca5a5;
    }

    @media (max-width: 640px) {
        .dub-header-user {
            display: none;
        }

        .dub-header-logout-label {
            display: none;
        }
    }
</style>
