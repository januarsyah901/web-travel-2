<!DOCTYPE html>
<html lang="id">
@include('public.head')
<body class="bg-gray-50">
    @include('public.messages-scripts')

    {{-- Navbar khusus halaman statis (tanpa scrollspy) --}}
    <nav class="fixed w-full top-0 z-50 bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('img/img/vertical_logo.png') }}" alt="PT Fabi Abadi Logo"
                         class="h-16 w-auto object-contain transition-all duration-300 group-hover:scale-105">
                </a>
                <a href="{{ route('home') }}"
                   class="flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-orange-600 transition-colors duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </nav>

    {{-- Hero / Header --}}
    <div class="pt-20">
        <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-orange-900 text-white py-20 px-4 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <svg class="absolute bottom-0 right-0 w-96 h-96 text-orange-500" fill="currentColor" viewBox="0 0 200 200">
                    <circle cx="160" cy="160" r="120"/>
                </svg>
                <svg class="absolute top-0 left-0 w-64 h-64 text-orange-600" fill="currentColor" viewBox="0 0 200 200">
                    <circle cx="40" cy="40" r="80"/>
                </svg>
            </div>
            <div class="relative z-10 max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 bg-orange-600/20 border border-orange-500/30 text-orange-300 text-xs font-semibold px-4 py-2 rounded-full mb-6 uppercase tracking-wider">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 000 6H4a3 3 0 000-6zm3 7.586V18a1 1 0 102 0v-6.414l3.707-3.707a1 1 0 00-1.414-1.414L10 7.757 7.707 5.465A1 1 0 006.293 6.88L9 9.172V18a1 1 0 102 0V9.172l2.707-2.707z" clip-rule="evenodd"/>
                    </svg>
                    Dokumen Legal
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Kebijakan Privasi</h1>
                <p class="mt-4 text-gray-300 max-w-2xl mx-auto text-base md:text-lg leading-relaxed">
                    Kami berkomitmen melindungi privasi dan keamanan data pribadi Anda. Bacalah kebijakan ini dengan seksama.
                </p>
                <div class="mt-6 inline-flex items-center gap-2 text-sm text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Terakhir diperbarui: 1 Agustus {{ date('Y') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Konten Utama --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        {{-- Ringkasan Singkat --}}
        <div class="bg-orange-50 border border-orange-200 rounded-2xl p-6 mb-12 flex gap-4">
            <div class="flex-shrink-0 w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center text-orange-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-orange-800 mb-1">Ringkasan Singkat</p>
                <p class="text-sm text-orange-700 leading-relaxed">
                    PT Fabi Abadi mengumpulkan data Anda hanya untuk keperluan pemrosesan pendaftaran umroh dan haji.
                    Kami tidak menjual atau membagikan data Anda kepada pihak ketiga tanpa izin Anda.
                </p>
            </div>
        </div>

        <div class="prose prose-gray max-w-none space-y-10">

            {{-- 1 --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">1</span>
                    <h2 class="text-xl font-bold text-gray-900">Informasi yang Kami Kumpulkan</h2>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Dalam rangka memberikan layanan perjalanan ibadah, kami mengumpulkan berbagai jenis informasi pribadi sebagai berikut:
                </p>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <h3 class="text-sm font-semibold text-gray-800 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                            Data Identitas
                        </h3>
                        <ul class="text-xs text-gray-600 space-y-1.5">
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-orange-400 flex-shrink-0"></span>Nama lengkap sesuai KTP</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-orange-400 flex-shrink-0"></span>Tanggal dan tempat lahir</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-orange-400 flex-shrink-0"></span>Nomor telepon / WhatsApp</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-orange-400 flex-shrink-0"></span>Alamat domisili lengkap</li>
                        </ul>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <h3 class="text-sm font-semibold text-gray-800 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"/><path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/></svg>
                            Dokumen Resmi
                        </h3>
                        <ul class="text-xs text-gray-600 space-y-1.5">
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-orange-400 flex-shrink-0"></span>Scan / foto KTP</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-orange-400 flex-shrink-0"></span>Kartu Keluarga (KK)</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-orange-400 flex-shrink-0"></span>Paspor (jika ada)</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-orange-400 flex-shrink-0"></span>Pas foto resmi (4x6 putih)</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- 2 --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">2</span>
                    <h2 class="text-xl font-bold text-gray-900">Cara Kami Menggunakan Informasi Anda</h2>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">Data yang Anda berikan digunakan secara eksklusif untuk:</p>
                <div class="space-y-3">
                    @foreach ([
                        ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Memproses pendaftaran paket umroh dan haji Anda.'],
                        ['icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9', 'text' => 'Menghubungi Anda terkait konfirmasi, jadwal, dan informasi keberangkatan.'],
                        ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'text' => 'Mengurus dokumen perjalanan seperti visa dan manifes keberangkatan.'],
                        ['icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z', 'text' => 'Memproses pembayaran dan administrasi keuangan pemesanan paket.'],
                        ['icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'text' => 'Memberikan dukungan pelayanan jamaah sebelum dan sesudah keberangkatan.'],
                    ] as $item)
                    <div class="flex items-start gap-3 bg-gray-50 rounded-xl p-3.5">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                        </svg>
                        <span class="text-sm text-gray-600">{{ $item['text'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 3 --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">3</span>
                    <h2 class="text-xl font-bold text-gray-900">Keamanan Data Anda</h2>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-5">
                    Kami mengambil langkah-langkah teknis dan organisasi yang tepat untuk melindungi data pribadi Anda dari akses tidak sah, perubahan, pengungkapan, atau penghancuran.
                </p>
                <div class="grid sm:grid-cols-3 gap-4">
                    <div class="text-center bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-5 border border-orange-100">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3 text-orange-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-700">Enkripsi SSL</p>
                        <p class="text-xs text-gray-500 mt-1">Data ditransmisikan dengan protokol aman HTTPS</p>
                    </div>
                    <div class="text-center bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-5 border border-orange-100">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3 text-orange-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-700">Akses Terbatas</p>
                        <p class="text-xs text-gray-500 mt-1">Hanya staf berwenang yang dapat mengakses data Anda</p>
                    </div>
                    <div class="text-center bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-5 border border-orange-100">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3 text-orange-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/></svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-700">Penyimpanan Aman</p>
                        <p class="text-xs text-gray-500 mt-1">Data tersimpan pada server dengan standar keamanan tinggi</p>
                    </div>
                </div>
            </div>

            {{-- 4 --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">4</span>
                    <h2 class="text-xl font-bold text-gray-900">Berbagi Informasi kepada Pihak Ketiga</h2>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    PT Fabi Abadi <span class="font-semibold text-gray-800">tidak menjual</span> data pribadi Anda. Data hanya dibagikan kepada pihak-pihak berikut yang diperlukan untuk pelaksanaan ibadah Anda:
                </p>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3 border-b border-gray-200">Pihak</th>
                                <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3 border-b border-gray-200">Tujuan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 font-medium text-gray-700">Imigrasi & Kedubes Saudi Arabia</td>
                                <td class="px-4 py-3 text-gray-500">Pengurusan visa umroh/haji</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 font-medium text-gray-700">Maskapai Penerbangan</td>
                                <td class="px-4 py-3 text-gray-500">Pemesanan tiket dan manifes penerbangan</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 font-medium text-gray-700">Hotel & Akomodasi</td>
                                <td class="px-4 py-3 text-gray-500">Pemesanan kamar di Mekkah dan Madinah</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 font-medium text-gray-700">Kementerian Agama RI</td>
                                <td class="px-4 py-3 text-gray-500">Pelaporan dan perizinan perjalanan ibadah</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- 5 --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">5</span>
                    <h2 class="text-xl font-bold text-gray-900">Hak-Hak Anda</h2>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">Sebagai pemilik data, Anda memiliki hak-hak berikut:</p>
                <div class="grid sm:grid-cols-2 gap-3">
                    @foreach([
                        ['Akses Data', 'Meminta salinan data pribadi yang kami simpan tentang Anda.'],
                        ['Koreksi Data', 'Meminta perbaikan data yang tidak akurat atau tidak lengkap.'],
                        ['Penghapusan Data', 'Meminta penghapusan data setelah hubungan bisnis berakhir.'],
                        ['Pembatasan Pemrosesan', 'Membatasi cara kami memproses data Anda dalam situasi tertentu.'],
                    ] as $hak)
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 border border-gray-100">
                        <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ $hak[0] }}</p>
                            <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">{{ $hak[1] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 6 --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">6</span>
                    <h2 class="text-xl font-bold text-gray-900">Perubahan Kebijakan</h2>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Kami berhak memperbarui Kebijakan Privasi ini sewaktu-waktu. Setiap perubahan akan diberitahukan melalui halaman ini dengan tanggal pembaruan yang baru. Penggunaan layanan kami setelah tanggal pembaruan dianggap sebagai persetujuan atas kebijakan yang baru.
                </p>
            </div>

            {{-- Kontak --}}
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 text-white rounded-2xl p-8 text-center border border-gray-700">
                <svg class="w-12 h-12 text-orange-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <h2 class="text-xl font-bold mb-2">Ada Pertanyaan?</h2>
                <p class="text-gray-400 text-sm mb-6 max-w-md mx-auto">
                    Hubungi tim kami jika Anda memiliki pertanyaan terkait privasi dan penggunaan data Anda.
                </p>
                @if(isset($contact) && $contact)
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="mailto:{{ $contact->email }}"
                       class="inline-flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-full text-sm font-medium transition-colors duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ $contact->email }}
                    </a>
                    <a href="{{ $contact->whatsapp_link }}" target="_blank"
                       class="inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20bd5a] text-white px-6 py-3 rounded-full text-sm font-medium transition-colors duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        WhatsApp
                    </a>
                </div>
                @else
                <p class="text-gray-400 text-sm">Silakan hubungi kami melalui halaman <a href="{{ route('home') }}#kontak" class="text-orange-400 underline">Kontak</a>.</p>
                @endif
            </div>

        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-gray-900 border-t border-gray-800 text-gray-500 text-sm py-8 mt-8">
        <div class="max-w-4xl mx-auto px-4 text-center space-y-3">
            <p>&copy; {{ date('Y') }} PT Fabi Abadi. All rights reserved.</p>
            <div class="flex justify-center gap-6">
                <a href="{{ route('privacy.policy') }}" class="text-orange-400 font-medium">Privacy Policy</a>
                <a href="{{ route('terms.service') }}" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
