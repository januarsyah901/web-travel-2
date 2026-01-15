<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }

    public function dashboard(Request $request)
    {
        $section = $request->get('section', 'dashboard');
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');

        // Fetch Users with sorting if it's the users section
        $userQuery = \App\Models\User::query();
        if ($section === 'users') {
            $userQuery->orderBy($sort, $order);
        } else {
            $userQuery->latest();
        }
        $users = $userQuery->paginate(10, ['*'], 'users_page')->appends(['section' => 'users']);

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
        $testimonials = \App\Models\Testimonial::with('user')->get();

        // Calculate counts (use separate query for accurate total)
        $counts = [
            'users' => \App\Models\User::count(),
            'bookings' => $bookings->count(),
            'packages' => $packages->count(),
            'partners' => $partners->count(),
            'testimonials' => $testimonials->count(),
        ];

        return view('admin.dashboard', compact(
            'users',
            'packages',
            'bookings',
            'galleries',
            'mutawwifs',
            'partners',
            'testimonials',
            'counts',
            'section'
        ));
    }
}
