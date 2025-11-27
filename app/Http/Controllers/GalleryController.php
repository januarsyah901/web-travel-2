<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index() {
        return Gallery::all();
    }

    public function show($id) {
        return Gallery::findOrFail($id);
    }

    public function create() {
        return view('admin.galleries.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('galleries', 'public');
        }

        Gallery::create($validated);
        return redirect()->route('admin.dashboard', ['section' => 'galleries'])->with('success', 'Foto berhasil ditambahkan!');
    }

    public function edit($id) {
        $gallery = Gallery::findOrFail($id);
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, $id) {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update($validated);
        return redirect()->route('admin.dashboard', ['section' => 'galleries'])->with('success', 'Foto berhasil diupdate!');
    }

    public function destroy($id) {
        $gallery = Gallery::findOrFail($id);

        // Delete image file
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();
        return redirect()->route('admin.dashboard', ['section' => 'galleries'])->with('success', 'Foto berhasil dihapus!');
    }
}
