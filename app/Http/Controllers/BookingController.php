<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() {
        return Booking::with(['user', 'package'])->get();
    }

    public function show($id) {
        return Booking::with(['user', 'package'])->findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required',
            'package_id' => 'required',
            'status' => 'nullable',
        ]);

        return Booking::create($data);
    }

    public function update(Request $request, $id) {
        $book = Booking::findOrFail($id);
        $book->update($request->all());
        return $book;
    }

    public function destroy($id) {
        return Booking::destroy($id);
    }
}
