{{-- Users Section --}}
<div id="users" class="content-section {{ $section == 'users' ? '' : 'hidden' }}">

    {{-- Page Header --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:20px;flex-wrap:wrap;">
        <div>
            <h1 style="font-size:20px;font-weight:600;color:var(--color-charcoal);margin:0 0 4px;">Data Pendaftar</h1>
            <p style="font-size:14px;color:var(--color-fog);margin:0;">Database lengkap calon jamaah umroh yang terdaftar.</p>
        </div>
        {{-- Search --}}
        <div style="position:relative;width:240px;flex-shrink:0;">
            <span style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--color-silver);pointer-events:none;">
                <i class="fas fa-search" style="font-size:13px;"></i>
            </span>
            <input type="text"
                   id="searchInput"
                   placeholder="Cari nama jamaah..."
                   class="dub-input"
                   style="padding-left:32px;"
                   autocomplete="off">
            <div id="searchLoader" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);display:none;">
                <svg class="animate-spin" width="14" height="14" viewBox="0 0 24 24" fill="none" style="color:var(--color-electric-blue);">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-opacity="0.25" stroke-width="4"/>
                    <path fill="currentColor" fill-opacity="0.75" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="dub-table-wrapper">
        <div style="overflow-x:auto;">
            <table class="dub-table" style="white-space:nowrap;">
                <thead>
                    <tr>
                        <th style="text-align:center;width:52px;">ID</th>
                        <th>Nama &amp; Kontak</th>
                        <th style="text-align:center;">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'package', 'order' => request('order') == 'asc' ? 'desc' : 'asc', 'section' => 'users']) }}"
                               style="display:inline-flex;align-items:center;gap:4px;color:inherit;text-decoration:none;">
                                Paket
                                @if(request('sort') == 'package' && request('section') == 'users')
                                    <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}" style="font-size:10px;color:var(--color-electric-blue);"></i>
                                @else
                                    <i class="fas fa-sort" style="font-size:10px;color:var(--color-pebble);"></i>
                                @endif
                            </a>
                        </th>
                        <th>Tgl Lahir</th>
                        <th>Alamat Domisili</th>
                        <th style="text-align:center;">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'order' => request('order') == 'asc' ? 'desc' : 'asc', 'section' => 'users']) }}"
                               style="display:inline-flex;align-items:center;gap:4px;color:inherit;text-decoration:none;">
                                Tgl Daftar
                                @if(request('sort', 'created_at') == 'created_at' && request('section', 'users') == 'users')
                                    <i class="fas fa-sort-{{ request('order', 'desc') == 'asc' ? 'up' : 'down' }}" style="font-size:10px;color:var(--color-electric-blue);"></i>
                                @else
                                    <i class="fas fa-sort" style="font-size:10px;color:var(--color-pebble);"></i>
                                @endif
                            </a>
                        </th>
                        <th style="text-align:center;">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'hasPassport', 'order' => request('order') == 'asc' ? 'desc' : 'asc', 'section' => 'users']) }}"
                               style="display:inline-flex;align-items:center;gap:4px;color:inherit;text-decoration:none;">
                                Status Paspor
                                @if(request('sort') == 'hasPassport' && request('section') == 'users')
                                    <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}" style="font-size:10px;color:var(--color-electric-blue);"></i>
                                @else
                                    <i class="fas fa-sort" style="font-size:10px;color:var(--color-pebble);"></i>
                                @endif
                            </a>
                        </th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                    @forelse($users as $user)
                        <tr>
                            <td style="text-align:center;">
                                <span class="dub-mono">#{{ $user->id }}</span>
                            </td>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div class="dub-avatar">
                                        {{ strtoupper(substr($user->fullName, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p style="font-size:14px;font-weight:500;color:var(--color-charcoal);margin:0 0 2px;">{{ $user->fullName }}</p>
                                        <p style="font-size:12px;color:var(--color-fog);margin:0;display:flex;align-items:center;gap:4px;">
                                            <i class="fab fa-whatsapp" style="color:#25d366;"></i>
                                            {{ $user->phone ?? '—' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @php $pkg = $user->bookings->sortByDesc('id')->first()?->package; @endphp
                                @if($pkg)
                                    <span style="font-size:13px;font-weight:500;color:var(--color-charcoal);">{{ $pkg->title }}</span>
                                @else
                                    <span style="font-size:12px;color:var(--color-fog);">—</span>
                                @endif
                            </td>
                            <td>
                                <span style="font-size:13px;color:var(--color-steel);">
                                    {{ $user->birthDate ? $user->birthDate->format('d M Y') : '—' }}
                                </span>
                            </td>
                            <td>
                                <span style="font-size:13px;color:var(--color-steel);max-width:180px;display:block;overflow:hidden;text-overflow:ellipsis;" title="{{ $user->address }}">
                                    {{ Str::limit($user->address, 30) ?? '—' }}
                                </span>
                            </td>
                            <td style="text-align:center;">
                                <span style="font-size:12px;color:var(--color-fog);font-family:var(--font-mono);">
                                    {{ $user->created_at ? $user->created_at->format('d/m/Y') : '—' }}
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
                                       class="dub-action-btn view" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="dub-action-btn edit" title="Edit Data">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                          class="inline-block"
                                          onsubmit="return handleDeleteUser(event, '{{ addslashes($user->fullName) }}');">
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
                            <td colspan="8">
                                <div class="dub-empty">
                                    <div class="dub-empty-icon"><i class="fas fa-users-slash"></i></div>
                                    <p>Belum ada data pendaftar umroh</p>
                                    <span>Data akan muncul di sini setelah jamaah mendaftar.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="dub-pagination">
            <span style="font-size:13px;">
                Menampilkan
                <strong style="color:var(--color-charcoal);">{{ $users->firstItem() ?? 0 }}</strong>
                –
                <strong style="color:var(--color-charcoal);">{{ $users->lastItem() ?? 0 }}</strong>
                dari
                <strong style="color:var(--color-charcoal);">{{ $users->total() }}</strong>
                pendaftar
            </span>
            <div>
                {{ $users->appends(['section' => 'users', 'sort' => request('sort'), 'order' => request('order')])->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>

</div>
