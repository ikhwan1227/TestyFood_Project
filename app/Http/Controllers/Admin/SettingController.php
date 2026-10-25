<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', '_method');

        $changedKeys = [];
        foreach ($data as $key => $value) {
            $oldValue = Setting::where('key', $key)->value('value');
            if ($oldValue != $value) {
                $changedKeys[] = $key;
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        if (!empty($changedKeys)) {
            NotificationService::log(
                'setting_updated',
                'Pengaturan Website Diperbarui',
                Auth::user()->name . ' mengubah pengaturan: ' . implode(', ', $changedKeys),
                null,
                route('admin.settings.index')
            );
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}