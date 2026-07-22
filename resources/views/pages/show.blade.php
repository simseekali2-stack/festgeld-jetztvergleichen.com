@extends('layouts.app')

@section('content')

  @if($page && $page->structured_data)
    <div style="display:none">{!! $page->structured_data !!}</div>
  @endif

  @if($page)

    {{-- PAGE HERO --}}
    <section class="bg-linear-to-br from-blue-950 to-blue-700 text-white py-10 md:py-16">
      <div class="container mx-auto px-4 sm:px-6 lg:px-10 max-w-4xl">
        <nav class="flex mb-5">
          <ol class="inline-flex items-center space-x-2 text-sm text-blue-300">
            <li><a href="/" class="hover:text-white transition-colors">Startseite</a></li>
            <li><span class="mx-1">/</span></li>
            <li class="text-white font-semibold">{{ $page->title }}</li>
          </ol>
        </nav>
        <h1 class="text-3xl md:text-4xl font-bold leading-tight">{{ $page->title }}</h1>
      </div>
    </section>

    {{-- CONTENT --}}
    <section class="bg-gray-50 py-10">
      <div class="container mx-auto px-4 sm:px-6 lg:px-10 max-w-4xl">
        <div class="bg-white shadow-xl rounded-md overflow-hidden">
          @if($page->featured_image)
            <img src="{{ $page->featured_image }}" alt="{{ $page->title }}"
              class="w-full h-64 md:h-80 object-cover" />
          @endif
          <div class="px-6 sm:px-10 lg:px-14 py-8 lg:py-12">
            <div class="blog-content max-w-none">
              {!! $page->content !!}
            </div>
          </div>
        </div>
      </div>
    </section>

  @else
    <section class="bg-gray-50 py-16">
      <div class="container mx-auto max-w-4xl px-4">
        <div class="bg-white shadow-xl rounded-md p-10 text-center text-gray-500 font-semibold">
          Seite nicht gefunden.
          <div class="mt-4">
            <a href="/" class="text-blue-700 font-bold hover:underline">Zurück zur Startseite</a>
          </div>
        </div>
      </div>
    </section>
  @endif

@endsection