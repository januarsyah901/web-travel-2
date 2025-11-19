<?php

namespace App\Http\Controllers;

use App\Models\Passport;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function index() {
        return Passport::with('photos')->get();
    }

    public function show($id) {
        return Passport::with('photos')->findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required',
            'passportName' => 'nullable',
        ]);

        return Passport::create($data);
    }

    public function update(Request $request, $id) {
        $passport = Passport::findOrFail($id);
        $passport->update($request->all());
        return $passport;
    }

    public function destroy($id) {
        return Passport::destroy($id);
    }
}
