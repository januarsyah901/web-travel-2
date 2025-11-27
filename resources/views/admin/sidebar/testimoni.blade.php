<div id="testimoni" class="content-section {{ $section == 'testimonials' ? '' : 'hidden' }}">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Testimoni</h2>
        <button onclick="openCreateTestimonialModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Testimoni
        </button>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rating</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Komentar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($testimonials as $testimonial)
                    <tr>
                        <td class="px-6 py-4">{{ $testimonial->id }}</td>
                        <td class="px-6 py-4">{{ $testimonial->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ Str::limit($testimonial->content, 50) }}</td>
                        <td class="px-6 py-4">
                            <button onclick="openEditTestimonialModal({{ $testimonial->id }}, '{{ addslashes($testimonial->name) }}', '{{ addslashes($testimonial->city ?? '') }}', '{{ addslashes($testimonial->content) }}', {{ $testimonial->rating }}, '{{ $testimonial->photo }}')" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                            <form method="POST" action="{{ route('testimonials.destroy', $testimonial->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data testimoni</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Testimonial Modal -->
<div id="createTestimonialModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-6 border shadow-2xl rounded-xl bg-white max-w-lg">
        <button onclick="closeCreateTestimonialModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <i class="fas fa-times text-xl"></i>
        </button>

        <h3 class="text-2xl font-bold text-gray-800 mb-6">Tambah Testimoni Baru</h3>
        <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="create_testimonial_name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="create_testimonial_name" required
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="create_testimonial_city" class="block text-sm font-semibold text-gray-700 mb-2">
                    Kota/Asal
                </label>
                <input type="text" name="city" id="create_testimonial_city"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="create_testimonial_content" class="block text-sm font-semibold text-gray-700 mb-2">
                    Testimoni <span class="text-red-500">*</span>
                </label>
                <textarea name="content" id="create_testimonial_content" rows="4" required
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <div>
                <label for="create_testimonial_rating" class="block text-sm font-semibold text-gray-700 mb-2">
                    Rating <span class="text-red-500">*</span>
                </label>
                <select name="rating" id="create_testimonial_rating" required
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Rating</option>
                    <option value="5">⭐⭐⭐⭐⭐ (5 Bintang)</option>
                    <option value="4">⭐⭐⭐⭐ (4 Bintang)</option>
                    <option value="3">⭐⭐⭐ (3 Bintang)</option>
                    <option value="2">⭐⭐ (2 Bintang)</option>
                    <option value="1">⭐ (1 Bintang)</option>
                </select>
            </div>

            <div>
                <label for="create_testimonial_photo" class="block text-sm font-semibold text-gray-700 mb-2">
                    Foto
                </label>
                <input type="file" name="photo" id="create_testimonial_photo" accept="image/*"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Format: JPG, JPEG, PNG. Max: 2MB</p>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeCreateTestimonialModal()"
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Testimonial Modal -->
<div id="editTestimonialModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-6 border shadow-2xl rounded-xl bg-white max-w-lg">
        <button onclick="closeEditTestimonialModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <i class="fas fa-times text-xl"></i>
        </button>

        <h3 class="text-2xl font-bold text-gray-800 mb-6">Edit Testimoni</h3>
        <form id="editTestimonialForm" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="edit_testimonial_name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="edit_testimonial_name" required
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="edit_testimonial_city" class="block text-sm font-semibold text-gray-700 mb-2">
                    Kota/Asal
                </label>
                <input type="text" name="city" id="edit_testimonial_city"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="edit_testimonial_content" class="block text-sm font-semibold text-gray-700 mb-2">
                    Testimoni <span class="text-red-500">*</span>
                </label>
                <textarea name="content" id="edit_testimonial_content" rows="4" required
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <div>
                <label for="edit_testimonial_rating" class="block text-sm font-semibold text-gray-700 mb-2">
                    Rating <span class="text-red-500">*</span>
                </label>
                <select name="rating" id="edit_testimonial_rating" required
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Rating</option>
                    <option value="5">⭐⭐⭐⭐⭐ (5 Bintang)</option>
                    <option value="4">⭐⭐⭐⭐ (4 Bintang)</option>
                    <option value="3">⭐⭐⭐ (3 Bintang)</option>
                    <option value="2">⭐⭐ (2 Bintang)</option>
                    <option value="1">⭐ (1 Bintang)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Saat Ini</label>
                <div id="current_testimonial_photo_preview" class="mb-3"></div>
            </div>

            <div>
                <label for="edit_testimonial_photo" class="block text-sm font-semibold text-gray-700 mb-2">
                    Foto Baru
                </label>
                <input type="file" name="photo" id="edit_testimonial_photo" accept="image/*"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ingin mengubah foto</p>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeEditTestimonialModal()"
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateTestimonialModal() {
    document.getElementById('createTestimonialModal').classList.remove('hidden');
}

function closeCreateTestimonialModal() {
    document.getElementById('createTestimonialModal').classList.add('hidden');
}

function openEditTestimonialModal(id, name, city, content, rating, photo) {
    const modal = document.getElementById('editTestimonialModal');
    const form = document.getElementById('editTestimonialForm');

    form.action = `/testimonials/${id}`;
    document.getElementById('edit_testimonial_name').value = name;
    document.getElementById('edit_testimonial_city').value = city;
    document.getElementById('edit_testimonial_content').value = content;
    document.getElementById('edit_testimonial_rating').value = rating;

    const photoPreview = document.getElementById('current_testimonial_photo_preview');
    if (photo) {
        photoPreview.innerHTML = `<img src="/storage/${photo}" alt="${name}" class="h-20 w-20 rounded-full object-cover">`;
    } else {
        photoPreview.innerHTML = '<p class="text-gray-500 text-sm">Tidak ada foto</p>';
    }

    modal.classList.remove('hidden');
}

function closeEditTestimonialModal() {
    document.getElementById('editTestimonialModal').classList.add('hidden');
}
</script>

