<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index() {
        return Partner::all();
    }

    public function show($id) {
        return Partner::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'logo_file' => 'nullable'
        ]);

        return Partner::create($data);
    }

    public function update(Request $request, $id) {
        $p = Partner::findOrFail($id);
        $p->update($request->all());
        return $p;
    }

    public function destroy($id) {
        return Partner::destroy($id);
    }
}
