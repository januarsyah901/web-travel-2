<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Package;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() {
        return Booking::with(['user', 'package'])->get();
    }

    public function show($id) {
        return Booking::with(['user', 'package'])->findOrFail($id);
    }

    public function edit($id) {
        $booking = Booking::findOrFail($id);
        $users = User::all();
        $packages = Package::all();
        return view('admin.bookings.edit', compact('booking', 'users', 'packages'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'required|exists:packages,id',
            'status' => 'nullable|string',
            'registered_at' => 'nullable|date',
        ]);

        Booking::create($data);
        return redirect()->route('admin.dashboard', ['section' => 'bookings'])->with('success', 'Booking created successfully');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'required|exists:packages,id',
            'status' => 'nullable|string',
            'registered_at' => 'nullable|date',
        ]);

        $book = Booking::findOrFail($id);
        $book->update($request->only(['user_id', 'package_id', 'status', 'registered_at']));
        return redirect()->route('admin.dashboard', ['section' => 'bookings'])->with('success', 'Booking updated successfully');
    }

    public function destroy($id) {
        Booking::destroy($id);
        return redirect()->route('admin.dashboard', ['section' => 'bookings'])->with('success', 'Booking deleted successfully');
    }
}
