<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index() {
        return Testimonial::with('user')->latest()->get();
    }

    public function show($id) {
        return Testimonial::with('user')->findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        return Testimonial::create($data);
    }

    public function update(Request $request, $id) {
        $testimonial = Testimonial::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'content' => 'sometimes|required|string',
            'rating' => 'sometimes|required|integer|min:1|max:5',
        ]);

        $testimonial->update($data);
        return $testimonial;
    }

    public function destroy($id) {
        return Testimonial::destroy($id);
    }
}
