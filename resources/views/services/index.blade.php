@extends('layouts.app')

@section('content')

  {{-- PAGE HERO --}}
  <section class="bg-linear-to-br from-blue-950 to-blue-700 text-white py-12 md:py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-10">
      <nav class="flex mb-6">
        <ol class="inline-flex items-center space-x-2 text-sm text-blue-300">
          <li><a href="/" class="hover:text-white transition-colors">Startseite</a></li>
          <li><span class="mx-1">/</span></li>
          <li class="text-white font-semibold">Services</li>
        </ol>
      </nav>
      <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4">Unsere Services</h1>
      <p class="text-lg text-blue-200 max-w-2xl">
        Professionelle Finanzservices mit klarem Mehrwert, transparenter Struktur und maximaler Verlässlichkeit.
      </p>
    </div>
  </section>

  {{-- SERVICES GRID --}}
  <section class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-10">
      @if(count($services) > 0)
        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
          @foreach($services as $service)
            <article class="bg-white shadow-xl rounded-md p-6 flex flex-col hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded flex items-center justify-center text-2xl bg-blue-50">
                  <span>&#11088;</span>
                </div>
                <h2 class="text-xl font-bold text-gray-900 leading-snug">{{ $service->title }}</h2>
              </div>
              <p class="text-sm text-gray-600 leading-relaxed flex-1 mb-4">{{ $service->excerpt ?: 'Für diesen Service liegt derzeit keine Kurzbeschreibung vor.' }}</p>
              @if($service->features && count($service->features) > 0)
                <ul class="mb-5 space-y-2">
                  @foreach(array_slice($service->features, 0, 3) as $feature)
                    <li class="text-xs font-semibold text-gray-600 flex items-center gap-2">
                      <svg class="w-3.5 h-3.5 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                      {{ $feature }}
                    </li>
                  @endforeach
                </ul>
              @endif
              <a href="/{{ $service->slug }}"
                class="inline-flex items-center gap-2 bg-linear-to-br from-blue-700 to-blue-900 hover:from-blue-800 hover:to-blue-600 text-white font-bold py-2.5 px-5 rounded-xs text-sm transition w-fit">
                Service ansehen
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
              </a>
            </article>
          @endforeach
        </div>
      @else
        <div class="bg-white shadow-xl rounded-md p-10 text-center text-gray-500 font-semibold">
          Derzeit sind keine aktiven Services verfügbar.
        </div>
      @endif
    </div>
  </section>

@endsection