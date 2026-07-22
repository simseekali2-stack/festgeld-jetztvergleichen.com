@extends('layouts.app')

@section('content')

  {{-- PAGE HERO --}}
  <section class="bg-linear-to-br from-blue-950 to-blue-700 text-white py-12 md:py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-10">
      <nav class="flex mb-6">
        <ol class="inline-flex items-center space-x-2 text-sm text-blue-300">
          <li><a href="/" class="hover:text-white transition-colors">Startseite</a></li>
          <li><span class="mx-1">/</span></li>
          <li class="text-white font-semibold">Partnerbanken</li>
        </ol>
      </nav>
      <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4">Unsere Partnerbanken</h1>
      <p class="text-lg text-blue-200 max-w-2xl">
        Vergleichen Sie Angebote von führenden europäischen Finanzinstituten.
        Wir wählen unsere Partner nach strengsten Kriterien für Sicherheit und Stabilität aus.
      </p>
    </div>
  </section>

  {{-- BANKS GRID --}}
  <section class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-10">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($banks as $bank)
          <div class="bg-white shadow-xl rounded-md p-6 flex flex-col h-full border border-gray-100 hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-start justify-between mb-5">
              <div class="h-16 w-36 flex items-center justify-start">
                <img src="{{ $bank['logo'] ?: 'https://placehold.co/200x100?text=' . urlencode($bank['name']) }}"
                  alt="{{ $bank['name'] }}"
                  class="max-h-full max-w-full object-contain">
              </div>
              @if($bank['country'])
                <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $bank['country'] }}</span>
              @endif
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $bank['name'] }}</h3>
            <p class="text-gray-600 text-sm leading-relaxed flex-1">{{ $bank['description'] }}</p>
            <a href="/kontakt" target="_blank" class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors">
              Kontaktieren
            </a>
          </div>
        @empty
          <div class="col-span-full py-16 text-center text-gray-500 font-semibold">
            Momentan keine Banken verfügbar.
          </div>
        @endforelse
      </div>
    </div>
  </section>

@endsection