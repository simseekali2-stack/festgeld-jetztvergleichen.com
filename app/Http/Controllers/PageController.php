<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')
            ->select('id', 'title', 'slug', 'type', 'status', 'created_at')
            ->get();

        return response()->json(['success' => true, 'data' => $pages]);
    }

    public function show($id)
    {
        $page = Page::findOrFail($id);
        return response()->json(['success' => true, 'data' => $page]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $data         = $request->all();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title']);

        $page = Page::create($data);
        return response()->json(['success' => true, 'data' => $page], 201);
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $data = $request->all();

        if (isset($data['slug'])) {
            $data['slug'] = $this->uniqueSlug($data['slug'], $page->id);
        }

        $page->update($data);
        return response()->json(['success' => true, 'data' => $page->fresh()]);
    }

    public function destroy($id)
    {
        Page::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Sayfa silindi.']);
    }

    // Public: list all published pages (for sitemap)
    public function publicIndex()
    {
        $pages = Page::where('status', 'published')
            ->orderBy('id', 'desc')
            ->select('slug', 'updated_at')
            ->get();
        return response()->json(['success' => true, 'data' => $pages]);
    }

    // Public: published page by slug
    public function publicShow($slug)
    {
        $page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return response()->json(['success' => true, 'data' => $page]);
    }

    private function uniqueSlug(string $input, ?int $excludeId = null): string
    {
        $slug  = Str::slug($input) ?: 'page-' . time();
        $base  = $slug;
        $count = 1;

        while (true) {
            $q = Page::where('slug', $slug);
            if ($excludeId) $q->where('id', '!=', $excludeId);
            if (! $q->exists()) break;
            $slug = $base . '-' . $count++;
        }

        return $slug;
    }
}
