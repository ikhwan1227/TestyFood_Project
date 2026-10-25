<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class GalleryController extends Controller
{
   public function index()
    {
        // Data untuk paginasi grid galeri
        $galleries = Gallery::latest()->paginate(12);
        
        // Data untuk slider/carousel (10 gambar terbaru)
        $sliderGalleries = Gallery::latest()->take(10)->get();

        return view('gallery', compact('galleries', 'sliderGalleries'));
    }
}