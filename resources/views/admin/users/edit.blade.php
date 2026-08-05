@extends('admin.layouts.app')

@section('title', 'Edit Data - ' . $user->fullName)

@section('page-title', 'Edit Data Pendaftar')

@section('content')
<div style="max-width: 800px; margin: 0 auto;" class="space-y-6">

    {{-- Page Header --}}
    <div style="display:flex; align-items:center; justify-content:space-between; gap:16px;">
        <div>
            <h1 style="font-size:20px; font-weight:600; color:var(--color-charcoal); margin:0 0 4px;">Edit Data Pendaftar</h1>
            <p style="font-size:14px; color:var(--color-fog); margin:0;">Perbarui informasi jamaah dengan teliti.</p>
        </div>
        <a href="{{ route('users.show', $user->id) }}" class="dub-btn dub-btn-outline">
            <i class="fas fa-arrow-left" style="font-size:12px;"></i> Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="dub-card" style="padding:24px;">
        <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:16px;">
                <div>
                    <label for="fullName" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="fullName" id="fullName" value="{{ old('fullName', $user->fullName) }}" class="dub-input" required>
                </div>

                <div>
                    <label for="birthDate" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="birthDate" id="birthDate" value="{{ old('birthDate', $user->birthDate ? $user->birthDate->format('Y-m-d') : '') }}" class="dub-input" required>
                </div>

                <div>
                    <label for="phone" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Nomor WhatsApp <span class="text-red-500">*</span></label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx" class="dub-input" required>
                </div>

                <div>
                    <label for="email" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Email (Opsional)</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="contoh@email.com" class="dub-input">
                </div>
            </div>

            <div>
                <label for="address" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Alamat Domisili <span class="text-red-500">*</span></label>
                <textarea name="address" id="address" rows="3" class="dub-input resize-none" required>{{ old('address', $user->address) }}</textarea>
            </div>

            <div style="padding-top:16px; border-top:1px solid var(--color-ash);">
                <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-2">Status Kepemilikan Paspor <span class="text-red-500">*</span></label>
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:12px;">
                    <label class="dub-card" style="display:flex; align-items:center; gap:10px; cursor:pointer; padding:12px 14px;">
                        <input type="radio" name="hasPassport" value="1" id="hasPassportYes" {{ old('hasPassport', $user->hasPassport) == 1 ? 'checked' : '' }}>
                        <div>
                            <span style="font-size:13px; font-weight:600; color:var(--color-charcoal); display:block;">Sudah Ada Paspor</span>
                            <span style="font-size:11px; color:var(--color-fog);">Memiliki dokumen paspor aktif</span>
                        </div>
                    </label>

                    <label class="dub-card" style="display:flex; align-items:center; gap:10px; cursor:pointer; padding:12px 14px;">
                        <input type="radio" name="hasPassport" value="0" id="hasPassportNo" {{ old('hasPassport', $user->hasPassport) == 0 ? 'checked' : '' }}>
                        <div>
                            <span style="font-size:13px; font-weight:600; color:var(--color-charcoal); display:block;">Belum Ada Paspor</span>
                            <span style="font-size:11px; color:var(--color-fog);">Perlu pengurusan paspor</span>
                        </div>
                    </label>
                </div>

                {{-- Passport Upload --}}
                <div id="passportUploadSection" class="dub-card {{ old('hasPassport', $user->hasPassport) == 1 ? '' : 'hidden' }}" style="margin-top:12px; background:var(--color-paper-mist); padding:16px;">
                    <label for="passport_file" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">File Paspor Baru (PDF/Image)</label>
                    <input type="file" name="passport_file" id="passport_file" accept=".pdf,.jpg,.jpeg,.png" class="dub-input" style="background:#fff;">
                    <p style="font-size:11px; color:var(--color-fog); margin-top:4px;">PDF, JPG, PNG (Max 2MB)</p>
                    @if(isset($user->passport) && $user->passport->file_path)
                        <p style="font-size:12px; color:var(--color-electric-blue); margin-top:6px; font-weight:500;">
                            <i class="fas fa-file"></i> {{ basename($user->passport->file_path) }}
                        </p>
                    @endif
                </div>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:8px; padding-top:16px; border-top:1px solid var(--color-ash);">
                <a href="{{ route('users.show', $user->id) }}" class="dub-btn dub-btn-outline">
                    Batal
                </a>
                <button type="submit" class="dub-btn dub-btn-primary">
                    <i class="fas fa-save" style="font-size:12px;"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
    const hasPassportYes = document.getElementById('hasPassportYes');
    const hasPassportNo = document.getElementById('hasPassportNo');
    const passportUploadSection = document.getElementById('passportUploadSection');

    function togglePassportSection() {
        if (hasPassportYes.checked) {
            passportUploadSection.classList.remove('hidden');
        } else {
            passportUploadSection.classList.add('hidden');
        }
    }

    hasPassportYes.addEventListener('change', togglePassportSection);
    hasPassportNo.addEventListener('change', togglePassportSection);
</script>
@endpush
