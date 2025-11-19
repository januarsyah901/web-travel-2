<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index() {
        return Testimonial::with('user')->get();
    }

    public function show($id) {
        return Testimonial::with('user')->findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required',
            'package_id' => 'nullable',
            'message' => 'required',
            'rating' => 'nullable|integer',
        ]);

        return Testimonial::create($data);
    }

    public function update(Request $request, $id) {
        $t = Testimonial::findOrFail($id);
        $t->update($request->all());
        return $t;
    }

    public function destroy($id) {
        return Testimonial::destroy($id);
    }
}
