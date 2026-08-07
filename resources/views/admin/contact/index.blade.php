@extends('admin.layouts.app')

@section('title', 'Kelola Kontak - Admin Fabi Abadi')

@section('page-title', 'Kontak Perusahaan')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap;">
        <div>
            <h1 style="font-size:20px; font-weight:600; color:var(--color-charcoal); margin:0 0 4px;">Informasi Kontak Perusahaan</h1>
            <p style="font-size:14px; color:var(--color-fog); margin:0;">Kelola detail alamat, kontak, media sosial, dan peta lokasi resmi.</p>
        </div>
        
        @if(!$contact)
            <a href="{{ route('contact.create') }}" class="dub-btn dub-btn-primary">
                <i class="fas fa-plus" style="font-size:12px;"></i> Buat Kontak Baru
            </a>
        @else
            <div style="display:flex; gap:8px;">
                <a href="{{ route('contact.edit', $contact->id) }}" class="dub-btn dub-btn-outline">
                    <i class="fas fa-pen" style="font-size:12px;"></i> Edit Data
                </a>
                <form method="POST" action="{{ route('contact.destroy', $contact->id) }}" onsubmit="return handleDeleteContact(event);">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dub-btn dub-btn-danger">
                        <i class="fas fa-trash" style="font-size:12px;"></i>
                    </button>
                </form>
                
                <script>
                async function handleDeleteContact(event) {
                    event.preventDefault();
                    const confirmed = await customConfirm(
                        'Data kontak akan dihapus permanen. Apakah Anda yakin?',
                        {
                            title: 'Hapus Data Kontak',
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
            </div>
        @endif
    </div>

    @if(session('success'))
        <div class="dub-card" style="border-color:#bbf7d0; background:#f0fdf4; padding:12px 16px; color:#166534; display:flex; align-items:center; gap:8px;">
            <i class="fas fa-check-circle" style="color:#16a34a;"></i>
            <span style="font-size:13px; font-weight:500;">{{ session('success') }}</span>
        </div>
    @endif

    @if($contact)
        {{-- Quick Stats --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:12px;">
            <div class="dub-stat-card">
                <p style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; margin:0 0 8px;">Informasi Utama</p>
                <p style="font-size:24px; font-weight:600; color:var(--color-charcoal); margin:0;">
                    {{ collect([$contact->company_name, $contact->address, $contact->whatsapp, $contact->email])->filter()->count() }}/4
                </p>
            </div>
            <div class="dub-stat-card">
                <p style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; margin:0 0 8px;">Sosial Media</p>
                <p style="font-size:24px; font-weight:600; color:var(--color-charcoal); margin:0;">
                    {{ count($contact->active_social_media ?? []) }} Aktif
                </p>
            </div>
            <div class="dub-stat-card">
                <p style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; margin:0 0 8px;">Jam Kerja</p>
                <p style="font-size:24px; font-weight:600; color:var(--color-charcoal); margin:0;">
                    {{ $contact->working_hours ? 'Diatur' : '—' }}
                </p>
            </div>
            <div class="dub-stat-card">
                <p style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; margin:0 0 8px;">Google Maps Embed</p>
                <p style="font-size:24px; font-weight:600; color:var(--color-charcoal); margin:0;">
                    {{ $contact->maps_embed ? 'Terpasang' : 'Kosong' }}
                </p>
            </div>
        </div>

        {{-- Details Grid --}}
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap:20px;">
            
            {{-- Left Column: Detail Utama --}}
            <div class="space-y-6">
                <div class="dub-table-wrapper">
                    <div class="dub-section-header">
                        <h3>Detail Kontak Utama</h3>
                    </div>
                    <div style="padding:16px; display:grid; grid-template-columns:1fr; gap:14px;">
                        <div>
                            <span style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; display:block; margin-bottom:2px;">Nama Perusahaan</span>
                            <span style="font-size:14px; font-weight:600; color:var(--color-charcoal);">{{ $contact->company_name ?? 'PT Fabi Abadi Travel' }}</span>
                        </div>
                        <div>
                            <span style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; display:block; margin-bottom:2px;">Telepon Kantor</span>
                            <span style="font-size:14px; color:var(--color-charcoal);">{{ \App\Models\Contact::OFFICE_PHONE }}</span>
                        </div>
                        <div>
                            <span style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; display:block; margin-bottom:2px;">WhatsApp</span>
                            <div style="display:flex; align-items:center; gap:8px;">
                                <span style="font-size:14px; color:var(--color-charcoal);">{{ $contact->whatsapp ?? '—' }}</span>
                                @if($contact->whatsapp)
                                    <a href="{{ $contact->whatsapp_link }}" target="_blank" style="font-size:12px; color:#25d366; text-decoration:none; font-weight:500;">
                                        <i class="fab fa-whatsapp"></i> Chat
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div>
                            <span style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; display:block; margin-bottom:2px;">Email Official</span>
                            <span style="font-size:14px; color:var(--color-charcoal);">{{ $contact->email ?? '—' }}</span>
                        </div>
                        <div>
                            <span style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; display:block; margin-bottom:2px;">Jam Operasional</span>
                            <span style="font-size:13px; color:var(--color-steel);">{{ $contact->working_hours ?? '—' }}</span>
                        </div>
                        <div>
                            <span style="font-size:11px; font-weight:600; color:var(--color-silver); text-transform:uppercase; display:block; margin-bottom:2px;">Alamat Kantor</span>
                            <span style="font-size:13px; color:var(--color-steel); line-height:1.5;">{{ $contact->address ?? '—' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Social Media Accounts Grid --}}
                <div class="dub-table-wrapper">
                    <div class="dub-section-header">
                        <div>
                            <h3>Media Sosial</h3>
                            <p>Daftar akun media sosial resmi yang terhubung.</p>
                        </div>
                        <span class="dub-badge dub-badge-blue">{{ count($contact->active_social_media ?? []) }} Aktif</span>
                    </div>
                    <div style="padding:16px;">
                        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap:10px;">
                            @php
                                $socials = [
                                    ['key' => 'facebook', 'icon' => 'fab fa-facebook-f', 'label' => 'Facebook'],
                                    ['key' => 'instagram', 'icon' => 'fab fa-instagram', 'label' => 'Instagram'],
                                    ['key' => 'twitter', 'icon' => 'fab fa-twitter', 'label' => 'Twitter'],
                                    ['key' => 'youtube', 'icon' => 'fab fa-youtube', 'label' => 'YouTube'],
                                    ['key' => 'tiktok', 'icon' => 'fab fa-tiktok', 'label' => 'TikTok'],
                                    ['key' => 'linkedin', 'icon' => 'fab fa-linkedin-in', 'label' => 'LinkedIn'],
                                    ['key' => 'pinterest', 'icon' => 'fab fa-pinterest-p', 'label' => 'Pinterest'],
                                    ['key' => 'telegram', 'icon' => 'fab fa-telegram-plane', 'label' => 'Telegram'],
                                ];
                            @endphp

                            @foreach($socials as $s)
                                @if(!empty($contact->{$s['key']}))
                                    <a href="{{ $contact->{$s['key']} }}" target="_blank" class="dub-card" style="display:flex; align-items:center; gap:8px; padding:10px; text-decoration:none; background:var(--color-paper-mist);">
                                        <div style="width:28px; height:28px; border-radius:6px; background:var(--color-soft-blue); color:var(--color-electric-blue); display:flex; align-items:center; justify-content:center; font-size:13px;">
                                            <i class="{{ $s['icon'] }}"></i>
                                        </div>
                                        <div style="overflow:hidden;">
                                            <span style="font-size:12px; font-weight:600; color:var(--color-charcoal); display:block; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">{{ $s['label'] }}</span>
                                            <span class="dub-badge dub-badge-mint" style="font-size:10px; padding:1px 6px;">Aktif</span>
                                        </div>
                                    </a>
                                @else
                                    <div class="dub-card" style="display:flex; align-items:center; gap:8px; padding:10px; opacity:0.5; background:var(--color-paper-mist);">
                                        <div style="width:28px; height:28px; border-radius:6px; background:var(--color-ash); color:var(--color-silver); display:flex; align-items:center; justify-content:center; font-size:13px;">
                                            <i class="{{ $s['icon'] }}"></i>
                                        </div>
                                        <div>
                                            <span style="font-size:12px; font-weight:500; color:var(--color-fog); display:block;">{{ $s['label'] }}</span>
                                            <span style="font-size:10px; color:var(--color-silver);">Nonaktif</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Pratinjau Google Maps --}}
            <div class="space-y-6">
                <div class="dub-table-wrapper">
                    <div class="dub-section-header">
                        <div>
                            <h3>Pratinjau Peta (Google Maps)</h3>
                        </div>
                        @if($contact->maps_embed)
                            <span class="dub-badge dub-badge-mint">✓ Terpasang</span>
                        @else
                            <span class="dub-badge dub-badge-neutral">Kosong</span>
                        @endif
                    </div>
                    <div style="padding:12px;">
                        @if($contact->maps_embed)
                            <div style="width:100%; height:260px; border-radius:8px; overflow:hidden; border:1px solid var(--color-ash); position:relative;" class="[&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0">
                                {!! $contact->maps_embed !!}
                            </div>
                        @else
                            <div class="dub-empty" style="padding:32px 16px; background:var(--color-paper-mist); border-radius:8px;">
                                <div class="dub-empty-icon"><i class="fas fa-map-marked-alt"></i></div>
                                <p style="font-size:14px; margin-bottom:4px;">Embed Map belum diatur</p>
                                <span>Salin kode embed dari Google Maps untuk menampilkan peta lokasi kantor.</span>
                                <a href="{{ route('contact.edit', $contact->id) }}#maps_embed" class="dub-btn dub-btn-primary" style="margin-top:12px; font-size:12px;">
                                    <i class="fas fa-plus"></i> Tambah Embed Maps
                                </a>
                            </div>
                        @endif
                    </div>
                    <div style="padding:12px 16px; border-top:1px solid var(--color-ash); background:var(--color-paper-mist); display:flex; align-items:center; justify-content:space-between; border-radius: 0 0 var(--radius-cards) var(--radius-cards);">
                        <span style="font-size:12px; color:var(--color-fog);">
                            Update: {{ $contact->updated_at ? $contact->updated_at->diffForHumans() : '—' }}
                        </span>
                        <a href="{{ route('contact.edit', $contact->id) }}#maps_embed" class="dub-btn dub-btn-outline" style="font-size:12px; padding:4px 10px;">
                            <i class="fas fa-edit"></i> Edit Maps
                        </a>
                    </div>
                </div>
            </div>

        </div>

    @else
        <div class="dub-table-wrapper">
            <div class="dub-empty" style="padding:48px;">
                <div class="dub-empty-icon"><i class="fas fa-address-book"></i></div>
                <p>Belum ada informasi kontak</p>
                <span>Silakan tambahkan informasi kontak resmi perusahaan Anda.</span>
                <a href="{{ route('contact.create') }}" class="dub-btn dub-btn-primary" style="margin-top:12px;">
                    <i class="fas fa-plus"></i> Buat Kontak Sekarang
                </a>
            </div>
        </div>
    @endif

</div>
@endsection