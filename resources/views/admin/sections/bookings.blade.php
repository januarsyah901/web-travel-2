{{-- Bookings Section --}}
<div id="bookings" class="content-section {{ $section == 'bookings' ? '' : 'hidden' }}">

    {{-- Page Header --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:20px;flex-wrap:wrap;">
        <div>
            <h1 style="font-size:20px;font-weight:600;color:var(--color-charcoal);margin:0 0 4px;">Data Pelunasan</h1>
            <p style="font-size:14px;color:var(--color-fog);margin:0;">Kelola pendaftaran dan status pelunasan jamaah.</p>
        </div>
        <a href="{{ route('bookings.create') }}" class="dub-btn dub-btn-primary" style="gap:8px;">
            <i class="fas fa-calendar-plus" style="font-size:13px;"></i>
            Tambah Booking
        </a>
    </div>

    {{-- Table Card --}}
    <div class="dub-table-wrapper">
        <div style="overflow-x:auto;">
            <table class="dub-table" style="white-space:nowrap;">
                <thead>
                    <tr>
                        <th style="width:52px;">ID</th>
                        <th>Nama Jamaah</th>
                        <th>Paket Pilihan</th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'registered_at', 'order' => request('order') == 'asc' ? 'desc' : 'asc', 'section' => 'bookings']) }}"
                               style="display:inline-flex;align-items:center;gap:4px;color:inherit;text-decoration:none;">
                                Tgl Daftar
                                @if(request('sort') == 'registered_at' && request('section') == 'bookings')
                                    <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}" style="font-size:10px;color:var(--color-electric-blue);"></i>
                                @elseif(request('sort', 'created_at') == 'created_at' && request('section') == 'bookings')
                                    <i class="fas fa-sort-{{ request('order', 'desc') == 'asc' ? 'up' : 'down' }}" style="font-size:10px;color:var(--color-electric-blue);"></i>
                                @else
                                    <i class="fas fa-sort" style="font-size:10px;color:var(--color-pebble);"></i>
                                @endif
                            </a>
                        </th>
                        <th style="text-align:center;">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'status', 'order' => request('order') == 'asc' ? 'desc' : 'asc', 'section' => 'bookings']) }}"
                               style="display:inline-flex;align-items:center;justify-content:center;gap:4px;color:inherit;text-decoration:none;width:100%;">
                                Status
                                @if(request('sort') == 'status' && request('section') == 'bookings')
                                    <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}" style="font-size:10px;color:var(--color-electric-blue);"></i>
                                @else
                                    <i class="fas fa-sort" style="font-size:10px;color:var(--color-pebble);"></i>
                                @endif
                            </a>
                        </th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td><span class="dub-mono">#{{ $booking->id }}</span></td>

                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div class="dub-avatar">
                                        {{ strtoupper(substr($booking->user->fullName ?? 'G', 0, 2)) }}
                                    </div>
                                    <div>
                                        <p style="font-size:14px;font-weight:500;color:var(--color-charcoal);margin:0 0 2px;">{{ $booking->user->fullName ?? 'Guest' }}</p>
                                        <p style="font-size:12px;color:var(--color-fog);margin:0;">{{ $booking->user->phone ?? '—' }}</p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span style="font-size:13px;color:var(--color-steel);">{{ $booking->package->title ?? 'Paket Dihapus' }}</span>
                            </td>

                            <td>
                                <span style="font-size:13px;color:var(--color-steel);">
                                    {{ $booking->registered_at ? $booking->registered_at->format('d M Y') : '—' }}
                                </span>
                            </td>

                            <td style="text-align:center;">
                                @php
                                    $statusBadge = [
                                        'pending'   => 'dub-badge-orange',
                                        'confirmed' => 'dub-badge-mint',
                                        'cancelled' => 'dub-badge-red',
                                    ][$booking->status] ?? 'dub-badge-neutral';
                                    $statusLabel = [
                                        'pending'   => 'Pending',
                                        'confirmed' => 'Confirmed',
                                        'cancelled' => 'Cancelled',
                                    ][$booking->status] ?? ucfirst($booking->status);
                                @endphp
                                <span class="dub-badge {{ $statusBadge }}">{{ $statusLabel }}</span>
                            </td>

                            <td>
                                <div style="display:flex;align-items:center;justify-content:center;gap:4px;">
                                    <a href="{{ route('bookings.edit', $booking->id) }}"
                                       class="dub-action-btn edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}"
                                          class="inline-block"
                                          onsubmit="return handleDeleteBooking(event, '{{ e($booking->user->fullName ?? 'Booking') }}');">
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
                                    <div class="dub-empty-icon"><i class="far fa-calendar-times"></i></div>
                                    <p>Belum ada booking masuk</p>
                                    <span>Booking jamaah akan tampil di sini.</span>
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
                <strong style="color:var(--color-charcoal);">{{ $bookings->firstItem() ?? 0 }}</strong>
                –
                <strong style="color:var(--color-charcoal);">{{ $bookings->lastItem() ?? 0 }}</strong>
                dari
                <strong style="color:var(--color-charcoal);">{{ $bookings->total() }}</strong>
                booking
            </span>
            <div>
                {{ $bookings->appends(['section' => 'bookings', 'sort' => request('sort'), 'order' => request('order')])->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>

</div>
