<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::where('is_published', true)->latest('published_at');

        // Filter berdasarkan kategori jika ada parameter ?category=slug
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $articles = $query->paginate(8); // Tampilkan 8 berita per halaman
        $categories = Category::all();

        return view('news.index', compact('articles', 'categories'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
                          ->where('is_published', true)
                          ->firstOrFail();

        // Ambil berita terkait (kategori sama, selain berita ini)
        $relatedArticles = Article::where('category_id', $article->category_id)
                                  ->where('id', '!=', $article->id)
                                  ->take(3)
                                  ->get();

        return view('news.show', compact('article', 'relatedArticles'));
    }
}