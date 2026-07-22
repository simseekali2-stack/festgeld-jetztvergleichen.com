@extends('layouts.app')

@section('content')

  @if($service && $service->structured_data)
    <div style="display:none">{!! $service->structured_data !!}</div>
  @endif

  @if($service)

    {{-- PAGE HERO --}}
    <section class="bg-linear-to-br from-blue-950 to-blue-700 text-white py-12 md:py-16">
      <div class="container mx-auto px-4 sm:px-6 lg:px-10">
        <a href="/services" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-300 hover:text-white transition-colors mb-6">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
          Zur Serviceliste
        </a>
        <div class="flex items-center gap-3 mb-4">
          <div class="w-12 h-12 rounded flex items-center justify-center text-2xl bg-blue-800">
            <span>&#11088;</span>
          </div>
          <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 rounded bg-blue-800 text-blue-200">Service</span>
        </div>
        <h1 class="text-3xl md:text-5xl font-bold leading-tight max-w-4xl">{{ $service->title }}</h1>
      </div>
    </section>

    {{-- CONTENT --}}
    <section class="bg-gray-50 py-10">
      <div class="container mx-auto px-4 sm:px-6 lg:px-10 max-w-4xl">
        <div class="bg-white shadow-xl rounded-md overflow-hidden">
          <div class="px-6 sm:px-10 lg:px-14 py-8 lg:py-12">
            @if($service->excerpt)
              <p class="text-lg text-gray-600 leading-relaxed font-medium border-l-4 border-blue-700 pl-5 mb-8">{{ $service->excerpt }}</p>
            @endif
            <div class="blog-content max-w-none break-words">
              {!! $service->content !!}
            </div>
            @if($service->features && count($service->features) > 0)
              <div class="mt-10 pt-6 border-t border-gray-100">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-4">Leistungsmerkmale</p>
                <div class="grid sm:grid-cols-2 gap-2.5">
                  @foreach($service->features as $feature)
                    <div class="text-sm font-semibold text-gray-700 flex items-center gap-2 bg-gray-50 border border-gray-200 rounded px-3 py-2">
                      <svg class="w-4 h-4 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                      {{ $feature }}
                    </div>
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
          Der Service wurde nicht gefunden.
          <div class="mt-4">
            <a href="/services" class="text-blue-700 font-bold hover:underline">Zur Serviceliste</a>
          </div>
        </div>
      </div>
    </section>
  @endif

@endsection