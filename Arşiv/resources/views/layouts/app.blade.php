<!DOCTYPE html>
<html lang="de" class="min-h-full antialiased selection:bg-primary-200 selection:text-primary-900">

<head>


<script type="text/javascript">
    (function(m,e,t,r,i,k,a){
        m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
    })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=109546968', 'ym');

    ym(109546968, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", referrer: document.referrer, url: location.href, accurateTrackBounce:true, trackLinks:true});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/109546968" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script>
function gtag_report_conversion(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-18185757931/rSk2CICynbccEOvJ0t9D',
      'value': 1.0,
      'currency': 'TRY',
      'event_callback': callback
  });
  return false;
}
</script>


    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NKWKQWGM');</script>
    <!-- End Google Tag Manager -->
    <!--  ClickCease.com tracking-->
      <script type='text/javascript'>var script = document.createElement('script');
      script.async = true; script.type = 'text/javascript';
      var target = 'https://www.clickcease.com/monitor/stat.js';
      script.src = target;var elem = document.head;elem.appendChild(script);
      </script>
	
	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-18185757931">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-18185757931');
</script>
      <noscript>
      <a href='https://www.clickcease.com' rel='nofollow'><img src='https://monitor.clickcease.com' alt='ClickCease'/></a>
      </noscript>
      <!--  ClickCease.com tracking-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Banken Online Vergleich | Top-Zinsen & Sicherheit' }}</title>
    <meta name="description"
        content="{{ $description ?? 'Europas detaillierteste Plattform für Festgeld- und Tagesgeldvergleiche. Analysieren Sie die besten Angebote ve berechnen Sie Ihre Nettorendite.' }}">

    <meta name="google-site-verification" content="mXPYTY-HIoMh3kLgQOVHOPMJRGcvpAyK2jTLsC4E2JM" />
    <meta name="robots" content="index, follow">
<style>
	.table
	{
		display: flex  !important;
    overflow: auto !important;
	}
	</style>

    <meta property="og:title" content="{{ $title ?? 'Festgeld Vergleichen | Top-Zinsen & Sicherheit' }}">
    <meta property="og:description"
        content="{{ $description ?? 'Europas detaillierte Plattform für Festgeld- und Tagesgeldvergleiche.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Festgeld Vergleichen">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="de_DE">

    <link rel="icon" href="/favicon.png">
    <link rel="shortcut icon" href="/favicon.png">
    <link rel="apple-touch-icon" href="/favicon.png">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'Festgeld Vergleichen | Top-Zinsen & Sicherheit' }}">
    <meta name="twitter:description"
        content="{{ $description ?? 'Europas detaillierte Plattform für Festgeld- und Tagesgeldvergleiche.' }}">

    <!-- Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    @unless(request()->is('admin*'))
        @if(config('services.yandex_metrika.counter_id'))
            <script type="text/javascript">
                (function(m,e,t,r,i,k,a){
                    m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                    m[i].l=1*new Date();
                    for (var j = 0; j < document.scripts.length; j++) {
                        if (document.scripts[j].src === r) {
                            return;
                        }
                    }
                    k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a);
                })(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

                ym({{ (int) config('services.yandex_metrika.counter_id') }}, "init", {
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true,
                    webvisor: true
                });
            </script>
        @endif
    @endunless
</head>

<body
    class="flex min-h-full flex-col bg-background text-foreground font-sans {{ request()->is('admin*') ? '!bg-slate-50' : '' }}">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKWKQWGM" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    @unless(request()->is('admin*'))
        @if(config('services.yandex_metrika.counter_id'))
            <noscript>
                <div><img src="https://mc.yandex.ru/watch/{{ (int) config('services.yandex_metrika.counter_id') }}" style="position:absolute; left:-9999px;" alt="" /></div>
            </noscript>
        @endif
    @endunless

    @unless(request()->is('admin*'))
        <!-- Main Navigation -->
        <header class="sticky top-0 z-50 w-full bg-white shadow-lg transition-all">
            <div class="container mx-auto px-4 sm:px-6 lg:px-10">
                <div class="flex h-[68px] sm:h-[80px] items-center justify-between gap-3 sm:gap-6">
                    <a class="shrink-0" href="/">
                        <img src="/logo.png" alt="Festgeld Vergleichen"
                            class="h-9 sm:h-12 w-auto object-contain transition-transform duration-300 hover:scale-[1.02]">
                    </a>

                    <nav class="hidden lg:flex items-center h-full flex-1 justify-center gap-1">
                        <a href="/" class="relative group h-full flex items-center px-4 cursor-pointer">
                            <span class="text-[15px] font-semibold {{ request()->is('/') ? 'text-blue-700' : 'text-blue-600 group-hover:text-white' }} flex items-center gap-1.5 transition-colors">
                                Festgeld
                            </span>
                            <div class="absolute bottom-0 left-0 w-full h-[3px] bg-white rounded-t-full origin-left {{ request()->is('/') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform duration-300"></div>
                        </a>
                        <a href="/tagesgeld" class="relative group h-full flex items-center px-4 cursor-pointer">
                            <span class="text-[15px] font-semibold {{ request()->is('tagesgeld*') ? 'text-blue-700' : 'text-blue-600 group-hover:text-white' }} flex items-center gap-1.5 transition-colors">
                                Tagesgeld
                            </span>
                            <div class="absolute bottom-0 left-0 w-full h-[3px] bg-white rounded-t-full origin-left {{ request()->is('tagesgeld*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform duration-300"></div>
                        </a>
                        <a href="/banken" class="relative group h-full flex items-center px-4 cursor-pointer">
                            <span class="text-[15px] font-semibold {{ request()->is('banken*') ? 'text-blue-700' : 'text-blue-600 group-hover:text-white' }} flex items-center gap-1.5 transition-colors">
                                Banken
                            </span>
                            <div class="absolute bottom-0 left-0 w-full h-[3px] bg-white rounded-t-full origin-left {{ request()->is('banken*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform duration-300"></div>
                        </a>
                   
                        <a href="/kontakt" class="relative group h-full flex items-center px-4 cursor-pointer">
                            <span class="text-[15px] font-semibold {{ request()->is('kontakt*') ? 'text-blue-700' : 'text-blue-600 group-hover:text-white' }} flex items-center gap-1.5 transition-colors">
                                Kontakt
                            </span>
                            <div class="absolute bottom-0 left-0 w-full h-[3px] bg-white rounded-t-full origin-left {{ request()->is('kontakt*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform duration-300"></div>
                        </a>
                       
                    </nav>

                    <div class="flex items-center gap-3 shrink-0">
                        <a href="tel:{{ config('settings.support_phone') }}"
                            class="hidden md:flex items-center gap-1.5 text-blue-700 hover:text-white text-sm font-medium transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            {{ config('settings.support_phone') }}
                        </a>
                        <a href="/#list"
                            class="hidden sm:inline-flex items-center justify-center px-5 h-[40px] rounded text-white bg-blue-900 font-bold text-[14px] hover:bg-blue-50 hover:text-blue-700 transition-all shadow">
                            Festgeld-Vergleich
                        </a>
                        <x-mobile-menu-drawer />
                    </div>
                </div>
            </div>
        </header>
    @endunless

    <!-- Main Content -->
    <main class="flex-1 flex flex-col">
        @yield('content')
    </main>

   @unless(request()->is('admin*'))
        <footer class="footer-bg mt-auto border-t border-blue-900/10">
            <!-- Footer Main Content -->
            <div class="pt-16 pb-12">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                        <!-- Branding & About -->
                        <div class="lg:col-span-1">
                            <img src="/logo.png" alt="Festgeld Deutschland" style="height: 110px; width: auto; object-fit: contain; " class="mb-8 hover:scale-[1.03] transition-transform">
                            <p class="text-sm leading-7 font-medium text-slate-400 mb-6">
                                Unabhängiges Vergleichsportal für Festgeld-Anlagen aus Europa.
                            </p>
                            <div class="flex items-center gap-4">
                                <div class="bg-white/5 border border-white/10 px-4 py-2 rounded-lg flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.9L10 1.554L17.834 4.9c.428.183.712.601.712 1.063a13.035 13.035 0 01-8.546 12.058l-.132.05a1 1 0 01-.736 0l-.132-.05A13.035 13.035 0 011.454 5.963c0-.462.284-.88.712-1.063zM10 4.041L4.413 6.435c.19 3.03 1.258 5.86 2.98 8.163A11.025 11.025 0 0010 16.516c1.018-.54 1.942-1.25 2.607-2.001c1.722-2.303 2.79-5.133 2.98-8.163L10 4.041z" clip-rule="evenodd" /></svg>
                                    <span class="text-xs font-black uppercase tracking-tighter">SSL Secured</span>
                                </div>
                            </div>
                        </div>

                        <!-- Services -->
                        <div>
                            <h3 class="footer-title text-xs font-black mb-8 uppercase tracking-[0.2em]">Vergleiche</h3>
                            <ul class="space-y-4">
                                <li><a href="/" class="footer-link text-[15px] font-bold flex items-center gap-3 transition-all"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>Festgeld Vergleich</a></li>
                                <li><a href="/tagesgeld" class="footer-link text-[15px] font-bold flex items-center gap-3 transition-all"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>Tagesgeld Vergleich</a></li>
                                <li><a href="/banken" class="footer-link text-[15px] font-bold flex items-center gap-3 transition-all"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>Top Banken</a></li>
                                <li><a href="/blog" class="footer-link text-[15px] font-bold flex items-center gap-3 transition-all"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>Finanz-Ratgeber</a></li>
                            </ul>
                        </div>

                        <!-- Company -->
                        <div>
                            <h3 class="footer-title text-xs font-black mb-8 uppercase tracking-[0.2em]">Plattform</h3>
                            <ul class="space-y-4">
                                <li><a href="/kontakt" class="footer-link text-[15px] font-bold transition-all">Kontakt & Support</a></li>
                            </ul>
                        </div>

                        <!-- Legal -->
                        <div>
                            <h3 class="footer-title text-xs font-black mb-8 uppercase tracking-[0.2em]">Rechtliches</h3>
                            <ul class="space-y-4">
                                <li><a href="/impressum" class="footer-link text-[15px] font-bold transition-all">Impressum</a></li>
                                <li><a href="/agb" class="footer-link text-[15px] font-bold transition-all">AGB</a></li>
							 <li><a href="/datenschutz" class="footer-link text-[15px] font-bold transition-all">Datenschutz</a></li>

                            </ul>
                        </div>
                    </div>

                    <!-- Risikohinweis & Legal Disclaimer -->
                    <div class="mt-12 pt-8 border-t border-white/5 text-xs text-slate-400 leading-relaxed space-y-4">
                        <p>
                            <strong>Risikohinweis:</strong> Alle Angaben sind beispielhaft und stellen keine Anlageberatung, Vermittlung oder Empfehlung dar. Tatsächliche Konditionen können je nach Anbieter, Anlagesumme und Marktlage abweichen. Vor jeder Anlageentscheidung empfehlen wir eine Beratung durch einen qualifizierten Finanzdienstleister.
                        </p>
                        <p class="text-slate-500 text-[11px]">
                            Diese Website erbringt keine Finanzberatung oder Anlagevermittlung und ist kein Finanzdienstleister im Sinne von § 34f GewO.
                        </p>
                    </div>

                    <!-- Bottom Bar -->
                    <div class="mt-8 pt-8 border-t border-white/5 flex flex-col lg:flex-row items-center justify-between gap-6">
                        <div class="flex flex-col items-center lg:items-start gap-2">
                            <p class="text-slate-500 text-xs font-semibold">
                                &copy; {{ date('Y') }} {{ parse_url(url('/'), PHP_URL_HOST) }} · Alle Rechte vorbehalten.
                            </p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>
    @endunless

    @stack('scripts')
</body>

</html>