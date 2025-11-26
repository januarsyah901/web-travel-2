<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index() {
        return Package::all();
    }

    public function show($id) {
        return Package::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'schedule' => 'required',
            'duration' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        try {
            return Package::create($data);
        } catch (\Illuminate\Database\QueryException $e) {
            $sqlState = $e->getCode();
            $driverErrorCode = $e->errorInfo[1] ?? null;

            if ($sqlState === '22003' || $driverErrorCode == 1264) {
                return redirect()->to(route('admin.dashboard') . '?section=packages')
                    ->with('error','Price value out of range');
            }

            return redirect()->to(route('admin.dashboard') . '?section=packages')
                ->with('error','Database error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id) {
        $pkg = Package::findOrFail($id);
        $pkg->update($request->all());
        return $pkg;
    }

    public function destroy($id) {
        Package::destroy($id);
        return redirect()->to(route('admin.dashboard') . '?section=packages')
            ->with('success', 'Package berhasil dihapus!');
    }
}
