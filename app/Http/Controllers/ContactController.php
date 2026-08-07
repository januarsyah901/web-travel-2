<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Display the contact information (for admin)
    public function index()
    {
        $contact = Contact::first();
        
        // Auto-create if doesn't exist
        if (!$contact) {
            $contact = Contact::create([
                'company_name' => 'Nama Perusahaan',
                'phone' => Contact::OFFICE_PHONE,
                'whatsapp' => '6282133087492',
                'is_active' => true,
            ]);
        }
        
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
            'whatsapp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'email_2' => 'nullable|email|max:255',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'pinterest' => 'nullable|url',
            'telegram' => 'nullable|url',
            'working_hours' => 'nullable|string',
            'maps_embed' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['phone'] = Contact::OFFICE_PHONE;

        // Normalize maps_embed if provided
        if (!empty($validated['maps_embed'])) {
            $validated['maps_embed'] = strip_tags($validated['maps_embed'], '<iframe>');
            $validated['maps_embed'] = $this->normalizeIframeAttributes($validated['maps_embed']);
        }

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
            'company_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'whatsapp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'email_2' => 'nullable|email|max:255',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'pinterest' => 'nullable|url',
            'telegram' => 'nullable|url',
            'working_hours' => 'nullable|string',
            'maps_embed' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['phone'] = Contact::OFFICE_PHONE;

        // Sanitize maps_embed if provided
        if (!empty($validated['maps_embed'])) {
            // Remove any potentially harmful scripts but keep iframe
            $validated['maps_embed'] = strip_tags($validated['maps_embed'], '<iframe>');
            
            // Normalize iframe attributes
            $validated['maps_embed'] = $this->normalizeIframeAttributes($validated['maps_embed']);
        }

        $contact->update($validated);

        return redirect()->route('contact.index')->with('success', 'Informasi kontak berhasil diperbarui!');
    }

    // Normalize iframe attributes for Google Maps embed
    private function normalizeIframeAttributes($embedCode)
    {
        // Extract src attribute value
        if (!preg_match('/src=["\']([^"\']+)["\']/', $embedCode, $srcMatches)) {
            return $embedCode;
        }
        
        $src = $srcMatches[1];
        
        // Create normalized iframe with required attributes
        $normalized = sprintf(
            '<iframe src="%s" width="100%%" height="100%%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            htmlspecialchars($src, ENT_QUOTES, 'UTF-8')
        );
        
        return $normalized;
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
