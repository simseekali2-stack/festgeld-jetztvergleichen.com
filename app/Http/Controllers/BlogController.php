<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')
            ->select('id', 'title', 'slug', 'status', 'featured', 'category', 'reading_time', 'published_at', 'created_at')
            ->get();

        return response()->json(['success' => true, 'data' => $posts]);
    }

    public function show($id)
    {
        $post = BlogPost::findOrFail($id);
        return response()->json(['success' => true, 'data' => $post]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $data = $request->all();
        $data['slug']         = $this->uniqueSlug($data['slug'] ?? $data['title']);
        $data['reading_time'] = $this->readingTime($data['content']);

        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = array_values(array_filter(array_map('trim', explode(',', $data['tags']))));
        }

        $post = BlogPost::create($data);
        
        \Illuminate\Support\Facades\Cache::forget('public_blog_posts');
        
        return response()->json(['success' => true, 'data' => $post], 201);
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $data = $request->all();

        if (isset($data['slug'])) {
            $data['slug'] = $this->uniqueSlug($data['slug'], $post->id);
        }
        if (isset($data['content'])) {
            $data['reading_time'] = $this->readingTime($data['content']);
        }
        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = array_values(array_filter(array_map('trim', explode(',', $data['tags']))));
        }

        $post->update($data);
        
        \Illuminate\Support\Facades\Cache::forget('public_blog_posts');
        \Illuminate\Support\Facades\Cache::forget('public_blog_post_' . $post->slug);
        
        return response()->json(['success' => true, 'data' => $post->fresh()]);
    }

    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        $slug = $post->slug;
        $post->delete();
        
        \Illuminate\Support\Facades\Cache::forget('public_blog_posts');
        \Illuminate\Support\Facades\Cache::forget('public_blog_post_' . $slug);
        
        return response()->json(['success' => true, 'message' => 'Blog yazısı silindi.']);
    }

    // Public: published posts list
    public function publicIndex()
    {
        $posts = \Illuminate\Support\Facades\Cache::remember('public_blog_posts', 3600, function() {
            return BlogPost::where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'category', 'tags', 'author_name', 'reading_time', 'published_at', 'featured')
                ->get();
        });

        return response()->json(['success' => true, 'data' => $posts]);
    }

    // Public: single published post by slug
    public function publicShow($slug)
    {
        $post = \Illuminate\Support\Facades\Cache::remember('public_blog_post_' . $slug, 3600, function() use ($slug) {
            return BlogPost::where('slug', $slug)->where('status', 'published')->firstOrFail();
        });
        
        return response()->json(['success' => true, 'data' => $post]);
    }

    private function uniqueSlug(string $input, ?int $excludeId = null): string
    {
        $slug         = Str::slug($input) ?: 'post-' . time();
        $base         = $slug;
        $count        = 1;

        while (true) {
            $q = BlogPost::where('slug', $slug);
            if ($excludeId) $q->where('id', '!=', $excludeId);
            if (! $q->exists()) break;
            $slug = $base . '-' . $count++;
        }

        return $slug;
    }

    private function readingTime(string $content): int
    {
        return max(1, (int) ceil(str_word_count(strip_tags($content)) / 200));
    }
}
