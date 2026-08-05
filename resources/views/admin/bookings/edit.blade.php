@extends('admin.layouts.app')

@section('title', 'Edit Booking - #' . $booking->id)

@section('page-title', 'Edit Booking')

@section('content')
<div style="max-width: 768px; margin: 0 auto;" class="space-y-6">

    {{-- Page Header --}}
    <div style="display:flex; align-items:center; justify-content:space-between; gap:16px;">
        <div>
            <h1 style="font-size:20px; font-weight:600; color:var(--color-charcoal); margin:0 0 4px;">Edit Booking #{{ $booking->id }}</h1>
            <p style="font-size:14px; color:var(--color-fog); margin:0;">Perbarui informasi booking dengan teliti.</p>
        </div>
        <a href="{{ route('admin.dashboard', ['section' => 'bookings']) }}" class="dub-btn dub-btn-outline">
            <i class="fas fa-arrow-left" style="font-size:12px;"></i> Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="dub-card" style="padding:24px;">
        <form method="POST" action="{{ route('bookings.update', $booking->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:16px;">
                <div>
                    <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Nama Jamaah</label>
                    <div class="dub-card" style="padding:10px 12px; background:var(--color-paper-mist);">
                        <div style="display:flex; align-items:center; gap:8px;">
                            <div class="dub-avatar" style="font-size:11px;">
                                {{ strtoupper(substr($booking->user->fullName ?? 'G', 0, 2)) }}
                            </div>
                            <div>
                                <p style="font-size:13px; font-weight:600; color:var(--color-charcoal); margin:0;">{{ $booking->user->fullName ?? 'Guest' }}</p>
                                <p style="font-size:11px; color:var(--color-fog); margin:0;">{{ $booking->user->phone ?? '—' }}</p>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{ $booking->user_id }}">
                </div>

                <div>
                    <label for="package_id" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Paket <span class="text-red-500">*</span></label>
                    <select name="package_id" id="package_id" class="dub-input" required>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" {{ old('package_id', $booking->package_id) == $package->id ? 'selected' : '' }}>
                                {{ $package->title }} (Rp {{ number_format($package->price, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status" class="dub-input" required>
                        <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                        <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed (Lunas)</option>
                        <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled (Batal)</option>
                    </select>
                </div>

                <div>
                    <label for="registered_at" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Tanggal Daftar <span class="text-red-500">*</span></label>
                    <input type="date" name="registered_at" id="registered_at" value="{{ old('registered_at', $booking->registered_at ? $booking->registered_at->format('Y-m-d') : '') }}" class="dub-input" required>
                </div>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:8px; padding-top:16px; border-top:1px solid var(--color-ash);">
                <a href="{{ route('admin.dashboard', ['section' => 'bookings']) }}" class="dub-btn dub-btn-outline">
                    Batal
                </a>
                <button type="submit" class="dub-btn dub-btn-primary">
                    <i class="fas fa-check" style="font-size:12px;"></i> Update Booking
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
