@extends('admin.layouts.app')

@section('title', 'Tambah Kontak - Admin Fabi Abadi')

@section('page-title', 'Tambah Kontak Perusahaan')

@section('content')
<div style="max-width: 800px; margin: 0 auto;" class="space-y-6">

    {{-- Page Header --}}
    <div style="display:flex; align-items:center; justify-content:space-between; gap:16px;">
        <div>
            <h1 style="font-size:20px; font-weight:600; color:var(--color-charcoal); margin:0 0 4px;">Tambah Kontak Perusahaan</h1>
            <p style="font-size:14px; color:var(--color-fog); margin:0;">Isi informasi kontak, media sosial, dan Google Maps embed.</p>
        </div>
        <a href="{{ route('contact.index') }}" class="dub-btn dub-btn-outline">
            <i class="fas fa-arrow-left" style="font-size:12px;"></i> Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="dub-card" style="padding:24px;">
        <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
            @csrf

            {{-- Section 1: Informasi Utama --}}
            <div>
                <h3 style="font-size:15px; font-weight:600; color:var(--color-charcoal); margin:0 0 14px; padding-bottom:8px; border-bottom:1px solid var(--color-ash);">
                    Informasi Perusahaan
                </h3>
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:16px;">
                    <div>
                        <label for="company_name" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Nama Perusahaan <span class="text-red-500">*</span></label>
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" placeholder="Contoh: PT Fabi Abadi Travel" class="dub-input" required>
                    </div>

                    <div>
                        <label for="phone" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Nomor Telepon / WA <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Contoh: 081234567890" class="dub-input" required>
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Email Official <span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="info@fabiabadi.com" class="dub-input" required>
                    </div>

                    <div>
                        <label for="working_hours" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Jam Operasional</label>
                        <input type="text" name="working_hours" id="working_hours" value="{{ old('working_hours') }}" placeholder="Senin - Sabtu: 08.00 - 17.00" class="dub-input">
                    </div>
                </div>

                <div style="margin-top:16px;">
                    <label for="address" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="address" id="address" rows="3" class="dub-input resize-none" required>{{ old('address') }}</textarea>
                </div>
            </div>

            {{-- Section 2: Media Sosial --}}
            <div>
                <h3 style="font-size:15px; font-weight:600; color:var(--color-charcoal); margin:0 0 14px; padding-bottom:8px; border-bottom:1px solid var(--color-ash);">
                    Media Sosial (Opsional)
                </h3>
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:12px;">
                    <div>
                        <label for="facebook" class="block text-xs text-[var(--color-fog)] mb-1"><i class="fab fa-facebook-f" style="color:#1877F2;"></i> Facebook</label>
                        <input type="url" name="facebook" id="facebook" value="{{ old('facebook') }}" placeholder="https://facebook.com/username" class="dub-input">
                    </div>

                    <div>
                        <label for="instagram" class="block text-xs text-[var(--color-fog)] mb-1"><i class="fab fa-instagram" style="color:#E4405F;"></i> Instagram</label>
                        <input type="url" name="instagram" id="instagram" value="{{ old('instagram') }}" placeholder="https://instagram.com/username" class="dub-input">
                    </div>

                    <div>
                        <label for="twitter" class="block text-xs text-[var(--color-fog)] mb-1"><i class="fab fa-twitter" style="color:#1DA1F2;"></i> Twitter / X</label>
                        <input type="url" name="twitter" id="twitter" value="{{ old('twitter') }}" placeholder="https://twitter.com/username" class="dub-input">
                    </div>

                    <div>
                        <label for="youtube" class="block text-xs text-[var(--color-fog)] mb-1"><i class="fab fa-youtube" style="color:#FF0000;"></i> YouTube</label>
                        <input type="url" name="youtube" id="youtube" value="{{ old('youtube') }}" placeholder="https://youtube.com/@username" class="dub-input">
                    </div>

                    <div>
                        <label for="tiktok" class="block text-xs text-[var(--color-fog)] mb-1"><i class="fab fa-tiktok"></i> TikTok</label>
                        <input type="url" name="tiktok" id="tiktok" value="{{ old('tiktok') }}" placeholder="https://tiktok.com/@username" class="dub-input">
                    </div>

                    <div>
                        <label for="linkedin" class="block text-xs text-[var(--color-fog)] mb-1"><i class="fab fa-linkedin-in" style="color:#0A66C2;"></i> LinkedIn</label>
                        <input type="url" name="linkedin" id="linkedin" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/company/nama" class="dub-input">
                    </div>

                    <div>
                        <label for="pinterest" class="block text-xs text-[var(--color-fog)] mb-1"><i class="fab fa-pinterest-p" style="color:#E60023;"></i> Pinterest</label>
                        <input type="url" name="pinterest" id="pinterest" value="{{ old('pinterest') }}" placeholder="https://pinterest.com/username" class="dub-input">
                    </div>

                    <div>
                        <label for="telegram" class="block text-xs text-[var(--color-fog)] mb-1"><i class="fab fa-telegram-plane" style="color:#0088CC;"></i> Telegram</label>
                        <input type="url" name="telegram" id="telegram" value="{{ old('telegram') }}" placeholder="https://t.me/username" class="dub-input">
                    </div>
                </div>
            </div>

            {{-- Section 3: Google Maps Embed --}}
            <div>
                <h3 style="font-size:15px; font-weight:600; color:var(--color-charcoal); margin:0 0 14px; padding-bottom:8px; border-bottom:1px solid var(--color-ash);">
                    Google Maps Embed
                </h3>
                <div>
                    <label for="maps_embed" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Kode Embed HTML Maps</label>
                    <textarea name="maps_embed" id="maps_embed" rows="4" placeholder='<iframe src="https://www.google.com/maps/embed?..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>' class="dub-input resize-none font-mono" style="font-size:13px;">{{ old('maps_embed') }}</textarea>
                    <p style="font-size:12px; color:var(--color-fog); margin-top:4px;">
                        <i class="fas fa-info-circle"></i> Salin kode embed HTML dari Google Maps (Bagikan / Share → Sematkan peta / Embed a map).
                    </p>
                </div>
            </div>

            {{-- Section 4: Status --}}
            <div style="display:flex; align-items:center; gap:8px;">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width:16px; height:16px; cursor:pointer;">
                <label for="is_active" style="font-size:13px; font-weight:500; color:var(--color-charcoal); cursor:pointer;">Aktifkan informasi kontak ini</label>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:8px; padding-top:16px; border-top:1px solid var(--color-ash);">
                <a href="{{ route('contact.index') }}" class="dub-btn dub-btn-outline">
                    Batal
                </a>
                <button type="submit" class="dub-btn dub-btn-primary">
                    <i class="fas fa-save" style="font-size:12px;"></i> Simpan Kontak
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
