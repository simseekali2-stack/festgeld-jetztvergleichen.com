@extends('layouts.app')

@section('content')

  {{-- PAGE HERO --}}
  <section class="bg-linear-to-br from-blue-950 to-blue-700 text-white py-12 md:py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-10">
      <nav class="flex mb-6">
        <ol class="inline-flex items-center space-x-2 text-sm text-blue-300">
          <li><a href="/" class="hover:text-white transition-colors">Startseite</a></li>
          <li><span class="mx-1">/</span></li>
          <li class="text-white font-semibold">Blog</li>
        </ol>
      </nav>
      <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4">Finanzwissen &amp; Analysen</h1>
      <p class="text-lg text-blue-200 max-w-2xl">
        Aktuelle Beiträge zu Anlagestrategien, Zinstrends und langfristiger Portfoliosicherheit.
      </p>
    </div>
  </section>

  {{-- BLOG POSTS --}}
  <section class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-10">

      @if(count($posts) > 0)
        @php
          $featuredPost = $posts->where('featured', true)->first() ?: $posts->first();
          $restPosts    = $posts->where('id', '!=', $featuredPost->id);
        @endphp

        {{-- Featured Post --}}
        @if($featuredPost)
          <article class="bg-white shadow-xl rounded-md overflow-hidden mb-8 flex flex-col lg:flex-row">
            <div class="w-full lg:w-5/12 min-h-[220px] lg:min-h-[320px] bg-gray-100 relative shrink-0">
              @if($featuredPost->featured_image)
                <img src="{{ $featuredPost->featured_image }}" alt="{{ $featuredPost->title }}"
                  class="absolute inset-0 w-full h-full object-cover" />
              @else
                <div class="absolute inset-0 bg-linear-to-br from-blue-100 to-blue-200"></div>
              @endif
            </div>
            <div class="flex-1 p-7 md:p-10 flex flex-col justify-center">
              <div class="flex items-center gap-2 mb-4 flex-wrap">
                @if($featuredPost->category)
                  <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 rounded bg-blue-100 text-blue-800">{{ $featuredPost->category }}</span>
                @endif
                <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 rounded bg-yellow-100 text-yellow-800">Redaktionstipp</span>
              </div>
              <h2 class="text-2xl md:text-3xl font-bold text-gray-900 leading-tight mb-3">{{ $featuredPost->title }}</h2>
              <p class="text-gray-600 font-medium leading-relaxed line-clamp-3 mb-5">{{ $featuredPost->excerpt }}</p>
              <div class="flex items-center gap-3 text-sm text-gray-500 mb-6">
                <span>{{ $featuredPost->published_at ? $featuredPost->published_at->format('d.m.Y') : now()->format('d.m.Y') }}</span>
              </div>
              <a href="/blog/{{ $featuredPost->slug }}"
                class="inline-flex w-fit items-center gap-2 bg-linear-to-br from-blue-700 to-blue-900 hover:from-blue-800 hover:to-blue-600 text-white font-bold py-3 px-6 rounded-xs transition">
                Beitrag lesen
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
              </a>
            </div>
          </article>
        @endif

        {{-- Remaining Posts Grid --}}
        @if($restPosts->count())
          <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($restPosts as $post)
              <article class="bg-white shadow-xl rounded-md overflow-hidden flex flex-col hover:shadow-2xl transition-shadow duration-300">
                <a style="height:200px" href="/blog/{{ $post->slug }}" class="block relative  bg-gray-100 shrink-0">
                  @if($post->featured_image)
                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                      class="absolute inset-0 w-full h-full " />
                  @else
                    <div class="absolute inset-0 bg-linear-to-br from-blue-50 to-blue-100"></div>
                  @endif
                </a>
                <div class="p-6 flex flex-col flex-1">
                  @if($post->category)
                    <span class="text-xs font-bold uppercase tracking-wider px-2 py-1 rounded bg-blue-100 text-blue-800 w-fit mb-3">{{ $post->category }}</span>
                  @endif
                  <a href="/blog/{{ $post->slug }}">
                    <h3 class="text-lg font-bold text-gray-900 leading-snug mb-3 hover:text-blue-700 transition-colors">{{ $post->title }}</h3>
                  </a>
                  <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 flex-1">{{ $post->excerpt }}</p>
                  <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-semibold">
                    <span>{{ $post->author_name ?: 'Redaktion' }}</span>
                    <span>{{ $post->published_at ? $post->published_at->format('d.m.Y') : now()->format('d.m.Y') }}</span>
                  </div>
                </div>
              </article>
            @endforeach
          </div>
        @endif

      @else
        <div class="bg-white shadow-xl rounded-md p-10 text-center text-gray-500 font-semibold">
          Noch keine Beiträge vorhanden.
        </div>
      @endif

    </div>
  </section>

@endsection