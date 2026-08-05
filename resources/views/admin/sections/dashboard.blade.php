<div id="dashboard" class="content-section {{ $section !== 'dashboard' ? 'hidden' : '' }}">

    {{-- Page Header --}}
    <div style="margin-bottom: 28px;">
        <h1 style="font-size:20px;font-weight:600;color:var(--color-charcoal);margin:0 0 4px;">Dashboard</h1>
        <p style="font-size:14px;color:var(--color-fog);margin:0;">Ringkasan data dan aktivitas terkini Fabi Abadi Travel.</p>
    </div>

    {{-- ===== STAT BAR (Tanpa UI Card — Inline Numbers) ===== --}}
    <div style="display:flex; align-items:center; flex-wrap:wrap; gap:32px; margin-bottom:36px; padding:12px 0 24px; border-bottom:1px solid var(--color-ash);">

        {{-- Total Jamaah --}}
        <div style="display:flex; flex-direction:column; align-items:flex-start;">
            <span style="font-size:36px; font-weight:800; color:var(--color-charcoal); line-height:1; font-variant-numeric:tabular-nums;">{{ number_format($counts['users']) }}</span>
            <span style="font-size:13px; font-weight:500; color:var(--color-fog); margin-top:6px; text-transform:lowercase;">jamaah</span>
        </div>

        {{-- Divider --}}
        <div style="width:1px; height:32px; background:var(--color-ash); flex-shrink:0;"></div>

        {{-- Total Booking --}}
        <div style="display:flex; flex-direction:column; align-items:flex-start;">
            <span style="font-size:36px; font-weight:800; color:var(--color-charcoal); line-height:1; font-variant-numeric:tabular-nums;">{{ number_format($counts['bookings']) }}</span>
            <span style="font-size:13px; font-weight:500; color:var(--color-fog); margin-top:6px; text-transform:lowercase;">booking</span>
        </div>

        {{-- Divider --}}
        <div style="width:1px; height:32px; background:var(--color-ash); flex-shrink:0;"></div>

        {{-- Paket Tersedia --}}
        <div style="display:flex; flex-direction:column; align-items:flex-start;">
            <span style="font-size:36px; font-weight:800; color:var(--color-charcoal); line-height:1; font-variant-numeric:tabular-nums;">{{ number_format($counts['packages']) }}</span>
            <span style="font-size:13px; font-weight:500; color:var(--color-fog); margin-top:6px; text-transform:lowercase;">paket</span>
        </div>

        {{-- Divider --}}
        <div style="width:1px; height:32px; background:var(--color-ash); flex-shrink:0;"></div>

        {{-- Total Partner --}}
        <div style="display:flex; flex-direction:column; align-items:flex-start;">
            <span style="font-size:36px; font-weight:800; color:var(--color-charcoal); line-height:1; font-variant-numeric:tabular-nums;">{{ number_format($counts['partners']) }}</span>
            <span style="font-size:13px; font-weight:500; color:var(--color-fog); margin-top:6px; text-transform:lowercase;">partner</span>
        </div>

    </div>


    {{-- Recent Users Table --}}
    <div class="dub-table-wrapper">

        {{-- Table Header --}}
        <div class="dub-section-header">
            <div>
                <h3>Pendaftar Terbaru</h3>
                <p>Daftar akun jamaah yang baru mendaftar.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}?section=users"
               class="dub-btn dub-btn-outline" style="font-size:13px;gap:6px;">
                Lihat Semua
                <i class="fas fa-arrow-right" style="font-size:11px;"></i>
            </a>
        </div>

        {{-- Table --}}
        <div style="overflow-x:auto;">
            <table class="dub-table" style="white-space:nowrap;">
                <thead>
                    <tr>
                        <th style="width:52px;">ID</th>
                        <th>Nama &amp; Kontak</th>
                        <th>Tgl Lahir</th>
                        <th>Alamat Domisili</th>
                        <th style="text-align:center;">Status Paspor</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <span class="dub-mono">#{{ $user->id }}</span>
                            </td>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div class="dub-avatar" style="font-size:11px;">
                                        {{ strtoupper(substr($user->fullName, 0, 2)) }}
                                    </div>
                                    <div style="display:flex;flex-direction:column;gap:2px;">
                                        <span style="font-weight:500;color:var(--color-charcoal);font-size:14px;">{{ $user->fullName }}</span>
                                        <span style="font-size:12px;color:var(--color-fog);display:flex;align-items:center;gap:4px;">
                                            <i class="fab fa-whatsapp" style="color:#25d366;"></i>
                                            {{ $user->phone ?? '—' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-size:13px;color:var(--color-steel);">
                                    {{ $user->birthDate ? $user->birthDate->format('d M Y') : '—' }}
                                </span>
                            </td>
                            <td>
                                <span style="font-size:13px;color:var(--color-steel);max-width:200px;display:block;overflow:hidden;text-overflow:ellipsis;" title="{{ $user->address }}">
                                    {{ Str::limit($user->address, 35) ?? '—' }}
                                </span>
                            </td>
                            <td style="text-align:center;">
                                @if($user->hasPassport)
                                    <span class="dub-badge dub-badge-mint">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5L4 7L8 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        Ada
                                    </span>
                                @else
                                    <span class="dub-badge dub-badge-red">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2.5 2.5L7.5 7.5M7.5 2.5L2.5 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                                        Belum
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div style="display:flex;align-items:center;justify-content:center;gap:4px;">
                                    <a href="{{ route('users.show', $user->id) }}"
                                       class="dub-action-btn view"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="dub-action-btn edit"
                                       title="Edit Data">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                          class="inline-block"
                                          onsubmit="return handleDeleteUser(event, '{{ e($user->fullName) }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dub-action-btn delete" title="Hapus Permanen">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="dub-empty">
                                    <div class="dub-empty-icon">
                                        <i class="fas fa-users-slash"></i>
                                    </div>
                                    <p>Belum ada data pendaftar umroh</p>
                                    <span>Data akan muncul di sini setelah jamaah mendaftar.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($recentUsers) && method_exists($recentUsers, 'links'))
            <div class="dub-pagination">
                {{ $recentUsers->links() }}
            </div>
        @endif

    </div>

</div>
