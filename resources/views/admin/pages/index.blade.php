@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Pages</h2>
            <p class="text-slate-500 mt-1">Seiten verwalten und erstellen.</p>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm">
            Neue Seite
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-black">
                <tr>
                    <th class="px-6 py-4">Titel</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aktionen</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($pages as $page)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4 font-bold text-slate-900">{{ $page->title }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-black {{ $page->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                            {{ ucfirst($page->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.pages.edit', $page->id) }}" class="text-blue-500 hover:text-blue-700 font-bold px-2 py-1 bg-blue-50 rounded-lg">Bearbeiten</a>
                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Wirklich löschen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-bold px-2 py-1 bg-red-50 rounded-lg">Löschen</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-slate-500">Keine Seiten gefunden.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection