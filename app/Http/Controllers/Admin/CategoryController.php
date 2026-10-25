<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('articles')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return redirect()->route('admin.categories.index');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:categories']);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        NotificationService::log(
            'category_created',
            'Kategori Baru Ditambahkan',
            Auth::user()->name . ' menambahkan kategori "' . $category->name . '"',
            $category,
            route('admin.categories.index')
        );

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return redirect()->route('admin.categories.index');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:255|unique:categories,name,' . $category->id]);

        $oldName = $category->name;

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        NotificationService::log(
            'category_updated',
            'Kategori Diperbarui',
            Auth::user()->name . ' mengubah kategori "' . $oldName . '" menjadi "' . $category->name . '"',
            $category,
            route('admin.categories.index')
        );

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $name = $category->name;
        $category->delete();

        NotificationService::log(
            'category_deleted',
            'Kategori Dihapus',
            Auth::user()->name . ' menghapus kategori "' . $name . '"',
            null,
            route('admin.categories.index')
        );

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}