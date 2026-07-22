<div x-show="activeTab === 'settings'" class="space-y-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Site Ayarları</h2>
            <p class="text-slate-500 mt-1">İletişim, şirket ve genel platform bilgileri</p>
        </div>
        <button @click="saveSettings" class="flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm">
            Kaydet
        </button>
    </div>

    <!-- Loading State -->
    <div x-show="settings.loading" class="flex justify-center py-20">
        <svg class="w-10 h-10 animate-spin text-primary-500" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
    </div>

    <div x-show="!settings.loading" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Contact Info -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-5">
            <h3 class="text-sm font-black text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                İletişim Bilgileri
            </h3>
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">E-Posta Adresi</label>
                <input type="email" x-model="settings.data.contact_email" placeholder="info@festgeld-vergleichen.de" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Telefon Numarası</label>
                <input type="text" x-model="settings.data.contact_phone" placeholder="+49 30 1234567" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Çalışma Saatleri</label>
                <input type="text" x-model="settings.data.contact_hours" placeholder="Mo-Fr: 09:00 - 18:00 Uhr" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Açık Adres</label>
                <textarea x-model="settings.data.contact_address" placeholder="Musterstraße 1, 10115 Berlin, Deutschland" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all resize-none"></textarea>
            </div>
        </div>

        <!-- Company Info -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-5">
            <h3 class="text-sm font-black text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                Şirket Bilgileri (Künye için)
            </h3>
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Şirket/Kurum Adı</label>
                <input type="text" x-model="settings.data.company_name" placeholder="Festgeld GmbH" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Vergi Numarası (USt-IdNr.)</label>
                <input type="text" x-model="settings.data.company_vat" placeholder="DE123456789" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Ticaret Sicil No (Handelsregister)</label>
                <input type="text" x-model="settings.data.company_reg" placeholder="HRB 123456" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Site Açıklaması</label>
                <textarea x-model="settings.data.site_description" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all resize-none"></textarea>
            </div>
        </div>

        <!-- General & Social -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-5 lg:col-span-2">
            <h3 class="text-sm font-black text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                Sosyal Medya & Diğer
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Facebook URL</label>
                    <input type="url" x-model="settings.data.social_facebook" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Twitter URL</label>
                    <input type="url" x-model="settings.data.social_twitter" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Instagram URL</label>
                    <input type="url" x-model="settings.data.social_instagram" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">LinkedIn URL</label>
                    <input type="url" x-model="settings.data.social_linkedin" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
                </div>
            </div>
        </div>
        
    </div>
</div>