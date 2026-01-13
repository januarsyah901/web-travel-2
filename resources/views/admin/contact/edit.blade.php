@extends('admin.layouts.app')

@section('title', 'Edit Kontak')

@section('page-title', 'Edit Kontak Perusahaan')

@section('content')
<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-5">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl shadow-inner">
                <i class="fas fa-edit"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Kontak Perusahaan</h1>
                <p class="text-gray-500 text-sm mt-1">Perbarui informasi kontak dan media sosial.</p>
            </div>
        </div>
        <a href="{{ route('contact.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition-colors shadow-sm flex items-center justify-center w-full md:w-auto">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500 text-lg"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</p>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('contact.update', $contact->id) }}" class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        @csrf
        @method('PUT')

        <div class="p-6 md:p-8 space-y-8">

            <!-- Informasi Perusahaan -->
            <div>
                <div class="pb-2 border-b border-gray-100 mb-6">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-1 h-6 bg-blue-500 rounded-full inline-block"></span>
                        Informasi Perusahaan
                    </h2>
                </div>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label for="company_name" class="text-sm font-semibold text-gray-700">Nama Perusahaan <span class="text-red-500">*</span></label>
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $contact->company_name) }}" placeholder="Contoh: PT Fabi Abadi" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                    </div>

                    <div class="space-y-2">
                        <label for="address" class="text-sm font-semibold text-gray-700">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="address" id="address" rows="3" placeholder="Jl. Contoh No. 123, Kota, Provinsi" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>{{ old('address', $contact->address) }}</textarea>
                    </div>

                    <div class="space-y-2">
                        <label for="working_hours" class="text-sm font-semibold text-gray-700">Jam Operasional</label>
                        <textarea name="working_hours" id="working_hours" rows="3" placeholder="Senin - Sabtu: 08.00 - 16.30&#10;Minggu: Libur" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">{{ old('working_hours', $contact->working_hours) }}</textarea>
                        <p class="text-xs text-gray-500">
                            <i class="fas fa-info-circle"></i> Tekan Enter untuk baris baru
                        </p>
                    </div>
                </div>
            </div>

            <!-- Kontak -->
            <div>
                <div class="pb-2 border-b border-gray-100 mb-6">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-1 h-6 bg-green-500 rounded-full inline-block"></span>
                        Informasi Kontak
                    </h2>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="phone" class="text-sm font-semibold text-gray-700">Telepon Utama <span class="text-red-500">*</span></label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $contact->phone) }}" placeholder="031-1234567" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                        </div>

                        <div class="space-y-2">
                            <label for="phone_2" class="text-sm font-semibold text-gray-700">Telepon Alternatif</label>
                            <input type="text" name="phone_2" id="phone_2" value="{{ old('phone_2', $contact->phone_2) }}" placeholder="031-7654321" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="whatsapp" class="text-sm font-semibold text-gray-700">WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $contact->whatsapp) }}" placeholder="082133087492" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                        <p class="text-xs text-gray-500">
                            <i class="fas fa-info-circle"></i> Format: 08xxxxxxxxxx atau 62xxxxxxxxxx
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-semibold text-gray-700">Email Utama <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email', $contact->email) }}" placeholder="info@perusahaan.com" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                        </div>

                        <div class="space-y-2">
                            <label for="email_2" class="text-sm font-semibold text-gray-700">Email Alternatif</label>
                            <input type="email" name="email_2" id="email_2" value="{{ old('email_2', $contact->email_2) }}" placeholder="cs@perusahaan.com" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Sosial -->
            <div>
                <div class="pb-2 border-b border-gray-100 mb-6">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-1 h-6 bg-purple-500 rounded-full inline-block"></span>
                        Media Sosial
                    </h2>
                    <p class="text-xs text-gray-500 mt-1">Isi link lengkap media sosial (opsional)</p>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="facebook" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-facebook text-[#1877F2]"></i> Facebook
                            </label>
                            <input type="url" name="facebook" id="facebook" value="{{ old('facebook', $contact->facebook) }}" placeholder="https://facebook.com/username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="instagram" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-instagram text-[#E4405F]"></i> Instagram
                            </label>
                            <input type="url" name="instagram" id="instagram" value="{{ old('instagram', $contact->instagram) }}" placeholder="https://instagram.com/username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="twitter" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-twitter text-[#1DA1F2]"></i> Twitter / X
                            </label>
                            <input type="url" name="twitter" id="twitter" value="{{ old('twitter', $contact->twitter) }}" placeholder="https://twitter.com/username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="youtube" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-youtube text-[#FF0000]"></i> YouTube
                            </label>
                            <input type="url" name="youtube" id="youtube" value="{{ old('youtube', $contact->youtube) }}" placeholder="https://youtube.com/@username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="tiktok" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-tiktok text-black"></i> TikTok
                            </label>
                            <input type="url" name="tiktok" id="tiktok" value="{{ old('tiktok', $contact->tiktok) }}" placeholder="https://tiktok.com/@username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="linkedin" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-linkedin text-[#0A66C2]"></i> LinkedIn
                            </label>
                            <input type="url" name="linkedin" id="linkedin" value="{{ old('linkedin', $contact->linkedin) }}" placeholder="https://linkedin.com/company/nama" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="pinterest" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-pinterest text-[#E60023]"></i> Pinterest
                            </label>
                            <input type="url" name="pinterest" id="pinterest" value="{{ old('pinterest', $contact->pinterest) }}" placeholder="https://pinterest.com/username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="telegram" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-telegram text-[#0088CC]"></i> Telegram
                            </label>
                            <input type="url" name="telegram" id="telegram" value="{{ old('telegram', $contact->telegram) }}" placeholder="https://t.me/username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Google Maps -->
            <div>
                <div class="pb-2 border-b border-gray-100 mb-6">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-1 h-6 bg-red-500 rounded-full inline-block"></span>
                        Google Maps Embed
                    </h2>
                    <p class="text-xs text-gray-500 mt-1">Embed peta lokasi kantor Anda dari Google Maps</p>
                </div>

                <div class="space-y-4">
                    <!-- Cara Mendapatkan Embed Code -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <h4 class="text-sm font-semibold text-blue-800 mb-2 flex items-center gap-2">
                            <i class="fas fa-lightbulb"></i> Cara Mendapatkan Kode Embed:
                        </h4>
                        <ol class="text-xs text-blue-700 space-y-1 ml-5 list-decimal">
                            <li>Buka <a href="https://www.google.com/maps" target="_blank" class="underline font-medium">Google Maps</a></li>
                            <li>Cari lokasi kantor Anda</li>
                            <li>Klik tombol <strong>"Share"</strong> atau <strong>"Bagikan"</strong></li>
                            <li>Pilih tab <strong>"Embed a map"</strong></li>
                            <li>Salin kode HTML yang muncul</li>
                            <li>Paste ke kotak di bawah ini</li>
                        </ol>
                    </div>

                    <!-- Textarea untuk Embed Code -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label for="maps_embed" class="text-sm font-semibold text-gray-700">Kode Embed Maps</label>
                            @if($contact->maps_embed)
                            <button type="button" onclick="clearMapsEmbed()" class="text-xs text-red-600 hover:text-red-700 font-medium flex items-center gap-1">
                                <i class="fas fa-times-circle"></i> Hapus Embed
                            </button>
                            @endif
                        </div>
                        <textarea name="maps_embed" id="maps_embed" rows="5" placeholder='<iframe src="https://www.google.com/maps/embed?pb=!1m18!..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none font-mono text-xs" oninput="updateMapsPreview()">{{ old('maps_embed', $contact->maps_embed) }}</textarea>
                        <p class="text-xs text-gray-500">
                            <i class="fas fa-info-circle"></i> Paste kode iframe dari Google Maps
                        </p>
                    </div>

                    <!-- Preview Maps -->
                    <div id="maps-preview-container" class="{{ $contact->maps_embed ? '' : 'hidden' }}">
                        <label class="text-sm font-semibold text-gray-700 mb-2 block">Preview Peta:</label>
                        <div class="bg-gray-100 rounded-xl p-4 border border-gray-200">
                            <div id="maps-preview" class="rounded-lg overflow-hidden border border-gray-300 bg-white">
                                @if($contact->maps_embed)
                                {!! $contact->maps_embed !!}
                                @else
                                <div class="h-64 flex items-center justify-center text-gray-400">
                                    <div class="text-center">
                                        <i class="fas fa-map-marked-alt text-4xl mb-2"></i>
                                        <p class="text-sm">Preview akan muncul di sini</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
            function updateMapsPreview() {
                const embedCode = document.getElementById('maps_embed').value.trim();
                const previewContainer = document.getElementById('maps-preview-container');
                const preview = document.getElementById('maps-preview');
                
                if (embedCode) {
                    previewContainer.classList.remove('hidden');
                    preview.innerHTML = embedCode;
                } else {
                    previewContainer.classList.add('hidden');
                    preview.innerHTML = `
                        <div class="h-64 flex items-center justify-center text-gray-400">
                            <div class="text-center">
                                <i class="fas fa-map-marked-alt text-4xl mb-2"></i>
                                <p class="text-sm">Preview akan muncul di sini</p>
                            </div>
                        </div>
                    `;
                }
            }

            async function clearMapsEmbed() {
                const confirmed = await customConfirm(
                    'Embed Google Maps akan dihapus. Anda bisa menambahkannya kembali nanti.',
                    {
                        title: 'Hapus Embed Maps',
                        type: 'warning',
                        confirmText: 'Ya, Hapus'
                    }
                );
                if (confirmed) {
                    document.getElementById('maps_embed').value = '';
                    updateMapsPreview();
                }
            }
            </script>

            <!-- Status -->
            <div>
                <div class="pb-2 border-b border-gray-100 mb-6">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-1 h-6 bg-orange-500 rounded-full inline-block"></span>
                        Status
                    </h2>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $contact->is_active) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-200">
                    <label for="is_active" class="text-sm font-medium text-gray-700">Aktifkan kontak ini</label>
                </div>
            </div>

        </div>

        <!-- Footer Actions -->
        <div class="bg-gray-50 px-8 py-6 border-t border-gray-100 flex justify-end gap-4">
            <a href="{{ route('contact.index') }}" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 font-medium transition-colors shadow-sm flex items-center">
                <i class="fas fa-save mr-2"></i> Update Kontak
            </button>
        </div>

    </form>

</div>
@endsection
