@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/css/intlTelInput.css">
  <style>
    .iti { width: 100% !important; display: block !important; }
    .iti__flag-container { z-index: 10; }
    .iti--container { z-index: 10050 !important; }
    .iti__country-list { z-index: 10050 !important; max-height: 200px !important; }
    
    /* Modern Premium Modal Animations & Backdrop */
    #applicationModal {
      backdrop-filter: blur(8px);
      transition: all 0.3s ease;
    }
    
    .contact-modal-shell {
      border-radius: 24px;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    /* Left Panel: Deep Navy Gradient */
    .contact-offer-panel {
      background: radial-gradient(circle at top left, #18283b 0%, #0f172a 100%);
      position: relative;
    }

    /* Micro-cards with dark glassmorphism styling */
    .premium-micro-card {
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 16px;
      padding: 1.15rem 1rem;
      transition: all 0.25s ease;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .premium-micro-card:hover {
      background: rgba(255, 255, 255, 0.08);
      border-color: rgba(233, 159, 76, 0.4);
      transform: translateY(-2px);
    }

    .contact-label {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: #94a3b8;
      font-weight: 700;
      margin-bottom: 0.35rem;
    }

    .contact-value {
      font-size: 0.9rem;
      line-height: 1.55rem;
      color: #ffffff;
      font-weight: 800;
    }

    .contact-value-highlight {
      color: #e99f4c; /* Amber accent */
    }

    /* Form Fields Premium Styling */
    .premium-input-container {
      position: relative;
    }

    .premium-input {
      width: 100%;
      border: 1.5px solid #e2e8f0;
      background: #f8fafc;
      padding: 0.85rem 1.25rem 0.85rem 2.75rem;
      border-radius: 14px;
      font-size: 1rem;
      color: #0f172a;
      transition: all 0.25s ease;
    }

    .premium-input:focus {
      border-color: #e99f4c;
      background: #ffffff;
      box-shadow: 0 0 0 4px rgba(233, 159, 76, 0.15);
      outline: none;
    }

    .premium-input-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      pointer-events: none;
      transition: color 0.25s ease;
    }

    .premium-input:focus ~ .premium-input-icon {
      color: #e99f4c;
    }

    .premium-submit-btn {
      background: #e99f4c;
      color: #18283b;
      font-weight: 800;
      padding: 1.1rem;
      border-radius: 14px;
      font-size: 1.125rem;
      transition: all 0.3s ease;
      box-shadow: 0 10px 20px -5px rgba(233, 159, 76, 0.35);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      border: none;
    }

    .premium-submit-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 14px 24px -5px rgba(217, 119, 6, 0.45);
      background: #d97706;
      color: #ffffff;
    }

    .premium-submit-btn:active {
      transform: translateY(1px);
    }
  </style>
@endpush

@section('content')

  {{-- HERO SECTION --}}
  <section id="hero" class="hero-dark relative bg-[#18283b] text-white pt-12 pb-16 lg:pt-16 lg:pb-20">
    <div class="hero-glow-top-right"></div>
    <div class="hero-glow-bottom-left"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      
      <div class="hero-grid">
        
        <!-- Left Column: Copy & Value Proposition -->
        <div class="hero-left-content">
          
          <!-- Pill Badge -->
          <div class="hero-badge-pill">
            <span class="hero-badge-dot"></span>
            <span>Festgeld- & Tagesgeldvergleich 2026</span>
          </div>

          <!-- Headline -->
          <h1 class="hero-main-title">
            Festgeld- & Tagesgeldangebote: <br class="hidden sm:block">
            <span class="hero-accent">Die besten Zinsen</span> aus Deutschland und der EU sichern
          </h1>

          <!-- Subtext -->
          <p class="hero-description">
            Vergleichen Sie geprüfte Festgeld- und Tagesgeldkonten renommierter deutscher und europäischer Banken. Profitieren Sie von attraktiven Zinskonditionen und der gesetzlichen Einlagensicherung bis 100.000 € je Kunde.
          </p>

          <!-- CTA Button -->
          <div class="flex flex-wrap items-center gap-4 mb-8">
            <a href="#angebote" class="btn-amber">
              <span>Jetzt Zinsen vergleichen</span>
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
              </svg>
            </a>
            <a href="#vorteile" class="px-6 py-3.5 rounded-lg border border-white/20 text-white font-bold hover:bg-white/10 transition-all text-sm">
              Mehr erfahren
            </a>
          </div>

          <!-- Quick Trust Badges -->
          <div class="grid grid-cols-3 gap-4 pt-4 border-t border-white/10 w-full max-w-lg">
            <div class="flex items-center gap-2">
              <span class="text-[#e99f4c] font-black text-lg">✓</span>
              <span class="text-xs text-slate-300 font-semibold leading-tight">100.000 € EU-Schutz</span>
            </div>
            <div class="flex items-center gap-2">
              <span class="text-[#e99f4c] font-black text-lg">✓</span>
              <span class="text-xs text-slate-300 font-semibold leading-tight">Transparente Tarife</span>
            </div>
            <div class="flex items-center gap-2">
              <span class="text-[#e99f4c] font-black text-lg">✓</span>
              <span class="text-xs text-slate-300 font-semibold leading-tight">100% Kostenfrei</span>
            </div>
          </div>

        </div>

        <!-- Right Column: Hero Advisor Photo (Matching reference top right image) -->
        <div class="relative flex justify-center lg:justify-end">
          <div class="hero-image-frame w-full max-w-md lg:max-w-lg">
            <img src="/images/hero_advisor.png" alt="Finanzberaterin im Kundenservice" class="w-full h-full object-cover">
            <div class="absolute bottom-4 left-4 right-4 bg-[#18283b]/90 backdrop-blur-md p-4 rounded-xl border border-white/15 text-white flex items-center justify-between shadow-xl">
              <div>
                <div class="text-xs font-bold text-[#e99f4c] uppercase tracking-wider">Persönlicher Service</div>
                <div class="text-sm font-extrabold mt-0.5">Kostenfreie & Unverbindliche Beratung</div>
              </div>
              <span class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  {{-- SECTION 2: AMBER INTRO BOX & BENEFITS --}}
  <section id="vorteile" class="py-16 bg-slate-50 border-t border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
        
        <!-- Left Amber Box (Matching left amber container in reference image) -->
        <div class="lg:col-span-5 amber-intro-box flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-xl bg-[#18283b] text-[#e99f4c] flex items-center justify-center font-black text-2xl mb-6 shadow-md">
              ✓
            </div>
            <h2 class="amber-intro-title">
              Unabhängiger Zinsvergleich – Ihre Vorteile auf einen Blick
            </h2>
            <p class="text-[#18283b]/80 font-medium leading-relaxed mb-6">
              Wir vergleichen verlässliche Festgeld- und Tagesgeldkonten europäischer Kreditinstitute, damit Sie Ihr Vermögen sicher und rentabel anlegen können.
            </p>
          </div>

          <div class="space-y-3 pt-6 border-t border-[#18283b]/15">
            <div class="flex items-center gap-3 text-sm font-extrabold text-[#18283b]">
              <span>🛡️</span>
              <span>Gesetzliche Einlagensicherung bis 100.000 €</span>
            </div>
            <div class="flex items-center gap-3 text-sm font-extrabold text-[#18283b]">
              <span>📊</span>
              <span>Transparente Aufstellung aller Konditionen</span>
            </div>
            <div class="flex items-center gap-3 text-sm font-extrabold text-[#18283b]">
              <span>🤝</span>
              <span>100% Kostenfreier Beratungsservice</span>
            </div>
          </div>
        </div>

        <!-- Right Content: Image & Bullet points -->
        <div class="lg:col-span-7 bg-white p-8 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mb-6">
            <div class="rounded-xl overflow-hidden shadow-md h-52">
              <img src="/images/advisor_presentation.png" alt="Finanzberatung Präsentation" class="w-full h-full object-cover">
            </div>
            <div>
              <h3 class="text-xl font-bold text-slate-900 mb-2">Transparenz & Sicherheit</h3>
              <p class="text-sm text-slate-600 leading-relaxed">
                Der Markt für Zinsangebote bewegt sich ständig. Unser Team unterstützt Sie dabei, Angebote objektiv zu bewerten und die ideale Anlageform für Ihre Bedürfnisse zu finden.
              </p>
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-slate-100 pt-6">
            <div class="flex items-start gap-3">
              <span class="w-6 h-6 rounded-full bg-[#fef3c7] text-[#d97706] flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">1</span>
              <div>
                <h4 class="text-sm font-bold text-slate-900">Transparente Konditionen</h4>
                <p class="text-xs text-slate-500 mt-0.5">Alle Kosten und Laufzeiten auf einen Blick übersichtlich dargestellt.</p>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <span class="w-6 h-6 rounded-full bg-[#fef3c7] text-[#d97706] flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">2</span>
              <div>
                <h4 class="text-sm font-bold text-slate-900">Gesetzlicher Schutz</h4>
                <p class="text-xs text-slate-500 mt-0.5">Absicherung durch europäische Einlagensicherungsfonds.</p>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <span class="w-6 h-6 rounded-full bg-[#fef3c7] text-[#d97706] flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">3</span>
              <div>
                <h4 class="text-sm font-bold text-slate-900">Ohne Gebühren</h4>
                <p class="text-xs text-slate-500 mt-0.5">Keine versteckten Entgelte für Vergleiche oder Beratung.</p>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <span class="w-6 h-6 rounded-full bg-[#fef3c7] text-[#d97706] flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">4</span>
              <div>
                <h4 class="text-sm font-bold text-slate-900">Express-Service</h4>
                <p class="text-xs text-slate-500 mt-0.5">Schnelle Bearbeitung Ihrer unverbindlichen Anfrage.</p>
              </div>
            </div>
          </div>

          <div class="mt-6 pt-4 border-t border-slate-100">
            <a href="#angebote" class="btn-amber text-sm py-2.5 px-5">
              <span>Jetzt Angebot anfordern</span>
            </a>
          </div>

        </div>

      </div>

    </div>
  </section>

  {{-- SECTION 3: DARK NAVY QUERY BANNER WITH 3 CARDS --}}
  <section class="navy-query-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-3xl mx-auto mb-12">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white tracking-tight mb-4">
          Welche Festgeldanlage passt zu Ihren individuellen Finanzzielen?
        </h2>
        <p class="text-slate-300 text-sm sm:text-base font-medium">
          Wählen Sie die passende Anlageform je nach gewünschter Laufzeit und Flexibilität.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Card 1 -->
        <div class="navy-query-card">
          <div class="w-12 h-12 rounded-xl bg-[#e99f4c]/20 text-[#e99f4c] flex items-center justify-center font-black text-xl mb-4 border border-[#e99f4c]/30">
            💡
          </div>
          <h3 class="text-lg font-bold text-white mb-2">Flexibles Tagesgeld</h3>
          <p class="text-sm text-slate-300 leading-relaxed font-normal">
            Verhalten Sie volle Verfügbarkeit über Ihr Geld bei täglicher Zinsgutschrift und variabler Verzinsung.
          </p>
        </div>

        <!-- Card 2 -->
        <div class="navy-query-card">
          <div class="w-12 h-12 rounded-xl bg-[#e99f4c]/20 text-[#e99f4c] flex items-center justify-center font-black text-xl mb-4 border border-[#e99f4c]/30">
            🛡️
          </div>
          <h3 class="text-lg font-bold text-white mb-2">Festgeld mit Top-Zinsen</h3>
          <p class="text-sm text-slate-300 leading-relaxed font-normal">
            Sichern Sie sich garantierte Zinsen über feste Laufzeiten von 6 bis 36 Monaten für klare Renditeplanung.
          </p>
        </div>

        <!-- Card 3 -->
        <div class="navy-query-card">
          <div class="w-12 h-12 rounded-xl bg-[#e99f4c]/20 text-[#e99f4c] flex items-center justify-center font-black text-xl mb-4 border border-[#e99f4c]/30">
            🔍
          </div>
          <h3 class="text-lg font-bold text-white mb-2">Persönliche Beratung</h3>
          <p class="text-sm text-slate-300 leading-relaxed font-normal">
            Lassen Sie sich kostenfrei von unseren Anlageexperten unterstützen und maßgeschneiderte Konditionen ermitteln.
          </p>
        </div>

      </div>

    </div>
  </section>

  {{-- SECTION 4: 4-STEP PROCESS --}}
  <section class="py-16 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-3xl mx-auto mb-14">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-3">
          In 4 einfachen Schritten zu Ihrer Geldanlage
        </h2>
        <p class="text-slate-600 font-medium text-sm sm:text-base">
          Der Weg zu Ihren besten Festgeld- und Tagesgeldkonditionen ist transparent und schnell erledigt.
        </p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
        
        <!-- Left Column: Process Photo -->
        <div class="lg:col-span-5">
          <div class="rounded-2xl overflow-hidden shadow-xl border border-slate-200 h-[420px]">
            <img src="/images/advisor_paperwork.png" alt="Finanzanalyse und Unterlagen" class="w-full h-full object-cover">
          </div>
        </div>

        <!-- Right Column: 4 Steps -->
        <div class="lg:col-span-7 space-y-6">
          
          <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-200">
            <div class="step-number">01</div>
            <div>
              <h3 class="text-base font-bold text-slate-900">Kostenlosen Zinsvergleich nutzen</h3>
              <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                Wählen Sie Ihren gewünschten Anlagebetrag und die passende Laufzeit aus unseren geprüften Festgeldtarifen.
              </p>
            </div>
          </div>

          <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-200">
            <div class="step-number">02</div>
            <div>
              <h3 class="text-base font-bold text-slate-900">Unverbindliches Angebot anfordern</h3>
              <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                Fordern Sie Ihr persönliches Zinsangebot mit wenigen Klicks kostenfrei und unverbindlich an.
              </p>
            </div>
          </div>

          <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-200">
            <div class="step-number">03</div>
            <div>
              <h3 class="text-base font-bold text-slate-900">Bequem legitimieren</h3>
              <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                Führen Sie die gesetzlich vorgeschriebene Identitätsprüfung schnell per VideoIdent oder PostIdent durch.
              </p>
            </div>
          </div>

          <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-200">
            <div class="step-number">04</div>
            <div>
              <h3 class="text-base font-bold text-slate-900">Zinsen und Erträge sichern</h3>
              <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                Nach Eröffnung Ihres Kontos wird Ihr Geld mit dem vereinbarten Zinssatz zuverlässig verzinst.
              </p>
            </div>
          </div>

          <div class="pt-4">
            <a href="#angebote" class="btn-amber">
              <span>Jetzt Schritt 1 starten</span>
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
          </div>

        </div>

      </div>

    </div>
  </section>

  {{-- SECTION 5: TRUSTED PARTNER BANK LOGOS BAR --}}
  <section class="py-12 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <p class="text-xs font-extrabold uppercase tracking-widest text-slate-400 mb-8">
        Vergleiche von renommierten Partnerbanken aus ganz Europa
      </p>
      
      <div class="flex flex-wrap items-center justify-center gap-8 sm:gap-12 opacity-80 grayscale hover:grayscale-0 transition-all">
        <div class="font-black text-slate-700 text-xl tracking-tight">FINOM</div>
        <div class="font-black text-slate-700 text-xl tracking-tight">N26</div>
        <div class="font-black text-slate-700 text-xl tracking-tight">Solarisbank</div>
        <div class="font-black text-slate-700 text-xl tracking-tight">Santander</div>
        <div class="font-black text-slate-700 text-xl tracking-tight">Trade Republic</div>
        <div class="font-black text-slate-700 text-xl tracking-tight">Klarna</div>
        <div class="font-black text-slate-700 text-xl tracking-tight">Barclays</div>
      </div>
    </div>
  </section>

  {{-- SECTION 6: FESTGELD OFFERS GRID --}}
  <section id="angebote" class="angebote-section py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="angebote-header">
        <h2 class="angebote-title">Riesige Auswahl an den besten Festgeldkonten für Ihre Finanzen</h2>
        <p class="text-slate-600 font-medium max-w-2xl mx-auto mb-4 text-sm sm:text-base">
          Vergleichen Sie tagesaktuelle Zinskonditionen europäischer Kreditinstitute und sichern Sie sich Ihre Erträge.
        </p>
        <div class="angebote-underline"></div>
      </div>

      <!-- Tiers / Bank Offers Grid -->
      <div class="angebote-grid mb-12">
        @foreach($tiers as $key => $tier)
          @php
            $zinsbetrag = number_format($tier['rate'] * $tier['amount'] / 100 * (12 / 12), 2, ',', '.');
            $rateStr    = number_format($tier['rate'], 2, ',', '.');
            $bankName   = $tier['bank_name'] ?? 'Partnerbank EU';
            $country    = $tier['country'] ?? '🇪🇺 EU-Mitgliedstaat';
          @endphp

          <div class="offer-card border-t-4 border-t-[#e99f4c]">
            <div>
              <!-- Header: Bank logo / name & protection badge -->
              <div class="flex items-center justify-between mb-4 gap-2">
                <div class="flex items-center gap-2.5">
                  @if(!empty($tier['bank_logo']))
                    <div class="w-10 h-10 rounded-lg bg-white p-1 border border-slate-200 flex items-center justify-center shrink-0 shadow-xs">
                      <img src="{{ $tier['bank_logo'] }}" alt="{{ $bankName }}" class="max-w-full max-h-full object-contain">
                    </div>
                  @else
                    <span class="w-9 h-9 rounded-lg bg-slate-100 text-[#18283b] font-black text-base flex items-center justify-center border border-slate-200 shrink-0">
                      🏦
                    </span>
                  @endif
                  <div>
                    <div class="text-xs font-black text-slate-900 leading-tight">{{ $bankName }}</div>
                    <div class="text-[10px] font-bold text-slate-400 mt-0.5">{{ $country }}</div>
                  </div>
                </div>
                <span class="text-[10px] font-extrabold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded shrink-0">
                  🇩🇪 100.000€ Schutz
                </span>
              </div>

              
              <!-- Interest Rate Display with ab / bis zu Prefix -->
              <div class="my-4 offer-rate-badge">
                <div class="text-[#d97706] font-black text-3xl sm:text-4xl tracking-tight">
                  @if(!empty($tier['rate_prefix']))<span class="text-lg font-bold opacity-80 mr-0.5">{{ $tier['rate_prefix'] }}</span>@endif{{ $rateStr }}<span class="text-2xl font-extrabold">%</span>
                </div>
                <div class="text-[10px] uppercase font-black tracking-widest text-slate-500 mt-1">ZINSEN p.a. (Festzins)</div>
              </div>

              <!-- Key Features -->
              <div class="space-y-2.5 border-t border-slate-100 pt-3 text-xs text-slate-600">
                <div class="flex justify-between items-center">
                  <span>Laufzeit:</span>
                  <strong class="text-slate-900 font-bold">12 Monate</strong>
                </div>
                <div class="flex justify-between items-center">
                  <span>Mindestanlage:</span>
                  <strong class="text-slate-900 font-bold">&euro;{{ number_format($tier['amount'], 0, ',', '.') }}</strong>
                </div>
                <div class="flex justify-between items-center">
                  <span>Geschätzter Zinsertrag:</span>
                  <strong class="text-[#d97706] font-black text-sm">&euro;{{ $zinsbetrag }}</strong>
                </div>
              </div>
            </div>

            <div class="mt-6">
              <button type="button" class="offer-btn open-modal-btn"
                data-id="{{ $tier['id'] }}"
                data-bank-id="{{ $tier['bank_id'] }}"
                data-bank-name="{{ $bankName }}"
                data-bank-logo="{{ $tier['bank_logo'] }}"
                data-rate="{{ $tier['rate'] }}"
                data-min-amount="{{ $tier['amount'] }}"
                data-max-amount=""
                data-min-term="12"
                data-max-term="12"
                data-tier="{{ $key }}">
                Konto jetzt vergleichen & anfragen
              </button>
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  {{-- SECTION 7: FAQ & INFORMATION WITH ADVISOR PHOTOS --}}
  <section class="py-16 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
      
      <div class="text-center max-w-3xl mx-auto">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-3">
          Wichtige Informationen zu Ihrer Festgeld-Anlage
        </h2>
        <p class="text-slate-600 font-medium text-sm sm:text-base">
          Hier finden Sie Antworten auf die am häufigsten gestellten Fragen rund um Zinsen, Laufzeiten und Sicherheit.
        </p>
      </div>

      <!-- Item 1: Meeting photo + Text -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        <div class="lg:col-span-5 rounded-2xl overflow-hidden shadow-lg border border-slate-200 h-64 sm:h-80">
          <img src="/images/advisor_meeting.png" alt="Finanzberatung Gespräch" class="w-full h-full object-cover">
        </div>
        <div class="lg:col-span-7 space-y-4">
          <h3 class="text-xl font-bold text-slate-900">Was ist der Unterschied zwischen Festgeld und Tagesgeld?</h3>
          <p class="text-sm text-slate-600 leading-relaxed">
            Beim <strong>Festgeld</strong> legen Sie einen festen Geldbetrag für eine vereinbarte Laufzeit (z. B. 12 oder 24 Monate) an. Der Zinssatz bleibt während der gesamten Laufzeit garantiert unverändert.
          </p>
          <p class="text-sm text-slate-600 leading-relaxed">
            Beim <strong>Tagesgeld</strong> ist Ihr Geld täglich verfügbar. Der Zinssatz ist jedoch variabel und kann sich an Marktzinsschwankungen anpassen.
          </p>
        </div>
      </div>

      <!-- Item 2: Text + Consultation photo -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        <div class="lg:col-span-7 space-y-4 order-2 lg:order-1">
          <h3 class="text-xl font-bold text-slate-900">Wie sicher ist mein Geld bei europäischen Partnerbanken?</h3>
          <p class="text-sm text-slate-600 leading-relaxed">
            Alle Partnerbanken in unserem Zinsvergleich unterliegen der gesetzlichen Einlagensicherung der Europäischen Union. Gemäß EU-Richtlinie sind Guthaben bis zu <strong>100.000 Euro pro Kunde und Bank</strong> vollumfänglich gesetzlich geschützt.
          </p>
          <p class="text-sm text-slate-600 leading-relaxed">
            Zusätzlich werden europäische Finanzinstitute von den jeweiligen nationalen Finanzaufsichtsbehörden streng kontrolliert.
          </p>
        </div>
        <div class="lg:col-span-5 rounded-2xl overflow-hidden shadow-lg border border-slate-200 h-64 sm:h-80 order-1 lg:order-2">
          <img src="/images/advisor_consultation.png" alt="Einlagensicherung Beratung" class="w-full h-full object-cover">
        </div>
      </div>

    </div>
  </section>

  {{-- SECTION 8: BLOG / GUIDE ARTICLES CARDS --}}
  @if(isset($latestPosts) && count($latestPosts) > 0)
    <section class="py-16 bg-slate-50 border-t border-slate-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-12">
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-3">
            Das Finanz-Wissen für Ihre Anlageentscheidungen
          </h2>
          <p class="text-slate-600 font-medium text-sm sm:text-base">
            Aktuelle Ratgeber und Expertenbeiträge rund um Zinsentwicklung, Festgeld und Sparstrategien.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          @foreach($latestPosts as $post)
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
              <div class="p-6">
                <div class="text-xs font-extrabold text-[#d97706] uppercase tracking-wider mb-2">Ratgeber</div>
                <h3 class="text-lg font-bold text-slate-900 mb-3 line-clamp-2">{{ $post->title }}</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed line-clamp-3 mb-4">
                  {{ $post->excerpt ?: strip_tags($post->content) }}
                </p>
              </div>
              <div class="p-6 pt-0 border-t border-slate-100">
                <a href="/blog/{{ $post->slug }}" class="inline-flex items-center gap-1.5 text-xs font-extrabold text-[#18283b] hover:text-[#d97706] transition-colors">
                  <span>Mehr erfahren</span>
                  <span>→</span>
                </a>
              </div>
            </div>
          @endforeach
        </div>

      </div>
    </section>
  @endif

  {{-- APPLICATION MODAL --}}
  <div id="applicationModal"
    class="hidden fixed inset-0 z-[111] overflow-y-auto p-4 items-start justify-center"
    style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(6px);"
    role="dialog"
    aria-modal="true" 
    aria-labelledby="contact-modal-title">
    <div class="contact-modal-backdrop contact-modal-shell w-full max-w-4xl shadow-2xl relative my-auto sm:my-8 bg-white">
      <button type="button" id="closeModal" class="absolute right-4 top-4 z-10 text-slate-400 w-10 h-10 rounded-full border border-slate-200 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-700 transition-all flex items-center justify-center bg-white shadow-md hover:scale-105" aria-label="Schließen">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
      <form id="applicationForm" class="grid grid-cols-1 lg:grid-cols-2">
        <!-- Left Panel: Offer Summary (Dark Navy) -->
        <div class="contact-offer-panel p-6 sm:p-10 flex flex-col justify-between gap-6">
          <div>
            <div class="flex items-center gap-4 mb-6 sm:mb-8 pr-10">
              <div>
                <div id="summary-bank-name" class="text-xl sm:text-2xl font-black text-white leading-tight">festgeld-jetztvergleichen.com</div>
                <div class="text-[10px] font-bold text-[#e99f4c] uppercase tracking-widest mt-0.5" id="summary-bank-sub">Unverbindlicher Zinsvergleich</div>
              </div>
            </div>
          
            <div class="grid grid-cols-2 gap-3 sm:gap-4">
              <div class="premium-micro-card">
                <div class="contact-label">Zinssatz</div>
                <div id="summary-rate" class="contact-value contact-value-highlight">3.50%</div>
              </div>
              <div class="premium-micro-card">
                <div class="contact-label">Laufzeit</div>
                <div id="summary-term" class="contact-value">12 Monate</div>
              </div>
              <div class="premium-micro-card">
                <div class="contact-label">Absicherung</div>
                <div class="contact-value">100.000 €</div>
              </div>
              <div class="premium-micro-card">
                <div class="contact-label">Kosten</div>
                <div class="contact-value contact-value-highlight">0,00 €</div>
              </div>
            </div>
          </div>
          
          <div class="text-[10px] sm:text-xs text-slate-400 leading-relaxed border-t border-white/10 pt-4">
            ✓ 100% Kostenfrei & Unverbindlich<br>
            ✓ Verschlüsselte Datenübertragung
          </div>
        </div>

        <!-- Right Panel: Form Inputs -->
        <div class="bg-white p-6 sm:p-10 flex flex-col justify-center">
          <h2 id="contact-modal-title" class="text-2xl font-extrabold text-slate-900 tracking-tight mb-2">Unverbindliche Anfrage</h2>
          <p class="text-xs sm:text-sm text-slate-500 mb-6">Tragen Sie Ihre Kontaktdaten ein, um ein individuelles Angebot zu erhalten.</p>

          <input type="hidden" id="form-bank-id">
          <input type="hidden" id="form-credit-id">
          <input type="hidden" id="form-requested-amount">
          <input type="hidden" id="form-requested-term">
          <input type="hidden" id="form-additional-notes">

          <div class="space-y-4">
            <div>
              <label class="block text-[10px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Vorname & Nachname</label>
              <div class="premium-input-container">
                <input type="text" id="form-full-name" required placeholder="z.B. Max Mustermann" class="premium-input">
                <span class="premium-input-icon">
                  <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                </span>
              </div>
            </div>

            <div>
              <label class="block text-[10px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Telefonnummer</label>
              <div class="premium-input-container premium-phone-wrapper">
                <input type="tel" id="phone-input" required placeholder="Ihre Telefonnummer" class="premium-input">
              </div>
            </div>

            <div>
              <label class="block text-[10px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">E-Mail-Adresse</label>
              <div class="premium-input-container">
                <input type="email" id="form-email" required placeholder="name@beispiel.de" class="premium-input">
                <span class="premium-input-icon">
                  <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21.05 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                </span>
              </div>
            </div>
          </div>

          <div id="formMessage" class="hidden p-3 rounded-lg text-xs sm:text-sm font-bold mt-4"></div>
          <button type="submit" class="premium-submit-btn w-full mt-6 group">
            <span>Jetzt absenden</span>
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection

@push('scripts')

  <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/intlTelInput.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const modal = document.getElementById('applicationModal');
      const closeModalBtn = document.getElementById('closeModal');
      const applicationForm = document.getElementById('applicationForm');
      let iti = null;

      function formatNumber(num, decimals) {
        decimals = decimals !== undefined ? decimals : 2;
        return Number(num).toLocaleString('de-DE', {
          minimumFractionDigits: decimals,
          maximumFractionDigits: decimals,
        });
      }

      function closeModal() {
        if (!modal) return;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        const msgBox = document.getElementById('formMessage');
        if (msgBox) msgBox.classList.add('hidden');
      }

      // Modal open handlers
      document.querySelectorAll('.open-modal-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const bankName = this.dataset.bankName || 'Festgeld';
          const rateValue = parseFloat(this.dataset.rate) || 3.50;
          const rateLabel = formatNumber(rateValue, 2) + '%';
          const termVal = this.dataset.minTerm || '12';
          const termLabel = termVal + ' Monate';
          const cardAmount = parseFloat(this.dataset.minAmount) || 25000;
          const zinsVal = rateValue * cardAmount / 100 * (parseInt(termVal) / 12);
          const interestAmount = '€' + formatNumber(zinsVal, 2);

          document.getElementById('form-bank-id').value = this.dataset.bankId || '';
          document.getElementById('form-credit-id').value = this.dataset.id || '';
          document.getElementById('form-requested-amount').value = cardAmount;
          document.getElementById('form-requested-term').value = parseInt(termVal) || 12;
          document.getElementById('form-additional-notes').value =
            'Ausgewähltes Angebot: ' + bankName +
            ' | Zinssatz p.a.: ' + rateLabel +
            ' | Laufzeit: ' + termLabel +
            ' | Anlagebetrag: €' + formatNumber(cardAmount, 0) +
            ' | Geschätzter Zinsertrag: ' + interestAmount;

          document.getElementById('summary-rate').textContent = rateLabel;
          document.getElementById('summary-term').textContent = termLabel;
          document.getElementById('summary-bank-name').textContent = bankName;

          modal.classList.remove('hidden');
          modal.classList.add('flex');
          document.body.style.overflow = 'hidden';

          if (!iti) {
            const phoneInput = document.getElementById('phone-input');
            if (phoneInput && window.intlTelInput) {
              iti = window.intlTelInput(phoneInput, {
                initialCountry: 'de',
                countryOrder: ['de', 'ch', 'at', 'it', 'gr', 'fr'],
                separateDialCode: true,
                dropdownContainer: document.body,
                utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/utils.js',
              });
            }
          }
        });
      });

      if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModal);
      }

      window.addEventListener('click', function(e) {
        if (e.target === modal) {
          closeModal();
        }
      });

      if (applicationForm) {
        applicationForm.addEventListener('submit', async function (e) {
          e.preventDefault();

          const submitBtn = applicationForm.querySelector('button[type="submit"]');
          const msgBox    = document.getElementById('formMessage');
          const fullName  = document.getElementById('form-full-name').value.trim();
          const nameParts = fullName.split(/\s+/).filter(Boolean);
          const firstName = nameParts[0] || '';
          const lastName  = nameParts.slice(1).join(' ') || (nameParts[0] || '');

          if (submitBtn) {
            submitBtn.disabled    = true;
            submitBtn.textContent = 'Wird gesendet…';
          }
          if (msgBox) msgBox.classList.add('hidden');

          const phoneEl = document.getElementById('phone-input');
          const fullPhone = iti ? iti.getNumber() : (phoneEl ? phoneEl.value : '');

          const payload = {
            first_name:       firstName,
            last_name:        lastName,
            email:            document.getElementById('form-email').value,
            phone:            fullPhone,
            bank_id:          document.getElementById('form-bank-id').value,
            credit_option_id: document.getElementById('form-credit-id').value,
            requested_amount: parseFloat(document.getElementById('form-requested-amount').value) || 25000,
            requested_term:   parseInt(document.getElementById('form-requested-term').value) || 12,
            additional_notes: document.getElementById('form-additional-notes').value,
          };

          try {
            const res    = await fetch('/api/submit', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify(payload),
            });
            const result = await res.json();

            if (msgBox) {
              msgBox.classList.remove('hidden', 'bg-red-100', 'text-red-800', 'bg-green-100', 'text-green-800');
            }

            if (res.ok && result.success) {
              if (msgBox) {
                msgBox.classList.add('bg-green-100', 'text-green-800');
                msgBox.textContent = result.message || 'Vielen Dank! Ihre Anfrage wurde erfolgreich gesendet.';
              }
              if (typeof gtag_report_conversion === 'function') {
                gtag_report_conversion();
              }
              setTimeout(function () {
                closeModal();
                applicationForm.reset();
                if (iti) { iti.destroy(); iti = null; }
              }, 2000);
            } else {
              if (msgBox) {
                msgBox.classList.add('bg-red-100', 'text-red-800');
                msgBox.textContent = result.message || 'Fehler beim Senden. Bitte versuchen Sie es erneut.';
              }
            }
          } catch (err) {
            if (msgBox) {
              msgBox.classList.remove('hidden');
              msgBox.classList.add('bg-red-100', 'text-red-800');
              msgBox.textContent = 'Ein technischer Fehler ist aufgetreten.';
            }
          }

          if (submitBtn) {
            submitBtn.disabled    = false;
            submitBtn.innerHTML   = '<span>Jetzt absenden</span><svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>';
          }
        });
      }
    });
  </script>
@endpush
