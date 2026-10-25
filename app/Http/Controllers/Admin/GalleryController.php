<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Category;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Gallery::latest();

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $galleries = $query->paginate(12)->withQueryString();

        // Ambil semua kategori dari database untuk dropdown
        $categories = Category::orderBy('name')->get();

        return view('admin.galleries.index', compact('galleries', 'categories'));
    }

    public function create()
    {
        return redirect()->route('admin.galleries.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery = Gallery::create($data);

        NotificationService::log(
            'gallery_created',
            'Foto Galeri Ditambahkan',
            Auth::user()->name . ' menambahkan foto' . ($gallery->title ? ' "' . $gallery->title . '"' : '') . ' ke galeri',
            $gallery,
            route('admin.galleries.index')
        );

        return redirect()->route('admin.galleries.index')->with('gallery_success', 'Foto berhasil ditambahkan!');
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
        ]);

        $gallery->update($request->only('title', 'category'));

        NotificationService::log(
            'gallery_updated',
            'Foto Galeri Diperbarui',
            Auth::user()->name . ' memperbarui foto' . ($gallery->title ? ' "' . $gallery->title . '"' : ''),
            $gallery,
            route('admin.galleries.index')
        );

        return redirect()->route('admin.galleries.index')->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        $title = $gallery->title;

        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();

        NotificationService::log(
            'gallery_deleted',
            'Foto Galeri Dihapus',
            Auth::user()->name . ' menghapus foto' . ($title ? ' "' . $title . '"' : '') . ' dari galeri',
            null,
            route('admin.galleries.index')
        );

        return redirect()->route('admin.galleries.index')->with('success', 'Foto berhasil dihapus.');
    }
}