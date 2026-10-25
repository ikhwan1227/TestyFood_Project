<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        // Cache statistik 5 menit
        $stats = Cache::remember('dashboard_stats', 300, function () {
            $articleStats = Article::selectRaw('
                COUNT(*) as total,
                SUM(CASE WHEN is_published = 1 THEN 1 ELSE 0 END) as published,
                SUM(CASE WHEN is_published = 0 THEN 1 ELSE 0 END) as draft
            ')->first();

            return [
                'articles_total' => $articleStats->total ?? 0,
                'articles_published' => $articleStats->published ?? 0,
                'articles_draft' => $articleStats->draft ?? 0,
                'galleries' => Gallery::count(),
                'notifications' => Notification::where('is_read', false)->count(),
            ];
        });

        // Trend artikel
        $trend = Cache::remember('dashboard_trend', 300, function () {
            $now = Carbon::now();
            $lastMonth = Carbon::now()->subMonth();

            $thisMonth = Article::whereMonth('created_at', $now->month)
                ->whereYear('created_at', $now->year)
                ->count();

            $prevMonth = Article::whereMonth('created_at', $lastMonth->month)
                ->whereYear('created_at', $lastMonth->year)
                ->count();

            $percentage = $prevMonth > 0
                ? (($thisMonth - $prevMonth) / $prevMonth) * 100
                : ($thisMonth > 0 ? 100 : 0);

            return [
                'this_month' => $thisMonth,
                'last_month' => $prevMonth,
                'percentage' => round($percentage, 1),
                'is_up' => $percentage >= 0,
            ];
        });

        // Top kategori
        $topCategories = Cache::remember('dashboard_top_categories', 300, function () {
            return Category::withCount('articles')
                ->orderByDesc('articles_count')
                ->take(5)
                ->get();
        });

        // Notifikasi terbaru (tidak perlu cache — harus fresh)
        $latest_notifications = Notification::with('actor')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'trend',
            'topCategories',
            'latest_notifications'
        ));
    }
}