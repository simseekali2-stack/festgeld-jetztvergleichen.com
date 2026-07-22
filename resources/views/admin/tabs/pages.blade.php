<div x-show="activeTab === 'pages'" class="space-y-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Pages</h2>
            <p class="text-slate-500 mt-1">Statische Seiten verwalten (Datenschutz, Impressum etc.).</p>
        </div>
        <button x-show="!pages.form" @click="createPage" class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm">
            Neue Seite
        </button>
        <button x-show="pages.form" @click="pages.form = null" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm">
            Zurück
        </button>
    </div>

    <!-- Loading State -->
    <div x-show="pages.loading" class="flex justify-center py-20">
        <svg class="w-10 h-10 animate-spin text-primary-500" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
    </div>

    <!-- List View -->
    <div x-show="!pages.loading && !pages.form">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-black">
                    <tr>
                        <th class="px-6 py-4">Titel</th>
                        <th class="px-6 py-4">Slug</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <template x-for="item in pages.list" :key="item.id">
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-slate-900" x-text="item.title"></td>
                            <td class="px-6 py-4 text-slate-500" x-text="'/' + item.slug"></td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-black" 
                                      :class="item.status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'"
                                      x-text="item.status"></span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button @click="editPage(item)" class="text-blue-500 hover:text-blue-700 font-bold px-2 py-1 bg-blue-50 rounded-lg">Bearbeiten</button>
                                <button @click="deletePage(item.id)" class="text-red-500 hover:text-red-700 font-bold px-2 py-1 bg-red-50 rounded-lg">Löschen</button>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="pages.list.length === 0">
                        <td colspan="4" class="px-6 py-10 text-center text-slate-500">Keine Seiten gefunden.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Form View -->
    <template x-if="pages.form">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 lg:p-10 space-y-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Titel</label>
                        <input type="text" x-model="pages.form.title" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Slug</label>
                        <input type="text" x-model="pages.form.slug" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Status</label>
                        <select x-model="pages.form.status" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                            <option value="draft">Entwurf</option>
                            <option value="published">Veröffentlicht</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Inhalt (CKEditor)</label>
                <textarea id="editor"></textarea>
            </div>

            <div class="space-y-4 border-t border-slate-100 pt-8">
                <h3 class="text-lg font-black text-slate-900">SEO Parameter</h3>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Focus Keyword</label>
                        <input type="text" x-model="pages.form.focus_keyword" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Meta Titel</label>
                        <input type="text" x-model="pages.form.meta_title" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Meta Beschreibung</label>
                        <textarea x-model="pages.form.meta_description" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500"></textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-slate-100">
                <button @click="savePage" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl font-bold text-sm transition-all shadow-sm">
                    Speichern
                </button>
            </div>
        </div>
    </template>
</div>