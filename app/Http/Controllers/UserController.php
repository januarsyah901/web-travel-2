<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class UserController extends Controller
{
    public function index(Request $request) {
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        $users = User::orderBy($sort, $order)->paginate(10);
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
                    'createdAt' => $user->created_at ? $user->created_at->format('d/m/Y H:i') : '-',
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

    public function downloadDocuments($id)
    {
        $user = User::with(['documents', 'passport.passportPhotos'])->findOrFail($id);

        $files = [];

        if ($user->documents) {
            if ($user->documents->ktp) {
                $files[] = ['path' => $user->documents->ktp, 'name' => 'KTP_' . basename($user->documents->ktp)];
            }
            if ($user->documents->kk) {
                $files[] = ['path' => $user->documents->kk, 'name' => 'KK_' . basename($user->documents->kk)];
            }
            if ($user->documents->dokumen_pendukung) {
                $pendukung = json_decode($user->documents->dokumen_pendukung, true);
                if (is_array($pendukung)) {
                    foreach ($pendukung as $i => $path) {
                        $files[] = ['path' => $path, 'name' => 'Dokumen_Pendukung_' . ($i + 1) . '_' . basename($path)];
                    }
                }
            }
        }

        if ($user->passport && $user->passport->passportPhotos) {
            foreach ($user->passport->passportPhotos as $i => $photo) {
                if ($photo->file_path) {
                    $files[] = [
                        'path' => $photo->file_path,
                        'name' => 'Paspor_Foto_' . ($i + 1) . '_' . basename($photo->file_path),
                    ];
                }
            }
        }

        $existing = array_values(array_filter($files, fn ($f) => Storage::disk('public')->exists($f['path'])));

        if (empty($existing)) {
            return back()->with('error', 'Tidak ada dokumen yang bisa diunduh.');
        }

        $safeName = Str::upper(Str::slug($user->fullName, '_')) ?: 'JAMAAH';
        $zipName = $safeName . '.zip';
        $tmpPath = storage_path('app/tmp/' . uniqid('docs_', true) . '.zip');

        if (!is_dir(dirname($tmpPath))) {
            mkdir(dirname($tmpPath), 0755, true);
        }

        $zip = new ZipArchive();
        if ($zip->open($tmpPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return back()->with('error', 'Gagal membuat file ZIP.');
        }

        foreach ($existing as $file) {
            $zip->addFile(Storage::disk('public')->path($file['path']), $file['name']);
        }
        $zip->close();

        return response()->download($tmpPath, $zipName)->deleteFileAfterSend(true);
    }
}
