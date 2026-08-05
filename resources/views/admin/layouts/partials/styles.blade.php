<style>
    /* =====================================================
       DUB DESIGN SYSTEM — CSS Custom Properties
       ===================================================== */
    :root {
        /* Colors */
        --color-canvas-white: #ffffff;
        --color-paper-mist: #f5f5f5;
        --color-ash: #e5e5e5;
        --color-smoke: #d4d4d4;
        --color-pebble: #c8c8c8;
        --color-midnight-ink: #0a0a0a;
        --color-charcoal: #171717;
        --color-graphite: #262626;
        --color-slate: #404040;
        --color-steel: #525252;
        --color-fog: #737373;
        --color-silver: #a3a3a3;
        --color-electric-blue: #2563eb;
        --color-deep-sapphire: #1e40af;
        --color-soft-mint: #dcfce7;
        --color-soft-blue: #dbeaff;
        --color-vivid-green: #16a34a;
        --color-tangerine: #ea580c;
        --color-lavender: #7c3aed;
        --color-primary-action-fill: #000000;

        /* Typography */
        --font-inter: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        --font-mono: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;

        /* Type Scale */
        --text-caption: 11px;
        --text-body: 14px;
        --text-body-lg: 16px;
        --text-subheading: 20px;
        --text-heading-sm: 24px;

        /* Spacing */
        --spacing-4: 4px;
        --spacing-8: 8px;
        --spacing-12: 12px;
        --spacing-16: 16px;
        --spacing-20: 20px;
        --spacing-24: 24px;
        --spacing-32: 32px;

        /* Border Radius */
        --radius-tags: 9999px;
        --radius-cards: 12px;
        --radius-inputs: 6px;
        --radius-buttons: 8px;
        --radius-largecards: 16px;

        /* Shadows */
        --shadow-subtle: rgba(0, 0, 0, 0.05) 0px 1px 2px 0px;
        --shadow-sm: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.1) 0px 2px 4px -2px;
        --shadow-subtle-2: rgba(0, 0, 0, 0.1) 0px 0px 0px 4px;
        --shadow-md: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.1) 0px 4px 6px -4px;

        /* Sidebar width */
        --sidebar-width: 248px;
        --sidebar-collapsed-width: 64px;
    }

    /* =====================================================
       BASE RESET
       ===================================================== */
    *, *::before, *::after {
        box-sizing: border-box;
    }

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body.dub-body {
        font-family: var(--font-inter);
        font-size: var(--text-body);
        color: var(--color-charcoal);
        background-color: var(--color-canvas-white);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* =====================================================
       SHELL LAYOUT
       ===================================================== */
    .dub-shell {
        display: flex;
        height: 100vh;
        overflow: hidden;
        background-color: var(--color-canvas-white);
    }

    .dub-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        min-width: 0;
    }

    .dub-content {
        flex: 1;
        overflow-y: auto;
        padding: var(--spacing-24);
        background-color: var(--color-paper-mist);
    }

    @media (max-width: 767px) {
        .dub-content {
            padding: var(--spacing-16);
        }
    }

    /* =====================================================
       SIDEBAR OVERLAY (mobile)
       ===================================================== */
    .sidebar-overlay {
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.3);
        z-index: 30;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.25s ease, visibility 0.25s ease;
        backdrop-filter: blur(2px);
    }

    .sidebar-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    body.sidebar-open {
        overflow: hidden;
    }

    @media (min-width: 768px) {
        .sidebar-overlay {
            display: none;
        }
    }

    /* =====================================================
       CUSTOM SCROLLBAR
       ===================================================== */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--color-smoke);
        border-radius: 9999px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--color-pebble);
    }

    /* =====================================================
       HAMBURGER MENU
       ===================================================== */
    .hamburger-menu {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border-radius: var(--radius-buttons);
        border: 1px solid var(--color-ash);
        background: var(--color-canvas-white);
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .hamburger-menu:hover {
        background: var(--color-paper-mist);
        border-color: var(--color-smoke);
    }

    .hamburger-icon {
        width: 16px;
        height: 12px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .hamburger-icon .line {
        width: 100%;
        height: 1.5px;
        background-color: var(--color-graphite);
        border-radius: 2px;
        transition: all 0.25s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        transform-origin: center;
    }

    .hamburger-menu.active .line-1 {
        transform: translateY(5.25px) rotate(45deg);
    }

    .hamburger-menu.active .line-2 {
        opacity: 0;
        transform: scaleX(0);
    }

    .hamburger-menu.active .line-3 {
        transform: translateY(-5.25px) rotate(-45deg);
    }

    /* =====================================================
       DUB CARD COMPONENT
       ===================================================== */
    .dub-card {
        background: var(--color-canvas-white);
        border: 1px solid var(--color-ash);
        border-radius: var(--radius-cards);
        padding: var(--spacing-16);
    }

    .dub-card-lg {
        background: var(--color-canvas-white);
        border: 1px solid var(--color-ash);
        border-radius: var(--radius-largecards);
        padding: var(--spacing-16);
    }

    /* =====================================================
       DUB BUTTON COMPONENTS
       ===================================================== */
    .dub-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-family: var(--font-inter);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.2;
        border-radius: 9999px;
        padding: 9px 18px;
        cursor: pointer;
        transition: all 0.15s ease;
        text-decoration: none;
        border: 1px solid transparent;
        white-space: nowrap;
    }

    .dub-btn-primary {
        background: var(--color-primary-action-fill);
        color: #ffffff;
        box-shadow: var(--shadow-subtle);
    }

    .dub-btn-primary:hover {
        background: var(--color-graphite);
        color: #ffffff;
    }

    .dub-btn-outline {
        background: var(--color-canvas-white);
        color: var(--color-charcoal);
        border: 1px solid var(--color-ash);
    }

    .dub-btn-outline:hover {
        background: var(--color-paper-mist);
        border-color: var(--color-smoke);
    }

    .dub-btn-ghost {
        background: transparent;
        color: var(--color-steel);
        border: 1px solid transparent;
    }

    .dub-btn-ghost:hover {
        background: var(--color-paper-mist);
        color: var(--color-charcoal);
    }

    .dub-btn-danger {
        background: var(--color-canvas-white);
        color: #dc2626;
        border: 1px solid var(--color-ash);
    }

    .dub-btn-danger:hover {
        background: #fef2f2;
        border-color: #fecaca;
    }

    /* =====================================================
       DUB BADGE / PILL COMPONENTS
       ===================================================== */
    .dub-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: var(--text-caption);
        font-weight: 500;
        border-radius: var(--radius-tags);
        padding: 3px 8px;
        white-space: nowrap;
    }

    .dub-badge-mint {
        background: var(--color-soft-mint);
        color: var(--color-vivid-green);
    }

    .dub-badge-blue {
        background: var(--color-soft-blue);
        color: var(--color-electric-blue);
    }

    .dub-badge-orange {
        background: #fff7ed;
        color: var(--color-tangerine);
    }

    .dub-badge-violet {
        background: #f5f3ff;
        color: var(--color-lavender);
    }

    .dub-badge-neutral {
        background: var(--color-paper-mist);
        color: var(--color-steel);
    }

    .dub-badge-red {
        background: #fef2f2;
        color: #dc2626;
    }

    /* =====================================================
       DUB TABLE
       ===================================================== */
    .dub-table-wrapper {
        background: var(--color-canvas-white);
        border: 1px solid var(--color-ash);
        border-radius: var(--radius-cards);
        overflow: hidden;
    }

    .dub-table {
        width: 100%;
        border-collapse: collapse;
        font-size: var(--text-body);
    }

    .dub-table thead tr {
        background: var(--color-paper-mist);
        border-bottom: 1px solid var(--color-ash);
    }

    .dub-table thead th {
        padding: 10px 16px;
        text-align: left;
        font-size: var(--text-caption);
        font-weight: 600;
        color: var(--color-fog);
        text-transform: uppercase;
        letter-spacing: 0.06em;
        white-space: nowrap;
    }

    .dub-table tbody tr {
        border-bottom: 1px solid var(--color-ash);
        transition: background 0.1s ease;
    }

    .dub-table tbody tr:last-child {
        border-bottom: none;
    }

    .dub-table tbody tr:hover {
        background: var(--color-paper-mist);
    }

    .dub-table tbody td {
        padding: 12px 16px;
        color: var(--color-charcoal);
        vertical-align: middle;
    }

    /* =====================================================
       DUB INPUT
       ===================================================== */
    .dub-input {
        display: block;
        width: 100%;
        font-family: var(--font-inter);
        font-size: var(--text-body);
        color: var(--color-charcoal);
        background: var(--color-canvas-white);
        border: 1px solid var(--color-ash);
        border-radius: var(--radius-inputs);
        padding: 7px 12px;
        outline: none;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }

    .dub-input:focus {
        border-color: var(--color-electric-blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .dub-input::placeholder {
        color: var(--color-silver);
    }

    /* =====================================================
       SECTION HEADER
       ===================================================== */
    .dub-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 16px;
        border-bottom: 1px solid var(--color-ash);
        background: var(--color-canvas-white);
        gap: var(--spacing-16);
        flex-wrap: wrap;
    }

    .dub-section-header h3 {
        font-size: var(--text-body-lg);
        font-weight: 600;
        color: var(--color-charcoal);
        margin: 0;
    }

    .dub-section-header p {
        font-size: var(--text-body);
        color: var(--color-fog);
        margin: 2px 0 0;
    }

    /* =====================================================
       STAT CARDS
       ===================================================== */
    .dub-stat-card {
        background: var(--color-canvas-white);
        border: 1px solid var(--color-ash);
        border-radius: var(--radius-cards);
        padding: var(--spacing-16);
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .dub-stat-card:hover {
        border-color: var(--color-smoke);
        box-shadow: var(--shadow-subtle);
    }

    /* =====================================================
       ANIMATIONS
       ===================================================== */
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in-up 0.25s ease-out;
    }

    .content-section {
        animation: fade-in-up 0.25s ease-out;
    }

    /* =====================================================
       UTILITY
       ===================================================== */
    .hidden {
        display: none !important;
    }

    .dub-mono {
        font-family: var(--font-mono);
        font-size: var(--text-caption);
        color: var(--color-fog);
    }

    /* =====================================================
       PAGE TITLE
       ===================================================== */
    .dub-page-title {
        font-size: var(--text-body-lg);
        font-weight: 600;
        color: var(--color-charcoal);
        margin: 0;
    }

    .dub-page-subtitle {
        font-size: var(--text-body);
        color: var(--color-fog);
        margin: 2px 0 0;
    }

    /* =====================================================
       SEARCH / FILTER BAR
       ===================================================== */
    .dub-filter-bar {
        display: flex;
        align-items: center;
        gap: var(--spacing-8);
        padding: 12px 16px;
        border-bottom: 1px solid var(--color-ash);
        background: var(--color-canvas-white);
        flex-wrap: wrap;
    }

    /* =====================================================
       PAGINATION
       ===================================================== */
    .dub-pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        border-top: 1px solid var(--color-ash);
        background: var(--color-paper-mist);
        font-size: var(--text-body);
        color: var(--color-fog);
    }

    /* Flowbite pagination override */
    nav[aria-label="Pagination"] {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* =====================================================
       ALERT OVERRIDES
       ===================================================== */
    .dub-alert {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 16px;
        border-radius: var(--radius-cards);
        border: 1px solid;
        margin-bottom: var(--spacing-16);
        font-size: var(--text-body);
        animation: fade-in-up 0.25s ease-out;
    }

    .dub-alert-success {
        background: var(--color-soft-mint);
        border-color: #86efac;
        color: #15803d;
    }

    .dub-alert-error {
        background: #fef2f2;
        border-color: #fecaca;
        color: #b91c1c;
    }

    .dub-alert-warning {
        background: #fffbeb;
        border-color: #fde68a;
        color: #92400e;
    }

    .dub-alert-close {
        margin-left: auto;
        background: none;
        border: none;
        cursor: pointer;
        color: currentColor;
        opacity: 0.6;
        padding: 0;
        line-height: 1;
        flex-shrink: 0;
    }

    .dub-alert-close:hover {
        opacity: 1;
    }

    /* =====================================================
       EMPTY STATE
       ===================================================== */
    .dub-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 48px 24px;
        gap: 12px;
        color: var(--color-fog);
        text-align: center;
    }

    .dub-empty-icon {
        width: 48px;
        height: 48px;
        background: var(--color-paper-mist);
        border: 1px solid var(--color-ash);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: var(--color-silver);
    }

    .dub-empty p {
        margin: 0;
        font-size: var(--text-body);
        font-weight: 500;
        color: var(--color-steel);
    }

    .dub-empty span {
        font-size: var(--text-body);
        color: var(--color-fog);
    }

    /* =====================================================
       AVATAR
       ===================================================== */
    .dub-avatar {
        width: 32px;
        height: 32px;
        border-radius: 9999px;
        background: var(--color-paper-mist);
        border: 1px solid var(--color-ash);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
        color: var(--color-steel);
        flex-shrink: 0;
        overflow: hidden;
    }

    /* =====================================================
       ACTION ICON BUTTONS
       ===================================================== */
    .dub-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: var(--radius-buttons);
        border: 1px solid var(--color-ash);
        background: var(--color-canvas-white);
        color: var(--color-fog);
        cursor: pointer;
        transition: all 0.15s ease;
        text-decoration: none;
        font-size: 13px;
    }

    .dub-action-btn:hover {
        background: var(--color-paper-mist);
        border-color: var(--color-smoke);
        color: var(--color-charcoal);
    }

    .dub-action-btn.view:hover {
        color: var(--color-electric-blue);
        border-color: #bfdbfe;
        background: #eff6ff;
    }

    .dub-action-btn.edit:hover {
        color: var(--color-lavender);
        border-color: #ddd6fe;
        background: #f5f3ff;
    }

    .dub-action-btn.delete:hover {
        color: #dc2626;
        border-color: #fecaca;
        background: #fef2f2;
    }
</style>
