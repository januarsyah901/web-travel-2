<!-- Quick Links Section -->
<section class="py-20 bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4 text-orange-400">PT Fabi Abadi</h3>
                <p class="text-gray-300">Travel umroh terpercaya dengan pelayanan terbaik untuk perjalanan ibadah Anda.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4 text-orange-400">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="#home" class="text-gray-300 hover:text-orange-400 transition">Beranda</a></li>
                    <li><a href="#tentang" class="text-gray-300 hover:text-orange-400 transition">Tentang Kami</a></li>
                    <li><a href="#paket" class="text-gray-300 hover:text-orange-400 transition">Paket Umroh</a></li>
                    <li><a href="#testimoni" class="text-gray-300 hover:text-orange-400 transition">Testimoni</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4 text-orange-400">Layanan</h3>
                <ul class="space-y-2">
                    <li><a href="#layanan" class="text-gray-300 hover:text-orange-400 transition">Layanan Kami</a></li>
                    <li><a href="#mutawwif" class="text-gray-300 hover:text-orange-400 transition">Mutawwif</a></li>
                    <li><a href="#galeri" class="text-gray-300 hover:text-orange-400 transition">Galeri</a></li>
                    <li><a href="{{ route('registration.form') }}" class="text-gray-300 hover:text-orange-400 transition">Pendaftaran</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4 text-orange-400">Kontak</h3>
                @if($contact)
                <ul class="space-y-2 text-gray-300">
                    <li>{{ $contact->phone }}</li>
                    <li>{{ $contact->email }}</li>
                    <li>{{ Str::limit($contact->address, 50) }}</li>
                </ul>
                @endif
            </div>
        </div>
    </div>
</section>

