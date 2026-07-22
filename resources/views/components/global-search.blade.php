<div id="global-search-wrapper">
    <!-- Arama Butonu -->
    <button
        id="global-search-open-btn"
        class="flex items-center justify-center w-[42px] h-[42px] sm:w-[46px] sm:h-[46px] rounded-full bg-slate-50 border border-slate-200/80 text-slate-500 hover:bg-slate-100 hover:text-primary-600 transition-all shadow-sm hover:shadow"
        aria-label="Suche öffnen"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
    </button>

    <!-- Modal Portal/Overlay -->
    <div id="global-search-container" class="fixed inset-0 z-[9999]" style="display: none;">
        <!-- Backdrop -->
        <button
            id="global-search-backdrop"
            class="absolute inset-0 bg-slate-900/45 backdrop-blur-md w-full h-full cursor-default transition-opacity duration-300 opacity-0"
            aria-label="Suche schließen"
        ></button>

        <!-- Arama Kutusu -->
        <div 
            id="global-search-modal"
            class="absolute inset-x-0 top-0 pt-16 px-3 sm:px-6 lg:px-8 transition-all duration-200 opacity-0 translate-y-4"
        >
            <div class="mx-auto w-full max-w-4xl rounded-3xl bg-white border border-slate-200 shadow-[0_20px_60px_-20px_rgba(2,6,23,0.45)] overflow-hidden">
                <!-- Arama Input -->
                <div class="flex items-center gap-3 border-b border-slate-100 px-4 sm:px-6 py-4">
                    <svg class="w-5 h-5 text-slate-400 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input
                        id="global-search-input"
                        placeholder="Blog und Services durchsuchen..."
                        class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 font-semibold text-sm sm:text-base focus:outline-none"
                    />
                    <button
                        id="global-search-close-btn"
                        class="w-8 h-8 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-slate-700 flex items-center justify-center"
                        aria-label="Schließen"
                    >
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Sonuçlar -->
                <div class="max-h-[70vh] overflow-y-auto p-4 sm:p-6 space-y-6" id="global-search-results">
                    <div id="global-search-initial" class="text-sm text-slate-500 font-medium">
                        Beginnen Sie mit der Eingabe, um Blogbeiträge und Services zu durchsuchen.
                    </div>
                    <div id="global-search-loading" class="text-sm font-semibold text-slate-500 hidden">
                        Inhalte werden geladen...
                    </div>
                    <div id="global-search-content" class="hidden">
                        <!-- Blog Sonuçları -->
                        <section class="mb-6">
                            <h3 class="text-[11px] font-black uppercase tracking-widest text-slate-500 mb-3 inline-flex items-center gap-2">
                                <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                Blog
                            </h3>
                            <div id="global-search-blog-list" class="space-y-2 hidden"></div>
                            <p id="global-search-blog-empty" class="text-sm text-slate-400 hidden">Keine Blog-Treffer.</p>
                        </section>

                        <!-- Service Sonuçları -->
                        <section>
                            <h3 class="text-[11px] font-black uppercase tracking-widest text-slate-500 mb-3 inline-flex items-center gap-2">
                                <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                Services
                            </h3>
                            <div id="global-search-service-list" class="space-y-2 hidden"></div>
                            <p id="global-search-service-empty" class="text-sm text-slate-400 hidden">Keine Service-Treffer.</p>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.getElementById('global-search-open-btn');
    const closeBtn = document.getElementById('global-search-close-btn');
    const container = document.getElementById('global-search-container');
    const backdrop = document.getElementById('global-search-backdrop');
    const modal = document.getElementById('global-search-modal');
    const input = document.getElementById('global-search-input');
    
    const initialText = document.getElementById('global-search-initial');
    const loadingText = document.getElementById('global-search-loading');
    const contentArea = document.getElementById('global-search-content');
    
    const blogList = document.getElementById('global-search-blog-list');
    const blogEmpty = document.getElementById('global-search-blog-empty');
    const serviceList = document.getElementById('global-search-service-list');
    const serviceEmpty = document.getElementById('global-search-service-empty');

    let blogs = [];
    let services = [];
    let fetched = false;

    async function fetchData() {
        loadingText.classList.remove('hidden');
        initialText.classList.add('hidden');
        contentArea.classList.add('hidden');
        
        try {
            const [blogRes, serviceRes] = await Promise.all([
                fetch('/api/blog'),
                fetch('/api/services')
            ]);
            
            if (blogRes.ok) {
                const bData = await blogRes.json();
                blogs = Array.isArray(bData?.data) ? bData.data : [];
            }
            if (serviceRes.ok) {
                const sData = await serviceRes.json();
                services = Array.isArray(sData?.data) ? sData.data : [];
            }
            fetched = true;
        } catch (e) {
            console.error("Search fetch error", e);
        } finally {
            loadingText.classList.add('hidden');
            renderResults();
        }
    }

    function renderItem(item, type) {
        const a = document.createElement('a');
        a.href = `/${type}/${item.slug}`;
        a.className = 'block rounded-xl border border-slate-200 hover:border-primary-200 hover:bg-primary-50/40 px-4 py-3 transition-colors';
        a.addEventListener('click', closeSearch);

        const title = document.createElement('p');
        title.className = 'font-bold text-slate-900 text-sm';
        title.textContent = item.title;
        a.appendChild(title);

        if (item.excerpt) {
            const excerpt = document.createElement('p');
            excerpt.className = 'text-xs text-slate-500 mt-1 line-clamp-2';
            excerpt.textContent = item.excerpt;
            a.appendChild(excerpt);
        }

        return a;
    }

    function renderResults() {
        const q = input.value.trim().toLowerCase();
        
        if (!q) {
            initialText.classList.remove('hidden');
            contentArea.classList.add('hidden');
            return;
        }

        initialText.classList.add('hidden');
        contentArea.classList.remove('hidden');

        const blogResults = blogs.filter(b => 
            (b.title && b.title.toLowerCase().includes(q)) ||
            (b.excerpt && b.excerpt.toLowerCase().includes(q)) ||
            (b.category && b.category.toLowerCase().includes(q))
        ).slice(0, 6);

        const serviceResults = services.filter(s => 
            (s.title && s.title.toLowerCase().includes(q)) ||
            (s.excerpt && s.excerpt.toLowerCase().includes(q))
        ).slice(0, 6);

        blogList.innerHTML = '';
        if (blogResults.length > 0) {
            blogResults.forEach(item => blogList.appendChild(renderItem(item, 'blog')));
            blogList.classList.remove('hidden');
            blogEmpty.classList.add('hidden');
        } else {
            blogList.classList.add('hidden');
            blogEmpty.classList.remove('hidden');
        }

        serviceList.innerHTML = '';
        if (serviceResults.length > 0) {
            serviceResults.forEach(item => serviceList.appendChild(renderItem(item, 'services')));
            serviceList.classList.remove('hidden');
            serviceEmpty.classList.add('hidden');
        } else {
            serviceList.classList.add('hidden');
            serviceEmpty.classList.remove('hidden');
        }
    }

    function openSearch() {
        container.style.display = 'block';
        void container.offsetWidth; // reflow
        
        backdrop.classList.remove('opacity-0');
        backdrop.classList.add('opacity-100');
        
        modal.classList.remove('opacity-0', 'translate-y-4');
        modal.classList.add('opacity-100', 'translate-y-0');
        
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => {
            input.focus();
        }, 100);

        if (!fetched) {
            fetchData();
        }
    }

    function closeSearch() {
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        
        modal.classList.remove('opacity-100', 'translate-y-0');
        modal.classList.add('opacity-0', 'translate-y-4');
        
        setTimeout(() => {
            container.style.display = 'none';
            document.body.style.overflow = '';
            input.value = '';
            renderResults();
        }, 200);
    }

    if(openBtn) openBtn.addEventListener('click', openSearch);
    if(closeBtn) closeBtn.addEventListener('click', closeSearch);
    if(backdrop) backdrop.addEventListener('click', closeSearch);
    
    if(input) {
        input.addEventListener('input', () => {
            if (fetched) renderResults();
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && container.style.display === 'block') {
            closeSearch();
        }
    });
});
</script>