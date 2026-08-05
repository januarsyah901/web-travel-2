@extends('admin.layouts.app')

@section('title', 'Activity Logs - Admin Panel')
@section('page-title', 'Activity Logs')

@section('content')
<div style="margin-bottom:20px;">
    <h1 style="font-size:20px;font-weight:600;color:var(--color-charcoal);margin:0 0 4px;">Activity Logs</h1>
    <p style="font-size:14px;color:var(--color-fog);margin:0;">Riwayat aksi admin — read only.</p>
</div>

<form method="GET" action="{{ route('activity-logs.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:16px;align-items:center;">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari email / deskripsi..."
           class="dub-input" style="max-width:260px;">
    <select name="action" class="dub-input" style="max-width:160px;">
        <option value="">Semua aksi</option>
        @foreach (['login','logout','created','updated','deleted'] as $act)
            <option value="{{ $act }}" @selected(request('action') === $act)>{{ ucfirst($act) }}</option>
        @endforeach
    </select>
    <button type="submit" class="dub-btn" style="padding:8px 16px;background:var(--color-electric-blue);color:#fff;border-radius:8px;border:none;cursor:pointer;font-size:13px;font-weight:600;">
        Filter
    </button>
    @if(request()->hasAny(['q','action']))
        <a href="{{ route('activity-logs.index') }}" style="font-size:13px;color:var(--color-fog);">Reset</a>
    @endif
</form>

<div class="dub-table-wrapper">
    <div style="overflow-x:auto;">
        <table class="dub-table" style="white-space:nowrap;">
            <thead>
                <tr>
                    <th style="width:52px;text-align:center;">#</th>
                    <th>Waktu</th>
                    <th>Admin</th>
                    <th>Aksi</th>
                    <th>Deskripsi</th>
                    <th>IP</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td style="text-align:center;color:var(--color-fog);">{{ $log->id }}</td>
                        <td>
                            <div style="font-size:13px;font-weight:500;">{{ $log->created_at->format('d M Y') }}</div>
                            <div style="font-size:12px;color:var(--color-fog);">{{ $log->created_at->format('H:i:s') }}</div>
                        </td>
                        <td>
                            <div style="font-size:13px;font-weight:500;">{{ $log->admin_name ?? '—' }}</div>
                            <div style="font-size:12px;color:var(--color-fog);">{{ $log->admin_email ?? '—' }}</div>
                        </td>
                        <td>
                            @php
                                $colors = [
                                    'login' => '#16a34a',
                                    'logout' => '#6b7280',
                                    'created' => '#2563eb',
                                    'updated' => '#d97706',
                                    'deleted' => '#dc2626',
                                ];
                                $c = $colors[$log->action] ?? '#6b7280';
                            @endphp
                            <span style="display:inline-block;padding:2px 8px;border-radius:999px;font-size:11px;font-weight:600;background:{{ $c }}18;color:{{ $c }};">
                                {{ strtoupper($log->action) }}
                            </span>
                        </td>
                        <td style="white-space:normal;max-width:360px;font-size:13px;">{{ $log->description }}</td>
                        <td style="font-size:12px;color:var(--color-fog);font-family:monospace;">{{ $log->ip_address ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:40px;color:var(--color-fog);">
                            Belum ada log aktivitas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($logs->hasPages())
    <div style="margin-top:16px;">
        {{ $logs->links() }}
    </div>
@endif
@endsection
