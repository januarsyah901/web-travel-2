<!-- Custom Alert/Confirm Modal -->
<div id="customAlertModal" class="fixed inset-0 bg-gray-900/20 backdrop-blur-sm hidden z-[9999] flex items-center justify-center p-4 transition-all duration-300" onclick="closeCustomAlert(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0" id="customAlertContent" onclick="event.stopPropagation()">
        <!-- Header -->
        <div class="p-6 pb-4">
            <div class="flex items-center gap-4">
                <div id="customAlertIcon" class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center">
                    <!-- Icon will be inserted here -->
                </div>
                <div class="flex-1">
                    <h3 id="customAlertTitle" class="text-lg font-bold text-gray-900"></h3>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="px-6 pb-6">
            <p id="customAlertMessage" class="text-gray-600 leading-relaxed"></p>
        </div>

        <!-- Footer -->
        <div id="customAlertFooter" class="px-6 pb-6 flex gap-3 justify-end">
            <!-- Buttons will be inserted here -->
        </div>
    </div>
</div>

<script>
let customAlertCallback = null;
let customAlertForm = null;

function showCustomAlert(options) {
    const modal = document.getElementById('customAlertModal');
    const content = document.getElementById('customAlertContent');
    const icon = document.getElementById('customAlertIcon');
    const title = document.getElementById('customAlertTitle');
    const message = document.getElementById('customAlertMessage');
    const footer = document.getElementById('customAlertFooter');

    // Set content
    title.textContent = options.title || 'Pemberitahuan';
    message.textContent = options.message || '';

    // Set icon based on type
    const iconHTML = {
        'warning': `
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
        `,
        'danger': `
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        `,
        'success': `
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        `,
        'info': `
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        `
    };
    icon.innerHTML = iconHTML[options.type || 'info'];

    // Set buttons
    footer.innerHTML = '';
    
    if (options.showCancel) {
        const cancelBtn = document.createElement('button');
        cancelBtn.type = 'button';
        cancelBtn.className = 'px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 font-medium transition-colors';
        cancelBtn.textContent = options.cancelText || 'Batal';
        cancelBtn.onclick = () => {
            closeCustomAlert();
            if (options.onCancel) options.onCancel();
        };
        footer.appendChild(cancelBtn);
    }

    const confirmBtn = document.createElement('button');
    confirmBtn.type = 'button';
    confirmBtn.className = options.confirmClass || 'px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 font-medium transition-colors shadow-sm';
    confirmBtn.textContent = options.confirmText || 'OK';
    confirmBtn.onclick = () => {
        closeCustomAlert();
        if (options.onConfirm) options.onConfirm();
    };
    footer.appendChild(confirmBtn);

    // Show modal with animation
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('bg-gray-900/20');
        modal.classList.add('bg-gray-900/30');
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeCustomAlert(event) {
    if (event && event.target.id !== 'customAlertModal') return;
    
    const modal = document.getElementById('customAlertModal');
    const content = document.getElementById('customAlertContent');
    
    modal.classList.remove('bg-gray-900/30');
    modal.classList.add('bg-gray-900/20');
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function customConfirm(message, options = {}) {
    return new Promise((resolve) => {
        showCustomAlert({
            title: options.title || 'Konfirmasi',
            message: message,
            type: options.type || 'warning',
            showCancel: true,
            cancelText: options.cancelText || 'Batal',
            confirmText: options.confirmText || 'Ya, Lanjutkan',
            confirmClass: options.confirmClass || 'px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 font-medium transition-colors shadow-sm',
            onConfirm: () => resolve(true),
            onCancel: () => resolve(false)
        });
    });
}

function customAlert(message, options = {}) {
    showCustomAlert({
        title: options.title || 'Pemberitahuan',
        message: message,
        type: options.type || 'info',
        showCancel: false,
        confirmText: options.confirmText || 'OK',
        confirmClass: 'px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 font-medium transition-colors shadow-sm',
        onConfirm: options.onConfirm
    });
}

// Close on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('customAlertModal');
        if (modal && !modal.classList.contains('hidden')) {
            closeCustomAlert();
        }
    }
});
</script>
