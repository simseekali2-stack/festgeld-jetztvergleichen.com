<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120', // maks 5MB
        ]);

        try {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = Str::random(20) . '-' . time() . '.' . $extension;

            // storage/app/public/uploads → public/storage (storage:link)
            $path = $file->storeAs('uploads', $filename, 'public');

            $path = str_replace('\\', '/', $path);
            $relative = '/storage/'.$path;

            // İstekten gerçek origin (host:port) — APP_URL yanlış olsa bile önizleme çalışır
            $url = rtrim($request->getSchemeAndHttpHost(), '/').$relative;

            return response()->json([
                'success'   => true,
                'url'       => $url,
                'path'      => $path,
                'relative'  => $relative,
            ]);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => app()->environment('local', 'development')
                    ? $e->getMessage()
                    : 'Yükleme sırasında bir hata oluştu.',
            ], 500);
        }
    }
}
