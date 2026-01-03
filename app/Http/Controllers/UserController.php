<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.dashboard', [
            'users' => $users,
            'section' => 'users',
            'counts' => [
                'users' => User::count(),
                'bookings' => \App\Models\Booking::count(),
                'packages' => \App\Models\Package::count(),
                'partners' => \App\Models\Partner::count(),
            ]
        ]);
    }

    public function search(Request $request) {
        $search = $request->get('search', '');

        $users = User::when($search, function($query) use ($search) {
            return $query->where('fullName', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%');
        })->get();

        return response()->json([
            'users' => $users->map(function($user) {
                return [
                    'id' => $user->id,
                    'fullName' => $user->fullName,
                    'phone' => $user->phone ?? '-',
                    'birthDate' => $user->birthDate ? $user->birthDate->format('d M Y') : 'N/A',
                    'address' => $user->address,
                    'hasPassport' => $user->hasPassport,
                ];
            })
        ]);
    }

    public function show($id) {
        $user = User::with(['bookings.package', 'documents', 'passport.passportPhotos'])->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'fullName' => 'required',
            'birthDate' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'hasPassport' => 'boolean',
        ]);

        User::create($data);

        return redirect()->to(route('home') . '?section=users')
            ->with('success', 'Pendaftar baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'fullName' => 'required|string|max:255',
            'birthDate' => 'required|date',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'hasPassport' => 'boolean',
            'email' => 'nullable|email|unique:users,email,' . $id,
        ]);

        $user->update($data);

        return redirect()->route('users.show', $id)
            ->with('success', 'Data pendaftar berhasil diperbarui!');
    }

    public function destroy($id) {
        User::destroy($id);
        return redirect()->to(route('admin.dashboard') . '?section=users')
            ->with('success', 'Pendaftar berhasil dihapus!');
    }
}
