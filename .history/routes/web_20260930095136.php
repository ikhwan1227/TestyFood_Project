<?php

use Illuminate\Support\Facades\Route;

// ==========================================
// FRONTEND CONTROLLERS
// ==========================================
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;

// ==========================================
// BACKEND (ADMIN) CONTROLLERS
// ==========================================
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. ROUTE FRONTEND (PUBLIK)
// ==========================================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');

// Route Berita
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');

// Route Galeri
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

// Route Kontak
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');


// ==========================================
// 2. ROUTE BACKEND (ADMIN)
// ==========================================

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Artikel (Berita)
    Route::resource('articles', AdminArticleController::class);

    // Manajemen Kategori
    Route::resource('categories', AdminCategoryController::class);

    // Manajemen Galeri
    // Kita batasi hanya index, create, store, destroy (karena galeri biasanya tidak diedit)
    Route::resource('galleries', AdminGalleryController::class)->except(['show', 'edit', 'update']);

    // Manajemen Testimoni
    Route::resource('testimonials', AdminTestimonialController::class);

    // Manajemen Pesan Kontak (Hanya lihat dan hapus)
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);

    // Pengaturan Website (Settings)
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});