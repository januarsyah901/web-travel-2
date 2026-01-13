@extends('admin.layouts.app')

@section('title', 'Tambah Kontak')

@section('page-title', 'Tambah Kontak Perusahaan')

@section('content')
<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-5">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl shadow-inner">
                <i class="fas fa-address-book"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Tambah Kontak Perusahaan</h1>
                <p class="text-gray-500 text-sm mt-1">Isi informasi kontak dan media sosial.</p>
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

    <form method="POST" action="{{ route('contact.store') }}" class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        @csrf

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
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" placeholder="Contoh: PT Fabi Abadi" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                    </div>

                    <div class="space-y-2">
                        <label for="address" class="text-sm font-semibold text-gray-700">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="address" id="address" rows="3" placeholder="Jl. Contoh No. 123, Kota, Provinsi" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>{{ old('address') }}</textarea>
                    </div>

                    <div class="space-y-2">
                        <label for="working_hours" class="text-sm font-semibold text-gray-700">Jam Operasional</label>
                        <textarea name="working_hours" id="working_hours" rows="3" placeholder="Senin - Sabtu: 08.00 - 16.30&#10;Minggu: Libur" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">{{ old('working_hours') }}</textarea>
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
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="031-1234567" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                        </div>

                        <div class="space-y-2">
                            <label for="phone_2" class="text-sm font-semibold text-gray-700">Telepon Alternatif</label>
                            <input type="text" name="phone_2" id="phone_2" value="{{ old('phone_2') }}" placeholder="031-7654321" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="whatsapp" class="text-sm font-semibold text-gray-700">WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}" placeholder="082133087492" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                        <p class="text-xs text-gray-500">
                            <i class="fas fa-info-circle"></i> Format: 08xxxxxxxxxx atau 62xxxxxxxxxx
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-semibold text-gray-700">Email Utama <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="info@perusahaan.com" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                        </div>

                        <div class="space-y-2">
                            <label for="email_2" class="text-sm font-semibold text-gray-700">Email Alternatif</label>
                            <input type="email" name="email_2" id="email_2" value="{{ old('email_2') }}" placeholder="cs@perusahaan.com" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
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
                            <input type="url" name="facebook" id="facebook" value="{{ old('facebook') }}" placeholder="https://facebook.com/username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="instagram" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-instagram text-[#E4405F]"></i> Instagram
                            </label>
                            <input type="url" name="instagram" id="instagram" value="{{ old('instagram') }}" placeholder="https://instagram.com/username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="twitter" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-twitter text-[#1DA1F2]"></i> Twitter / X
                            </label>
                            <input type="url" name="twitter" id="twitter" value="{{ old('twitter') }}" placeholder="https://twitter.com/username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="youtube" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-youtube text-[#FF0000]"></i> YouTube
                            </label>
                            <input type="url" name="youtube" id="youtube" value="{{ old('youtube') }}" placeholder="https://youtube.com/@username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="tiktok" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-tiktok text-black"></i> TikTok
                            </label>
                            <input type="url" name="tiktok" id="tiktok" value="{{ old('tiktok') }}" placeholder="https://tiktok.com/@username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="linkedin" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-linkedin text-[#0A66C2]"></i> LinkedIn
                            </label>
                            <input type="url" name="linkedin" id="linkedin" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/company/nama" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="pinterest" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-pinterest text-[#E60023]"></i> Pinterest
                            </label>
                            <input type="url" name="pinterest" id="pinterest" value="{{ old('pinterest') }}" placeholder="https://pinterest.com/username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label for="telegram" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fab fa-telegram text-[#0088CC]"></i> Telegram
                            </label>
                            <input type="url" name="telegram" id="telegram" value="{{ old('telegram') }}" placeholder="https://t.me/username" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
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
                </div>

                <div class="space-y-2">
                    <label for="maps_embed" class="text-sm font-semibold text-gray-700">Kode Embed Maps</label>
                    <textarea name="maps_embed" id="maps_embed" rows="4" placeholder='<iframe src="https://www.google.com/maps/embed?..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>' class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none font-mono text-sm">{{ old('maps_embed') }}</textarea>
                    <p class="text-xs text-gray-500">
                        <i class="fas fa-info-circle"></i> Salin kode embed dari Google Maps (Share → Embed a map)
                    </p>
                </div>
            </div>

            <!-- Status -->
            <div>
                <div class="pb-2 border-b border-gray-100 mb-6">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-1 h-6 bg-orange-500 rounded-full inline-block"></span>
                        Status
                    </h2>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-200">
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
                <i class="fas fa-save mr-2"></i> Simpan Kontak
            </button>
        </div>

    </form>

</div>
@endsection
