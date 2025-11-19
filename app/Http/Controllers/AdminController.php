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
        $section = $request->get('section');

        // Fetch all data for dashboard
        $users = \App\Models\User::all();
        $packages = \App\Models\Package::all();
        $bookings = \App\Models\Booking::with('user', 'package')->get();
        $galleries = \App\Models\Gallery::all();
        $mutawwifs = \App\Models\Mutawwif::all();
        $partners = \App\Models\Partner::all();
        $testimonials = \App\Models\Testimonial::with('user')->get();

        // Calculate counts
        $counts = [
            'users' => $users->count(),
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
