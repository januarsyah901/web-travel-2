<script>
    /* ===================================
       GLOBAL VARIABLES
       =================================== */
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('mobile-menu-overlay');
    const hamburgerBtn = document.getElementById('hamburger-btn');
    let isDesktop = window.innerWidth >= 1024;
    let isTablet = window.innerWidth >= 768 && window.innerWidth < 1024;
    let isMobile = window.innerWidth < 768;

    /* ===================================
       DEVICE TYPE DETECTION
       =================================== */
    function updateDeviceType() {
        isDesktop = window.innerWidth >= 1024;
        isTablet = window.innerWidth >= 768 && window.innerWidth < 1024;
        isMobile = window.innerWidth < 768;
    }

    /* ===================================
       SIDEBAR FUNCTIONS
       =================================== */
    function toggleSidebar() {
        updateDeviceType();

        if (isMobile) {
            // Mobile: Toggle slide in/out with overlay
            const isOpen = sidebar.classList.contains('open');
            if (isOpen) {
                closeSidebar();
            } else {
                openSidebar();
            }
        } else {
            // Tablet & Desktop: Toggle collapsed state
            sidebar.classList.toggle('collapsed');
            hamburgerBtn.classList.toggle('active');

            // Save state to localStorage for desktop
            if (isDesktop) {
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            }
        }
    }

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('show');
        hamburgerBtn.classList.add('active');
        document.body.classList.add('sidebar-open');
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
        hamburgerBtn.classList.remove('active');
        document.body.classList.remove('sidebar-open');
    }

    /* ===================================
       ALERT FUNCTIONS
       =================================== */
    function closeAlert(alertId) {
        const alertElement = document.getElementById(alertId);
        if (alertElement) {
            alertElement.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
            alertElement.style.opacity = '0';
            alertElement.style.transform = 'translateX(100%)';
            setTimeout(() => alertElement.remove(), 300);
        }
    }

    /* ===================================
       IMAGE PREVIEW HELPER
       =================================== */
    function previewImage(input, previewId, placeholderId) {
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById(placeholderId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    /* ===================================
       WINDOW RESIZE HANDLER
       =================================== */
    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const wasMobile = isMobile;
            const wasDesktop = isDesktop;
            updateDeviceType();

            // Transitioning from mobile to tablet/desktop
            if (wasMobile && !isMobile) {
                closeSidebar();
                // Restore collapsed state if transitioning to desktop
                if (isDesktop) {
                    const wasCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                    if (wasCollapsed) {
                        sidebar.classList.add('collapsed');
                        hamburgerBtn.classList.add('active');
                    }
                }
            }

            // Transitioning from tablet/desktop to mobile
            if (!wasMobile && isMobile) {
                sidebar.classList.remove('collapsed');
                hamburgerBtn.classList.remove('active');
                closeSidebar();
            }

            // Restore collapsed state when transitioning to desktop
            if (!wasDesktop && isDesktop) {
                const wasCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                if (wasCollapsed) {
                    sidebar.classList.add('collapsed');
                    hamburgerBtn.classList.add('active');
                }
            }
        }, 150);
    });

    /* ===================================
       PAGE INITIALIZATION
       =================================== */
    document.addEventListener('DOMContentLoaded', function () {
        updateDeviceType();

        // Debug: Force sidebar visible on desktop
        if (!isMobile) {
            console.log('Desktop mode detected - ensuring sidebar is visible');
            sidebar.style.display = 'flex';
            sidebar.style.position = 'static';
            sidebar.style.transform = 'translateX(0)';
        }

        // Restore sidebar state on desktop
        if (isDesktop) {
            const wasCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (wasCollapsed) {
                sidebar.classList.add('collapsed');
                hamburgerBtn.classList.add('active');
            }
        }

        // Auto-dismiss alerts after 5 seconds
        const alerts = ['success-alert', 'error-alert', 'warning-alert'];
        alerts.forEach(alertId => {
            const alert = document.getElementById(alertId);
            if (alert) {
                setTimeout(() => closeAlert(alertId), 5000);
            }
        });

        // Close mobile sidebar when clicking on nav links
        const navLinks = document.querySelectorAll('#sidebar a');
        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                if (isMobile) {
                    closeSidebar();
                }
            });
        });
    });
</script>

