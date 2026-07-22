@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-900">{{ isset($service) ? 'Service bearbeiten' : 'Neuer Service' }}</h2>
        </div>
        <a href="{{ route('admin.services.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm">
            Zurück
        </a>
    </div>

    <form action="{{ isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store') }}" method="POST" class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 lg:p-10 space-y-8">
        @csrf
        @if(isset($service))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Titel</label>
                    <input type="text" name="title" value="{{ old('title', $service->title ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $service->slug ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Status</label>
                    <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                        <option value="active" {{ old('status', $service->status ?? '') === 'active' ? 'selected' : '' }}>Aktiv</option>
                        <option value="inactive" {{ old('status', $service->status ?? '') === 'inactive' ? 'selected' : '' }}>Inaktiv</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Sortierung (z.B. 10)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
            </div>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Auszug (Excerpt)</label>
            <textarea name="excerpt" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">{{ old('excerpt', $service->excerpt ?? '') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Inhalt</label>
            <textarea id="editor" name="content">{{ old('content', $service->content ?? '') }}</textarea>
        </div>

        <div class="space-y-4 border-t border-slate-100 pt-8">
            <h3 class="text-lg font-black text-slate-900">SEO</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Meta Titel</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $service->meta_title ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Meta Beschreibung</label>
                    <textarea name="meta_description" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">{{ old('meta_description', $service->meta_description ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6 border-t border-slate-100">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl font-bold text-sm transition-all shadow-sm">
                Speichern
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    if(document.getElementById('editor')){
        CKEDITOR.replace('editor', {
            height: 400
        });
    }
</script>
@endpush
@endsection