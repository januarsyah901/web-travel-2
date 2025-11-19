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
        $users = \App\Models\User::all();
        $data = collect();
        $resource = null;
        $fields = [];

        if ($section) {
            switch ($section) {
                case 'packages':
                    $data = \App\Models\Package::all();
                    $resource = 'packages';
                    $fields = ['id', 'title', 'schedule', 'duration', 'price', 'description'];
                    break;
                case 'bookings':
                    $data = \App\Models\Booking::with('user', 'package')->get();
                    $resource = 'bookings';
                    $fields = ['id', 'user.fullName', 'package.title', 'status', 'registered_at'];
                    break;
                case 'galleries':
                    $data = \App\Models\Gallery::all();
                    $resource = 'galleries';
                    $fields = ['id', 'title', 'description', 'image_path'];
                    break;
                case 'mutawwifs':
                    $data = \App\Models\Mutawwif::all();
                    $resource = 'mutawwifs';
                    $fields = ['id', 'name', 'description', 'photo_path'];
                    break;
                case 'partners':
                    $data = \App\Models\Partner::all();
                    $resource = 'partners';
                    $fields = ['id', 'name', 'logo_path'];
                    break;
                case 'testimonials':
                    $data = \App\Models\Testimonial::with('user')->get();
                    $resource = 'testimonials';
                    $fields = ['id', 'user.fullName', 'content', 'rating'];
                    break;
            }
        }

        return view('admin.dashboard', compact('users', 'data', 'resource', 'fields', 'section'));
    }
}
