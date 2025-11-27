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
            'city' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        Testimonial::create($validated);
        return redirect()->route('admin.dashboard', ['section' => 'testimonials'])->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $testimonial = Testimonial::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($testimonial->photo) {
                Storage::disk('public')->delete($testimonial->photo);
            }
            $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $testimonial->update($validated);
        return redirect()->route('admin.dashboard', ['section' => 'testimonials'])->with('success', 'Testimoni berhasil diupdate!');
    }

    public function destroy($id) {
        $testimonial = Testimonial::findOrFail($id);

        // Delete photo file
        if ($testimonial->photo) {
            Storage::disk('public')->delete($testimonial->photo);
        }

        $testimonial->delete();
        return redirect()->route('admin.dashboard', ['section' => 'testimonials'])->with('success', 'Testimoni berhasil dihapus!');
    }
}
