<?php

namespace App\Http\Controllers;

use App\Models\Mutawwif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MutawwifController extends Controller
{
    public function index() {
        return Mutawwif::all();
    }

    public function show($id) {
        return Mutawwif::findOrFail($id);
    }

    public function create() {
        return view('admin.mutawwifs.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'experience' => 'nullable|integer',
            'specialization' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('mutawwifs', 'public');
        }

        Mutawwif::create($validated);
        return redirect()->route('admin.dashboard', ['section' => 'mutawwifs'])->with('success', 'Mutawwif berhasil ditambahkan!');
    }

    public function edit($id) {
        $mutawwif = Mutawwif::findOrFail($id);
        return view('admin.mutawwifs.edit', compact('mutawwif'));
    }

    public function update(Request $request, $id) {
        $mutawwif = Mutawwif::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'experience' => 'nullable|integer',
            'specialization' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($mutawwif->photo_path) {
                Storage::disk('public')->delete($mutawwif->photo_path);
            }
            $validated['photo_path'] = $request->file('photo')->store('mutawwifs', 'public');
        }

        $mutawwif->update($validated);
        return redirect()->route('admin.dashboard', ['section' => 'mutawwifs'])->with('success', 'Mutawwif berhasil diupdate!');
    }

    public function destroy($id) {
        $mutawwif = Mutawwif::findOrFail($id);

        // Delete photo file
        if ($mutawwif->photo_path) {
            Storage::disk('public')->delete($mutawwif->photo_path);
        }

        $mutawwif->delete();
        return redirect()->route('admin.dashboard', ['section' => 'mutawwifs'])->with('success', 'Mutawwif berhasil dihapus!');
    }
}
