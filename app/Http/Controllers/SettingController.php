<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    // Tüm ayarları anahtar-değer çifti olarak döndürür
    public function index()
    {
        $settings = Cache::remember('site_settings', 60, function () {
            return Setting::pluck('value', 'key')->toArray();
        });

        return response()->json([
            'success' => true,
            'data'    => $settings,
        ]);
    }

    // Toplu ayar kaydetme (sadece Adminler)
    public function update(Request $request)
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? json_encode($value) : $value]
            );
        }

        Cache::forget('site_settings');

        return response()->json([
            'success' => true,
            'message' => 'Ayarlar başarıyla güncellendi.',
        ]);
    }
}
