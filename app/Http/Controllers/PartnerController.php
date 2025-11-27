<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index() {
        return Partner::all();
    }

    public function show($id) {
        return Partner::findOrFail($id);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('partners', 'public');
        }

        Partner::create($validated);
        return redirect()->route('admin.dashboard', ['section' => 'partners'])->with('success', 'Partner berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $partner = Partner::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($partner->logo_path) {
                Storage::disk('public')->delete($partner->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($validated);
        return redirect()->route('admin.dashboard', ['section' => 'partners'])->with('success', 'Partner berhasil diupdate!');
    }

    public function destroy($id) {
        $partner = Partner::findOrFail($id);

        // Delete logo file
        if ($partner->logo_path) {
            Storage::disk('public')->delete($partner->logo_path);
        }

        $partner->delete();
        return redirect()->route('admin.dashboard', ['section' => 'partners'])->with('success', 'Partner berhasil dihapus!');
    }
}
