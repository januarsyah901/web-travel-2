@extends('admin.layouts.app')

@section('title', 'Kelola Kontak')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Informasi Kontak</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola detail alamat, kontak, dan media sosial perusahaan.</p>
        </div>
        
        @if(!$contact)
            <a href="{{ route('contact.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-lg shadow-blue-500/30">
                <i class="fas fa-plus mr-2"></i> Buat Kontak Baru
            </a>
        @else
            <div class="flex gap-3">
                <a href="{{ route('contact.edit', $contact->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 hover:text-blue-600 focus:outline-none focus:ring ring-gray-200 transition ease-in-out duration-150 shadow-sm">
                    <i class="fas fa-pencil-alt mr-2"></i> Edit Data
                </a>
                <form method="POST" action="{{ route('contact.destroy', $contact->id) }}" onsubmit="return handleDeleteContact(event);">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-50 border border-transparent rounded-xl font-semibold text-xs text-red-700 uppercase tracking-widest hover:bg-red-100 focus:outline-none focus:ring ring-red-300 transition ease-in-out duration-150">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
                
                <script>
                async function handleDeleteContact(event) {
                    event.preventDefault();
                    const confirmed = await customConfirm(
                        'Data kontak akan dihapus permanen. Apakah Anda yakin ingin melanjutkan?',
                        {
                            title: 'Hapus Data Kontak',
                            type: 'danger',
                            confirmText: 'Ya, Hapus',
                            confirmClass: 'px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 font-medium transition-colors shadow-sm'
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
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center shadow-sm" role="alert">
            <i class="fas fa-check-circle text-xl mr-3"></i>
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if($contact)
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                    <i class="fas fa-info"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-medium uppercase">Info Dasar</div>
                    <div class="font-bold text-gray-800">
                        {{ collect([$contact->address, $contact->phone, $contact->email])->filter()->count() }}/3
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
                    <i class="fas fa-share-alt"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-medium uppercase">Sosial Media</div>
                    <div class="font-bold text-gray-800">
                        {{ count($contact->active_social_media ?? []) }} Aktif
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-600">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-medium uppercase">Jam Kerja</div>
                    <div class="font-bold text-gray-800">{{ $contact->working_hours ? 'Diatur' : '-' }}</div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-red-600">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-medium uppercase">Peta</div>
                    <div class="font-bold text-gray-800">{{ $contact->maps_embed ? 'Terpasang' : 'Kosong' }}</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-7 space-y-8">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800 flex items-center">
                            <i class="fas fa-building text-gray-400 mr-2"></i> Identitas & Lokasi
                        </h3>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $contact->is_active ? 'Publik' : 'Draft' }}
                        </span>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Nama Perusahaan</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $contact->company_name ?? '-' }}</p>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <i class="fas fa-map-pin text-gray-300"></i>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Alamat Kantor</label>
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $contact->address ?? 'Belum diisi' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <i class="far fa-clock text-gray-300"></i>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Jam Operasional</label>
                                <p class="text-gray-700 whitespace-pre-line">{{ $contact->working_hours ?? 'Belum diisi' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-bold text-gray-800 flex items-center">
                            <i class="fas fa-address-book text-gray-400 mr-2"></i> Saluran Kontak
                        </h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-4 rounded-xl bg-blue-50/50 border border-blue-100">
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-xs font-bold text-blue-600 uppercase">Telepon</label>
                                <i class="fas fa-phone text-blue-300"></i>
                            </div>
                            <p class="font-semibold text-gray-800 mb-1">{{ $contact->phone ?? '-' }}</p>
                            @if($contact->phone_2)
                                <p class="text-sm text-gray-500">{{ $contact->phone_2 }} (Alt)</p>
                            @endif
                        </div>

                        <div class="p-4 rounded-xl bg-indigo-50/50 border border-indigo-100">
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-xs font-bold text-indigo-600 uppercase">Email</label>
                                <i class="fas fa-envelope text-indigo-300"></i>
                            </div>
                            <p class="font-semibold text-gray-800 mb-1 truncate">{{ $contact->email ?? '-' }}</p>
                            @if($contact->email_2)
                                <p class="text-sm text-gray-500 truncate">{{ $contact->email_2 }}</p>
                            @endif
                        </div>

                        <div class="p-4 rounded-xl bg-emerald-50/50 border border-emerald-100 md:col-span-2">
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-xs font-bold text-emerald-600 uppercase">WhatsApp</label>
                                <i class="fab fa-whatsapp text-emerald-300 text-lg"></i>
                            </div>
                            @if($contact->whatsapp)
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-gray-800">{{ $contact->whatsapp }}</span>
                                    <a href="{{ $contact->whatsapp_link }}" target="_blank" class="text-xs bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full hover:bg-emerald-200 transition">
                                        Test Link <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                </div>
                            @else
                                <span class="text-gray-400 italic text-sm">Belum diatur</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-5 space-y-8">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">Media Sosial</h3>
                        <span class="text-xs text-gray-400">{{ count($contact->active_social_media ?? []) }} Terhubung</span>
                    </div>
                    
                    <div class="p-4">
                        <div class="grid grid-cols-2 gap-3">
                            @php
                                $socials = [
                                    ['key' => 'facebook', 'icon' => 'fab fa-facebook-f', 'color' => 'bg-[#1877F2]', 'label' => 'Facebook'],
                                    ['key' => 'instagram', 'icon' => 'fab fa-instagram', 'color' => 'bg-[#E4405F]', 'label' => 'Instagram'],
                                    ['key' => 'twitter', 'icon' => 'fab fa-twitter', 'color' => 'bg-[#1DA1F2]', 'label' => 'Twitter'],
                                    ['key' => 'youtube', 'icon' => 'fab fa-youtube', 'color' => 'bg-[#FF0000]', 'label' => 'YouTube'],
                                    ['key' => 'tiktok', 'icon' => 'fab fa-tiktok', 'color' => 'bg-black', 'label' => 'TikTok'],
                                    ['key' => 'linkedin', 'icon' => 'fab fa-linkedin-in', 'color' => 'bg-[#0A66C2]', 'label' => 'LinkedIn'],
                                    ['key' => 'pinterest', 'icon' => 'fab fa-pinterest-p', 'color' => 'bg-[#E60023]', 'label' => 'Pinterest'],
                                    ['key' => 'telegram', 'icon' => 'fab fa-telegram-plane', 'color' => 'bg-[#0088CC]', 'label' => 'Telegram'],
                                ];
                            @endphp

                            @foreach($socials as $social)
                                @if($contact->{$social['key']})
                                    <a href="{{ $contact->{$social['key']} }}" target="_blank" class="flex items-center p-2 rounded-lg border border-gray-100 hover:border-blue-200 hover:shadow-sm transition-all group bg-white">
                                        <div class="w-8 h-8 {{ $social['color'] }} rounded text-white flex items-center justify-center text-sm mr-2 shadow-sm">
                                            <i class="{{ $social['icon'] }}"></i>
                                        </div>
                                        <div class="overflow-hidden">
                                            <span class="text-xs font-semibold text-gray-700 block truncate group-hover:text-blue-600">{{ $social['label'] }}</span>
                                            <span class="text-[10px] text-green-600 flex items-center">
                                                <i class="fas fa-check-circle mr-1"></i> Aktif
                                            </span>
                                        </div>
                                    </a>
                                @else
                                    <div class="flex items-center p-2 rounded-lg border border-gray-50 bg-gray-50 opacity-60 grayscale">
                                        <div class="w-8 h-8 bg-gray-300 rounded text-white flex items-center justify-center text-sm mr-2">
                                            <i class="{{ $social['icon'] }}"></i>
                                        </div>
                                        <div>
                                            <span class="text-xs font-semibold text-gray-500 block">{{ $social['label'] }}</span>
                                            <span class="text-[10px] text-gray-400">-</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">Pratinjau Peta</h3>
                        <div class="flex items-center gap-2">
                            @if($contact->maps_embed)
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">✓ Terisi</span>
                            @else
                                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded-full">Kosong</span>
                            @endif
                        </div>
                    </div>
                    <div class="p-1">
                        @if($contact->maps_embed)
                            <div class="w-full h-64 bg-gray-100 rounded-xl overflow-hidden relative">
                                <div class="absolute inset-0 [&>iframe]:w-full [&>iframe]:h-full">
                                    {!! $contact->maps_embed !!}
                                </div>
                            </div>
                        @else
                            <div class="h-48 flex flex-col items-center justify-center bg-gray-50 text-gray-400 rounded-xl m-4 border-2 border-dashed border-gray-200">
                                <i class="fas fa-map-marked-alt text-3xl mb-2 opacity-50"></i>
                                <span class="text-sm">Embed Map belum diatur</span>
                                <a href="{{ route('contact.edit', $contact->id) }}#maps_embed" class="mt-3 text-xs text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                                    <i class="fas fa-plus-circle"></i> Tambah Maps Embed
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-xs text-gray-500">
                            Terakhir update: {{ $contact->updated_at->diffForHumans() }}
                        </span>
                        @if($contact->maps_embed)
                        <a href="{{ route('contact.edit', $contact->id) }}#maps_embed" class="text-xs text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                            <i class="fas fa-edit"></i> Edit Maps
                        </a>
                        @else
                        <a href="https://www.google.com/maps" target="_blank" class="text-xs text-gray-600 hover:text-gray-700 font-medium flex items-center gap-1">
                            <i class="fas fa-external-link-alt"></i> Buka Google Maps
                        </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    @else
        <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
            <div class="w-24 h-24 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-folder-open text-4xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Data Kontak Kosong</h2>
            <p class="text-gray-500 max-w-md mx-auto mb-8">Anda belum mengatur informasi kontak perusahaan. Data ini akan ditampilkan di halaman depan website.</p>
            <a href="{{ route('contact.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 font-medium transition shadow-lg shadow-blue-500/30">
                <i class="fas fa-plus mr-2"></i> Mulai Pengaturan
            </a>
        </div>
    @endif
</div>
@endsection