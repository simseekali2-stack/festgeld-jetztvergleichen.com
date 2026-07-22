@extends('layouts.app')

@section('content')

  @if($post && $post->structured_data)
    <div style="display:none">{!! $post->structured_data !!}</div>
  @endif

  @if($post)

    {{-- PAGE HERO --}}
    <section class="bg-linear-to-br from-blue-950 to-blue-700 text-white py-12 md:py-16">
      <div class="container mx-auto px-4 sm:px-6 lg:px-10">
        <a href="/blog" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-300 hover:text-white transition-colors mb-6">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
          Zur Blogliste
        </a>
        <div class="flex items-center gap-2 mb-4 flex-wrap">
          @if($post->category)
            <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 rounded bg-blue-800 text-blue-200">{{ $post->category }}</span>
          @endif
          <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 rounded bg-blue-800 text-blue-200">Blog</span>
        </div>
        <h1 class="text-3xl md:text-5xl font-bold leading-tight max-w-4xl mb-5">{{ $post->title }}</h1>
        <div class="flex flex-wrap items-center gap-3 text-sm text-blue-300">
          <time>{{ $post->published_at ? $post->published_at->format('d. F Y') : now()->format('d. F Y') }}</time>
          @if($post->reading_time)
            <span>&bull;</span>
            <span>{{ $post->reading_time }} Min. Lesezeit</span>
          @endif
        </div>
      </div>
    </section>

    {{-- CONTENT --}}
    <section class="bg-gray-50 py-10">
      <div class="container mx-auto px-4 sm:px-6 lg:px-10 max-w-4xl">
        <div class="bg-white shadow-xl rounded-md overflow-hidden">
          @if($post->featured_image)
            <div class="h-[260px] sm:h-[360px] bg-gray-100">
              <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                class="w-full h-full object-cover" />
            </div>
          @endif
          <div class="px-6 sm:px-10 lg:px-14 py-8 lg:py-12">
            @if($post->excerpt)
              <p class="text-lg text-gray-600 leading-relaxed font-medium border-l-4 border-blue-700 pl-5 mb-8">{{ $post->excerpt }}</p>
            @endif
            <div class="blog-content max-w-none break-words">
              {!! $post->content !!}
            </div>
            @if($post->tags && count($post->tags) > 0)
              <div class="mt-10 pt-6 border-t border-gray-100">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3">Schlagwörter</p>
                <div class="flex flex-wrap gap-2">
                  @foreach($post->tags as $tag)
                    <span class="px-3 py-1 rounded text-xs font-bold bg-gray-100 text-gray-700">{{ $tag }}</span>
                  @endforeach
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </section>

  @else
    <section class="bg-gray-50 py-16">
      <div class="container mx-auto max-w-4xl px-4">
        <div class="bg-white shadow-xl rounded-md p-10 text-center text-gray-500 font-semibold">
          Der Blogbeitrag wurde nicht gefunden.
          <div class="mt-4">
            <a href="/blog" class="text-blue-700 font-bold hover:underline">Zur Blogliste</a>
          </div>
        </div>
      </div>
    </section>
  @endif

@endsection