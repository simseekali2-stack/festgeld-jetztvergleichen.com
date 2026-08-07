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

    <title>{{ $title ?? 'festgeld-jetztvergleichen.com | Top-Zinsen & Sicherheit' }}</title>
    <meta name="description"
        content="{{ $description ?? 'festgeld-jetztvergleichen.com — Europäische Plattform für Festgeld- und Tagesgeldvergleiche. Analysieren Sie die besten Angebote und berechnen Sie Ihre Nettorendite.' }}">

    <meta name="google-site-verification" content="mXPYTY-HIoMh3kLgQOVHOPMJRGcvpAyK2jTLsC4E2JM" />
    <meta name="robots" content="index, follow">
<style>
	.table
	{
		display: flex  !important;
    overflow: auto !important;
	}
	</style>

    <meta property="og:title" content="{{ $title ?? 'festgeld-jetztvergleichen.com | Top-Zinsen & Sicherheit' }}">
    <meta property="og:description"
        content="{{ $description ?? 'festgeld-jetztvergleichen.com — Europäische Plattform für Festgeld- und Tagesgeldvergleiche. Analysieren Sie die besten Angebote ve berechnen Sie Ihre Nettorendite.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="festgeld-jetztvergleichen.com">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="de_DE">

    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="shortcut icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="apple-touch-icon" type="image/svg+xml" href="/favicon.svg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'festgeld-jetztvergleichen.com | Top-Zinsen & Sicherheit' }}">
    <meta name="twitter:description"
        content="{{ $description ?? 'festgeld-jetztvergleichen.com — Europäische Plattform für Festgeld- und Tagesgeldvergleiche.' }}">

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
        <!-- Main Navigation (Dark Navy & Amber theme) -->
        <header class="sticky top-0 z-50 w-full bg-[#18283b]/95 backdrop-blur-md border-b border-white/10 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex h-[72px] items-center justify-between gap-4 w-full">
                    
                    <!-- Left: Brand / Logo -->
                    <div class="flex items-center shrink-0">
                        <a class="flex items-center gap-3 group" href="/">
                            <img src="/logo.svg" alt="festgeld-jetztvergleichen.com" class="h-10 sm:h-12 w-auto object-contain transition-transform group-hover:scale-105">
                        </a>
                    </div>

                    <!-- Center: Navigation Links -->
                    <nav class="hidden lg:flex items-center gap-2 mx-auto">
                        <a href="/" class="py-2 px-4 rounded-lg font-bold text-sm transition-all {{ request()->is('/') ? 'bg-white/10 text-[#e99f4c]' : 'text-slate-200 hover:text-white hover:bg-white/5' }}">
                            Festgeld
                        </a>
                        <a href="/tagesgeld" class="py-2 px-4 rounded-lg font-bold text-sm transition-all {{ request()->is('tagesgeld*') ? 'bg-white/10 text-[#e99f4c]' : 'text-slate-200 hover:text-white hover:bg-white/5' }}">
                            Tagesgeld
                        </a>
                        <a href="/banken" class="py-2 px-4 rounded-lg font-bold text-sm transition-all {{ request()->is('banken*') ? 'bg-white/10 text-[#e99f4c]' : 'text-slate-200 hover:text-white hover:bg-white/5' }}">
                            Partnerbanken
                        </a>
                        <a href="/kontakt" class="py-2 px-4 rounded-lg font-bold text-sm transition-all {{ request()->is('kontakt*') ? 'bg-white/10 text-[#e99f4c]' : 'text-slate-200 hover:text-white hover:bg-white/5' }}">
                            Kontakt
                        </a>
                    </nav>

                    <!-- Right: Amber CTA -->
                    <div class="flex items-center justify-end gap-3 shrink-0">
                        <a href="#hero"
                            class="hidden sm:inline-flex items-center justify-center px-5 py-2.5 rounded-lg text-[#18283b] bg-[#e99f4c] hover:bg-[#d97706] hover:text-white font-black text-sm transition-all shadow-md shadow-[#e99f4c]/20 active:scale-95">
                            Kostenlos anfragen
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
        <div id="mobile-menu-container" class="lg:hidden fixed inset-0 z-[10050] pointer-events-auto" style="display: none;">
            
            <!-- Backdrop -->
            <button
                type="button"
                id="mobile-menu-backdrop"
                class="absolute inset-0 z-0 bg-slate-900/45 backdrop-blur-[3px] w-full h-full transition-opacity duration-250 opacity-0"
                aria-label="Menü schließen"
            ></button>

            <!-- Panel -->
            <aside
                id="mobile-nav-drawer"
                class="absolute inset-y-0 right-0 z-[1] flex w-[min(100%,21rem)] max-w-[100vw] flex-col bg-white shadow-[-12px_0_48px_-12px_rgba(15,23,42,0.2)] transition-transform duration-300 translate-x-full"
                role="dialog"
                aria-modal="true"
                aria-label="Navigation"
            >
                <!-- Header strip -->
                <div class="flex items-center justify-between gap-3 border-b border-slate-100 bg-linear-to-br from-slate-50 to-white px-4 py-3">
                    <div class="flex-1 min-w-0">
                        <img src="/logo.svg" alt="festgeld-jetztvergleichen.com" class="h-9 w-auto object-contain max-w-full">
                    </div>
                    <button
                        type="button"
                        class="mobile-menu-close-btn flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:bg-slate-50 hover:text-slate-900"
                        aria-label="Schließen"
                    >
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Links -->
                <nav class="flex-1 overflow-y-auto overscroll-contain px-3 py-4">
                    <ul class="flex flex-col gap-2">
                        <!-- Festgeld -->
                        <li>
                            <a href="/" class="mobile-menu-close-btn group flex items-center gap-3 rounded-2xl border px-3 py-3.5 transition {{ request()->is('/') ? 'border-blue-200 bg-blue-50/60 shadow-sm' : 'border-transparent bg-transparent hover:border-slate-100 hover:bg-slate-50' }}">
                                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-linear-to-br {{ request()->is('/') ? 'from-blue-600 to-indigo-600 text-white' : 'from-slate-100 to-slate-200 text-slate-500' }} shadow-md">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="5" x2="5" y2="19"></line><circle cx="6.5" cy="6.5" r="2.5"></circle><circle cx="17.5" cy="17.5" r="2.5"></circle></svg>
                                </span>
                                <span class="min-w-0 flex-1">
                                    <span class="block text-[15px] font-black leading-tight {{ request()->is('/') ? 'text-blue-900' : 'text-slate-900' }}">Festgeld</span>
                                    <span class="mt-0.5 block text-[11px] font-medium text-slate-500">Zinsvergleich & Rechner</span>
                                </span>
                                <svg class="h-5 w-5 shrink-0 transition group-hover:translate-x-0.5 group-hover:text-blue-600 {{ request()->is('/') ? 'text-blue-500' : 'text-slate-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </a>
                        </li>

                        <!-- Tagesgeld -->
                        <li>
                            <a href="/tagesgeld" class="mobile-menu-close-btn group flex items-center gap-3 rounded-2xl border px-3 py-3.5 transition {{ request()->is('tagesgeld*') ? 'border-blue-200 bg-blue-50/60 shadow-sm' : 'border-transparent bg-transparent hover:border-slate-100 hover:bg-slate-50' }}">
                                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-linear-to-br {{ request()->is('tagesgeld*') ? 'from-blue-600 to-indigo-600 text-white' : 'from-slate-100 to-slate-200 text-slate-500' }} shadow-md">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="5" x2="5" y2="19"></line><circle cx="6.5" cy="6.5" r="2.5"></circle><circle cx="17.5" cy="17.5" r="2.5"></circle></svg>
                                </span>
                                <span class="min-w-0 flex-1">
                                    <span class="block text-[15px] font-black leading-tight {{ request()->is('tagesgeld*') ? 'text-blue-900' : 'text-slate-900' }}">Tagesgeld</span>
                                    <span class="mt-0.5 block text-[11px] font-medium text-slate-500">Zinsvergleich & Rechner</span>
                                </span>
                                <svg class="h-5 w-5 shrink-0 transition group-hover:translate-x-0.5 group-hover:text-blue-600 {{ request()->is('tagesgeld*') ? 'text-blue-500' : 'text-slate-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </a>
                        </li>

                        <!-- Einlagenbanken -->
                        <li>
                            <a href="/#einlagebanken-liste" class="mobile-menu-close-btn group flex items-center gap-3 rounded-2xl border px-3 py-3.5 transition border-transparent bg-transparent hover:border-slate-100 hover:bg-slate-50">
                                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-linear-to-br from-slate-100 to-slate-200 text-slate-500 shadow-md">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="22" x2="21" y2="22"></line><line x1="6" y1="18" x2="6" y2="11"></line><line x1="10" y1="18" x2="10" y2="11"></line><line x1="14" y1="18" x2="14" y2="11"></line><line x1="18" y1="18" x2="18" y2="11"></line><polygon points="12 2 20 7 4 7"></polygon></svg>
                                </span>
                                <span class="min-w-0 flex-1">
                                    <span class="block text-[15px] font-black leading-tight text-slate-900">Einlagenbanken</span>
                                    <span class="mt-0.5 block text-[11px] font-medium text-slate-500">Top-Konditionen</span>
                                </span>
                                <svg class="h-5 w-5 shrink-0 transition group-hover:translate-x-0.5 group-hover:text-blue-600 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </a>
                        </li>
                        <li>
                            <a href="/datenschutz" class="mobile-menu-close-btn group flex items-center gap-3 rounded-2xl border px-3 py-3.5 transition {{ request()->is('datenschutz*') ? 'border-blue-200 bg-blue-50/60 shadow-sm' : 'border-transparent bg-transparent hover:border-slate-100 hover:bg-slate-50' }}">
                                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-linear-to-br {{ request()->is('datenschutz*') ? 'from-blue-600 to-indigo-600 text-white' : 'from-slate-100 to-slate-200 text-slate-500' }} shadow-md">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                                </span>
                                <span class="min-w-0 flex-1">
                                    <span class="block text-[15px] font-black leading-tight {{ request()->is('datenschutz*') ? 'text-blue-900' : 'text-slate-900' }}">Datenschutz</span>
                                    <span class="mt-0.5 block text-[11px] font-medium text-slate-500">Datenschutzerklärung</span>
                                </span>
                                <svg class="h-5 w-5 shrink-0 transition group-hover:translate-x-0.5 group-hover:text-blue-600 {{ request()->is('datenschutz*') ? 'text-blue-500' : 'text-slate-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </a>
                        </li>
                        <li>
                            <a href="/impressum" class="mobile-menu-close-btn group flex items-center gap-3 rounded-2xl border px-3 py-3.5 transition {{ request()->is('impressum*') ? 'border-blue-200 bg-blue-50/60 shadow-sm' : 'border-transparent bg-transparent hover:border-slate-100 hover:bg-slate-50' }}">
                                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-linear-to-br {{ request()->is('impressum*') ? 'from-blue-600 to-indigo-600 text-white' : 'from-slate-100 to-slate-200 text-slate-500' }} shadow-md">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                </span>
                                <span class="min-w-0 flex-1">
                                    <span class="block text-[15px] font-black leading-tight {{ request()->is('impressum*') ? 'text-blue-900' : 'text-slate-900' }}">Impressum</span>
                                    <span class="mt-0.5 block text-[11px] font-medium text-slate-500">Rechtliche Hinweise</span>
                                </span>
                                <svg class="h-5 w-5 shrink-0 transition group-hover:translate-x-0.5 group-hover:text-blue-600 {{ request()->is('impressum*') ? 'text-blue-500' : 'text-slate-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </a>
                        </li>
                    </ul>

                    <!-- CTA -->
                    <a
                        href="/#einlagebanken-liste"
                        class="mobile-menu-close-btn mt-5 flex w-full items-center justify-center gap-2 rounded-2xl bg-linear-to-r from-blue-600 to-indigo-600 px-4 py-4 text-[15px] font-extrabold text-white shadow-lg shadow-blue-600/25 transition hover:opacity-95 active:scale-[0.98]"
                    >
                        Jetzt vergleichen
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </a>



                    <!-- Legal mini -->
                    <div class="mt-6 flex flex-wrap gap-x-4 gap-y-2 border-t border-slate-100 pt-4 text-[11px] font-semibold text-slate-500">
                        <a href="/impressum" class="mobile-menu-close-btn hover:text-blue-600">Impressum</a>
                        <a href="/datenschutz" class="mobile-menu-close-btn hover:text-blue-600">Datenschutz</a>
                        <a href="/agb" class="mobile-menu-close-btn hover:text-blue-600">AGB</a>
                    </div>
                </nav>
            </aside>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openBtn = document.getElementById('mobile-menu-open-btn');
            const container = document.getElementById('mobile-menu-container');
            const backdrop = document.getElementById('mobile-menu-backdrop');
            const drawer = document.getElementById('mobile-nav-drawer');
            const closeBtns = document.querySelectorAll('.mobile-menu-close-btn');

            function openMenu() {
                container.style.display = 'block';
                // force reflow
                void container.offsetWidth;
                
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
                
                drawer.classList.remove('translate-x-full');
                drawer.classList.add('translate-x-0');
                
                document.body.style.overflow = 'hidden';
                if (openBtn) openBtn.setAttribute('aria-expanded', 'true');
            }

            function closeMenu() {
                backdrop.classList.remove('opacity-100');
                backdrop.classList.add('opacity-0');
                
                drawer.classList.remove('translate-x-0');
                drawer.classList.add('translate-x-full');
                
                setTimeout(() => {
                    container.style.display = 'none';
                    document.body.style.overflow = '';
                    if (openBtn) openBtn.setAttribute('aria-expanded', 'false');
                }, 300); // match transition duration
            }

            if (openBtn) {
                openBtn.addEventListener('click', openMenu);
            }
            
            if (backdrop) {
                backdrop.addEventListener('click', closeMenu);
            }

            closeBtns.forEach(btn => {
                btn.addEventListener('click', closeMenu);
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && container.style.display === 'block') {
                    closeMenu();
                }
            });
        });
        </script>
    @endunless

   @unless(request()->is('admin*'))
        <footer class="footer-bg mt-auto border-t border-slate-200/80 bg-slate-950 text-white">
            <!-- Footer Main Content -->
            <div class="pt-16 pb-12">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                        <!-- Branding & About -->
                        <div class="lg:col-span-1">
                            <img src="/logo.svg" alt="festgeld-jetztvergleichen.com" style="height: 52px; width: auto; object-fit: contain; " class="mb-6 hover:scale-[1.02] transition-transform">
                            <p class="text-xs leading-6 font-medium text-slate-400 mb-6">
                                festgeld-jetztvergleichen.com ist Ihr unabhängiges Vergleichsportal für erstklassige Tagesgeld- und Festgeld-Anlagen aus ganz Europa.
                            </p>
                            <div class="flex items-center gap-4">
                                <div class="bg-white/5 border border-white/10 px-3.5 py-2 rounded-xl flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.9L10 1.554L17.834 4.9c.428.183.712.601.712 1.063a13.035 13.035 0 01-8.546 12.058l-.132.05a1 1 0 01-.736 0l-.132-.05A13.035 13.035 0 011.454 5.963c0-.462.284-.88.712-1.063zM10 4.041L4.413 6.435c.19 3.03 1.258 5.86 2.98 8.163A11.025 11.025 0 0010 16.516c1.018-.54 1.942-1.25 2.607-2.001c1.722-2.303 2.79-5.133 2.98-8.163L10 4.041z" clip-rule="evenodd" /></svg>
                                    <span class="text-xs font-black uppercase tracking-wider text-slate-300">SSL Secured</span>
                                </div>
                            </div>
                        </div>

                        <!-- Services -->
                        <div>
                            <h3 class="footer-title text-xs font-black mb-8 uppercase tracking-[0.2em] text-slate-300">Vergleiche</h3>
                            <ul class="space-y-4">
                                <li><a href="/" class="footer-link text-[14px] font-bold flex items-center gap-2.5 text-slate-400 hover:text-blue-400 transition-all"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>Festgeld</a></li>
                                <li><a href="/tagesgeld" class="footer-link text-[14px] font-bold flex items-center gap-2.5 text-slate-400 hover:text-blue-400 transition-all"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>Tagesgeld</a></li>
                            </ul>
                        </div>

                        <!-- Company -->
                        <div>
                            <h3 class="footer-title text-xs font-black mb-8 uppercase tracking-[0.2em] text-slate-300">Unternehmen</h3>
                            <ul class="space-y-4">
                                <li><a href="/kontakt" class="footer-link text-[14px] font-bold text-slate-400 hover:text-blue-400 transition-all">Kontakt</a></li>
                            </ul>
                        </div>

                        <!-- Legal -->
                        <div>
                            <h3 class="footer-title text-xs font-black mb-8 uppercase tracking-[0.2em] text-slate-300">Rechtliches</h3>
                            <ul class="space-y-4">
                                <li><a href="/impressum" class="footer-link text-[14px] font-bold text-slate-400 hover:text-blue-400 transition-all">Impressum</a></li>
                                <li><a href="/agb" class="footer-link text-[14px] font-bold text-slate-400 hover:text-blue-400 transition-all">AGB</a></li>
							 <li><a href="/datenschutz" class="footer-link text-[14px] font-bold text-slate-400 hover:text-blue-400 transition-all">Datenschutz</a></li>

                            </ul>
                        </div>
                    </div>

                    <!-- Risikohinweis & Legal Disclaimer -->
                    <div class="mt-12 pt-8 border-t border-white/10 text-xs text-slate-400 leading-relaxed space-y-4">
                        <p>
                            <strong>Risikohinweis:</strong> Alle Angaben auf festgeld-jetztvergleichen.com sind beispielhaft und stellen keine Anlageberatung, Vermittlung oder Empfehlung dar. Tatsächliche Konditionen können je nach Anbieter, Anlagesumme und Marktlage abweichen. Vor jeder Anlageentscheidung empfehlen wir eine Beratung durch einen qualifizierten Finanzdienstleister.
                        </p>
                        <p class="text-slate-500 text-[11px]">
                            Die Betreiberin ist selbstständige Finanzanlagenvermittlerin mit einer Erlaubnis nach § 34f Abs. 1 GewO.
                        </p>
                    </div>

                    <!-- Bottom Bar -->
                    <div class="mt-8 pt-8 border-t border-white/10 flex flex-col lg:flex-row items-center justify-between gap-6">
                        <div class="flex flex-col items-center lg:items-start gap-2">
                            <p class="text-slate-400 text-xs font-semibold">
                                &copy; {{ date('Y') }} festgeld-jetztvergleichen.com · Alle Rechte vorbehalten.
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
