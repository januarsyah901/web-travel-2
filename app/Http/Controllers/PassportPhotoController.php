<?php

namespace App\Http\Controllers;

use App\Models\PassportPhoto;
use Illuminate\Http\Request;

class PassportPhotoController extends Controller
{
    public function index() {
        return PassportPhoto::all();
    }

    public function show($id) {
        return PassportPhoto::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'passport_id' => 'required',
            'file_path' => 'required',
        ]);

        return PassportPhoto::create($data);
    }

    public function update(Request $request, $id) {
        $photo = PassportPhoto::findOrFail($id);
        $photo->update($request->all());
        return $photo;
    }

    public function destroy($id) {
        return PassportPhoto::destroy($id);
    }
}
