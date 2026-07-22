@extends('layouts.app')

@section('content')

  {{-- HERO --}}
  <section class="bg-linear-to-br from-blue-950 to-blue-700 text-white py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-10 text-center">
      <span class="inline-block bg-white/10 border border-white/20 text-blue-200 text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">
        Über Uns
      </span>
      <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-5">
        Ihr zuverlässiger Partner für<br class="hidden md:block"> transparente Festgeldvergleiche
      </h1>
      <p class="text-lg text-blue-200 max-w-2xl mx-auto leading-relaxed">
        Willkommen bei <strong class="text-white">bankenonlinevergleich.com</strong> –
        Ihrem zuverlässigen Partner für transparente und unabhängige Festgeldvergleiche.
        Unser Ziel ist es, Ihnen dabei zu helfen, die besten Festgeldangebote am Markt
        schnell und einfach zu finden. In einer Zeit, in der Zinssätze, Laufzeiten und
        Konditionen ständig variieren, bieten wir Ihnen eine klare Übersicht über attraktive
        Angebote führender Banken aus Deutschland und Europa.
      </p>
    </div>
  </section>

  <div class="bg-gray-50 py-16 md:py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-10 max-w-4xl space-y-14">

      {{-- Unsere Mission --}}
      <section class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 md:p-10">
        <div class="flex items-center gap-3 mb-5">
          <div class="w-10 h-10 bg-blue-50 text-blue-700 rounded-lg flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
          </div>
          <h2 class="text-2xl font-bold text-gray-900">Unsere Mission</h2>
        </div>
        <p class="text-gray-600 leading-relaxed">
          Wir möchten Anlegern fundierte Entscheidungen ermöglichen. Deshalb stellen wir Ihnen aktuelle
          Festgeldangebote übersichtlich dar, damit Sie die besten Zinsen für Ihre individuellen Anlageziele
          finden können. Ein Vergleich lohnt sich, da Zinssätze je nach Anbieter, Laufzeit und Anlagesumme
          stark variieren können.
        </p>
      </section>

      {{-- Was uns auszeichnet --}}
      <section>
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Was uns auszeichnet</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          @foreach([
            ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>', 'color' => 'blue', 'label' => 'Unabhängigkeit', 'text' => 'Unsere Vergleiche erfolgen objektiv und transparent.'],
            ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>', 'color' => 'green', 'label' => 'Aktualität', 'text' => 'Wir analysieren regelmäßig neue Angebote und Zinssätze.'],
            ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>', 'color' => 'purple', 'label' => 'Einfachheit', 'text' => 'Intuitive Tools und Rechner erleichtern Ihre Entscheidung.'],
            ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>', 'color' => 'teal', 'label' => 'Sicherheit', 'text' => 'Wir berücksichtigen nur Banken mit gesetzlicher Einlagensicherung innerhalb der EU (bis 100.000 € pro Kunde).'],
          ] as $item)
          @php
            $palette = ['blue'=>['bg'=>'bg-blue-50','text'=>'text-blue-700'],'green'=>['bg'=>'bg-green-50','text'=>'text-green-700'],'purple'=>['bg'=>'bg-purple-50','text'=>'text-purple-700'],'teal'=>['bg'=>'bg-teal-50','text'=>'text-teal-700']];
            $p = $palette[$item['color']];
          @endphp
          <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm flex gap-4">
            <div class="w-10 h-10 {{ $p['bg'] }} {{ $p['text'] }} rounded-lg flex items-center justify-center shrink-0 mt-0.5">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">{!! $item['icon'] !!}</svg>
            </div>
            <div>
              <h3 class="font-bold text-gray-900 mb-1">{{ $item['label'] }}</h3>
              <p class="text-gray-500 text-sm leading-relaxed">{{ $item['text'] }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </section>

      {{-- Unser Service --}}
      <section class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 md:p-10">
        <div class="flex items-center gap-3 mb-6">
          <div class="w-10 h-10 bg-orange-50 text-orange-600 rounded-lg flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
          </div>
          <h2 class="text-2xl font-bold text-gray-900">Unser Service</h2>
        </div>
        <p class="text-gray-600 leading-relaxed mb-5">Mit unserem Festgeldvergleich können Sie:</p>
        <ul class="space-y-3">
          @foreach([
            'Angebote nach Laufzeit und Anlagebetrag filtern',
            'Zinssätze und Erträge direkt vergleichen',
            'passende Banken und sichere Anlageoptionen finden',
          ] as $item)
          <li class="flex items-start gap-3">
            <svg class="w-5 h-5 text-blue-600 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="text-gray-700 text-sm">{{ $item }}</span>
          </li>
          @endforeach
        </ul>
        <div class="mt-6 bg-blue-50 border border-blue-100 rounded-lg px-5 py-4 text-sm text-blue-800 leading-relaxed">
          <strong>Hinweis:</strong> Festgeld ist eine der beliebtesten Anlageformen für sicherheitsorientierte Sparer,
          da der Zinssatz über die gesamte Laufzeit garantiert ist.
        </div>
      </section>

      {{-- Transparenz & Finanzierung --}}
      <section class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 md:p-10">
        <div class="flex items-center gap-3 mb-5">
          <div class="w-10 h-10 bg-gray-100 text-gray-600 rounded-lg flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
          <h2 class="text-2xl font-bold text-gray-900">Transparenz &amp; Finanzierung</h2>
        </div>
        <p class="text-gray-600 leading-relaxed">
          Unser Service ist für Sie <strong class="text-gray-800">kostenlos</strong>. Wir finanzieren uns teilweise über
          Provisionen, wenn Nutzer über unsere Plattform Produkte abschließen. Dies hat jedoch
          <strong class="text-gray-800">keinen Einfluss auf die Objektivität</strong> unserer Vergleiche.
        </p>
      </section>

      {{-- Für wen ist unser Angebot geeignet? --}}
      <section class="bg-linear-to-br from-blue-950 to-blue-800 rounded-xl p-8 md:p-10 text-white">
        <h2 class="text-2xl font-bold mb-2">Für wen ist unser Angebot geeignet?</h2>
        <p class="text-blue-200 mb-7 text-sm">Unsere Plattform richtet sich an alle, die:</p>
        <ul class="space-y-4">
          @foreach([
            'ihr Geld sicher und planbar anlegen möchten',
            'von attraktiven Festgeldzinsen profitieren wollen',
            'verschiedene Banken und Angebote effizient vergleichen möchten',
          ] as $item)
          <li class="flex items-start gap-3">
            <div class="w-6 h-6 bg-white/10 rounded-full flex items-center justify-center shrink-0 mt-0.5">
              <svg class="w-3.5 h-3.5 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
              </svg>
            </div>
            <span class="text-blue-100 text-sm leading-relaxed">{{ $item }}</span>
          </li>
          @endforeach
        </ul>
        <div class="mt-8">
          <a href="/" class="inline-block bg-white text-blue-900 font-bold px-7 py-3 rounded hover:bg-blue-50 transition shadow text-sm">
            Jetzt Festgeld vergleichen
          </a>
        </div>
      </section>

    </div>
  </div>

@endsection
