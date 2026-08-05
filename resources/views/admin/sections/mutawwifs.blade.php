<div id="mutawwifs" class="content-section {{ $section == 'mutawwifs' ? '' : 'hidden' }}">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:20px;flex-wrap:wrap;">
        <div>
            <h1 style="font-size:20px;font-weight:600;color:var(--color-charcoal);margin:0 0 4px;">Data Mutawwif</h1>
            <p style="font-size:14px;color:var(--color-fog);margin:0;">Kelola data pembimbing ibadah (Ustadz/Mutawwif).</p>
        </div>
        <button onclick="openCreateMutawwifModal()" class="dub-btn dub-btn-primary" style="gap:8px;">
            <i class="fas fa-user-plus" style="font-size:13px;"></i>
            Tambah Mutawwif
        </button>
    </div>

    <div class="dub-table-wrapper">
        <div style="overflow-x:auto;">
            <table class="dub-table" style="white-space:nowrap;">
                <thead>
                    <tr>
                        <th>Profil</th>
                        <th>Nama Lengkap</th>
                        <th>Spesialisasi</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($mutawwifs as $mutawwif)
                    <tr>
                        <td style="width:60px;">
                            @if($mutawwif->photo_path)
                                <img src="{{ asset('storage/' . $mutawwif->photo_path) }}" alt="{{ $mutawwif->name }}"
                                     style="width:36px;height:36px;border-radius:9999px;object-fit:cover;border:1px solid var(--color-ash);">
                            @else
                                <div class="dub-avatar" style="background:var(--color-soft-blue);color:var(--color-electric-blue);border-color:#bfdbfe;">
                                    {{ strtoupper(substr($mutawwif->name, 0, 2)) }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <span style="font-size:14px;font-weight:500;color:var(--color-charcoal);">{{ $mutawwif->name }}</span>
                        </td>
                        <td>
                            <span style="font-size:13px;color:var(--color-steel);max-width:220px;display:block;overflow:hidden;text-overflow:ellipsis;" title="{{ $mutawwif->specialization }}">
                                {{ $mutawwif->specialization ?? '—' }}
                            </span>
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;justify-content:center;gap:4px;">
                                <button onclick="openEditMutawwifModal({{ $mutawwif->id }}, '{{ addslashes($mutawwif->name) }}', '{{ addslashes($mutawwif->specialization) }}', '{{ $mutawwif->photo_path ? asset('storage/' . $mutawwif->photo_path) : '' }}')"
                                        class="dub-action-btn edit" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <form method="POST" action="{{ route('mutawwifs.destroy', $mutawwif->id) }}" class="inline-block"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mutawwif ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dub-action-btn delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="dub-empty">
                                <div class="dub-empty-icon"><i class="fas fa-user-slash"></i></div>
                                <p>Belum ada data mutawwif</p>
                                <span>Tambahkan mutawwif pertama Anda.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="createMutawwifModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/25 backdrop-blur-xs transition-opacity opacity-0" id="createMutawwifBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left border border-[var(--color-ash)] shadow-lg transition-all w-full max-w-md scale-95 opacity-0" id="createMutawwifPanel">

                <div class="px-6 py-4 border-b border-[var(--color-ash)] flex justify-between items-center bg-white">
                    <h3 class="text-base font-semibold text-[var(--color-charcoal)] flex items-center gap-2">
                        <i class="fas fa-user-plus text-[var(--color-electric-blue)]"></i>
                        Tambah Mutawwif Baru
                    </h3>
                    <button onclick="closeCreateMutawwifModal()" class="text-[var(--color-fog)] hover:text-[var(--color-charcoal)] transition-colors focus:outline-none">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form id="createMutawwifForm" method="POST" action="{{ route('mutawwifs.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf

                    <div class="flex flex-col items-center justify-center space-y-2">
                        <div class="relative group">
                            <div class="w-24 h-24 rounded-full overflow-hidden border border-[var(--color-ash)] bg-[var(--color-paper-mist)] flex items-center justify-center">
                                <img id="createMutawwifPreview" src="" alt="Preview Foto Mutawwif" class="w-full h-full object-cover hidden" />
                                <i id="createMutawwifPlaceholder" class="fas fa-camera text-2xl text-[var(--color-silver)]"></i>
                            </div>
                            <label for="createMutawwifPhoto" class="absolute bottom-0 right-0 bg-[var(--color-primary-action-fill)] text-white p-1.5 rounded-full shadow-sm cursor-pointer hover:bg-[var(--color-graphite)] transition-colors">
                                <i class="fas fa-pencil-alt text-xs"></i>
                            </label>
                            <input id="createMutawwifPhoto" name="photo" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'createMutawwifPreview', 'createMutawwifPlaceholder')" />
                        </div>
                        <span class="text-xs text-[var(--color-fog)]">Upload Foto Profil (Opsional)</span>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" class="dub-input" placeholder="Contoh: Ustadz Ahmad" required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Spesialisasi</label>
                        <textarea name="specialization" rows="3" class="dub-input resize-none" placeholder="Contoh: Pembimbing Ibadah & Tour Leader..."></textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4 border-t border-[var(--color-ash)]">
                        <button type="button" onclick="closeCreateMutawwifModal()" class="dub-btn dub-btn-outline">Batal</button>
                        <button type="submit" class="dub-btn dub-btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editMutawwifModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/25 backdrop-blur-xs transition-opacity opacity-0" id="editMutawwifBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left border border-[var(--color-ash)] shadow-lg transition-all w-full max-w-md scale-95 opacity-0" id="editMutawwifPanel">

                <div class="px-6 py-4 border-b border-[var(--color-ash)] flex justify-between items-center bg-white">
                    <h3 class="text-base font-semibold text-[var(--color-charcoal)] flex items-center gap-2">
                        <i class="fas fa-user-edit text-[var(--color-electric-blue)]"></i>
                        Edit Data Mutawwif
                    </h3>
                    <button onclick="closeEditMutawwifModal()" class="text-[var(--color-fog)] hover:text-[var(--color-charcoal)] transition-colors focus:outline-none">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form id="editMutawwifForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col items-center justify-center space-y-2">
                        <div class="relative group">
                            <div class="w-24 h-24 rounded-full overflow-hidden border border-[var(--color-ash)] bg-[var(--color-paper-mist)] flex items-center justify-center">
                                <img id="editMutawwifPreview" src="" alt="Preview Edit Foto Mutawwif" class="w-full h-full object-cover hidden" />
                                <i id="editMutawwifPlaceholder" class="fas fa-user text-2xl text-[var(--color-silver)]"></i>
                            </div>
                            <label for="editMutawwifPhotoInput" class="absolute bottom-0 right-0 bg-[var(--color-primary-action-fill)] text-white p-1.5 rounded-full shadow-sm cursor-pointer hover:bg-[var(--color-graphite)] transition-colors">
                                <i class="fas fa-camera text-xs"></i>
                            </label>
                            <input id="editMutawwifPhotoInput" name="photo" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'editMutawwifPreview', 'editMutawwifPlaceholder')" />
                        </div>
                        <span class="text-xs text-[var(--color-fog)]">Ganti Foto Profil</span>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                        <input type="text" id="editMutawwifName" name="name" class="dub-input" required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Spesialisasi</label>
                        <textarea id="editMutawwifSpecialization" name="specialization" rows="3" class="dub-input resize-none"></textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4 border-t border-[var(--color-ash)]">
                        <button type="button" onclick="closeEditMutawwifModal()" class="dub-btn dub-btn-outline">Batal</button>
                        <button type="submit" class="dub-btn dub-btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // --- Helper for Modal Animations (Reused) ---
    function animateMutawwifModal(modalId, backdropId, panelId, show) {
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
    function openCreateMutawwifModal() {
        document.getElementById('createMutawwifForm').reset();
        // Reset preview
        document.getElementById('createMutawwifPreview').classList.add('hidden');
        document.getElementById('createMutawwifPlaceholder').classList.remove('hidden');
        animateMutawwifModal('createMutawwifModal', 'createMutawwifBackdrop', 'createMutawwifPanel', true);
    }

    function closeCreateMutawwifModal() {
        animateMutawwifModal('createMutawwifModal', 'createMutawwifBackdrop', 'createMutawwifPanel', false);
    }

    // --- Edit Modal Functions ---
    function openEditMutawwifModal(id, name, specialization, photoUrl) {
        document.getElementById('editMutawwifName').value = name;
        document.getElementById('editMutawwifSpecialization').value = specialization;

        const preview = document.getElementById('editMutawwifPreview');
        const placeholder = document.getElementById('editMutawwifPlaceholder');

        if (photoUrl) {
            preview.src = photoUrl;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        } else {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }

        // Dynamic Action URL
        const baseUrl = '{{ url("mutawwifs") }}';
        document.getElementById('editMutawwifForm').action = `${baseUrl}/${id}`;

        animateMutawwifModal('editMutawwifModal', 'editMutawwifBackdrop', 'editMutawwifPanel', true);
    }

    function closeEditMutawwifModal() {
        animateMutawwifModal('editMutawwifModal', 'editMutawwifBackdrop', 'editMutawwifPanel', false);
    }

    // --- Close on Click Outside ---
    window.addEventListener('click', function(e) {
        const createModal = document.getElementById('createMutawwifModal');
        const editModal = document.getElementById('editMutawwifModal');
        const createPanel = document.getElementById('createMutawwifPanel');
        const editPanel = document.getElementById('editMutawwifPanel');

        if (e.target === createModal || (createModal && createModal.contains(e.target) && !createPanel.contains(e.target))) {
            closeCreateMutawwifModal();
        }
        if (e.target === editModal || (editModal && editModal.contains(e.target) && !editPanel.contains(e.target))) {
            closeEditMutawwifModal();
        }
    });
</script>
