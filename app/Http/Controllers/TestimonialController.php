<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index() {
        return Testimonial::with('user')->latest()->get();
    }

    public function show($id) {
        return Testimonial::with('user')->findOrFail($id);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create($validated);
        return redirect()->route('admin.dashboard', ['section' => 'testimonials'])->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $testimonial = Testimonial::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $testimonial->update($validated);
        return redirect()->route('admin.dashboard', ['section' => 'testimonials'])->with('success', 'Testimoni berhasil diupdate!');
    }

    public function destroy($id) {
        $testimonial = Testimonial::findOrFail($id);

        $testimonial->delete();
        return redirect()->route('admin.dashboard', ['section' => 'testimonials'])->with('success', 'Testimoni berhasil dihapus!');
    }
}
