<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index() {
        return Gallery::all();
    }

    public function show($id) {
        return Gallery::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'file_path' => 'required',
            'category' => 'nullable',
        ]);

        return Gallery::create($data);
    }

    public function update(Request $request, $id) {
        $g = Gallery::findOrFail($id);
        $g->update($request->all());
        return $g;
    }

    public function destroy($id) {
        return Gallery::destroy($id);
    }
}
