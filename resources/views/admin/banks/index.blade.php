@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Partnerbanken</h2>
            <p class="text-slate-500 mt-1">Beschreibungen für die von der API kommenden Banken verwalten.</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-black">
                    <tr>
                        <th class="px-6 py-4">Banka</th>
                        <th class="px-6 py-4">Land</th>
                        <th class="px-6 py-4">Beschreibung</th>
                        <th class="px-6 py-4 text-right">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($banks as $bank)
                    <tr class="hover:bg-slate-50/50 transition-colors align-top">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-16 bg-white border border-slate-100 rounded-lg p-1 flex items-center justify-center shrink-0">
                                    <img src="{{ $bank['logo'] }}" alt="{{ $bank['name'] }}" class="max-h-full max-w-full object-contain">
                                </div>
                                <span class="font-bold text-slate-900">{{ $bank['name'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-black bg-slate-100 text-slate-700 border border-slate-200">
                                {{ $bank['country'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <textarea 
                                id="desc-{{ $bank['id'] }}" 
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary-500/10 focus:border-primary-500 transition-all"
                                rows="3"
                                placeholder="Bankenbeschreibung hier eingeben..."
                            >{{ $localDescriptions[$bank['id']] ?? '' }}</textarea>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button 
                                onclick="saveDescription('{{ $bank['id'] }}')"
                                class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-bold text-xs transition-all shadow-sm flex items-center gap-2 ml-auto"
                            >
                                <span class="save-status-icon hidden">
                                    <svg class="animate-spin h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                                Speichern
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-500">Keine Banken gefunden.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    async function saveDescription(bankId) {
        const textarea = document.getElementById(`desc-${bankId}`);
        const description = textarea.value;
        const button = textarea.closest('tr').querySelector('button');
        const icon = button.querySelector('.save-status-icon');
        
        button.disabled = true;
        icon.classList.remove('hidden');
        
        try {
            const response = await fetch("{{ route('admin.banks.update-description') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    bank_id: bankId,
                    description: description
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Flash green
                button.classList.remove('bg-primary-600', 'hover:bg-primary-700');
                button.classList.add('bg-emerald-600');
                setTimeout(() => {
                    button.classList.add('bg-primary-600', 'hover:bg-primary-700');
                    button.classList.remove('bg-emerald-600');
                }, 1500);
            } else {
                alert('Ein Fehler ist aufgetreten.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Ein Fehler ist aufgetreten beim Speichern.');
        } finally {
            button.disabled = false;
            icon.classList.add('hidden');
        }
    }
</script>
@endpush
@endsection
