<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return response()->json(['success' => true, 'data' => $services]);
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);
        return response()->json(['success' => true, 'data' => $service]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $data         = $request->all();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title']);

        if (isset($data['features']) && is_string($data['features'])) {
            $data['features'] = array_values(array_filter(array_map('trim', explode("\n", $data['features']))));
        }

        $service = Service::create($data);
        return response()->json(['success' => true, 'data' => $service], 201);
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $data    = $request->all();

        if (isset($data['slug'])) {
            $data['slug'] = $this->uniqueSlug($data['slug'], $service->id);
        }
        if (isset($data['features']) && is_string($data['features'])) {
            $data['features'] = array_values(array_filter(array_map('trim', explode("\n", $data['features']))));
        }

        $service->update($data);
        return response()->json(['success' => true, 'data' => $service->fresh()]);
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Hizmet silindi.']);
    }

    // Public: active services
    public function publicIndex()
    {
        $services = Service::where('status', 'active')->orderBy('sort_order')->get();
        return response()->json(['success' => true, 'data' => $services]);
    }

    // Public: single active service by slug
    public function publicShow($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return response()->json(['success' => true, 'data' => $service]);
    }

    private function uniqueSlug(string $input, ?int $excludeId = null): string
    {
        $slug  = Str::slug($input) ?: 'service-' . time();
        $base  = $slug;
        $count = 1;

        while (true) {
            $q = Service::where('slug', $slug);
            if ($excludeId) $q->where('id', '!=', $excludeId);
            if (! $q->exists()) break;
            $slug = $base . '-' . $count++;
        }

        return $slug;
    }
}
