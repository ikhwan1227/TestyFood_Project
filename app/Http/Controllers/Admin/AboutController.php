<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::getInstance();
        return view('admin.about.edit', compact('about'));
    }

        public function update(Request $request)
    {
        $about = About::getInstance();

        $data = $request->except(['_token', '_method']);

        // Daftar semua field gambar
        $imageFields = [
            'image_1a', 'image_1b', 'image_2a', 'image_2b', 'image_3', 
            'about_image_1a', 'about_image_1b', 'about_image_2a', 'about_image_2b', 'about_image_3'
        ];

        // Tambahkan aturan validasi untuk setiap field gambar
        $rules = [];
        foreach ($imageFields as $field) {
            // nullable: boleh kosong jika user tidak mengganti gambar
            // image: harus berupa file gambar
            // mimes: tambahkan avif di sini
            $rules[$field] = 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:2048';
        }
        
        // Jalankan validasi
        $request->validate($rules);

        // Proses upload gambar
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Hapus gambar lama jika ada dan bukan dari folder assets/
                $oldImage = $about->$field;
                if ($oldImage && !str_starts_with($oldImage, 'assets/')) {
                    Storage::disk('public')->delete($oldImage);
                }
                // Simpan gambar baru
                $data[$field] = $request->file($field)->store('abouts', 'public');
            }
        }

        $about->update($data);

        NotificationService::log(
            'about_updated',
            'Halaman Tentang Kami Diperbarui',
            Auth::user()->name . ' memperbarui konten halaman Tentang Kami',
            null,
            route('admin.about.edit')
        );

        return redirect()->route('admin.about.edit')
            ->with('success', 'Halaman Tentang Kami berhasil diperbarui.');
    }
}