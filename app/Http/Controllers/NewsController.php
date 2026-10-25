<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil 1 artikel terbaru untuk Section Utama (Featured)
        $latestArticle = Article::with('category')
            ->where('is_published', true)
            ->latest('published_at')
            ->first();

        // 2. Ambil artikel untuk daftar di bawahnya (kecuali artikel utama)
        $query = Article::with('category')
            ->where('is_published', true)
            ->when($latestArticle, function ($q) use ($latestArticle) {
                return $q->where('id', '!=', $latestArticle->id); // Hindari duplikasi
            })
            ->latest('published_at');

        // Filter berdasarkan kategori (jika ada)
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $articles = $query->paginate(8);

        // Cache kategori
        $categories = Cache::remember('all_categories', 3600, function () {
            return Category::orderBy('name')->get();
        });

        return view('news.index', compact('articles', 'categories', 'latestArticle'));
    }

    public function show($slug)
    {
        $article = Article::with('category')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $relatedArticles = Article::with('category')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('news.show', compact('article', 'relatedArticles'));
    }
}