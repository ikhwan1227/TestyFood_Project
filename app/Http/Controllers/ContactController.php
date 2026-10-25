<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($validated);

        // Log ke notifikasi sistem
        NotificationService::log(
            'contact_received',
            'Pesan Kontak Baru',
            'Dari: ' . $contact->name . ' (' . $contact->email . ') — ' . $contact->subject,
            null,
            route('admin.notifications.index')
        );

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim!');
    }
}