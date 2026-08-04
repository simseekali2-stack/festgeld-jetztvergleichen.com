@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/css/intlTelInput.css">
  <style>
    .iti { width: 100% !important; display: block !important; }
    .iti__flag-container { z-index: 10; }
    .iti--container { z-index: 10000; }
    
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

    /* Left Panel: Deep Slate Blue Gradient with Red Glow */
    .contact-offer-panel {
      background: radial-gradient(circle at top left, #1f1113 0%, #0f172a 100%);
      position: relative;
    }

    /* Micro-cards with dark glassmorphism styling */
    .premium-micro-card {
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid rgba(255, 255, 255, 0.07);
      border-radius: 16px;
      padding: 1.15rem 1rem;
      transition: all 0.25s ease;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .premium-micro-card:hover {
      background: rgba(255, 255, 255, 0.06);
      border-color: rgba(220, 38, 38, 0.4);
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
      color: #f97316; /* orange accent */
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
      border-color: #ea580c;
      background: #ffffff;
      box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.15);
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
      color: #ea580c;
    }

    .premium-submit-btn {
      background: #f97316;
      color: #ffffff;
      font-weight: 700;
      padding: 1.1rem;
      border-radius: 14px;
      font-size: 1.125rem;
      transition: all 0.3s ease;
      box-shadow: 0 10px 20px -5px rgba(249, 115, 22, 0.3);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      border: none;
    }

    .premium-submit-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 12px 24px -5px rgba(249, 115, 22, 0.4);
      background: #ea580c;
    }

    .premium-submit-btn:active {
      transform: translateY(1px);
    }
  </style>
@endpush

@section('content')

  {{-- HERO SECTION --}}
  <section id="hero" class="hero-dark relative pt-12 pb-20 overflow-hidden">
    <div class="hero-glow-top-right"></div>
    <div class="hero-glow-bottom-left"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
      
      <!-- Badge -->
      <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-orange-500/20 bg-orange-50 text-orange-700 text-xs font-extrabold uppercase tracking-wider mb-6 mx-auto shadow-sm">
        <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
        <span>🔥 Live Zins-Ticker 2026</span>
      </div>

      <!-- Headline -->
      <h1 class="text-4xl sm:text-5xl md:text-6xl font-black text-slate-900 tracking-tight leading-tight mb-6">
        Entdecken Sie Europas höchste<br>
        <span class="text-orange-500">Tagesgeldzinsen</span> — jetzt vergleichen
      </h1>

      <!-- Subtext -->
      <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto mb-10 leading-relaxed font-medium">
        Schützen Sie Ihr Kapital mit den attraktivsten Tagesgeld-Konditionen Europas – täglich verfügbar, kostenlos und flexibel.
      </p>

      <!-- Horizontal Calculator (Modular Bar) -->
      <div class="max-w-4xl mx-auto bg-white/95 backdrop-blur-md border border-slate-200 shadow-2xl rounded-2xl p-2 lg:p-3 flex flex-col lg:flex-row items-center divide-y lg:divide-y-0 lg:divide-x divide-slate-200 gap-0 border-t-4 border-t-orange-500">
        
        <!-- Tab indicator or small label (Visual context) -->
        <div class="w-full lg:w-[15%] text-left lg:text-center px-6 py-4 lg:py-0 shrink-0">
          <div class="text-[10px] font-black tracking-widest text-orange-600 uppercase">Option</div>
          <div class="text-sm font-extrabold text-slate-800 mt-0.5">Tagesgeld</div>
        </div>

        <!-- Field 1: Amount -->
        <div class="w-full lg:flex-1 text-left px-6 py-4 lg:py-0">
          <label for="calc-amount" class="block text-[10px] font-black tracking-wider text-slate-400 uppercase mb-1">Anlagebetrag</label>
          <div class="flex items-center">
            <input type="number" id="calc-amount" value="25000" placeholder="25000" class="w-full bg-transparent border-0 outline-none text-slate-800 text-lg font-bold p-0 focus:ring-0">
            <span class="text-slate-400 font-extrabold ml-2">€</span>
          </div>
        </div>

        <!-- Field 2: Preview Yield -->
        <div class="w-full lg:flex-1 text-left px-6 py-4 lg:py-0">
          <label class="block text-[10px] font-black tracking-wider text-slate-400 uppercase mb-1">Jährlicher Zinsertrag</label>
          <div class="flex items-center">
            <span id="calc-result" class="text-orange-600 text-lg font-extrabold">&euro;0,00</span>
            <span class="text-slate-400 font-semibold ml-2 text-xs shrink-0">(Täglich verfügbar)</span>
          </div>
        </div>

        <!-- Button -->
        <div class="w-full lg:w-auto px-6 py-4 lg:py-0 shrink-0 text-center lg:text-right">
          <button type="button" id="compare-btn" class="w-full lg:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 lg:py-3.5 bg-orange-500 hover:bg-orange-600 text-white font-extrabold rounded-xl text-sm shadow-sm transition-all active:scale-[0.98] group">
            <span>Angebote vergleichen</span>
            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
          </button>
        </div>

      </div>

      <!-- Quick note below calculator -->
      <div class="mt-4 text-xs font-semibold text-slate-500 flex items-center justify-center gap-4 flex-wrap">
        <span>✓ Kostenlos & unverbindlich</span>
        <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
        <span>✓ Keine Registrierung erforderlich</span>
        <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
        <span>✓ <a href="{{ url('/') }}" class="text-orange-600 hover:underline">Lieber Festgeld vergleichen?</a></span>
      </div>

    </div>
  </section>

  {{-- AKTUELLE TAGESGELD-ANGEBOTE - Tier Cards --}}
  <section id="list" class="angebote-section">
    <div class="angebote-header">
      <h2 class="angebote-title">Aktuelle Tagesgeld-Angebote</h2>
      <div class="angebote-underline"></div>
    </div>

    <div class="angebote-grid">

      @foreach($tiers as $key => $tier)
        @php
          $zinsbetrag = number_format($tier['rate'] * $tier['amount'] / 100, 2, ',', '.');
          $rateStr    = number_format($tier['rate'], 2, ',', '.');
          $isFirst    = $loop->first;
        @endphp
        <div class="tier-card {{ $isFirst ? 'tier-card--featured' : '' }}"
             style="--tier-color:{{ $tier['color'] }}; --tier-glow:{{ $tier['glow'] }}; --tier-border:{{ $tier['border'] }};">

          {{-- Range --}}
          <div class="tier-range">{{ $tier['range'] }}</div>

          {{-- Rate --}}
          <div class="tier-rate" style="color:var(--tier-color);">
            @if(!empty($tier['rate_prefix']))<span class="tier-rate-prefix">{{ $tier['rate_prefix'] }}</span>@endif{{ $rateStr }}<span class="tier-rate-pct">%</span>
          </div>
          <div class="tier-rate-label">ZINSEN p.a.</div>

          {{-- Details --}}
          <div class="tier-details">
            <div class="tier-detail-row">
              <span class="tier-detail-key">Verfügbarkeit:</span>
              <span class="tier-detail-val">Täglich</span>
            </div>
            <div class="tier-detail-row">
              <span class="tier-detail-key">Anlagebetrag:</span>
              <span class="tier-detail-val">&euro;{{ number_format($tier['amount'], 2, ',', '.') }}</span>
            </div>
            <div class="tier-detail-row">
              <span class="tier-detail-key">Zinsertrag:</span>
              <span class="tier-detail-val" style="color:var(--tier-color);">&euro;{{ $zinsbetrag }}</span>
            </div>
          </div>

          {{-- CTA --}}
          <button type="button" class="tier-btn open-modal-btn"
            data-id="{{ $tier['id'] ?? '' }}"
            data-bank-id="{{ $tier['bank_id'] ?? '' }}"
            data-bank-name="{{ $tier['label'] }}"
            data-bank-logo="{{ $tier['bank_logo'] ?? '' }}"
            data-rate="{{ $tier['rate'] }}"
            data-min-amount="{{ $tier['amount'] }}"
            data-max-amount=""
            data-min-term="0"
            data-max-term="0"
            data-tier="{{ $key }}"
            style="background:var(--tier-color); box-shadow: 0 4px 20px var(--tier-glow);">
            Jetzt Kontakt aufnehmen
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
          </button>
        </div>
      @endforeach

    </div>

    {{-- Feature Badges under interest rate boxes --}}
    <div class="angebote-features">
      <div class="angebote-feature-badge">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        <span>Einlagensicherung bis 1.000.000€</span>
      </div>
      <div class="angebote-feature-badge">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        <span>Kapitalertragssteuerfrei</span>
      </div>
      
    </div>
  </section>

  {{-- NEW SECTION 1: WHY FESTGELD-JETZTVERGLEICHEN (BENEFITS) --}}
  <section class="py-20 bg-slate-50 border-t border-b border-slate-200/60">
    <div class="container mx-auto px-4 max-w-6xl">
      <div class="text-center max-w-2xl mx-auto mb-16">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-4">
          Warum festgeld-jetztvergleichen.com?
        </h2>
        <p class="text-slate-600 font-medium">
          Wir bringen Transparenz, Sicherheit und erstklassige Renditen in Ihre Geldanlage.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Card 1 -->
        <div class="bg-white p-8 rounded-2xl border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
          <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 border border-red-100 flex items-center justify-center mb-6">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          </div>
          <h3 class="text-lg font-bold text-slate-900 mb-3">Maximale Sicherheit</h3>
          <p class="text-sm text-slate-500 leading-relaxed font-medium">
            100% geschützt durch die gesetzliche europäische Einlagensicherung bis zu 100.000 € je Bank und Anleger.
          </p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-8 rounded-2xl border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
          <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 border border-red-100 flex items-center justify-center mb-6">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
          </div>
          <h3 class="text-lg font-bold text-slate-900 mb-3">Top-Konditionen</h3>
          <p class="text-sm text-slate-500 leading-relaxed font-medium">
            Erhalten Sie exklusiven Zugriff auf die höchsten Tages- und Festgeldzinsen aus ganz Europa – ohne Kosten.
          </p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-8 rounded-2xl border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
          <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 border border-red-100 flex items-center justify-center mb-6">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
          </div>
          <h3 class="text-lg font-bold text-slate-900 mb-3">Unabhängiger Vergleich</h3>
          <p class="text-sm text-slate-500 leading-relaxed font-medium">
            Wir vergleichen unabhängig und transparent, um das rentabelste und sicherste Angebot für Sie zu finden.
          </p>
        </div>

        <!-- Card 4 -->
        <div class="bg-white p-8 rounded-2xl border border-slate-200/80 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
          <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 border border-red-100 flex items-center justify-center mb-6">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
          </div>
          <h3 class="text-lg font-bold text-slate-900 mb-3">Kostenloser Service</h3>
          <p class="text-sm text-slate-500 leading-relaxed font-medium">
            Von der Zinsberechnung bis zur Kontoeröffnung stehen wir Ihnen mit persönlichem Service kostenfrei zur Seite.
          </p>
        </div>

      </div>
    </div>
  </section>

  {{-- NEW SECTION 2: EU DEPOSIT INSURANCE (TRUST) --}}
  <section class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-6xl">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        
        <!-- Left text block -->
        <div class="text-left">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-red-500/20 bg-red-500/10 text-red-700 text-[11px] font-extrabold uppercase tracking-wider mb-4">
            EU-Richtlinie
          </div>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-6">
            Ihre Einlagen sind europaweit geschützt
          </h2>
          <p class="text-slate-600 leading-relaxed font-medium mb-6">
            Sicherheit ist das Fundament jeder erfolgreichen Geldanlage. Alle Geldeinlagen bei unseren europäischen Partnerbanken unterliegen der gesetzlichen Einlagensicherung des jeweiligen Landes gemäß den Richtlinien der Europäischen Union.
          </p>
          <p class="text-slate-600 leading-relaxed font-medium mb-8">
            Das bedeutet: Sollte eine Bank wider Erwarten in finanzielle Schwierigkeiten geraten, sind Ihre Ersparnisse bis zu 100.000 € pro Bank und Sparer durch den Staat zu 100 % abgesichert.
          </p>

          <ul class="space-y-4">
            <li class="flex items-center gap-3">
              <span class="w-5 h-5 rounded-full bg-red-100 flex items-center justify-center text-red-600 shrink-0">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
              </span>
              <span class="text-slate-700 font-bold text-[15px]">100.000 € gesetzlicher Schutz je Bank</span>
            </li>
            <li class="flex items-center gap-3">
              <span class="w-5 h-5 rounded-full bg-red-100 flex items-center justify-center text-red-600 shrink-0">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
              </span>
              <span class="text-slate-700 font-bold text-[15px]">Strenge Überwachung durch europäische Aufsichtsbehörden</span>
            </li>
            <li class="flex items-center gap-3">
              <span class="w-5 h-5 rounded-full bg-red-100 flex items-center justify-center text-red-600 shrink-0">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
              </span>
              <span class="text-slate-700 font-bold text-[15px]">Keine Währungsrisiken dank Anlage in Euro (€)</span>
            </li>
          </ul>
        </div>

        <!-- Right visual trust box -->
        <div class="relative flex justify-center lg:justify-end">
          <div class="bg-linear-to-br from-red-950 via-slate-900 to-slate-900 text-white rounded-3xl p-8 sm:p-10 shadow-2xl max-w-md w-full relative overflow-hidden border border-red-900/30">
            <div class="absolute -right-16 -top-16 w-48 h-48 rounded-full bg-red-600/20 blur-3xl"></div>
            
            <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center mb-8 border border-white/10">
              <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>

            <h3 class="text-2xl font-black mb-2 tracking-tight">Einlagensicherung</h3>
            <p class="text-red-300 font-extrabold tracking-widest text-xs uppercase mb-6">100% Gesetzlich Garantiert</p>
            
            <div class="space-y-6 border-t border-white/10 pt-6">
              <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Absicherungssumme</div>
                <div class="text-3xl font-black mt-1 text-white">Bis 100.000 €</div>
                <div class="text-xs text-slate-400 mt-1">pro Sparer und Bank voll geschützt</div>
              </div>

              <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Geltungsbereich</div>
                <div class="text-lg font-extrabold mt-1 text-white">Alle EU-Mitgliedstaaten</div>
                <div class="text-xs text-slate-400 mt-1">Sowie assoziierte europäische Länder</div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- NEW SECTION 3: CALL TO ACTION BLOCK --}}
  <section class="py-16 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(239,68,68,0.1)_0%,transparent_70%)]"></div>
    <div class="container mx-auto px-4 max-w-4xl text-center relative z-10">
      <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">
        Sichern Sie sich heute noch Top-Konditionen
      </h2>
      <p class="text-slate-400 max-w-xl mx-auto mb-8 font-medium leading-relaxed">
        Berechnen Sie Ihre Rendite mit unserem Rechner oben und fordern Sie Ihr unverbindliches Zinsangebot kostenlos an.
      </p>
      
      <a href="#hero" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-linear-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 text-white font-extrabold rounded-full text-[15px] shadow-lg shadow-red-900/40 transition-all hover:-translate-y-0.5 active:translate-y-0">
        <span>Jetzt Zinsen berechnen</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
      </a>
    </div>
  </section>

  {{-- CONTACT MODAL --}}
  <div id="applicationModal"
    class="hidden fixed inset-0 z-[111] overflow-y-auto p-4 items-start justify-center"
    style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px);"
    role="dialog"
    aria-modal="true"
    aria-labelledby="contact-modal-title">
    <div class="contact-modal-backdrop contact-modal-shell w-full max-w-5xl shadow-2xl relative my-auto sm:my-8 bg-white">
      <button type="button" id="closeModal" class="absolute right-4 top-4 z-10 text-slate-400 w-9 h-9 rounded-full border border-slate-200 hover:bg-slate-100 hover:text-slate-700 transition flex items-center justify-center bg-white shadow-xs" aria-label="Schließen">
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
      <form id="applicationForm" class="grid grid-cols-1 lg:grid-cols-2">
        <!-- Left Panel: Offer Summary (Premium Dark Blue) -->
        <div class="contact-offer-panel p-6 sm:p-10 flex flex-col justify-between gap-6">
          <div>
            <div style="display:none;" class="flex items-center gap-4 mb-6 sm:mb-8 pr-10">
              <div class="bg-white rounded-xl p-2 border border-white/10 shadow-lg flex items-center justify-center w-[110px] h-[55px]">
                <img id="summary-bank-logo" src="/logo.svg" alt="Bank Logo"
                  class="max-w-full max-h-full object-contain">
              </div>
              <div>
                <div id="summary-bank-name" class="text-xl sm:text-2xl font-black text-white leading-tight">ING BANK</div>
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5" id="summary-bank-sub">Tagesgeld-Anlage</div>
              </div>
            </div>
         
            <div class="grid grid-cols-2 gap-3 sm:gap-4">
              <div class="premium-micro-card">
                <div class="contact-label">Zinssatz</div>
                <div id="summary-rate" class="contact-value contact-value-highlight">0.00%</div>
              </div>
              <div class="premium-micro-card">
                <div class="contact-label">Laufzeit</div>
                <div id="summary-term" class="contact-value">1 Jahr</div>
              </div>
              <div class="premium-micro-card">
                <div class="contact-label">Zinsbetrag</div>
                <div id="summary-interest" class="contact-value">&euro;0,00</div>
              </div>
              <div class="premium-micro-card">
                <div class="contact-label">Gesamtzahlung</div>
                <div id="summary-total" class="contact-value">&euro;0,00</div>
              </div>
            </div>
          </div>
          
          <div class="text-[10px] sm:text-xs text-slate-400 leading-relaxed border-t border-white/5 pt-4 hidden sm:block">
            * ssl secured. Ihre Daten werden verchlüsselt übertragen. Keine Weitergabe an unbefugte Dritte.
          </div>
        </div>

        <!-- Right Panel: Form Inputs (Modern Light) -->
        <div class="bg-white p-6 sm:p-10 lg:pr-12 flex flex-col justify-center">
          <h2 id="contact-modal-title" class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Unverbindliche Anfrage</h2>
          <p class="text-xs sm:text-sm text-slate-500 mb-6">Bitte füllen Sie das Formular aus, um Ihr exklusives Angebot anzufordern.</p>

          <input type="hidden" id="form-bank-id">
          <input type="hidden" id="form-credit-id">
          <input type="hidden" id="form-requested-amount">
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
                <input type="tel" id="phone-input" placeholder="Ihre Telefonnummer" class="premium-input">
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
          <button type="submit" onclick="gtag_report_conversion()" class="premium-submit-btn w-full mt-6 group">
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

    document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".angebote-grid  ").forEach(section => {
    [...section.children]
      .reverse()
      .forEach(element => section.appendChild(element));
  });
});
</script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {

      let amount = 25000;

      const amountInput = document.getElementById('calc-amount');
      const compareBtn  = document.getElementById('compare-btn');
      const calcResult  = document.getElementById('calc-result');
      const offerCards  = document.querySelectorAll('.offer-card');
      const offersEmpty = document.getElementById('offers-empty');

      function formatNumber(num, decimals) {
        decimals = decimals !== undefined ? decimals : 0;
        return Number(num).toLocaleString('de-DE', {
          minimumFractionDigits: decimals,
          maximumFractionDigits: decimals,
        });
      }

      function updateTierCards() {
        const tierCards = document.querySelectorAll('.tier-card');
        
        let activeTier = 'bronze';
        if (amount >= 75000 && amount < 150000) {
          activeTier = 'gold';
        } else if (amount >= 150000) {
          activeTier = 'plat';
        }

        let activeRate = 2.80;

        tierCards.forEach(function(card) {
          const btn = card.querySelector('.tier-btn');
          if (!btn) return;
          
          let tierKey = btn.dataset.tier;

          const isFeatured = (tierKey === activeTier);
          
          if (isFeatured) {
            card.classList.add('tier-card--featured');
            activeRate = parseFloat(btn.dataset.rate) || 2.80;
          } else {
            card.classList.remove('tier-card--featured');
          }

          let cardAmount = 25000;
          if (tierKey === 'gold') cardAmount = 75000;
          if (tierKey === 'plat') cardAmount = 150000;
          
          if (isFeatured) {
            cardAmount = amount;
          }

          const rate = parseFloat(btn.dataset.rate) || 0;
          const zinsbetrag = rate * cardAmount / 100;

          const valCells = card.querySelectorAll('.tier-detail-val');
          if (valCells.length >= 3) {
            valCells[1].textContent = '\u20AC' + formatNumber(cardAmount, 2);
            valCells[2].textContent = '\u20AC' + formatNumber(zinsbetrag, 2);
          }

          btn.dataset.minAmount = cardAmount;
        });

        if (calcResult) {
          const activeInterest = amount * activeRate / 100;
          calcResult.textContent = '\u20AC' + formatNumber(activeInterest, 2);
        }
      }

      compareBtn.addEventListener('click', function () {
        amount = Math.max(0, parseInt(amountInput.value) || 25000);
        updateTierCards();
        const listSection = document.getElementById('list');
        if (listSection) listSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });

      if (amountInput) {
        amountInput.addEventListener('input', function() {
          amount = Math.max(0, parseInt(this.value) || 0);
          updateTierCards();
        });
      }

      /* Initial render */
      updateTierCards();

      // Modal logic
      const modal           = document.getElementById('applicationModal');
      const closeModalBtn   = document.getElementById('closeModal');
      const applicationForm = document.getElementById('applicationForm');
      const summaryBankLogo = document.getElementById('summary-bank-logo');
      const summaryBankName = document.getElementById('summary-bank-name');
      const summaryBankSub  = document.getElementById('summary-bank-sub');
      const summaryRate     = document.getElementById('summary-rate');
      const summaryInterest = document.getElementById('summary-interest');
      const summaryTerm     = document.getElementById('summary-term');
      const summaryTotal    = document.getElementById('summary-total');
      let iti = null;

      document.querySelectorAll('.open-modal-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
          const bankName = btn.dataset.bankName || 'Bank';
          const bankLogo = btn.dataset.bankLogo || '/logo.svg';
          const rateValue = parseFloat(btn.dataset.rate) || 0;
          const rateLabel = formatNumber(rateValue, 2) + '% p.a.';
          
          const cardAmount = parseFloat(btn.dataset.minAmount) || amount;
          const zinsVal = rateValue * cardAmount / 100;
          const interestAmount = '\u20AC' + formatNumber(zinsVal, 2);
          const totalValue = cardAmount + zinsVal;

          document.getElementById('form-bank-id').value          = btn.dataset.bankId || '';
          document.getElementById('form-credit-id').value        = btn.dataset.id     || '';
          document.getElementById('form-requested-amount').value = cardAmount;
          document.getElementById('form-additional-notes').value =
            'Ausgewaehltes Angebot: ' + bankName +
            ' | Zinssatz p.a.: ' + rateLabel +
            ' | Zinsbetrag p.a.: ' + interestAmount +
            ' | Anlagebetrag: ' + ('\u20AC' + formatNumber(cardAmount, 2)) +
            ' | Verfuegbarkeit: Taeglich verfuegbar';

          summaryBankLogo.src = bankLogo;
          summaryBankLogo.alt = bankName + ' Logo';
          summaryBankName.textContent = bankName;
          if (summaryBankSub) summaryBankSub.textContent = 'Tagesgeld-Anlage';
          summaryRate.textContent = rateLabel;
          summaryInterest.textContent = interestAmount;
          summaryTerm.textContent = '1 Jahr';
          summaryTotal.textContent = '\u20AC' + formatNumber(totalValue, 2);

          modal.classList.remove('hidden');
          modal.classList.add('flex');
          document.body.style.overflow = 'hidden';

          if (!iti) {
            iti = window.intlTelInput(document.getElementById('phone-input'), {
              initialCountry: 'de',
              countryOrder: ['de', 'ch', 'at', 'it', 'gr', 'fr'],
              separateDialCode: true,
              dropdownContainer: document.body,
              utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/utils.js',
            });
          }
        });
      });

      function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        document.getElementById('formMessage').classList.add('hidden');
      }

      closeModalBtn.addEventListener('click', closeModal);
      modal.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
      });

      applicationForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const submitBtn = applicationForm.querySelector('button[type="submit"]');
        const msgBox    = document.getElementById('formMessage');
        const fullName  = document.getElementById('form-full-name').value.trim();
        const nameParts = fullName.split(/\s+/).filter(Boolean);
        const firstName = nameParts[0] || '';
        const lastName  = nameParts.slice(1).join(' ') || (nameParts[0] || '');

        submitBtn.disabled    = true;
        submitBtn.textContent = 'Wird gesendet\u2026';
        msgBox.classList.add('hidden');

        const fullPhone = iti ? iti.getNumber() : document.getElementById('phone-input').value;

        const payload = {
          first_name:       firstName,
          last_name:        lastName,
          email:            document.getElementById('form-email').value,
          phone:            fullPhone,
          bank_id:          document.getElementById('form-bank-id').value,
          credit_option_id: document.getElementById('form-credit-id').value,
          requested_amount: amount,
          requested_term: 1,
          additional_notes: document.getElementById('form-additional-notes').value,
        };

        try {
          const res    = await fetch('/api/submit', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload),
          });
          const result = await res.json();

          msgBox.classList.remove('hidden', 'bg-red-100', 'text-red-800', 'bg-green-100', 'text-green-800');

          if (res.ok && result.success) {
            msgBox.classList.add('bg-green-100', 'text-green-800');
            msgBox.textContent = result.message || 'Erfolgreich gesendet!';
            setTimeout(function () {
              closeModal();
              applicationForm.reset();
              if (iti) { iti.destroy(); iti = null; }
            }, 2000);
          } else {
            msgBox.classList.add('bg-red-100', 'text-red-800');
            msgBox.textContent = result.message || 'Fehler!';
          }
        } catch (err) {
          msgBox.classList.remove('hidden');
          msgBox.classList.add('bg-red-100', 'text-red-800');
          msgBox.textContent = 'Ein technischer Fehler ist aufgetreten.';
        }

        submitBtn.disabled    = false;
        submitBtn.textContent = 'Anfrage senden';
      });

      updateTierCards();
    });
  </script>
@endpush
