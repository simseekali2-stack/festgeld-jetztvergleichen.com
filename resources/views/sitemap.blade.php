{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Statik Sayfalar --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->startOfMonth()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/blog') }}</loc>
        <lastmod>{{ now()->startOfDay()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/services') }}</loc>
        <lastmod>{{ now()->startOfMonth()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/kontakt') }}</loc>
        <lastmod>2026-01-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>

    {{-- Blog Yazıları --}}
    @foreach($blogs as $blog)
    <url>
        <loc>{{ url('/blog/' . $blog->slug) }}</loc>
        <lastmod>{{ $blog->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    {{-- Servisler --}}
    @foreach($services as $service)
    <url>
        <loc>{{ url('/' . $service->slug) }}</loc>
        <lastmod>{{ $service->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    {{-- Dinamik Sayfalar --}}
    @foreach($pages as $page)
    <url>
        <loc>{{ url('/' . ltrim($page->slug, '/')) }}</loc>
        <lastmod>{{ $page->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
</urlset>
