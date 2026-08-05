{{-- Success Alert --}}
@if(session('success'))
    <div id="success-alert" class="dub-alert dub-alert-success">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="flex-shrink:0;margin-top:1px;">
            <path d="M13.5 4.5L6 12L2.5 8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div style="flex:1;min-width:0;">
            <p style="font-weight:600;margin:0 0 2px;font-size:14px;">Berhasil!</p>
            <p style="margin:0;font-size:13px;opacity:0.85;">{{ session('success') }}</p>
        </div>
        <button onclick="closeAlert('success-alert')" class="dub-alert-close" aria-label="Tutup">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M1 1L13 13M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </button>
    </div>
@endif

{{-- Error Alert --}}
@if(session('error') || $errors->any())
    <div id="error-alert" class="dub-alert dub-alert-error">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="flex-shrink:0;margin-top:1px;">
            <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/>
            <path d="M8 5V8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            <circle cx="8" cy="11" r="0.75" fill="currentColor"/>
        </svg>
        <div style="flex:1;min-width:0;">
            <p style="font-weight:600;margin:0 0 2px;font-size:14px;">Terjadi Kesalahan</p>
            @if(session('error'))
                <p style="margin:0;font-size:13px;opacity:0.85;">{{ session('error') }}</p>
            @endif
            @if($errors->any())
                <ul style="margin:4px 0 0;padding-left:16px;font-size:13px;opacity:0.85;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <button onclick="closeAlert('error-alert')" class="dub-alert-close" aria-label="Tutup">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M1 1L13 13M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </button>
    </div>
@endif

{{-- Warning Alert --}}
@if(session('warning'))
    <div id="warning-alert" class="dub-alert dub-alert-warning">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="flex-shrink:0;margin-top:1px;">
            <path d="M8 1.5L14.5 13H1.5L8 1.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M8 6V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            <circle cx="8" cy="11" r="0.75" fill="currentColor"/>
        </svg>
        <div style="flex:1;min-width:0;">
            <p style="font-weight:600;margin:0 0 2px;font-size:14px;">Peringatan</p>
            <p style="margin:0;font-size:13px;opacity:0.85;">{{ session('warning') }}</p>
        </div>
        <button onclick="closeAlert('warning-alert')" class="dub-alert-close" aria-label="Tutup">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M1 1L13 13M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </button>
    </div>
@endif
