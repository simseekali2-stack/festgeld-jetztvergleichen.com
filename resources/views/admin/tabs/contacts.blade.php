<div x-show="activeTab === 'contacts'" class="space-y-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Kontaktanfragen</h2>
            <p class="text-slate-500 mt-1">Gelesene und ungelesene Nachrichten.</p>
        </div>
    </div>

    <!-- Loading State -->
    <div x-show="contacts.loading" class="flex justify-center py-20">
        <svg class="w-10 h-10 animate-spin text-primary-500" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
    </div>

    <div x-show="!contacts.loading" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Message List -->
        <div :class="contacts.selected ? 'lg:col-span-5' : 'lg:col-span-12'" class="space-y-4">
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                    <h3 class="font-black text-slate-900 flex items-center gap-2">
                        Nachrichten
                        <span class="ml-2 px-2 py-0.5 bg-slate-100 text-slate-500 text-[10px] rounded-full font-black" x-text="contacts.list.length"></span>
                    </h3>
                </div>
                <div class="divide-y divide-slate-50 max-h-[600px] overflow-y-auto">
                    <template x-for="msg in contacts.list" :key="msg.id">
                        <div @click="openContact(msg)" 
                             class="p-4 hover:bg-slate-50 transition-colors cursor-pointer relative group"
                             :class="(contacts.selected?.id === msg.id ? 'bg-primary-50/50 ' : '') + (!msg.is_read ? 'bg-white' : 'bg-slate-50/30')">
                            
                            <div x-show="!msg.is_read" class="absolute left-0 top-0 bottom-0 w-1 bg-primary-500"></div>
                            
                            <div class="flex justify-between items-start mb-1">
                                <span class="text-sm font-bold" :class="!msg.is_read ? 'text-slate-900' : 'text-slate-500'" x-text="msg.first_name + ' ' + msg.last_name"></span>
                                <span class="text-[10px] font-medium text-slate-400" x-text="new Date(msg.created_at).toLocaleDateString()"></span>
                            </div>
                            <div class="text-xs text-slate-500 truncate mb-2" x-text="msg.email"></div>
                            <div class="text-xs text-slate-400 line-clamp-1 italic" x-text="msg.message"></div>
                            
                            <button @click.stop="deleteContact(msg.id)" class="absolute right-2 bottom-2 p-1.5 text-slate-300 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </div>
                    </template>
                    <div x-show="contacts.list.length === 0" class="p-10 text-center">
                        <p class="text-slate-400 font-medium">Keine Nachrichten vorhanden.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message Detail -->
        <template x-if="contacts.selected">
            <div class="lg:col-span-7">
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden sticky top-6">
                    <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-primary-50 flex items-center justify-center text-primary-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-black text-slate-900 text-sm" x-text="contacts.selected.first_name + ' ' + contacts.selected.last_name"></h4>
                                <p class="text-xs text-slate-400 font-medium" x-text="contacts.selected.email"></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="deleteContact(contacts.selected.id)" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all" title="Löschen">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                            <button @click="contacts.selected = null" class="p-2 text-slate-400 hover:text-slate-900 hover:bg-slate-50 rounded-xl transition-all lg:hidden">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-2 mb-6">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest" x-text="'Datum: ' + new Date(contacts.selected.created_at).toLocaleString()"></span>
                        </div>
                        <div class="bg-slate-50 rounded-2xl p-6 text-slate-700 text-sm font-medium leading-relaxed whitespace-pre-wrap border border-slate-100" x-text="contacts.selected.message"></div>
                        <div class="mt-8 flex justify-end">
                            <a :href="'mailto:' + contacts.selected.email" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm flex items-center gap-2 transition-all">
                                Antworten
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>