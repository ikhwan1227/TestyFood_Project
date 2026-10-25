<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    /**
     * Catat aktivitas admin ke tabel notifications.
     *
     * @param string $type    Kategori aksi: article_created, category_updated, dll
     * @param string $title   Judul notifikasi: "Artikel Baru Ditambahkan"
     * @param string $message Detail aktivitas
     * @param mixed  $model   Model yang di-CRUD (opsional)
     * @param string $url     URL tujuan (opsional)
     */
    public static function log(
        string $type,
        string $title,
        string $message = '',
        $model = null,
        string $url = ''
    ): void {
        $actor = Auth::user();

        Notification::create([
            'actor_id' => $actor?->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'model_type' => $model ? get_class($model) : null,
            'model_id' => $model?->id,
            'url' => $url,
        ]);
    }

    /**
     * Hitung jumlah notifikasi belum dibaca.
     */
    public static function unreadCount(): int
    {
        return Notification::where('is_read', false)->count();
    }
}