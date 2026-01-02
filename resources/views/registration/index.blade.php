@extends('registration.app')

@section('title', 'Pendaftaran Umroh')

@section('header')
    <div class="text-center mb-6 md:mb-10 px-4">
        <div class="inline-block mb-4">
            <img src="{{ asset('img/img/vertical_logo.png') }}"
                 alt="Logo Fabi Abadi"
                 class="w-32 md:w-64 mx-auto h-auto object-contain">
        </div>
        <h1 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">Pendaftaran Umroh</h1>
        <p class="text-sm md:text-base text-gray-600">Isi formulir di bawah untuk memulai perjalanan ibadah Anda</p>
    </div>
@endsection

@section('content')
    <div class="bg-white rounded-xl md:rounded-2xl shadow-xl p-5 md:p-8 mx-auto max-w-4xl">

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Mohon perbaiki kesalahan berikut:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('registration.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6 md:space-y-8">
            @csrf

            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-100">
                    <div class="bg-orange-100 p-1.5 rounded text-orange-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h2 class="text-lg md:text-2xl font-semibold text-gray-800">Informasi Pribadi</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="md:col-span-2">
                        <label for="fullName" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap (Sesuai KTP) <span class="text-red-500">*</span></label>
                        <input type="text" name="fullName" id="fullName" value="{{ old('fullName') }}"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                               placeholder="Contoh: Ahmad Fulan" required>
                    </div>

                    <div>
                        <label for="birthPlace" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="birthPlace" id="birthPlace" value="{{ old('birthPlace') }}"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500"
                               placeholder="Kota Lahir" required>
                    </div>

                    <div>
                        <label for="birthDate" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="birthDate" id="birthDate" value="{{ old('birthDate') }}"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500"
                               required>
                    </div>

                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="address" id="address" rows="3"
                                  class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500"
                                  placeholder="Jalan, RT/RW, Kelurahan, Kecamatan" required>{{ old('address') }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500"
                               placeholder="08xxxxxxxxxx" required>
                        <p class="text-xs text-gray-500 mt-1">Pastikan nomor aktif untuk konfirmasi pendaftaran.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-100">
                    <div class="bg-orange-100 p-1.5 rounded text-orange-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h2 class="text-lg md:text-2xl font-semibold text-gray-800">Pilih Paket</h2>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    @forelse($packages as $package)
                        <label class="relative flex cursor-pointer group">
                            <input type="radio" name="package_id" value="{{ $package->id }}"
                                   {{ old('package_id') == $package->id ? 'checked' : '' }}
                                   class="peer sr-only" required>

                            <div class="flex-1 p-4 md:p-5 border-2 border-gray-200 rounded-xl bg-white hover:border-orange-300 transition-all shadow-sm
                    peer-checked:border-orange-600 peer-checked:bg-orange-50
                    peer-checked:[&_.check-circle]:border-orange-600
                    peer-checked:[&_.check-dot]:opacity-100">

                                <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-3">
                                    <div class="flex items-start gap-3">
                                        <div class="check-circle mt-1 w-5 h-5 rounded-full border-2 border-gray-400 flex items-center justify-center flex-shrink-0 transition-colors duration-200">
                                            <div class="check-dot w-2.5 h-2.5 rounded-full bg-orange-600 opacity-0 transition-opacity duration-200"></div>
                                        </div>

                                        <div>
                                            <h3 class="font-bold text-gray-900 text-lg">{{ $package->title }}</h3>
                                            <div class="text-sm text-gray-600 mt-1 flex flex-col sm:flex-row sm:gap-4">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $package->schedule }}
                            </span>
                                                <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $package->duration }} Hari
                            </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pl-8 sm:pl-0 sm:text-right">
                                        <p class="text-sm text-gray-500">Mulai dari</p>
                                        <p class="text-lg md:text-xl font-bold text-orange-600">
                                            Rp {{ number_format($package->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    @empty
                        <div class="text-center p-4 bg-gray-50 rounded-lg text-gray-500 italic">
                            Belum ada paket tersedia saat ini.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-100">
                    <div class="bg-orange-100 p-1.5 rounded text-orange-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h2 class="text-lg md:text-2xl font-semibold text-gray-800">Upload Dokumen</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    @php
                        $fileInputClass = "block w-full text-sm text-slate-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-full file:border-0
                          file:text-sm file:font-semibold
                          file:bg-orange-50 file:text-orange-700
                          hover:file:bg-orange-100 transition-all cursor-pointer border border-gray-300 rounded-lg p-1";
                    @endphp

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">KTP (Scan/Foto) <span class="text-red-500">*</span></label>
                        <input type="file" name="ktp" accept="image/*,.pdf" required class="{{ $fileInputClass }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kartu Keluarga (KK) <span class="text-red-500">*</span></label>
                        <input type="file" name="kk" accept="image/*,.pdf" required class="{{ $fileInputClass }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Akte / Buku Nikah / Ijazah <span class="text-red-500">*</span></label>
                        <input type="file" name="supporting_docs[]" accept="image/*,.pdf" multiple required class="{{ $fileInputClass }}">
                        <p class="text-xs text-gray-500 mt-1">Bisa pilih lebih dari satu file.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pas Foto (Background Putih)</label>
                        <input type="file" name="pas_foto" accept="image/*" class="{{ $fileInputClass }}">
                        <p class="text-xs text-gray-500 mt-1">Ukuran 4x6, wajah tampak 80%.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-100">
                    <div class="bg-orange-100 p-1.5 rounded text-orange-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <h2 class="text-lg md:text-2xl font-semibold text-gray-800">Paspor</h2>
                </div>

                <div class="bg-gray-50 p-4 md:p-6 rounded-xl border border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Status Kepemilikan Paspor <span class="text-red-500">*</span></label>

                    <div class="flex flex-col sm:flex-row gap-4 mb-6">
                        <label class="flex items-center cursor-pointer p-3 border border-gray-300 rounded-lg bg-white hover:border-orange-400 transition-colors">
                            <input type="radio" name="hasPassport" value="1" {{ old('hasPassport') == '1' ? 'checked' : '' }}
                            class="w-4 h-4 text-orange-600 focus:ring-orange-500"
                                   onchange="togglePassportFields(true)" required>
                            <span class="ml-2 text-sm text-gray-700 font-medium">Sudah Punya</span>
                        </label>
                        <label class="flex items-center cursor-pointer p-3 border border-gray-300 rounded-lg bg-white hover:border-orange-400 transition-colors">
                            <input type="radio" name="hasPassport" value="0" {{ old('hasPassport') == '0' ? 'checked' : '' }}
                            class="w-4 h-4 text-orange-600 focus:ring-orange-500"
                                   onchange="togglePassportFields(false)">
                            <span class="ml-2 text-sm text-gray-700 font-medium">Belum Punya</span>
                        </label>
                    </div>

                    <div id="passportDetails" class="space-y-4 pt-4 border-t border-gray-200" style="display: {{ old('hasPassport') == '1' ? 'block' : 'none' }};">
                        <div>
                            <label for="passportName" class="block text-sm font-medium text-gray-700 mb-1">Nama di Paspor</label>
                            <input type="text" name="passportName" id="passportName" value="{{ old('passportName') }}"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500"
                                   placeholder="Nama sesuai paspor">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Paspor</label>
                            <input type="file" name="passportPhoto" accept="image/*,.pdf" class="{{ $fileInputClass }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 flex flex-col-reverse sm:flex-row gap-4">
                <a href="{{ route('home') }}" class="w-full sm:w-1/3 px-6 py-3.5 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors text-center">
                    Kembali
                </a>
                <button type="submit" class="w-full sm:w-2/3 px-6 py-3.5 bg-orange-600 text-white font-bold rounded-xl hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">
                    Daftar Sekarang
                </button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <div class="max-w-4xl mx-auto mt-6 px-4">
        <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl flex gap-3">
            <svg class="w-6 h-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-sm text-blue-700">
                <strong>Info Penting:</strong> Tim kami akan menghubungi nomor WhatsApp yang terdaftar untuk verifikasi data setelah Anda menekan tombol Daftar.
            </p>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function togglePassportFields(show) {
            const el = document.getElementById('passportDetails');
            if(show) {
                el.style.display = 'block';
                // Sedikit animasi fade in
                el.style.opacity = 0;
                setTimeout(() => { el.style.transition = 'opacity 0.3s'; el.style.opacity = 1; }, 10);
            } else {
                el.style.display = 'none';
                // Reset fields
                document.getElementById('passportName').value = '';
                document.querySelectorAll('input[name="passportStatus"]').forEach(e => e.checked = false);
            }
        }

        // Cek kondisi awal saat halaman dimuat (untuk old input)
        document.addEventListener('DOMContentLoaded', () => {
            if(document.querySelector('input[name="hasPassport"][value="1"]').checked) {
                togglePassportFields(true);
            }
        });
    </script>
@endpush
