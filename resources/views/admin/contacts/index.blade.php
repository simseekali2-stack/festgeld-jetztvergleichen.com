@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Contacts</h2>
            <p class="text-slate-500 mt-1">Kontaktanfragen verwalten.</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-black">
                <tr>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">E-Mail</th>
                    <th class="px-6 py-4">Datum</th>
                    <th class="px-6 py-4">Nachricht</th>
                    <th class="px-6 py-4 text-right">Aktionen</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($contacts as $contact)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4 font-bold text-slate-900">{{ $contact->first_name }} {{ $contact->last_name }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $contact->email }}</td>
                    <td class="px-6 py-4 text-slate-500 font-medium">{{ $contact->created_at->format('d.m.Y H:i') }}</td>
                    <td class="px-6 py-4 text-slate-600 max-w-xs truncate">{{ $contact->message }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Wirklich löschen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-bold px-2 py-1 bg-red-50 rounded-lg">Löschen</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-slate-500">Keine Nachrichten gefunden.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection