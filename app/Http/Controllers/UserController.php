<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return User::all();
    }

    public function show($id) {
        return User::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'fullName' => 'required',
            'birthDate' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'hasPassport' => 'boolean',
        ]);

        return User::create($data);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $user;
    }

    public function destroy($id) {
        return User::destroy($id);
    }
}
