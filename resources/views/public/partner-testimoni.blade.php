<!-- Partner & Testimoni Section -->
<section id="testimoni" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Partner -->
        <div class="mb-20">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Partner Kami</h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto mb-4"></div>
                <p class="text-gray-600">Bekerjasama dengan mitra terpercaya untuk layanan terbaik</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @php
                    $partners = \App\Models\Partner::take(8)->get();
                @endphp
                @forelse($partners as $partner)
                    <div class="bg-white border rounded-lg p-6 flex items-center justify-center hover:shadow-lg transition">
                        @if($partner->logo_path)
                            <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="max-h-20 object-contain">
                        @else
                            <span class="text-gray-400 text-center">{{ $partner->name }}</span>
                        @endif
                    </div>
                @empty
                    <div class="col-span-4 text-center py-12">
                        <p class="text-gray-600">Partner akan segera ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>


        <!-- Testimoni -->
        <div>
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Testimoni Jamaah</h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto mb-4"></div>
                <p class="text-gray-600">Apa kata mereka yang telah bergabung bersama kami</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $testimonials = \App\Models\Testimonial::latest()->take(3)->get();
                @endphp
                @forelse($testimonials as $testimonial)
                    <div class="bg-orange-50 p-8 rounded-lg">
                        <div class="flex items-center mb-4">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-gray-700 mb-4">"{{ $testimonial->content }}"</p>
                        <div class="flex items-center">
                            @if($testimonial->photo)
                                <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover mr-4">
                            @else
                                <div class="w-12 h-12 rounded-full bg-orange-200 flex items-center justify-center mr-4">
                                    <span class="text-orange-600 font-bold">{{ substr($testimonial->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div>
                                <div class="font-bold text-gray-800">{{ $testimonial->name }}</div>
                                <div class="text-sm text-gray-600">{{ $testimonial->city ?? 'Jamaah' }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-600">Testimoni akan segera ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

