<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Contact;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'galleries' => Gallery::count(),
            'contacts' => Contact::where('is_read', false)->count(), // Pesan belum dibaca
            'testimonials' => Testimonial::count(),
        ];

        $latest_contacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latest_contacts'));
    }
}