<?php

namespace App\Http\Controllers;

use App\Models\Mutawwif;
use Illuminate\Http\Request;

class MutawwifController extends Controller
{
    public function index() {
        return Mutawwif::all();
    }

    public function show($id) {
        return Mutawwif::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'bio' => 'nullable',
            'photo_file' => 'nullable',
        ]);

        return Mutawwif::create($data);
    }

    public function update(Request $request, $id) {
        $m = Mutawwif::findOrFail($id);
        $m->update($request->all());
        return $m;
    }

    public function destroy($id) {
        return Mutawwif::destroy($id);
    }
}
