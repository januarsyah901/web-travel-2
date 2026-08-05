@extends('admin.layouts.app')

@section('title', 'Tambah Booking - Admin Fabi Abadi')

@section('page-title', 'Tambah Booking Baru')

@section('content')
<div style="max-width: 768px; margin: 0 auto;" class="space-y-6">

    {{-- Page Header --}}
    <div style="display:flex; align-items:center; justify-content:space-between; gap:16px;">
        <div>
            <h1 style="font-size:20px; font-weight:600; color:var(--color-charcoal); margin:0 0 4px;">Tambah Booking Baru</h1>
            <p style="font-size:14px; color:var(--color-fog); margin:0;">Daftarkan booking jamaah dengan teliti.</p>
        </div>
        <a href="{{ route('admin.dashboard', ['section' => 'bookings']) }}" class="dub-btn dub-btn-outline">
            <i class="fas fa-arrow-left" style="font-size:12px;"></i> Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="dub-card" style="padding:24px;">
        <form method="POST" action="{{ route('bookings.store') }}" class="space-y-5">
            @csrf

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:16px;">
                <div>
                    <label for="user_id" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Pilih Jamaah <span class="text-red-500">*</span></label>
                    <div style="position:relative; margin-bottom:8px;">
                        <input type="text" id="searchJamaah" placeholder="Cari nama atau telepon..." 
                               class="dub-input" style="padding-left:32px; font-size:13px;"
                               onkeyup="filterJamaah()">
                        <span style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--color-silver); pointer-events:none;">
                            <i class="fas fa-search" style="font-size:12px;"></i>
                        </span>
                    </div>
                    <select name="user_id" id="user_id" size="5" class="dub-input" style="height:auto;" required>
                        <option value="" disabled {{ old('user_id') ? '' : 'selected' }}>-- Pilih Jamaah --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }} data-name="{{ strtolower($user->fullName) }}" data-phone="{{ $user->phone }}" style="padding:6px 8px;">
                                {{ $user->fullName }} ({{ $user->phone ?? 'no phone' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="package_id" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Pilih Paket <span class="text-red-500">*</span></label>
                        <select name="package_id" id="package_id" class="dub-input" required>
                            <option value="">-- Pilih Paket --</option>
                            @foreach($packages as $package)
                                <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                    {{ $package->title }} (Rp {{ number_format($package->price, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Status <span class="text-red-500">*</span></label>
                        <select name="status" id="status" class="dub-input" required>
                            <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                            <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed (Lunas)</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled (Batal)</option>
                        </select>
                    </div>

                    <div>
                        <label for="registered_at" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Tanggal Daftar <span class="text-red-500">*</span></label>
                        <input type="date" name="registered_at" id="registered_at" value="{{ old('registered_at', date('Y-m-d')) }}" class="dub-input" required>
                    </div>
                </div>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:8px; padding-top:16px; border-top:1px solid var(--color-ash);">
                <a href="{{ route('admin.dashboard', ['section' => 'bookings']) }}" class="dub-btn dub-btn-outline">
                    Batal
                </a>
                <button type="submit" class="dub-btn dub-btn-primary">
                    <i class="fas fa-save" style="font-size:12px;"></i> Simpan Booking
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
function filterJamaah() {
    const searchInput = document.getElementById('searchJamaah');
    const select = document.getElementById('user_id');
    const filter = searchInput.value.toLowerCase();
    const options = select.getElementsByTagName('option');

    for (let i = 0; i < options.length; i++) {
        const option = options[i];
        if (option.value === '') continue;
        const name = option.getAttribute('data-name') || '';
        const phone = option.getAttribute('data-phone') || '';
        
        if (name.indexOf(filter) > -1 || phone.indexOf(filter) > -1) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    }
}
</script>
@endpush
