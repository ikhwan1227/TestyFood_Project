<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $query = Notification::with('actor')->latest();

        // Filter berdasarkan tipe
        if ($filter === 'unread') {
            $query->where('is_read', false);
        } elseif ($filter === 'contact') {
            $query->where('type', 'like', 'contact%');
        }

        $notifications = $query->paginate(20)->withQueryString();

        // Hitung semua statistik
        $unreadCount = Notification::where('is_read', false)->count();
        $contactCount = Notification::where('type', 'like', 'contact%')->count();
        $totalCount = Notification::count();

        return view('admin.notifications.index', compact(
            'notifications',
            'unreadCount',
            'contactCount',
            'totalCount',
            'filter'
        ));
    }

    public function markAsRead(Notification $notification)
    {
        $notification->update(['is_read' => true]);

        if ($notification->url) {
            return redirect($notification->url);
        }

        return back();
    }

    public function markAllAsRead()
    {
        Notification::where('is_read', false)->update(['is_read' => true]);
        return back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return back()->with('success', 'Notifikasi dihapus.');
    }

    public function clearAll()
    {
        Notification::truncate();
        return back()->with('success', 'Semua notifikasi telah dibersihkan.');
    }
}