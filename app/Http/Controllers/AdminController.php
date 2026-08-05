<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            ActivityLog::record('logout', 'Logout: ' . Auth::guard('admin')->user()->email);
        }

        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function dashboard(Request $request)
    {
        $section = $request->get('section', 'dashboard');
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');

        // Fetch Users with sorting if it's the users section
        $userQuery = \App\Models\User::query()->with(['bookings.package']);
        if ($section === 'users') {
            if ($sort === 'package') {
                $userQuery->leftJoin('bookings', function ($join) {
                        $join->on('users.id', '=', 'bookings.user_id')
                            ->whereRaw('bookings.id = (select max(id) from bookings where bookings.user_id = users.id)');
                    })
                    ->leftJoin('packages', 'bookings.package_id', '=', 'packages.id')
                    ->orderBy('packages.title', $order)
                    ->select('users.*');
            } elseif (in_array($sort, ['created_at', 'hasPassport', 'fullName', 'birthDate'], true)) {
                $userQuery->orderBy($sort, $order);
            } else {
                $userQuery->latest();
            }
        } else {
            $userQuery->latest();
        }
        $users = $userQuery->paginate(10, ['*'], 'users_page')->appends([
            'section' => 'users',
            'sort' => $sort,
            'order' => $order,
        ]);

        // Fetch Bookings with sorting if it's the bookings section
        $bookingQuery = \App\Models\Booking::with('user', 'package');
        if ($section === 'bookings') {
            // Check if sorting by status or date
            if (in_array($sort, ['status', 'registered_at', 'created_at'])) {
                $bookingQuery->orderBy($sort, $order);
            } else {
                $bookingQuery->latest();
            }
        } else {
            $bookingQuery->latest();
        }
        $bookings = $bookingQuery->paginate(10, ['*'], 'bookings_page')->appends(['section' => 'bookings']);

        $packages = \App\Models\Package::all();
        $galleries = \App\Models\Gallery::all();
        $mutawwifs = \App\Models\Mutawwif::all();
        $partners = \App\Models\Partner::all();

        // Calculate counts (use separate query for accurate total)
        $counts = [
            'users' => \App\Models\User::count(),
            'bookings' => $bookings->count(),
            'packages' => $packages->count(),
            'partners' => $partners->count(),
        ];

        return view('admin.dashboard', compact(
            'users',
            'packages',
            'bookings',
            'galleries',
            'mutawwifs',
            'partners',
            'counts',
            'section'
        ));
    }
}
