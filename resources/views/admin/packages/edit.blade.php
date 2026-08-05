@extends('admin.layouts.app')

@section('title', 'Edit Paket - ' . $package->title)

@section('page-title', 'Edit Paket Umroh')

@section('content')
<div style="max-width: 768px; margin: 0 auto;" class="space-y-6">

    {{-- Page Header --}}
    <div style="display:flex; align-items:center; justify-content:space-between; gap:16px;">
        <div>
            <h1 style="font-size:20px; font-weight:600; color:var(--color-charcoal); margin:0 0 4px;">Edit Paket Umroh</h1>
            <p style="font-size:14px; color:var(--color-fog); margin:0;">Perbarui informasi paket perjalanan.</p>
        </div>
        <a href="{{ route('admin.dashboard', ['section' => 'packages']) }}" class="dub-btn dub-btn-outline">
            <i class="fas fa-arrow-left" style="font-size:12px;"></i> Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="dub-card" style="padding:24px;">
        <form method="POST" action="{{ route('packages.update', $package->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Nama Paket <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $package->title) }}" placeholder="Contoh: Paket Umroh Ramadhan 2026" class="dub-input" required>
            </div>

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:16px;">
                <div>
                    <label for="schedule" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Jadwal Keberangkatan <span class="text-red-500">*</span></label>
                    <input type="text" name="schedule" id="schedule" value="{{ old('schedule', $package->schedule) }}" placeholder="Contoh: 15 Maret 2026" class="dub-input" required>
                </div>

                <div>
                    <label for="duration" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Durasi (Hari) <span class="text-red-500">*</span></label>
                    <input type="number" name="duration" id="duration" value="{{ old('duration', $package->duration) }}" placeholder="Contoh: 9" min="1" class="dub-input" required>
                </div>
            </div>

            <div>
                <label for="price" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Harga Paket (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="price" id="price" value="{{ old('price', $package->price) }}" placeholder="Contoh: 25000000" min="0" step="100000" class="dub-input" required>
                <p style="font-size:12px; color:var(--color-fog); margin-top:4px;">Masukkan nominal angka tanpa titik atau koma.</p>
            </div>

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:16px;">
                <div>
                    <label for="hotel_makkah" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Hotel Makkah</label>
                    <input type="text" name="hotel_makkah" id="hotel_makkah" value="{{ old('hotel_makkah', $package->hotel_makkah) }}" placeholder="Contoh: Hilton Makkah" class="dub-input">
                </div>

                <div>
                    <label for="hotel_madinah" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Hotel Madinah</label>
                    <input type="text" name="hotel_madinah" id="hotel_madinah" value="{{ old('hotel_madinah', $package->hotel_madinah) }}" placeholder="Contoh: Anwar Al Madinah Mövenpick" class="dub-input">
                </div>
            </div>

            <div>
                <label for="description" class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Deskripsi Paket</label>
                <textarea name="description" id="description" rows="4" placeholder="Jelaskan detail fasilitas, hotel, dan keunggulan paket..." class="dub-input resize-none">{{ old('description', $package->description) }}</textarea>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:8px; padding-top:16px; border-top:1px solid var(--color-ash);">
                <a href="{{ route('admin.dashboard', ['section' => 'packages']) }}" class="dub-btn dub-btn-outline">
                    Batal
                </a>
                <button type="submit" class="dub-btn dub-btn-primary">
                    <i class="fas fa-check" style="font-size:12px;"></i> Update Paket
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
