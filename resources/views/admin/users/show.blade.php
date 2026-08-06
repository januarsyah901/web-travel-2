@extends('admin.layouts.app')

@section('title', 'Detail Pendaftar - ' . $user->fullName)

@section('page-title', 'Detail Pendaftar')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="dub-card" style="padding:20px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
        <div style="display:flex; align-items:center; gap:12px;">
            <div class="dub-avatar" style="width:48px; height:48px; font-size:18px; background:var(--color-soft-blue); color:var(--color-electric-blue); border-color:#bfdbfe;">
                {{ strtoupper(substr($user->fullName, 0, 2)) }}
            </div>
            <div>
                <h1 style="font-size:20px; font-weight:600; color:var(--color-charcoal); margin:0 0 2px;">{{ $user->fullName }}</h1>
                <p style="font-size:13px; color:var(--color-fog); margin:0; font-family:var(--font-mono);">
                    Terdaftar sejak {{ $user->created_at->format('d M Y') }}
                </p>
            </div>
        </div>

        <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
            <a href="{{ route('admin.dashboard') }}?section=users" class="dub-btn dub-btn-outline">
                <i class="fas fa-arrow-left" style="font-size:12px;"></i> Kembali
            </a>
            <a href="{{ route('users.documents.download', $user->id) }}" class="dub-btn dub-btn-outline" style="color:var(--color-vivid-green); border-color:#86efac; background:var(--color-soft-mint);">
                <i class="fas fa-file-archive" style="font-size:12px;"></i> Unduh Semua Dokumen
            </a>
            <a href="{{ route('users.edit', $user->id) }}" class="dub-btn dub-btn-primary">
                <i class="fas fa-pen" style="font-size:12px;"></i> Edit Data
            </a>
        </div>
    </div>

    {{-- Content Grid --}}
    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap:20px;">

        {{-- Left Column --}}
        <div class="space-y-6">

            {{-- Data Pribadi --}}
            <div class="dub-table-wrapper">
                <div class="dub-section-header">
                    <h3>Data Pribadi Jamaah</h3>
                </div>
                <div style="padding:16px; display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div>
                        <span style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; letter-spacing:0.05em; display:block; margin-bottom:4px;">Nama Lengkap</span>
                        <span style="font-size:14px; font-weight:500; color:var(--color-charcoal);">{{ $user->fullName }}</span>
                    </div>

                    <div>
                        <span style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; letter-spacing:0.05em; display:block; margin-bottom:4px;">Tanggal Lahir</span>
                        <span style="font-size:14px; font-weight:500; color:var(--color-charcoal);">
                            {{ $user->birthDate ? $user->birthDate->format('d F Y') : '—' }}
                            @if($user->birthDate)
                                <span style="font-size:12px; color:var(--color-fog); font-weight:normal;">({{ $user->birthDate->age }} thn)</span>
                            @endif
                        </span>
                    </div>

                    <div>
                        <span style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; letter-spacing:0.05em; display:block; margin-bottom:4px;">Nomor WhatsApp</span>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <span style="font-size:14px; font-weight:500; color:var(--color-charcoal);">{{ $user->phone }}</span>
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $user->phone)) }}" target="_blank" style="font-size:12px; color:#25d366; text-decoration:none; font-weight:500;">
                                <i class="fab fa-whatsapp"></i> Chat
                            </a>
                        </div>
                    </div>

                    <div>
                        <span style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; letter-spacing:0.05em; display:block; margin-bottom:4px;">Status Paspor</span>
                        @if($user->hasPassport)
                            <span class="dub-badge dub-badge-mint">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5L4 7L8 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Sudah Ada
                            </span>
                        @else
                            <span class="dub-badge dub-badge-red">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2.5 2.5L7.5 7.5M7.5 2.5L2.5 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                                Belum Ada
                            </span>
                        @endif
                    </div>

                    <div style="grid-column: span 2;">
                        <span style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; letter-spacing:0.05em; display:block; margin-bottom:4px;">Alamat Domisili</span>
                        <span style="font-size:13px; color:var(--color-steel); line-height:1.5;">{{ $user->address }}</span>
                    </div>
                </div>
            </div>

            {{-- Riwayat Booking --}}
            <div class="dub-table-wrapper">
                <div class="dub-section-header">
                    <h3>Riwayat Booking Paket</h3>
                </div>
                <div style="padding:16px;">
                    @if($user->bookings && $user->bookings->count() > 0)
                        <div class="space-y-3">
                            @foreach($user->bookings as $booking)
                                <div class="dub-card" style="display:flex; align-items:center; justify-content:space-between; padding:12px 14px;">
                                    <div>
                                        <p style="font-size:14px; font-weight:600; color:var(--color-charcoal); margin:0 0 2px;">{{ $booking->package->title ?? 'Paket Dihapus' }}</p>
                                        <span style="font-size:12px; color:var(--color-fog);">
                                            Tgl Daftar: {{ $booking->registered_at ? $booking->registered_at->format('d M Y') : '—' }}
                                        </span>
                                    </div>
                                    <div>
                                        @php
                                            $bBadge = match($booking->status) {
                                                'confirmed' => 'dub-badge-mint',
                                                'pending' => 'dub-badge-orange',
                                                'cancelled' => 'dub-badge-red',
                                                default => 'dub-badge-neutral',
                                            };
                                        @endphp
                                        <span class="dub-badge {{ $bBadge }}">{{ ucfirst($booking->status) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="dub-empty" style="padding:24px;">
                            <div class="dub-empty-icon"><i class="fas fa-box-open"></i></div>
                            <p>Belum ada riwayat booking</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- Right Column --}}
        <div class="space-y-6">

            {{-- Berkas Dokumen --}}
            <div class="dub-table-wrapper">
                <div class="dub-section-header">
                    <h3>Berkas Dokumen</h3>
                </div>
                <div style="padding:16px;" class="space-y-4">
                    @foreach([
                        ['label' => 'KTP', 'file' => $user->documents->ktp ?? null, 'icon' => 'fa-id-card'],
                        ['label' => 'Kartu Keluarga', 'file' => $user->documents->kk ?? null, 'icon' => 'fa-users'],
                    ] as $doc)
                        <div class="dub-card" style="padding:12px; background:var(--color-paper-mist);">
                            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:8px;">
                                <span style="font-size:13px; font-weight:600; color:var(--color-charcoal);">
                                    <i class="fas {{ $doc['icon'] }}" style="color:var(--color-silver); margin-right:6px;"></i>
                                    {{ $doc['label'] }}
                                </span>
                                @if($doc['file'])
                                    <span class="dub-badge dub-badge-mint">Ada</span>
                                @else
                                    <span class="dub-badge dub-badge-neutral">Kosong</span>
                                @endif
                            </div>

                            @if($doc['file'])
                                @php
                                    $ext = pathinfo($doc['file'], PATHINFO_EXTENSION);
                                    $isImg = in_array(strtolower($ext), ['jpg','jpeg','png']);
                                @endphp

                                @if($isImg)
                                    <div style="width:100%; height:100px; border-radius:6px; overflow:hidden; border:1px solid var(--color-ash); margin-bottom:8px;">
                                        <img src="{{ asset('storage/' . $doc['file']) }}" style="width:100%; height:100%; object-fit:cover; cursor:pointer;" onclick="window.open(this.src)">
                                    </div>
                                @endif

                                <div style="display:flex; gap:6px;">
                                    <a href="{{ asset('storage/' . $doc['file']) }}" target="_blank" class="dub-btn dub-btn-outline" style="font-size:12px; padding:4px 8px; flex:1; justify-content:center;">
                                        <i class="fas fa-external-link-alt"></i> Buka
                                    </a>
                                    <a href="{{ asset('storage/' . $doc['file']) }}" download class="dub-btn dub-btn-outline" style="font-size:12px; padding:4px 8px; flex:1; justify-content:center;">
                                        <i class="fas fa-download"></i> Unduh
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Hapus Permanen --}}
            <div class="dub-card" style="border-color:#fecaca; background:#fef2f2; padding:16px;">
                <h4 style="font-size:13px; font-weight:600; color:#dc2626; margin:0 0 4px;">Hapus Akun Pendaftar</h4>
                <p style="font-size:12px; color:#991b1b; margin:0 0 12px; line-height:1.4;">
                    Semua data pendaftar dan riwayat booking akan dihapus secara permanen.
                </p>
                <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return handlePermanentDeleteUser(event, '{{ addslashes($user->fullName) }}');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dub-btn dub-btn-danger" style="width:100%; justify-content:center;">
                        <i class="fas fa-trash"></i> Hapus Permanen
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

<script>
async function handlePermanentDeleteUser(event, name) {
    event.preventDefault();
    const confirmed = await customConfirm(
        `Data pendaftar "${name}" akan dihapus permanen. Tindakan ini tidak dapat dibatalkan!`,
        {
            title: 'Hapus Permanen',
            type: 'danger',
            confirmText: 'Ya, Hapus',
            cancelText: 'Batal'
        }
    );
    if (confirmed) {
        event.target.submit();
    }
    return false;
}
</script>
@endsection
