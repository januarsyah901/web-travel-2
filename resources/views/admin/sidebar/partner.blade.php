<div id="partner" class="content-section {{ $section == 'partners' ? '' : 'hidden' }}">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Partner</h2>
        <button onclick="openCreatePartnerModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Partner
        </button>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Logo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($partners as $partner)
                    <tr>
                        <td class="px-6 py-4">{{ $partner->id }}</td>
                        <td class="px-6 py-4">{{ $partner->name }}</td>
                        <td class="px-6 py-4">
                            @if($partner->logo_path)
                                <a href="{{ asset('storage/' . $partner->logo_path) }}" target="_blank" class="text-blue-600 hover:underline">View</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <button onclick="openEditPartnerModal({{ $partner->id }}, '{{ addslashes($partner->name) }}', '{{ $partner->logo_path }}')" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                            <form method="POST" action="{{ route('partners.destroy', $partner->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data partner</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Partner Modal -->
<div id="createPartnerModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-6 border shadow-2xl rounded-xl bg-white max-w-lg">
        <button onclick="closeCreatePartnerModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <i class="fas fa-times text-xl"></i>
        </button>

        <h3 class="text-2xl font-bold text-gray-800 mb-6">Tambah Partner Baru</h3>
        <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="create_partner_name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Partner <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="create_partner_name" required
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="create_partner_logo" class="block text-sm font-semibold text-gray-700 mb-2">
                    Logo
                </label>
                <input type="file" name="logo" id="create_partner_logo" accept="image/*"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Format: JPG, JPEG, PNG, SVG. Max: 2MB</p>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeCreatePartnerModal()"
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

<!-- Edit Partner Modal -->
<div id="editPartnerModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-6 border shadow-2xl rounded-xl bg-white max-w-lg">
        <button onclick="closeEditPartnerModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <i class="fas fa-times text-xl"></i>
        </button>

        <h3 class="text-2xl font-bold text-gray-800 mb-6">Edit Partner</h3>
        <form id="editPartnerForm" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="edit_partner_name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Partner <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="edit_partner_name" required
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Logo Saat Ini</label>
                <div id="current_logo_preview" class="mb-3"></div>
            </div>

            <div>
                <label for="edit_partner_logo" class="block text-sm font-semibold text-gray-700 mb-2">
                    Logo Baru
                </label>
                <input type="file" name="logo" id="edit_partner_logo" accept="image/*"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ingin mengubah logo</p>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeEditPartnerModal()"
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
function openCreatePartnerModal() {
    document.getElementById('createPartnerModal').classList.remove('hidden');
}

function closeCreatePartnerModal() {
    document.getElementById('createPartnerModal').classList.add('hidden');
}

function openEditPartnerModal(id, name, logoPath) {
    const modal = document.getElementById('editPartnerModal');
    const form = document.getElementById('editPartnerForm');

    form.action = `/partners/${id}`;
    document.getElementById('edit_partner_name').value = name;

    const logoPreview = document.getElementById('current_logo_preview');
    if (logoPath) {
        logoPreview.innerHTML = `<img src="/storage/${logoPath}" alt="${name}" class="h-20 object-contain">`;
    } else {
        logoPreview.innerHTML = '<p class="text-gray-500 text-sm">Tidak ada logo</p>';
    }

    modal.classList.remove('hidden');
}

function closeEditPartnerModal() {
    document.getElementById('editPartnerModal').classList.add('hidden');
}
</script>

