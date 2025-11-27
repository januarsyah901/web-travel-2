<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index() {
        $packages = Package::all();
        $contact = Contact::getMainContact();
        return view('home', compact('packages', 'contact'));
    }

    public function showRegistrationForm() {
        $packages = Package::all();
        return view('registration', compact('packages'));
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'birthPlace' => 'required|string|max:255',
            'birthDate' => 'required|date',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'hasPassport' => 'required|boolean',
            'package_id' => 'required|exists:packages,id',
            'ktp' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'kk' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'supporting_docs' => 'required|array',
            'supporting_docs.*' => 'file|mimes:jpeg,jpg,png,pdf|max:2048',
            'pas_foto' => 'nullable|file|mimes:jpeg,jpg,png|max:2048',
            'passportName' => 'nullable|string|max:255',
            'passportStatus' => 'nullable|in:valid,expired',
            'passportPhoto' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:2048',
        ]);

        $user = \App\Models\User::create([
            'fullName' => $validated['fullName'],
            'birthDate' => $validated['birthDate'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'hasPassport' => $validated['hasPassport'],
//            'password' => bcrypt('password123'), // Default password
        ]);

        // Create booking
        \App\Models\Booking::create([
            'user_id' => $user->id,
            'package_id' => $validated['package_id'],
            'status' => 'pending',
            'registered_at' => now(),
        ]);

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

        // Supporting documents (Akte/Buku Nikah/Ijazah)
        if ($request->hasFile('supporting_docs')) {
            $supportingPaths = [];
            foreach ($request->file('supporting_docs') as $file) {
                $supportingPaths[] = $file->store('documents/supporting', 'public');
            }
            $documentData['dokumen_pendukung'] = json_encode($supportingPaths);
        }

        // Create document record
        \App\Models\Document::create($documentData);

        // Create passport record first (required for passport_photos)
        $passport = \App\Models\Passport::create([
            'user_id' => $user->id,
            'passportName' => $request->passportName ?? $validated['fullName'],
            'isActive' => $validated['hasPassport'],
        ]);

        // Handle passport photos (pas foto and passport photo)
        // Pas foto background putih
        if ($request->hasFile('pas_foto')) {
            \App\Models\PassportPhoto::create([
                'passport_id' => $passport->id,
                'file_path' => $request->file('pas_foto')->store('passport_photos/pas_foto', 'public'),
            ]);
        }

        // Upload passport photo if provided
        if ($request->hasFile('passportPhoto')) {
            \App\Models\PassportPhoto::create([
                'passport_id' => $passport->id,
                'file_path' => $request->file('passportPhoto')->store('passport_photos/passport', 'public'),
            ]);
        }

        return redirect()->route('home')->with('success', 'Pendaftaran berhasil! Kami akan menghubungi Anda segera.');
    }

    public function registrationSuccess() {
        return view('registration-success');
    }
}
