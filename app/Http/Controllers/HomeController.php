<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class HomeController extends Controller
{
    public function index() {
        $packages = Package::all();
        return $packages;
    }

    public function showRegistrationForm() {
        $packages = Package::all();
        return view('registration', compact('packages'));
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'birthDate' => 'required|date',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'hasPassport' => 'required|boolean',
            'password' => 'required|string|min:6|confirmed',
            'package_id' => 'nullable|exists:packages,id',
        ]);

        $user = \App\Models\User::create([
            'fullName' => $validated['fullName'],
            'birthDate' => $validated['birthDate'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'hasPassport' => $validated['hasPassport'],
            'password' => bcrypt($validated['password']),
        ]);

        // Create booking if package selected
        if ($request->package_id) {
            \App\Models\Booking::create([
                'user_id' => $user->id,
                'package_id' => $request->package_id,
                'status' => 'pending',
                'registered_at' => now(),
            ]);
        }

        // Handle file uploads
        $documentData = ['user_id' => $user->id];

        // KTP
        if ($request->hasFile('ktp')) {
            $documentData['ktp'] = $request->file('ktp')->store('documents/ktp', 'public');
        }

        // KK
        if ($request->hasFile('kk')) {
            $documentData['kk'] = $request->file('kk')->store('documents/kk', 'public');
        }

        // Supporting documents (multiple files)
        if ($request->hasFile('supporting_docs')) {
            $supportingPaths = [];
            foreach ($request->file('supporting_docs') as $file) {
                $supportingPaths[] = $file->store('documents/supporting', 'public');
            }
            $documentData['dokumen_pendukung'] = json_encode($supportingPaths);
        }

        // Create document record
        \App\Models\Document::create($documentData);

        return redirect()->route('registration.success')->with('success', 'Pendaftaran berhasil! Kami akan menghubungi Anda segera.');
    }

    public function registrationSuccess() {
        return view('registration-success');
    }
}
