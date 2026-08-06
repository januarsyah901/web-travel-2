<section id="pendaftaran" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Pendaftaran Terbuka</h2>
        <div class="w-20 h-1 bg-orange-600 mx-auto mb-4"></div>
        <p class="text-gray-600 mb-10 max-w-2xl mx-auto">
            Segera wujudkan impian ibadah umroh Anda bersama PT Fabi Abadi. Kuota terbatas tiap keberangkatan.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('registration.index') }}"
               class="inline-flex items-center justify-center bg-orange-600 text-white px-8 py-3.5 rounded-full font-bold hover:bg-orange-700 transition-colors shadow-md text-base">
                Formulir Pendaftaran
            </a>
            @if(isset($contact) && $contact && $contact->whatsapp)
            <a href="{{ $contact->whatsapp_link ?? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $contact->whatsapp) }}"
               target="_blank"
               class="inline-flex items-center justify-center bg-white text-orange-600 border-2 border-orange-600 px-8 py-3.5 rounded-full font-bold hover:bg-orange-50 transition-colors text-base">
                Hubungi Kami
            </a>
            @endif
        </div>
    </div>
</section>
