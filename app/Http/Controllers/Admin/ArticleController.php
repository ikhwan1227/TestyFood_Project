<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'user'])->latest();

        // Search by title
        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('published_at', $request->date);
        }

        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $articles = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp,avif|max:2048',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'is_published' => 'boolean',
        ]);

        $data = $request->all();

        // Sanitasi HTML
        $data['title'] = $this->purifyHtml($request->input('title'));
        $data['excerpt'] = $this->purifyHtml($request->input('excerpt'));
        $data['content'] = $this->purifyHtml($request->input('content'));

        $plainTitle = strip_tags($request->title);
        $data['slug'] = Str::slug($plainTitle) . '-' . time();
        $data['user_id'] = Auth::id();

        if ($request->is_published) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $article = Article::create($data);

        NotificationService::log(
            'article_created',
            'Artikel Baru Ditambahkan',
            Auth::user()->name . ' menambahkan artikel "' . strip_tags($article->title) . '"',
            $article,
            route('admin.articles.index')
        );

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:2048',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'is_published' => 'boolean',
        ]);

        $data = $request->all();

        // Sanitasi HTML
        $data['title'] = $this->purifyHtml($request->input('title'));
        $data['excerpt'] = $this->purifyHtml($request->input('excerpt'));
        $data['content'] = $this->purifyHtml($request->input('content'));

        $plainTitle = strip_tags($request->title);
        $data['slug'] = Str::slug($plainTitle) . '-' . time();
        $data['user_id'] = Auth::id();

        if ($request->is_published && !$article->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $article->update($data);

        NotificationService::log(
            'article_updated',
            'Artikel Diperbarui',
            Auth::user()->name . ' memperbarui artikel "' . strip_tags($article->title) . '"',
            $article,
            route('admin.articles.index')
        );

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        $title = strip_tags($article->title);

        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();

        NotificationService::log(
            'article_deleted',
            'Artikel Dihapus',
            Auth::user()->name . ' menghapus artikel "' . $title . '"',
            null,
            route('admin.articles.index')
        );

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Sanitasi HTML dengan HTMLPurifier.
     */
    private function purifyHtml(?string $html): ?string
    {
        if (empty($html)) {
            return $html;
        }

        $config = \HTMLPurifier_Config::createDefault();

        $config->set('HTML.Allowed',
            'p,b,strong,i,em,u,s,h1,h2,h3,h4,' .
            'ul,ol,li,blockquote,br,hr,pre,code,' .
            'a[href|title|target],img[src|alt|width|height]'
        );

        $config->set('Attr.AllowedFrameTargets', ['_blank']);
        $config->set('AutoFormat.RemoveEmpty', true);

        $cachePath = storage_path('app/purifier');
        if (!is_dir($cachePath)) {
            mkdir($cachePath, 0755, true);
        }
        $config->set('Cache.SerializerPath', $cachePath);

        $purifier = new \HTMLPurifier($config);

        return $purifier->purify($html);
    }
}