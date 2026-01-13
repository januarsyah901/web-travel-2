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

    /* ===================================
       LIVE SEARCH - USERS SECTION
       =================================== */
    (function() {
        // DOM Elements
        const searchInput = document.getElementById('searchInput');
        const searchLoader = document.getElementById('searchLoader');
        const usersTableBody = document.getElementById('usersTableBody');

        // Exit if elements don't exist (not on users page)
        if (!searchInput || !usersTableBody) return;

        let searchTimeout;
        const originalContent = usersTableBody.innerHTML;

        // Debounce function for better performance
        function debounce(func, delay) {
            return function() {
                const context = this;
                const args = arguments;
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => func.apply(context, args), delay);
            };
        }

        // Function to render users in table
        function renderUsers(users) {
            // Empty state
            if (users.length === 0) {
                usersTableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <div class="p-4 bg-gray-50 rounded-full">
                                    <i class="fas fa-search text-gray-400 text-3xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Tidak ada hasil untuk pencarian ini</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            let html = '';
            users.forEach(user => {
                const passportBadge = user.hasPassport
                    ? '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200"><i class="fas fa-check-circle mr-1.5"></i> Ada</span>'
                    : '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200"><i class="fas fa-times-circle mr-1.5"></i> Belum</span>';

                html += `
                    <tr class="hover:bg-gray-50/80 transition-colors duration-150">
                        <td class="px-6 py-4 text-sm text-gray-500 font-mono">#${user.id}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-900">${user.fullName}</span>
                                <span class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                    <i class="fab fa-whatsapp text-green-500"></i> ${user.phone}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-700 flex items-center gap-2">
                                <i class="far fa-calendar-alt text-gray-400"></i>
                                ${user.birthDate}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-600 block max-w-xs truncate" title="${user.address}">
                                ${user.address.substring(0, 35)}${user.address.length > 35 ? '...' : ''}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            ${passportBadge}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="/users/${user.id}" class="group p-2 text-teal-600 hover:bg-teal-50 rounded-lg transition-all duration-200" title="Lihat Detail">
                                    <i class="fas fa-eye text-lg group-hover:scale-110 transition-transform"></i>
                                </a>
                                <a href="/users/${user.id}/edit" class="group p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200" title="Edit Data">
                                    <i class="fas fa-edit text-lg group-hover:scale-110 transition-transform"></i>
                                </a>
                                <form method="POST" action="/users/${user.id}" class="inline-block" onsubmit="return handleDeleteUser(event, '${user.fullName.replace(/'/g, "\\'")}');">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="group p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200" title="Hapus Permanen">
                                        <i class="fas fa-trash-alt text-lg group-hover:scale-110 transition-transform"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                `;
            });

            usersTableBody.innerHTML = html;
        }

        // Search function
        function performSearch() {
            const searchTerm = searchInput.value.trim();

            // If search is empty, restore original content
            if (searchTerm === '') {
                usersTableBody.innerHTML = originalContent;
                return;
            }

            // Show loader
            if (searchLoader) {
                searchLoader.classList.remove('hidden');
                searchLoader.classList.add('flex');
            }

            // Perform AJAX request
            fetch(`/users/search?search=${encodeURIComponent(searchTerm)}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data && data.users) {
                    renderUsers(data.users);
                } else {
                    throw new Error('Invalid response format');
                }
            })
            .catch(error => {
                console.error('Search error:', error);
                usersTableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <div class="p-4 bg-red-50 rounded-full">
                                    <i class="fas fa-exclamation-circle text-red-400 text-3xl"></i>
                                </div>
                                <p class="text-red-500 font-medium">Terjadi kesalahan saat mencari</p>
                                <p class="text-xs text-gray-500">${error.message}</p>
                            </div>
                        </td>
                    </tr>
                `;
            })
            .finally(() => {
                // Hide loader
                if (searchLoader) {
                    searchLoader.classList.add('hidden');
                    searchLoader.classList.remove('flex');
                }
            });
        }

        // Attach event listener with debounce
        searchInput.addEventListener('input', debounce(performSearch, 300));
    })();

    /* ===================================
       CUSTOM DELETE HANDLERS
       =================================== */
    async function handleDeletePartner(event, name) {
        event.preventDefault();
        const confirmed = await customConfirm(
            `Partner "${name}" akan dihapus dari daftar. Lanjutkan?`,
            {
                title: 'Hapus Partner',
                type: 'warning',
                confirmText: 'Ya, Hapus',
                confirmClass: 'px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 font-medium transition-colors shadow-sm'
            }
        );
        if (confirmed) {
            event.target.submit();
        }
        return false;
    }

    async function handleDeletePackage(event, name) {
        event.preventDefault();
        const confirmed = await customConfirm(
            `Paket "${name}" akan dihapus permanen. Data yang dihapus tidak dapat dikembalikan. Apakah Anda yakin?`,
            {
                title: 'Hapus Paket',
                type: 'danger',
                confirmText: 'Ya, Hapus Paket',
                confirmClass: 'px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 font-medium transition-colors shadow-sm'
            }
        );
        if (confirmed) {
            event.target.submit();
        }
        return false;
    }

    async function handleDeleteUser(event, name) {
        event.preventDefault();
        const confirmed = await customConfirm(
            `Data pendaftar "${name}" akan dihapus. Data yang terkait (seperti booking) mungkin akan terpengaruh. Lanjutkan?`,
            {
                title: 'Hapus Pendaftar',
                type: 'danger',
                confirmText: 'Ya, Hapus',
                confirmClass: 'px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 font-medium transition-colors shadow-sm'
            }
        );
        if (confirmed) {
            event.target.submit();
        }
        return false;
    }

    async function handleDeleteBooking(event, name) {
        event.preventDefault();
        const confirmed = await customConfirm(
            `Booking untuk "${name}" akan dihapus. Lanjutkan?`,
            {
                title: 'Hapus Booking',
                type: 'warning',
                confirmText: 'Ya, Hapus',
                confirmClass: 'px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 font-medium transition-colors shadow-sm'
            }
        );
        if (confirmed) {
            event.target.submit();
        }
        return false;
    }

    async function handleDeleteTestimonial(event, name) {
        event.preventDefault();
        const confirmed = await customConfirm(
            `Testimoni dari "${name}" akan dihapus. Lanjutkan?`,
            {
                title: 'Hapus Testimoni',
                type: 'warning',
                confirmText: 'Ya, Hapus',
                confirmClass: 'px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 font-medium transition-colors shadow-sm'
            }
        );
        if (confirmed) {
            event.target.submit();
        }
        return false;
    }

    async function handleDeleteGallery(event, title) {
        event.preventDefault();
        const confirmed = await customConfirm(
            `Foto "${title}" akan dihapus dari galeri. Lanjutkan?`,
            {
                title: 'Hapus Foto',
                type: 'warning',
                confirmText: 'Ya, Hapus',
                confirmClass: 'px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 font-medium transition-colors shadow-sm'
            }
        );
        if (confirmed) {
            event.target.submit();
        }
        return false;
    }
</script>

