<div id="partners" class="content-section {{ $section == 'partners' ? '' : 'hidden' }}">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:20px;flex-wrap:wrap;">
        <div>
            <h1 style="font-size:20px;font-weight:600;color:var(--color-charcoal);margin:0 0 4px;">Data Partner</h1>
            <p style="font-size:14px;color:var(--color-fog);margin:0;">Kelola daftar mitra kerja sama dan sponsorship.</p>
        </div>
        <button onclick="openCreatePartnerModal()" class="dub-btn dub-btn-primary" style="gap:8px;">
            <i class="fas fa-handshake" style="font-size:13px;"></i>
            Tambah Partner
        </button>
    </div>

    <div class="dub-table-wrapper">
        <div style="overflow-x:auto;">
            <table class="dub-table" style="white-space:nowrap;">
                <thead>
                    <tr>
                        <th style="text-align:center;">Logo</th>
                        <th>Nama Partner</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($partners as $partner)
                    <tr>
                        <td style="text-align:center;width:100px;">
                            <div style="display:flex;justify-content:center;align-items:center;height:40px;width:80px;margin:0 auto;">
                                @if($partner->logo_path)
                                    <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}"
                                         style="max-height:40px;max-width:80px;object-fit:contain;filter:grayscale(20%);">
                                @else
                                    <div style="background:var(--color-paper-mist);border:1px solid var(--color-ash);border-radius:6px;width:80px;height:40px;display:flex;align-items:center;justify-content:center;font-size:11px;color:var(--color-fog);">
                                        No Logo
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span style="font-size:14px;font-weight:500;color:var(--color-charcoal);">{{ $partner->name }}</span>
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;justify-content:center;gap:4px;">
                                <button onclick="openEditPartnerModal({{ $partner->id }}, '{{ e($partner->name) }}', '{{ $partner->logo_path ? asset('storage/' . $partner->logo_path) : '' }}')"
                                        class="dub-action-btn edit" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <form method="POST" action="{{ route('partners.destroy', $partner->id) }}" class="inline-block"
                                      onsubmit="return handleDeletePartner(event, '{{ e($partner->name) }}');">
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
                        <td colspan="3">
                            <div class="dub-empty">
                                <div class="dub-empty-icon"><i class="fas fa-handshake"></i></div>
                                <p>Belum ada partner terdaftar</p>
                                <span>Tambahkan mitra kerja sama pertama Anda.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="createPartnerModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/25 backdrop-blur-xs transition-opacity opacity-0" id="createPartnerBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left border border-[var(--color-ash)] shadow-lg transition-all w-full max-w-md scale-95 opacity-0" id="createPartnerPanel">

                <div class="px-6 py-4 border-b border-[var(--color-ash)] flex justify-between items-center bg-white">
                    <h3 class="text-base font-semibold text-[var(--color-charcoal)] flex items-center gap-2">
                        <i class="fas fa-handshake text-[var(--color-electric-blue)]"></i>
                        Tambah Partner
                    </h3>
                    <button onclick="closeCreatePartnerModal()" class="text-[var(--color-fog)] hover:text-[var(--color-charcoal)] transition-colors focus:outline-none">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form id="createPartnerForm" method="POST" action="{{ route('partners.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Logo Partner</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="createPartnerLogo" class="flex flex-col items-center justify-center w-full h-28 border border-dashed border-[var(--color-ash)] rounded-xl cursor-pointer bg-[var(--color-paper-mist)] hover:bg-white hover:border-[var(--color-smoke)] transition-colors relative overflow-hidden group">
                                <img id="createPartnerPreview" class="absolute inset-0 w-full h-full object-contain p-3 hidden" />
                                <div id="createPartnerPlaceholder" class="flex flex-col items-center justify-center py-4">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-[var(--color-silver)] mb-1 group-hover:text-[var(--color-electric-blue)] transition-colors"></i>
                                    <p class="text-xs text-[var(--color-fog)]">Klik untuk upload logo</p>
                                </div>
                                <input id="createPartnerLogo" name="logo" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'createPartnerPreview', 'createPartnerPlaceholder')" />
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Nama Partner <span class="text-red-500">*</span></label>
                        <input type="text" name="name" class="dub-input" placeholder="Contoh: Garuda Indonesia" required>
                    </div>

                    <div class="flex justify-end gap-2 pt-4 border-t border-[var(--color-ash)]">
                        <button type="button" onclick="closeCreatePartnerModal()" class="dub-btn dub-btn-outline">Batal</button>
                        <button type="submit" class="dub-btn dub-btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editPartnerModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/25 backdrop-blur-xs transition-opacity opacity-0" id="editPartnerBackdrop"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left border border-[var(--color-ash)] shadow-lg transition-all w-full max-w-md scale-95 opacity-0" id="editPartnerPanel">

                <div class="px-6 py-4 border-b border-[var(--color-ash)] flex justify-between items-center bg-white">
                    <h3 class="text-base font-semibold text-[var(--color-charcoal)] flex items-center gap-2">
                        <i class="fas fa-edit text-[var(--color-electric-blue)]"></i>
                        Edit Partner
                    </h3>
                    <button onclick="closeEditPartnerModal()" class="text-[var(--color-fog)] hover:text-[var(--color-charcoal)] transition-colors focus:outline-none">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form id="editPartnerForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Logo Partner (Klik untuk ganti)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="editPartnerLogoInput" class="flex flex-col items-center justify-center w-full h-28 border border-dashed border-[var(--color-ash)] rounded-xl cursor-pointer bg-[var(--color-paper-mist)] hover:bg-white hover:border-[var(--color-smoke)] transition-colors relative overflow-hidden group">
                                <img id="editPartnerPreview" class="absolute inset-0 w-full h-full object-contain p-3" />
                                <div id="editPartnerPlaceholder" class="flex flex-col items-center justify-center py-4 hidden">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-[var(--color-silver)] mb-1"></i>
                                    <p class="text-xs text-[var(--color-fog)]">Upload logo baru</p>
                                </div>
                                <input id="editPartnerLogoInput" name="logo" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'editPartnerPreview', 'editPartnerPlaceholder')" />
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--color-steel)] uppercase tracking-wider mb-1.5">Nama Partner</label>
                        <input type="text" id="editPartnerName" name="name" class="dub-input" required>
                    </div>

                    <div class="flex justify-end gap-2 pt-4 border-t border-[var(--color-ash)]">
                        <button type="button" onclick="closeEditPartnerModal()" class="dub-btn dub-btn-outline">Batal</button>
                        <button type="submit" class="dub-btn dub-btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // --- Animation Helper ---
    function animatePartnerModal(modalId, backdropId, panelId, show) {
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
    function openCreatePartnerModal() {
        document.getElementById('createPartnerForm').reset();
        document.getElementById('createPartnerPreview').classList.add('hidden');
        document.getElementById('createPartnerPlaceholder').classList.remove('hidden');
        animatePartnerModal('createPartnerModal', 'createPartnerBackdrop', 'createPartnerPanel', true);
    }

    function closeCreatePartnerModal() {
        animatePartnerModal('createPartnerModal', 'createPartnerBackdrop', 'createPartnerPanel', false);
    }

    // --- Edit Modal Functions ---
    function openEditPartnerModal(id, name, logoUrl) {
        document.getElementById('editPartnerName').value = name;

        const preview = document.getElementById('editPartnerPreview');
        const placeholder = document.getElementById('editPartnerPlaceholder');

        if (logoUrl) {
            preview.src = logoUrl;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        } else {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }

        const baseUrl = '{{ url("partners") }}';
        document.getElementById('editPartnerForm').action = `${baseUrl}/${id}`;

        animatePartnerModal('editPartnerModal', 'editPartnerBackdrop', 'editPartnerPanel', true);
    }

    function closeEditPartnerModal() {
        animatePartnerModal('editPartnerModal', 'editPartnerBackdrop', 'editPartnerPanel', false);
    }

    // --- Close on Click Outside ---
    window.addEventListener('click', function(e) {
        const createModal = document.getElementById('createPartnerModal');
        const editModal = document.getElementById('editPartnerModal');
        const createPanel = document.getElementById('createPartnerPanel');
        const editPanel = document.getElementById('editPartnerPanel');

        if (e.target === createModal || (createModal && createModal.contains(e.target) && !createPanel.contains(e.target))) {
            closeCreatePartnerModal();
        }
        if (e.target === editModal || (editModal && editModal.contains(e.target) && !editPanel.contains(e.target))) {
            closeEditPartnerModal();
        }
    });
</script>
