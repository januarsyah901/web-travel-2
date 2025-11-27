<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Display the contact information (for admin)
    public function index()
    {
        $contact = Contact::active()->first();
        return view('admin.contact.index', compact('contact'));
    }

    // Show form to create contact (admin)
    public function create()
    {
        return view('admin.contact.create');
    }

    // Store new contact (admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'email_2' => 'nullable|email|max:255',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'working_hours' => 'nullable|string',
            'maps_embed' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Contact::create($validated);

        return redirect()->route('admin.contact.index')->with('success', 'Informasi kontak berhasil ditambahkan!');
    }

    // Show form to edit contact (admin)
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contact.edit', compact('contact'));
    }

    // Update contact (admin)
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'email_2' => 'nullable|email|max:255',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'working_hours' => 'nullable|string',
            'maps_embed' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $contact->update($validated);

        return redirect()->route('admin.contact.index')->with('success', 'Informasi kontak berhasil diperbarui!');
    }

    // Delete contact (admin)
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contact.index')->with('success', 'Informasi kontak berhasil dihapus!');
    }

    // Get contact info for homepage (public)
    public function getContactInfo()
    {
        $contact = Contact::getMainContact();
        return response()->json($contact);
    }
}
