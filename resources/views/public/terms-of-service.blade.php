<!DOCTYPE html>
<html lang="id">
@include('public.head')
<body class="bg-gray-50">
    @include('public.messages-scripts')

    {{-- Navbar khusus halaman statis --}}
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
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                    </svg>
                    Dokumen Legal
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Syarat &amp; Ketentuan</h1>
                <p class="mt-4 text-gray-300 max-w-2xl mx-auto text-base md:text-lg leading-relaxed">
                    Harap baca syarat dan ketentuan ini dengan seksama sebelum menggunakan layanan perjalanan ibadah kami.
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

        {{-- Ringkasan --}}
        <div class="bg-orange-50 border border-orange-200 rounded-2xl p-6 mb-12 flex gap-4">
            <div class="flex-shrink-0 w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center text-orange-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-orange-800 mb-1">Penting untuk Dibaca</p>
                <p class="text-sm text-orange-700 leading-relaxed">
                    Dengan mendaftar dan menggunakan layanan PT Fabi Abadi, Anda menyetujui seluruh syarat dan ketentuan yang berlaku di bawah ini. Pastikan Anda memahami setiap poin sebelum melakukan pembayaran.
                </p>
            </div>
        </div>

        <div class="space-y-10">

            {{-- 1. Definisi --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">1</span>
                    <h2 class="text-xl font-bold text-gray-900">Definisi</h2>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">Dalam dokumen ini, istilah-istilah berikut memiliki arti sebagaimana dijelaskan:</p>
                <div class="space-y-3">
                    @foreach([
                        ['"Perusahaan"', 'PT Fabi Abadi, penyelenggara perjalanan umroh dan haji yang terdaftar dan berizin.'],
                        ['"Jamaah" / "Anda"', 'Setiap individu yang mendaftar dan menggunakan layanan perjalanan ibadah PT Fabi Abadi.'],
                        ['"Paket"', 'Paket perjalanan ibadah umroh atau haji yang ditawarkan dengan rincian harga, fasilitas, dan jadwal yang telah ditentukan.'],
                        ['"Pembayaran"', 'Seluruh transaksi keuangan yang dilakukan Jamaah kepada Perusahaan terkait pembelian Paket.'],
                    ] as $def)
                    <div class="flex gap-3 bg-gray-50 rounded-xl p-4">
                        <span class="text-sm font-semibold text-orange-700 flex-shrink-0 min-w-[120px]">{{ $def[0] }}</span>
                        <span class="text-sm text-gray-600">{{ $def[1] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 2. Pendaftaran --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">2</span>
                    <h2 class="text-xl font-bold text-gray-900">Pendaftaran dan Pemesanan</h2>
                </div>
                <div class="space-y-3">
                    @foreach([
                        'Pendaftaran dianggap sah setelah Jamaah melengkapi formulir pendaftaran, menyerahkan dokumen yang diperlukan, dan melakukan pembayaran uang muka (DP) sesuai ketentuan.',
                        'Jamaah wajib memberikan data diri yang benar, lengkap, dan akurat. Perusahaan tidak bertanggung jawab atas kerugian yang timbul akibat kesalahan data yang diberikan Jamaah.',
                        'Pemesanan paket bersifat terbatas (first come, first served). Perusahaan berhak menolak pendaftaran apabila kuota paket telah penuh.',
                        'Konfirmasi pendaftaran akan dikirimkan melalui WhatsApp atau email yang terdaftar dalam waktu 1x24 jam kerja.',
                        'Jamaah yang belum memiliki paspor wajib segera mengurusnya. Keterlambatan pengurusan paspor yang berdampak pada keberangkatan menjadi tanggung jawab Jamaah.',
                    ] as $i => $point)
                    <div class="flex items-start gap-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs font-bold mt-0.5">{{ $i + 1 }}</span>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $point }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 3. Pembayaran --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">3</span>
                    <h2 class="text-xl font-bold text-gray-900">Pembayaran dan Harga</h2>
                </div>
                <div class="grid md:grid-cols-2 gap-4 mb-5">
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                        <h3 class="text-sm font-semibold text-green-800 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Yang Termasuk
                        </h3>
                        <ul class="text-xs text-green-700 space-y-1.5">
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-green-500 flex-shrink-0"></span>Tiket penerbangan PP sesuai paket</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-green-500 flex-shrink-0"></span>Akomodasi hotel sesuai kategori paket</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-green-500 flex-shrink-0"></span>Visa umroh / haji</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-green-500 flex-shrink-0"></span>Konsumsi sesuai program</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-green-500 flex-shrink-0"></span>Bimbingan mutawwif berpengalaman</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-green-500 flex-shrink-0"></span>Asuransi perjalanan</li>
                        </ul>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                        <h3 class="text-sm font-semibold text-red-800 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            Tidak Termasuk
                        </h3>
                        <ul class="text-xs text-red-700 space-y-1.5">
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-red-400 flex-shrink-0"></span>Biaya pembuatan paspor</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-red-400 flex-shrink-0"></span>Pengeluaran pribadi dan oleh-oleh</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-red-400 flex-shrink-0"></span>Biaya excess baggage</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-red-400 flex-shrink-0"></span>Obat-obatan pribadi</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-red-400 flex-shrink-0"></span>Tips untuk pemandu lokal</li>
                        </ul>
                    </div>
                </div>
                <div class="space-y-3">
                    @foreach([
                        'Harga paket dapat berubah sewaktu-waktu sesuai kondisi kurs dan kebijakan pemerintah. Harga yang berlaku adalah harga pada saat pendaftaran dilakukan.',
                        'Pembayaran dapat dilakukan melalui transfer bank ke rekening resmi PT Fabi Abadi. Bukti transfer wajib dikirimkan kepada admin.',
                        'Pembayaran lunas wajib dilakukan minimal 30 hari sebelum tanggal keberangkatan.',
                    ] as $i => $point)
                    <div class="flex items-start gap-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs font-bold mt-0.5">{{ $i + 1 }}</span>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $point }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 4. Pembatalan --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">4</span>
                    <h2 class="text-xl font-bold text-gray-900">Pembatalan dan Pengembalian Dana</h2>
                </div>
                <div class="overflow-x-auto mb-5">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr class="bg-gray-900 text-white">
                                <th class="text-left text-xs font-semibold px-4 py-3 rounded-tl-lg">Waktu Pembatalan</th>
                                <th class="text-left text-xs font-semibold px-4 py-3 rounded-tr-lg">Penalti / Potongan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-gray-700 font-medium">≥ 60 hari sebelum keberangkatan</td>
                                <td class="px-4 py-3 text-green-600 font-semibold">Pengembalian 80% dari total pembayaran</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-gray-700 font-medium">30 – 59 hari sebelum keberangkatan</td>
                                <td class="px-4 py-3 text-yellow-600 font-semibold">Pengembalian 50% dari total pembayaran</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-gray-700 font-medium">14 – 29 hari sebelum keberangkatan</td>
                                <td class="px-4 py-3 text-orange-600 font-semibold">Pengembalian 25% dari total pembayaran</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-gray-700 font-medium">< 14 hari sebelum keberangkatan</td>
                                <td class="px-4 py-3 text-red-600 font-semibold">Tidak ada pengembalian dana</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-sm text-amber-700">
                    <p class="font-semibold mb-1">Catatan Penting:</p>
                    <p class="leading-relaxed">Pembatalan harus dilakukan secara tertulis dan dikirimkan ke email resmi perusahaan. Pengembalian dana diproses dalam 7–14 hari kerja setelah permotongan biaya administrasi.</p>
                </div>
            </div>

            {{-- 5. Kewajiban Jamaah --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">5</span>
                    <h2 class="text-xl font-bold text-gray-900">Kewajiban Jamaah</h2>
                </div>
                <div class="space-y-3">
                    @foreach([
                        'Hadir di titik keberangkatan tepat waktu sesuai jadwal yang telah ditentukan. Keterlambatan yang mengakibatkan tertinggal keberangkatan menjadi tanggung jawab Jamaah sepenuhnya.',
                        'Menjaga sikap, perilaku, dan tindakan selama perjalanan sesuai norma agama, hukum Indonesia, dan hukum Arab Saudi.',
                        'Mengikuti seluruh program dan arahan yang diberikan oleh mutawwif/pembimbing demi kelancaran dan keselamatan bersama.',
                        'Tidak membawa atau mengonsumsi barang-barang yang dilarang oleh hukum Arab Saudi dan peraturan penerbangan internasional.',
                        'Menjaga kesehatan pribadi dan membawa surat keterangan sehat dari dokter apabila memiliki kondisi medis tertentu.',
                        'Melaporkan kondisi darurat atau kejadian tidak terduga segera kepada pembimbing atau petugas PT Fabi Abadi.',
                    ] as $i => $point)
                    <div class="flex items-start gap-3 bg-gray-50 rounded-xl p-3.5">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs font-bold mt-0.5">{{ $i + 1 }}</span>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $point }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 6. Tanggung Jawab --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">6</span>
                    <h2 class="text-xl font-bold text-gray-900">Batasan Tanggung Jawab</h2>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">PT Fabi Abadi tidak bertanggung jawab atas:</p>
                <div class="space-y-3">
                    @foreach([
                        'Kejadian force majeure (bencana alam, perang, pandemi, kebijakan pemerintah) yang menyebabkan penundaan atau pembatalan perjalanan.',
                        'Kehilangan atau kerusakan barang bawaan pribadi Jamaah selama perjalanan.',
                        'Kondisi kesehatan Jamaah yang tidak dilaporkan sebelumnya dan menyebabkan pembatalan perjalanan.',
                        'Perubahan jadwal oleh maskapai penerbangan di luar kendali perusahaan.',
                        'Penolakan visa oleh otoritas Saudi Arabia akibat kelengkapan dokumen yang tidak memenuhi syarat.',
                    ] as $point)
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-orange-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $point }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 7. Perubahan Jadwal --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">7</span>
                    <h2 class="text-xl font-bold text-gray-900">Perubahan Jadwal dan Program</h2>
                </div>
                <div class="space-y-3">
                    @foreach([
                        'PT Fabi Abadi berhak mengubah jadwal, program, atau fasilitas paket apabila terdapat kondisi mendesak atau force majeure, dengan pemberitahuan kepada Jamaah secepatnya.',
                        'Dalam hal perubahan jadwal keberangkatan, Jamaah akan ditawarkan opsi penjadwalan ulang atau pengembalian dana sesuai kebijakan yang berlaku.',
                        'Perubahan program atau rute perjalanan yang disebabkan oleh kondisi di lapangan (cuaca, kepadatan jamaah haji dunia, dll.) tidak dianggap sebagai wanprestasi perusahaan.',
                    ] as $i => $point)
                    <div class="flex items-start gap-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs font-bold mt-0.5">{{ $i + 1 }}</span>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $point }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 8. Hukum --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">8</span>
                    <h2 class="text-xl font-bold text-gray-900">Hukum yang Berlaku dan Penyelesaian Sengketa</h2>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed mb-4">
                    Syarat dan ketentuan ini diatur dan ditafsirkan berdasarkan hukum yang berlaku di Republik Indonesia.
                    Setiap sengketa yang timbul diselesaikan terlebih dahulu melalui musyawarah untuk mufakat.
                    Apabila tidak tercapai kesepakatan, sengketa diselesaikan melalui Pengadilan Negeri yang berwenang di wilayah Surabaya.
                </p>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <p class="text-xs text-gray-500 leading-relaxed">
                        <span class="font-semibold text-gray-700">Referensi Hukum:</span> UU No. 8 Tahun 1999 tentang Perlindungan Konsumen &bull;
                        UU No. 13 Tahun 2008 tentang Penyelenggaraan Ibadah Haji &bull;
                        Peraturan Menteri Agama terkait penyelenggaraan perjalanan ibadah umroh.
                    </p>
                </div>
            </div>

            {{-- 9. Persetujuan --}}
            <div class="bg-gradient-to-br from-orange-600 to-orange-700 text-white rounded-2xl p-8 text-center shadow-lg">
                <svg class="w-12 h-12 mx-auto mb-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <h2 class="text-xl font-bold mb-3">Persetujuan Syarat &amp; Ketentuan</h2>
                <p class="text-orange-100 text-sm leading-relaxed mb-6 max-w-md mx-auto">
                    Dengan mendaftarkan diri dan melakukan pembayaran, Anda menyatakan telah membaca, memahami, dan menyetujui seluruh syarat dan ketentuan yang berlaku.
                </p>
                <a href="{{ route('registration.index') }}"
                   class="inline-flex items-center gap-2 bg-white text-orange-700 hover:bg-orange-50 font-semibold px-8 py-3 rounded-full text-sm transition-colors duration-300 shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Daftar Sekarang
                </a>
            </div>

        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-gray-900 border-t border-gray-800 text-gray-500 text-sm py-8 mt-8">
        <div class="max-w-4xl mx-auto px-4 text-center space-y-3">
            <p>&copy; {{ date('Y') }} PT Fabi Abadi. All rights reserved.</p>
            <div class="flex justify-center gap-6">
                <a href="{{ route('privacy.policy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="{{ route('terms.service') }}" class="text-orange-400 font-medium">Terms of Service</a>
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
