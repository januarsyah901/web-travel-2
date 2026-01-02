<style>
    /* ===================================
       HAMBURGER MENU STYLES
       =================================== */
    .hamburger-menu {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .hamburger-icon {
        width: 24px;
        height: 18px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .hamburger-icon .line {
        width: 100%;
        height: 2px;
        background-color: currentColor;
        border-radius: 2px;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        transform-origin: center;
    }

    /* Hamburger Active State (X) */
    .hamburger-menu.active .line-1 {
        transform: translateY(8px) rotate(45deg);
    }

    .hamburger-menu.active .line-2 {
        opacity: 0;
        transform: scaleX(0);
    }

    .hamburger-menu.active .line-3 {
        transform: translateY(-8px) rotate(-45deg);
    }

    /* ===================================
       OVERLAY STYLES
       =================================== */
    .sidebar-overlay {
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 30;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        backdrop-filter: blur(2px);
    }

    .sidebar-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    /* Prevent body scroll when sidebar is open on mobile */
    body.sidebar-open {
        overflow: hidden;
    }

    @media (min-width: 768px) {
        .sidebar-overlay {
            display: none;
        }
    }

    /* ===================================
       CUSTOM SCROLLBAR
       =================================== */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* ===================================
       ANIMATIONS
       =================================== */
    @keyframes fade-in {
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
        animation: fade-in 0.3s ease-out;
    }

    /* ===================================
       UTILITY CLASSES
       =================================== */
    .hidden {
        display: none !important;
    }

    /* Tab content transition */
    .content-section {
        animation: fade-in 0.3s ease-out;
    }
</style>

