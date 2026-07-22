@extends('layouts.app')

@section('content')

  {{-- PAGE HERO --}}
  <section class="bg-linear-to-br from-blue-950 to-blue-700 text-white py-12 md:py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-10 text-center">
      <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4">Wir sind für Sie da</h1>
      <p class="text-lg text-blue-200 max-w-xl mx-auto">
        Haben Sie Fragen zu unseren BankenOnlineVergleich oder benötigen Sie Unterstützung? Unser Team hilft Ihnen gerne.
      </p>
    </div>
  </section>

  <section class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-10 max-w-6xl">

      {{-- Contact Info Cards --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        @if(config('settings.contact_email'))
          <div class="bg-white shadow-xl rounded-md p-6 text-center border border-gray-100">
            <div class="w-12 h-12 mx-auto bg-blue-50 text-blue-700 rounded flex items-center justify-center mb-4">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-1">E-Mail</h3>
            <p class="text-gray-500 text-sm mb-3">Für allgemeine Anfragen</p>
            <a href="mailto:{{ config('settings.contact_email') }}" class="text-blue-700 font-bold hover:underline text-sm">
              {{ config('settings.contact_email') }}
            </a>
          </div>
        @endif
        @if(config('settings.contact_phone'))
          <div class="bg-white shadow-xl rounded-md p-6 text-center border border-gray-100">
            <div class="w-12 h-12 mx-auto bg-green-50 text-green-700 rounded flex items-center justify-center mb-4">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-1">Telefon</h3>
            <p class="text-gray-500 text-sm mb-3">{{ config('settings.contact_hours', 'Mo-Fr, 09:00 - 18:00 Uhr') }}</p>
            <a href="tel:{{ str_replace(' ', '', config('settings.contact_phone')) }}" class="text-blue-700 font-bold hover:underline text-sm">
              {{ config('settings.contact_phone') }}
            </a>
          </div>
        @endif
        @if(config('settings.contact_address'))
          <div class="bg-white shadow-xl rounded-md p-6 text-center border border-gray-100">
            <div class="w-12 h-12 mx-auto bg-purple-50 text-purple-700 rounded flex items-center justify-center mb-4">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-1">Büro</h3>
            <p class="text-gray-500 text-sm mb-3">Hauptsitz</p>
            <address class="text-gray-700 font-semibold not-italic text-sm">
              @foreach(explode("\n", config('settings.contact_address')) as $line)
                <span class="block">{{ $line }}</span>
              @endforeach
            </address>
          </div>
        @endif
      </div>

      {{-- Contact Form --}}
      <div class="bg-white shadow-xl rounded-md overflow-hidden flex flex-col md:flex-row">
        <div class="w-full md:w-5/12 bg-blue-950 p-8 md:p-12 flex flex-col justify-between">
          <div>
            <h3 class="text-2xl font-bold text-white mb-4">Schreiben Sie uns</h3>
            <p class="text-blue-300 leading-relaxed mb-8">
              Füllen Sie das Formular aus und unser Team meldet sich so schnell wie möglich bei Ihnen.
            </p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2374.872413158487!2d9.995963776693437!3d53.55133607234271!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b18ee114a84499%3A0x600121175658600!2sAlstertor%2015%2C%2020095%20Hamburg%2C%20Germany!5e0!3m2!1sen!2s!4v1721641200000!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p class="text-white mt-4">
              Dennis Missfeldt<br/>
              Alstertor 15<br/>
              20095 Hamburg<br/>
              Deutschland
            </p>
          </div>
          <div class="space-y-5">
            @if(config('settings.contact_hours'))
              <div class="flex items-center gap-3 text-blue-300 text-sm">
                <svg class="w-5 h-5 text-blue-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ config('settings.contact_hours') }}
              </div>
            @endif
            @if(config('settings.company_name'))
              <div class="flex items-center gap-3 text-blue-300 text-sm">
                <svg class="w-5 h-5 text-blue-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><path d="M9 22v-4h6v4"></path><path d="M8 6h.01M16 6h.01M12 6h.01M12 10h.01M12 14h.01M16 10h.01M16 14h.01M8 10h.01M8 14h.01"></path></svg>
                {{ config('settings.company_name') }}
              </div>
            @endif
          </div>
        </div>

        <div class="w-full md:w-7/12 p-8 md:p-12">
          <form class="space-y-5" id="contact-form">
            <div id="form-message" class="hidden p-4 rounded text-sm font-bold"></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Vorname</label>
                <input type="text" id="form-first-name" required
                  class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition" />
              </div>
              <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Nachname</label>
                <input type="text" id="form-last-name" required
                  class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition" />
              </div>
            </div>
            <div>
              <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">E-Mail Adresse</label>
              <input type="email" id="form-email" required
                class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition" />
            </div>
            <div>
              <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Telefonnummer</label>
              <input type="tel" id="form-phone" required
                class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition" />
            </div>
            <div>
              <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Ihre Nachricht</label>
              <textarea rows="4" id="form-message-body" required
                class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition resize-none"></textarea>
            </div>
            {{-- Honeypot: must remain empty --}}
            <input type="text" name="website" id="form-website" autocomplete="off" tabindex="-1"
              aria-hidden="true" style="display:none !important; position:absolute; left:-9999px;">
            <button id="form-submit-btn" type="submit"
              class="bg-linear-to-br from-blue-700 to-blue-900 hover:from-blue-800 hover:to-blue-600 text-white font-bold py-3 px-8 rounded-xs transition flex items-center justify-center gap-2 w-full sm:w-auto disabled:opacity-70">
              <div id="form-submit-loading" class="hidden items-center gap-2">
                <svg class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Senden...
              </div>
              <div id="form-submit-text" class="flex items-center gap-2">
                Nachricht senden
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
              </div>
            </button>
          </form>
        </div>
      </div>

    </div>
  </section>

@endsection

@push('scripts')
<script>
// Record timestamp when form becomes visible so the API can reject bots
window._contactFormTimestamp = Date.now();

document.addEventListener('DOMContentLoaded', function () {
  var form = document.getElementById('contact-form');
  if (!form) return;

  form.addEventListener('submit', async function (e) {
    e.preventDefault();

    var submitBtn     = document.getElementById('form-submit-btn');
    var submitLoading = document.getElementById('form-submit-loading');
    var submitText    = document.getElementById('form-submit-text');
    var messageBox    = document.getElementById('form-message');

    submitBtn.disabled = true;
    submitLoading.classList.remove('hidden');
    submitLoading.classList.add('flex');
    submitText.classList.add('hidden');
    messageBox.classList.add('hidden');

    var payload = {
      full_name:   (document.getElementById('form-first-name').value.trim() + ' ' +
                    document.getElementById('form-last-name').value.trim()).trim(),
      email:       document.getElementById('form-email').value,
      phone:       document.getElementById('form-phone').value,
      message:     document.getElementById('form-message-body').value,
      website:     document.getElementById('form-website').value, // honeypot — stays empty
      _timestamp:  window._contactFormTimestamp || Date.now(),
    };

    try {
      var res    = await fetch('/api/contact', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(payload) });
      var result = await res.json();

      messageBox.classList.remove('hidden', 'bg-red-100', 'text-red-800', 'bg-green-100', 'text-green-800');
      if (res.ok && result.success) {
        messageBox.classList.add('bg-green-100', 'text-green-800');
        messageBox.textContent = result.message || 'Erfolgreich gesendet!';
        form.reset();
      } else {
        messageBox.classList.add('bg-red-100', 'text-red-800');
        messageBox.textContent = result.message || 'Ein Fehler ist aufgetreten.';
      }
    } catch (err) {
      messageBox.classList.remove('hidden');
      messageBox.classList.add('bg-red-100', 'text-red-800');
      messageBox.textContent = 'Ein technischer Fehler ist aufgetreten.';
    }

    submitBtn.disabled = false;
    submitLoading.classList.add('hidden');
    submitLoading.classList.remove('flex');
    submitText.classList.remove('hidden');
  });
});
</script>
@endpush