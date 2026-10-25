<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Share settings ke semua view
        View::composer('*', function ($view) {
            $view->with('globalSettings', Setting::pluck('value', 'key')->toArray());
        });
    }
}