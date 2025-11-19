<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index() {
        return Package::all();
    }

    public function show($id) {
        return Package::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'schedule' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'description' => 'nullable',
        ]);

        return Package::create($data);
    }

    public function update(Request $request, $id) {
        $pkg = Package::findOrFail($id);
        $pkg->update($request->all());
        return $pkg;
    }

    public function destroy($id) {
        return Package::destroy($id);
    }
}
