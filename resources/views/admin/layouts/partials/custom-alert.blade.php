{{-- Custom Alert / Confirm Modal --}}
<div id="customAlertModal"
     class="dub-modal-backdrop hidden"
     onclick="closeCustomAlert(event)">
    <div class="dub-modal" id="customAlertContent" onclick="event.stopPropagation()">

        {{-- Header --}}
        <div class="dub-modal-header">
            <div id="customAlertIcon" class="dub-modal-icon"></div>
            <h3 id="customAlertTitle" class="dub-modal-title"></h3>
            <button class="dub-modal-close" onclick="closeCustomAlert()" aria-label="Tutup">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M1 1L13 13M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </button>
        </div>

        {{-- Divider --}}
        <div style="height:1px;background:var(--color-ash);"></div>

        {{-- Body --}}
        <div class="dub-modal-body">
            <p id="customAlertMessage" style="margin:0;font-size:14px;color:var(--color-steel);line-height:1.6;"></p>
        </div>

        {{-- Footer --}}
        <div id="customAlertFooter" class="dub-modal-footer"></div>

    </div>
</div>

<style>
    .dub-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(4px);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
        transition: opacity 0.2s ease;
    }

    .dub-modal-backdrop.hidden {
        display: none !important;
    }

    .dub-modal {
        background: var(--color-canvas-white);
        border: 1px solid var(--color-ash);
        border-radius: var(--radius-largecards);
        max-width: 420px;
        width: 100%;
        box-shadow: var(--shadow-md);
        transform: translateY(0);
        opacity: 1;
        transition: transform 0.2s ease, opacity 0.2s ease;
    }

    .dub-modal.entering {
        transform: translateY(8px);
        opacity: 0;
    }

    .dub-modal-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
    }

    .dub-modal-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .dub-modal-title {
        flex: 1;
        font-size: 15px;
        font-weight: 600;
        color: var(--color-charcoal);
        margin: 0;
    }

    .dub-modal-close {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 6px;
        border: 1px solid var(--color-ash);
        background: var(--color-canvas-white);
        color: var(--color-fog);
        cursor: pointer;
        transition: all 0.15s ease;
        flex-shrink: 0;
    }

    .dub-modal-close:hover {
        background: var(--color-paper-mist);
        color: var(--color-charcoal);
        border-color: var(--color-smoke);
    }

    .dub-modal-body {
        padding: 16px 20px;
    }

    .dub-modal-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        padding: 14px 20px;
        border-top: 1px solid var(--color-ash);
        background: var(--color-paper-mist);
        border-radius: 0 0 var(--radius-largecards) var(--radius-largecards);
    }
</style>

<script>
let customAlertCallback = null;
let customAlertForm = null;

function showCustomAlert(options) {
    const modal    = document.getElementById('customAlertModal');
    const content  = document.getElementById('customAlertContent');
    const icon     = document.getElementById('customAlertIcon');
    const title    = document.getElementById('customAlertTitle');
    const message  = document.getElementById('customAlertMessage');
    const footer   = document.getElementById('customAlertFooter');

    title.textContent   = options.title || 'Pemberitahuan';
    message.textContent = options.message || '';

    // Icons
    const iconMap = {
        warning: {
            bg: '#fffbeb', color: '#d97706',
            svg: `<path d="M8 3L14 13H2L8 3Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                  <path d="M8 7V9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                  <circle cx="8" cy="11.5" r="0.5" fill="currentColor"/>`,
            vb: '0 0 16 16'
        },
        danger: {
            bg: '#fef2f2', color: '#dc2626',
            svg: `<circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.5"/>
                  <path d="M8 5V8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                  <circle cx="8" cy="10.5" r="0.5" fill="currentColor"/>`,
            vb: '0 0 16 16'
        },
        success: {
            bg: '#f0fdf4', color: '#16a34a',
            svg: `<path d="M2.5 8L6 11.5L13.5 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>`,
            vb: '0 0 16 16'
        },
        info: {
            bg: '#eff6ff', color: '#2563eb',
            svg: `<circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.5"/>
                  <path d="M8 7V11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                  <circle cx="8" cy="5" r="0.5" fill="currentColor"/>`,
            vb: '0 0 16 16'
        },
    };

    const t = iconMap[options.type || 'info'];
    icon.style.background = t.bg;
    icon.innerHTML = `<svg width="16" height="16" viewBox="${t.vb}" fill="none" style="color:${t.color}">${t.svg}</svg>`;

    // Buttons
    footer.innerHTML = '';

    if (options.showCancel) {
        const cancelBtn = document.createElement('button');
        cancelBtn.type = 'button';
        cancelBtn.className = 'dub-btn dub-btn-outline';
        cancelBtn.textContent = options.cancelText || 'Batal';
        cancelBtn.onclick = () => {
            closeCustomAlert();
            if (options.onCancel) options.onCancel();
        };
        footer.appendChild(cancelBtn);
    }

    const confirmBtn = document.createElement('button');
    confirmBtn.type = 'button';
    confirmBtn.className = options.confirmClass || 'dub-btn dub-btn-primary';
    confirmBtn.textContent = options.confirmText || 'OK';
    confirmBtn.onclick = () => {
        closeCustomAlert();
        if (options.onConfirm) options.onConfirm();
    };
    footer.appendChild(confirmBtn);

    // Show
    modal.classList.remove('hidden');
    content.classList.add('entering');
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            content.classList.remove('entering');
        });
    });
}

function closeCustomAlert(event) {
    if (event && event.target.id !== 'customAlertModal') return;
    const modal = document.getElementById('customAlertModal');
    modal.classList.add('hidden');
}

function customConfirm(message, options = {}) {
    return new Promise((resolve) => {
        showCustomAlert({
            title:        options.title || 'Konfirmasi',
            message:      message,
            type:         options.type || 'warning',
            showCancel:   true,
            cancelText:   options.cancelText || 'Batal',
            confirmText:  options.confirmText || 'Ya, Lanjutkan',
            confirmClass: options.confirmClass || 'dub-btn dub-btn-primary',
            onConfirm:    () => resolve(true),
            onCancel:     () => resolve(false)
        });
    });
}

function customAlert(message, options = {}) {
    showCustomAlert({
        title:       options.title || 'Pemberitahuan',
        message:     message,
        type:        options.type || 'info',
        showCancel:  false,
        confirmText: options.confirmText || 'OK',
        confirmClass:'dub-btn dub-btn-primary',
        onConfirm:   options.onConfirm
    });
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('customAlertModal');
        if (modal && !modal.classList.contains('hidden')) {
            closeCustomAlert();
        }
    }
});
</script>
