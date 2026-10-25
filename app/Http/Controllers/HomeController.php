<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Gallery;
use App\Models\About;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
            ->where('is_published', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        $galleries = Gallery::latest()->take(6)->get();
        $about = About::getInstance();

        return view('home', compact('articles', 'galleries', 'about'));
    }
}