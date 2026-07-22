<div x-show="activeTab === 'services'" class="space-y-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Services</h2>
            <p class="text-slate-500 mt-1">Dienstleistungen verwalten und erstellen.</p>
        </div>
        <button x-show="!services.form" @click="createService" class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm">
            Neuer Service
        </button>
        <button x-show="services.form" @click="services.form = null" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm">
            Zurück
        </button>
    </div>

    <!-- Loading State -->
    <div x-show="services.loading" class="flex justify-center py-20">
        <svg class="w-10 h-10 animate-spin text-primary-500" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
    </div>

    <!-- List View -->
    <div x-show="!services.loading && !services.form">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-black">
                    <tr>
                        <th class="px-6 py-4">Titel</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Sortierung</th>
                        <th class="px-6 py-4 text-right">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <template x-for="item in services.list" :key="item.id">
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-slate-900" x-text="item.title"></td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-black" 
                                      :class="item.status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700'"
                                      x-text="item.status === 'active' ? 'Aktiv' : 'Inaktiv'"></span>
                            </td>
                            <td class="px-6 py-4 text-slate-500 font-medium" x-text="item.sort_order"></td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button @click="editService(item)" class="text-blue-500 hover:text-blue-700 font-bold px-2 py-1 bg-blue-50 rounded-lg">Bearbeiten</button>
                                <button @click="deleteService(item.id)" class="text-red-500 hover:text-red-700 font-bold px-2 py-1 bg-red-50 rounded-lg">Löschen</button>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="services.list.length === 0">
                        <td colspan="4" class="px-6 py-10 text-center text-slate-500">Keine Services gefunden.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Form View -->
    <template x-if="services.form">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 lg:p-10 space-y-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Titel</label>
                        <input type="text" x-model="services.form.title" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Slug</label>
                        <input type="text" x-model="services.form.slug" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Status</label>
                        <select x-model="services.form.status" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                            <option value="active">Aktiv</option>
                            <option value="inactive">Inaktiv</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Sortierung</label>
                        <input type="number" x-model="services.form.sort_order" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Icon (SVG oder Name)</label>
                <input type="text" x-model="services.form.icon" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
            </div>

            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Auszug (Excerpt)</label>
                <textarea x-model="services.form.excerpt" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500"></textarea>
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
                        <input type="text" x-model="services.form.focus_keyword" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Meta Titel</label>
                        <input type="text" x-model="services.form.meta_title" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Meta Beschreibung</label>
                        <textarea x-model="services.form.meta_description" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500"></textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-slate-100">
                <button @click="saveService" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl font-bold text-sm transition-all shadow-sm">
                    Speichern
                </button>
            </div>
        </div>
    </template>
</div>