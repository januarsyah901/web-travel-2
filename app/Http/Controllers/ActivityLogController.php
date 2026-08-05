<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::query()->latest();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('admin_email', 'like', "%{$search}%")
                    ->orWhere('admin_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('action', 'like', "%{$search}%");
            });
        }

        if ($action = $request->get('action')) {
            $query->where('action', $action);
        }

        $logs = $query->paginate(20)->withQueryString();

        return view('admin.activity-logs.index', compact('logs'));
    }
}
