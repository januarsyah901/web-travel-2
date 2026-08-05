{{-- Packages Section --}}
<div id="packages" class="content-section {{ $section == 'packages' ? '' : 'hidden' }}">

    {{-- Page Header --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:20px;flex-wrap:wrap;">
        <div>
            <h1 style="font-size:20px;font-weight:600;color:var(--color-charcoal);margin:0 0 4px;">Paket Umroh</h1>
            <p style="font-size:14px;color:var(--color-fog);margin:0;">Kelola daftar paket perjalanan ibadah yang tersedia.</p>
        </div>
        <a href="{{ route('packages.create') }}" class="dub-btn dub-btn-primary" style="gap:8px;">
            <i class="fas fa-plus" style="font-size:13px;"></i>
            Tambah Paket Baru
        </a>
    </div>

    {{-- Table Card --}}
    <div class="dub-table-wrapper">
        <div style="overflow-x:auto;">
            <table class="dub-table" style="white-space:nowrap;">
                <thead>
                    <tr>
                        <th style="width:52px;">ID</th>
                        <th>Nama Paket</th>
                        <th>Durasi / Jadwal</th>
                        <th>Harga</th>
                        <th>Hotel</th>
                        <th>Deskripsi Singkat</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $package)
                        <tr>
                            <td><span class="dub-mono">#{{ $package->id }}</span></td>

                            <td>
                                <p style="font-size:14px;font-weight:500;color:var(--color-charcoal);margin:0;">{{ $package->title }}</p>
                            </td>

                            <td>
                                <div style="display:flex;flex-direction:column;gap:4px;">
                                    <span class="dub-badge dub-badge-blue" style="width:fit-content;">
                                        {{ $package->duration }} Hari
                                    </span>
                                    <span style="font-size:12px;color:var(--color-fog);display:flex;align-items:center;gap:4px;">
                                        <i class="far fa-calendar-alt" style="font-size:11px;"></i>
                                        {{ $package->schedule }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <span style="font-size:14px;font-weight:600;color:var(--color-charcoal);">
                                    Rp {{ number_format($package->price, 0, ',', '.') }}
                                </span>
                            </td>

                            <td>
                                <div style="display:flex;flex-direction:column;gap:3px;">
                                    <span style="font-size:12px;color:var(--color-steel);">
                                        <strong style="color:var(--color-charcoal);">Makkah:</strong> {{ $package->hotel_makkah ?: '—' }}
                                    </span>
                                    <span style="font-size:12px;color:var(--color-steel);">
                                        <strong style="color:var(--color-charcoal);">Madinah:</strong> {{ $package->hotel_madinah ?: '—' }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <span style="font-size:13px;color:var(--color-steel);max-width:220px;display:block;overflow:hidden;text-overflow:ellipsis;" title="{{ $package->description }}">
                                    {{ Str::limit($package->description, 50) }}
                                </span>
                            </td>

                            <td>
                                <div style="display:flex;align-items:center;justify-content:center;gap:4px;">
                                    <a href="{{ route('packages.edit', $package->id) }}"
                                       class="dub-action-btn edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form method="POST" action="{{ route('packages.destroy', $package->id) }}"
                                          class="inline-block"
                                          onsubmit="return handleDeletePackage(event, '{{ e($package->name) }}');">
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
                            <td colspan="6">
                                <div class="dub-empty">
                                    <div class="dub-empty-icon"><i class="fas fa-box-open"></i></div>
                                    <p>Belum ada data paket tersedia</p>
                                    <a href="{{ route('packages.create') }}"
                                       style="font-size:13px;color:var(--color-electric-blue);text-decoration:none;font-weight:500;">
                                        Tambah paket pertama →
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
