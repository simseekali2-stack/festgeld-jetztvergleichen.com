@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Settings</h2>
            <p class="text-slate-500 mt-1">Globale Seiteneinstellungen anpassen.</p>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 lg:p-10 space-y-8">
        @csrf

        <!-- General Settings -->
        <div class="space-y-6">
            <h3 class="text-lg font-black text-slate-900 border-b border-slate-100 pb-2">Allgemein</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Site Titel</label>
                    <input type="text" name="site_title" value="{{ $settings['site_title'] ?? '' }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Firmenname</label>
                    <input type="text" name="company_name" value="{{ $settings['company_name'] ?? '' }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
            </div>
            
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Site Beschreibung</label>
                <textarea name="site_description" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">{{ $settings['site_description'] ?? '' }}</textarea>
            </div>
        </div>

        <!-- Contact Settings -->
        <div class="space-y-6 pt-8 border-t border-slate-100">
            <h3 class="text-lg font-black text-slate-900 border-b border-slate-100 pb-2">Kontakt</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Support E-Mail</label>
                    <input type="email" name="support_email" value="{{ $settings['support_email'] ?? '' }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Support Telefon</label>
                    <input type="text" name="support_phone" value="{{ $settings['support_phone'] ?? '' }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
            </div>
        </div>

        <!-- Social Media Settings -->
        <div class="space-y-6 pt-8 border-t border-slate-100">
            <h3 class="text-lg font-black text-slate-900 border-b border-slate-100 pb-2">Social Media</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Facebook URL</label>
                    <input type="url" name="social_facebook" value="{{ $settings['social_facebook'] ?? '' }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Twitter URL</label>
                    <input type="url" name="social_twitter" value="{{ $settings['social_twitter'] ?? '' }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Instagram URL</label>
                    <input type="url" name="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">LinkedIn URL</label>
                    <input type="url" name="social_linkedin" value="{{ $settings['social_linkedin'] ?? '' }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6 border-t border-slate-100">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl font-bold text-sm transition-all shadow-sm">
                Einstellungen speichern
            </button>
        </div>
    </form>
</div>
@endsection