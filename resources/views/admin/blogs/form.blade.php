@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-900">{{ isset($blog) ? 'Blog bearbeiten' : 'Neuer Blog Post' }}</h2>
        </div>
        <a href="{{ route('admin.blogs.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm">
            Zurück
        </a>
    </div>

    <form action="{{ isset($blog) ? route('admin.blogs.update', $blog->id) : route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 lg:p-10 space-y-8">
        @csrf
        @if(isset($blog))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Titel</label>
                    <input type="text" name="title" value="{{ old('title', $blog->title ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $blog->slug ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Status</label>
                    <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                        <option value="draft" {{ old('status', $blog->status ?? '') === 'draft' ? 'selected' : '' }}>Entwurf</option>
                        <option value="published" {{ old('status', $blog->status ?? '') === 'published' ? 'selected' : '' }}>Veröffentlicht</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Kategorie</label>
                    <input type="text" name="category" value="{{ old('category', $blog->category ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
            </div>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Auszug (Excerpt)</label>
            <textarea name="excerpt" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Inhalt</label>
            <textarea id="editor" name="content">{{ old('content', $blog->content ?? '') }}</textarea>
        </div>

        <div class="space-y-4 border-t border-slate-100 pt-8">
            <h3 class="text-lg font-black text-slate-900">SEO & Bilder</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Featured Image (Upload)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:bg-slate-50 hover:border-primary-400 transition-colors relative group">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-10 w-10 text-slate-400 group-hover:text-primary-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-bold text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                    <span>Datei hochladen</span>
                                    <input id="file-upload" name="featured_image_file" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
                                </label>
                                <p class="pl-1">oder Drag & Drop</p>
                            </div>
                            <p class="text-xs text-slate-500">PNG, JPG, WEBP bis zu 5MB</p>
                        </div>
                    </div>
                    
                    <!-- Preview Container -->
                    <div id="image-preview-container" class="mt-4 {{ empty($blog->featured_image) ? 'hidden' : '' }}">
                        <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Aktuelles / Vorschau</p>
                        <img id="image-preview" src="{{ $blog->featured_image ?? '' }}" alt="Vorschau" class="h-32 object-cover rounded-xl border border-slate-200 shadow-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Focus Keyword</label>
                    <input type="text" name="focus_keyword" value="{{ old('focus_keyword', $blog->focus_keyword ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Meta Titel</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $blog->meta_title ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-1.5">Meta Beschreibung</label>
                    <textarea name="meta_description" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
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

    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById('image-preview-container');
                const previewImage = document.getElementById('image-preview');
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection