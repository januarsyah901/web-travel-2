<div id="testimonials" class="content-section {{ $section == 'testimonials' ? '' : 'hidden' }} space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Testimoni Jamaah</h2>
            <p class="text-gray-500 mt-1">Kelola ulasan dan pengalaman dari para jamaah.</p>
        </div>
        <button onclick="openCreateTestimonialModal()" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 ease-in-out transform hover:-translate-y-0.5">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <i class="fas fa-star text-blue-300 group-hover:text-white transition-colors"></i>
            </span>
            <span class="ml-4">Tambah Testimoni</span>
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full whitespace-nowrap">
                <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4 w-12">No</th>
                    <th class="px-6 py-4">Nama Jamaah</th> <th class="px-6 py-4">Rating</th>
                    <th class="px-6 py-4">Ulasan</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($testimonials as $testimonial)
                    <tr class="hover:bg-gray-50/80 transition-colors duration-150">
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900">{{ $testimonial->name }}</div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex text-yellow-400 text-sm mr-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star text-gray-300"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-500 font-medium border border-gray-200 px-1.5 py-0.5 rounded bg-gray-50">{{ $testimonial->rating }}.0</span>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="relative group cursor-help max-w-xs md:max-w-sm">
                                <p class="text-sm text-gray-600 truncate italic">"{{ Str::limit($testimonial->content, 60) }}"</p>
                                <div class="absolute bottom-full left-0 mb-2 w-64 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-20 whitespace-normal leading-relaxed">
                                    {{ $testimonial->content }}
                                    <div class="absolute top-full left-4 -mt-1 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-3">
                                <button onclick="openEditTestimonialModal({{ $testimonial->id }}, '{{ addslashes($testimonial->name) }}', '{{ addslashes($testimonial->content) }}', {{ $testimonial->rating }}, '{{ $testimonial->photo ? asset('storage/' . $testimonial->photo) : '' }}')"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </button>

                                <form method="POST" action="{{ route('testimonials.destroy', $testimonial->id) }}" class="inline-block" onsubmit="return handleDeleteTestimonial(event, '{{ addslashes($testimonial->name) }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200" title="Hapus">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <div class="p-3 bg-gray-100 rounded-full">
                                    <i class="far fa-comment-dots text-gray-400 text-3xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Belum ada testimoni</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="createTestimonialModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity opacity-0" id="createTestimoniBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg scale-95 opacity-0" id="createTestimoniPanel">

                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-star bg-white/20 p-1.5 rounded-md"></i>
                        Tambah Testimoni
                    </h3>
                    <button onclick="closeCreateTestimonialModal()" class="text-blue-100 hover:text-white transition-colors focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="createTestimonialForm" method="POST" action="{{ route('testimonials.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jamaah</label>
                            <input type="text" name="name" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5" placeholder="Nama Lengkap" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                            <select name="rating" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5" required>
                                <option value="5" selected>⭐⭐⭐⭐⭐ (Sempurna)</option>
                                <option value="4">⭐⭐⭐⭐ (Sangat Baik)</option>
                                <option value="3">⭐⭐⭐ (Cukup)</option>
                                <option value="2">⭐⭐ (Kurang)</option>
                                <option value="1">⭐ (Buruk)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Isi Ulasan</label>
                        <textarea name="content" rows="4" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 resize-none" placeholder="Tuliskan pengalaman jamaah..." required></textarea>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeCreateTestimonialModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm transition-colors">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editTestimonialModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity opacity-0" id="editTestimoniBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg scale-95 opacity-0" id="editTestimoniPanel">

                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-edit bg-white/20 p-1.5 rounded-md"></i>
                        Edit Testimoni
                    </h3>
                    <button onclick="closeEditTestimonialModal()" class="text-blue-100 hover:text-white transition-colors focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="editTestimonialForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jamaah</label>
                            <input type="text" id="editTestimoniName" name="name" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                            <select id="editTestimoniRating" name="rating" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5" required>
                                <option value="5">⭐⭐⭐⭐⭐ (Sempurna)</option>
                                <option value="4">⭐⭐⭐⭐ (Sangat Baik)</option>
                                <option value="3">⭐⭐⭐ (Cukup)</option>
                                <option value="2">⭐⭐ (Kurang)</option>
                                <option value="1">⭐ (Buruk)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Isi Ulasan</label>
                        <textarea id="editTestimoniContent" name="content" rows="4" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 resize-none" required></textarea>
                    </div>
                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeEditTestimonialModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Batal</button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm transition-colors">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // --- Helper for Animations ---
    function animateTestimoniModal(modalId, backdropId, panelId, show) {
        const modal = document.getElementById(modalId);
        const backdrop = document.getElementById(backdropId);
        const panel = document.getElementById(panelId);

        if (show) {
            modal.classList.remove('hidden');
            requestAnimationFrame(() => {
                backdrop.classList.remove('opacity-0');
                panel.classList.remove('opacity-0', 'scale-95');
                panel.classList.add('opacity-100', 'scale-100');
            });
        } else {
            backdrop.classList.add('opacity-0');
            panel.classList.remove('opacity-100', 'scale-100');
            panel.classList.add('opacity-0', 'scale-95');
            setTimeout(() => { modal.classList.add('hidden'); }, 300);
        }
    }

    // --- Create Modal Functions ---
    function openCreateTestimonialModal() {
        document.getElementById('createTestimonialForm').reset();
        animateTestimoniModal('createTestimonialModal', 'createTestimoniBackdrop', 'createTestimoniPanel', true);
    }

    function closeCreateTestimonialModal() {
        animateTestimoniModal('createTestimonialModal', 'createTestimoniBackdrop', 'createTestimoniPanel', false);
    }

    // --- Edit Modal Functions ---
    // Hapus parameter 'city'
    function openEditTestimonialModal(id, name, content, rating, photoUrl) {
        document.getElementById('editTestimoniName').value = name;
        document.getElementById('editTestimoniContent').value = content;
        document.getElementById('editTestimoniRating').value = rating;
        // Tidak ada set value city

        const baseUrl = '{{ url("testimonials") }}';
        document.getElementById('editTestimonialForm').action = `${baseUrl}/${id}`;

        animateTestimoniModal('editTestimonialModal', 'editTestimoniBackdrop', 'editTestimoniPanel', true);
    }

    function closeEditTestimonialModal() {
        animateTestimoniModal('editTestimonialModal', 'editTestimoniBackdrop', 'editTestimoniPanel', false);
    }

    // --- Close on Outside Click ---
    window.addEventListener('click', function(e) {
        const createModal = document.getElementById('createTestimonialModal');
        const editModal = document.getElementById('editTestimonialModal');
        const createPanel = document.getElementById('createTestimoniPanel');
        const editPanel = document.getElementById('editTestimoniPanel');

        if (e.target === createModal || (createModal && createModal.contains(e.target) && !createPanel.contains(e.target))) {
            closeCreateTestimonialModal();
        }
        if (e.target === editModal || (editModal && editModal.contains(e.target) && !editPanel.contains(e.target))) {
            closeEditTestimonialModal();
        }
    });
</script>
