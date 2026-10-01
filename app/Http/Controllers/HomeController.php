<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Gallery;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 4 berita terbaru yang sudah dipublish
        $articles = Article::where('is_published', true)
                            ->latest('published_at')
                            ->take(4)
                            ->get();

        // Ambil 6 foto galeri terbaru
        $galleries = Gallery::latest()->take(6)->get();

        // Ambil testimoni yang aktif
        $testimonials = Testimonial::where('is_active', true)->get();

        return view('home', compact('articles', 'galleries', 'testimonials'));
    }
}