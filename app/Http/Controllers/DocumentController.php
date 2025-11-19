<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index() {
        return Document::all();
    }

    public function show($id) {
        return Document::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required',
            'type' => 'required',
            'file_path' => 'required',
        ]);

        return Document::create($data);
    }

    public function update(Request $request, $id) {
        $doc = Document::findOrFail($id);
        $doc->update($request->all());
        return $doc;
    }

    public function destroy($id) {
        return Document::destroy($id);
    }
}
