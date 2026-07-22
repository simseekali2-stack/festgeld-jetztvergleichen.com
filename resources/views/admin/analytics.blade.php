@extends('admin.layouts.app')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    @if(!empty($dailyVisits))
    // Günlük Ziyaretçi Grafiği
    const dailyCtx = document.getElementById('dailyChart')?.getContext('2d');
    if (dailyCtx) {
        new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_column($dailyVisits, 'date')) !!},
                datasets: [
                    {
                        label: 'Ziyaretler',
                        data: {!! json_encode(array_column($dailyVisits, 'visits')) !!},
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59,130,246,0.08)',
                        borderWidth: 2,
                        pointRadius: 3,
                        tension: 0.3,
                        fill: true,
                    },
                    {
                        label: 'Kullanıcılar',
                        data: {!! json_encode(array_column($dailyVisits, 'users')) !!},
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16,185,129,0.08)',
                        borderWidth: 2,
                        pointRadius: 3,
                        tension: 0.3,
                        fill: true,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true },
                },
            },
        });
    }
    @endif

    @if(!empty($trafficSources))
    // Trafik Kaynakları Pasta Grafiği
    const srcCtx = document.getElementById('sourceChart')?.getContext('2d');
    if (srcCtx) {
        new Chart(srcCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_column($trafficSources, 'source')) !!},
                datasets: [{
                    data: {!! json_encode(array_column($trafficSources, 'visits')) !!},
                    backgroundColor: ['#3b82f6','#10b981','#f59e0b','#ef4444','#8b5cf6','#06b6d4','#ec4899'],
                    borderWidth: 2,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } },
            },
        });
    }
    @endif

    @if(!empty($deviceStats))
    // Cihaz Grafiği
    const devCtx = document.getElementById('deviceChart')?.getContext('2d');
    if (devCtx) {
        new Chart(devCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_column($deviceStats, 'device')) !!},
                datasets: [{
                    data: {!! json_encode(array_column($deviceStats, 'visits')) !!},
                    backgroundColor: ['#3b82f6','#10b981','#f59e0b'],
                    borderWidth: 2,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } },
            },
        });
    }
    @endif

});
</script>
@endpush

@section('content')
<div class="mb-6 flex flex-wrap justify-between items-center gap-4">
    <h1 class="text-2xl font-semibold text-gray-800">Site İstatistikleri</h1>

    {{-- Dönem seçici --}}
    <div class="flex items-center gap-2">
        @foreach([7 => '7 Gün', 30 => '30 Gün', 90 => '90 Gün'] as $d => $label)
            <a href="{{ request()->fullUrlWithQuery(['period' => $d]) }}"
               class="px-4 py-2 rounded-lg text-sm font-semibold transition-all
                      {{ $period == $d ? 'bg-blue-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>

@if(!$configured)
<div class="bg-amber-50 border border-amber-200 rounded-xl p-6 mb-6">
    <h2 class="text-base font-bold text-amber-800 mb-2">Yandex Metrika API Ayarlanmamış</h2>
    <p class="text-sm text-amber-700 mb-3">
        Verileri görmek için <code class="bg-amber-100 px-1 py-0.5 rounded">.env</code> dosyanıza aşağıdaki değerleri ekleyin:
    </p>
    <pre class="bg-amber-100 rounded-lg p-4 text-sm text-amber-900 overflow-x-auto">YANDEX_METRIKA_TOKEN=OAuth_token_burada
YANDEX_METRIKA_COUNTER_ID=sayaç_id_burada</pre>
    <p class="text-xs text-amber-600 mt-3">
        OAuth token almak için:
        <a href="https://oauth.yandex.com/authorize?response_type=token&client_id=1d0b9dd4d652455a9eb710d450ff456a" target="_blank" class="underline font-semibold">Yandex OAuth</a>
        &nbsp;|&nbsp;
        Counter ID:
        <a href="https://metrika.yandex.com/list" target="_blank" class="underline font-semibold">Metrika Kontrol Paneli</a>
    </p>
</div>
@else

{{-- Özet Kartları --}}
@if(!empty($summary))
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5">
        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Ziyaretler</p>
        <p class="text-3xl font-black text-slate-800">{{ number_format($summary['visits']) }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5">
        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Kullanıcılar</p>
        <p class="text-3xl font-black text-slate-800">{{ number_format($summary['users']) }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5">
        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Hemen Çıkma</p>
        <p class="text-3xl font-black {{ $summary['bounce_rate'] > 70 ? 'text-red-600' : ($summary['bounce_rate'] > 50 ? 'text-amber-600' : 'text-emerald-600') }}">
            {{ $summary['bounce_rate'] }}%
        </p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5">
        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Sayfa Derinliği</p>
        <p class="text-3xl font-black text-slate-800">{{ $summary['page_depth'] }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5">
        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Ort. Süre</p>
        @php
            $min = intdiv($summary['avg_duration_seconds'], 60);
            $sec = $summary['avg_duration_seconds'] % 60;
        @endphp
        <p class="text-3xl font-black text-slate-800">{{ $min }}:{{ str_pad($sec, 2, '0', STR_PAD_LEFT) }}</p>
    </div>
</div>
@endif

{{-- Günlük Grafik --}}
@if(!empty($dailyVisits))
<div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 mb-6">
    <h2 class="text-base font-bold text-slate-800 mb-4">Günlük Ziyaretçi Trendi</h2>
    <div class="relative" style="height:260px;">
        <canvas id="dailyChart"></canvas>
    </div>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    {{-- Trafik Kaynakları --}}
    @if(!empty($trafficSources))
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
        <h2 class="text-base font-bold text-slate-800 mb-4">Trafik Kaynakları</h2>
        <div class="relative mb-4" style="height:200px;">
            <canvas id="sourceChart"></canvas>
        </div>
        <div class="space-y-2 mt-2">
            @php $totalSrcVisits = array_sum(array_column($trafficSources, 'visits')); @endphp
            @foreach($trafficSources as $src)
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-600">{{ $src['source'] }}</span>
                <span class="font-semibold text-slate-800">
                    {{ number_format($src['visits']) }}
                    @if($totalSrcVisits > 0)
                        <span class="text-slate-400 font-normal text-xs">({{ round($src['visits'] / $totalSrcVisits * 100, 1) }}%)</span>
                    @endif
                </span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Cihaz --}}
    @if(!empty($deviceStats))
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
        <h2 class="text-base font-bold text-slate-800 mb-4">Cihaz Türü</h2>
        <div class="relative mb-4" style="height:200px;">
            <canvas id="deviceChart"></canvas>
        </div>
        <div class="space-y-2 mt-2">
            @php $totalDevVisits = array_sum(array_column($deviceStats, 'visits')); @endphp
            @foreach($deviceStats as $dev)
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-600">{{ $dev['device'] }}</span>
                <span class="font-semibold text-slate-800">
                    {{ number_format($dev['visits']) }}
                    @if($totalDevVisits > 0)
                        <span class="text-slate-400 font-normal text-xs">({{ round($dev['visits'] / $totalDevVisits * 100, 1) }}%)</span>
                    @endif
                </span>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

{{-- En Çok Ziyaret Edilen Sayfalar --}}
@if(!empty($topPages))
<div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 mb-6">
    <h2 class="text-base font-bold text-slate-800 mb-4">En Çok Ziyaret Edilen Sayfalar</h2>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-slate-500 border-b border-slate-100">
                    <th class="pb-3 font-semibold">#</th>
                    <th class="pb-3 font-semibold">Sayfa</th>
                    <th class="pb-3 font-semibold text-right">Sayfa Görüntüleme</th>
                    <th class="pb-3 font-semibold text-right">Kullanıcı</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($topPages as $i => $page)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="py-3 text-slate-400 font-medium">{{ $i + 1 }}</td>
                    <td class="py-3">
                        <a href="{{ $page['url'] }}" target="_blank"
                           class="text-blue-600 hover:underline font-medium break-all">
                            {{ $page['url'] }}
                        </a>
                    </td>
                    <td class="py-3 text-right font-semibold text-slate-800">{{ number_format($page['pageviews']) }}</td>
                    <td class="py-3 text-right text-slate-600">{{ number_format($page['users']) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Yüksek Hemen Çıkma Oranı (Kullanıcının Takıldığı Sayfalar) --}}
@if(!empty($highBouncePages))
<div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 mb-6">
    <h2 class="text-base font-bold text-slate-800 mb-1">Kullanıcının Takıldığı Sayfalar</h2>
    <p class="text-xs text-slate-500 mb-4">Yüksek hemen çıkma oranına sahip giriş sayfaları — kullanıcılar buralarda ikinci sayfaya geçmeden çıkıyor.</p>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-slate-500 border-b border-slate-100">
                    <th class="pb-3 font-semibold">#</th>
                    <th class="pb-3 font-semibold">Giriş Sayfası</th>
                    <th class="pb-3 font-semibold text-right">Ziyaret</th>
                    <th class="pb-3 font-semibold text-right">Hemen Çıkma</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($highBouncePages as $i => $page)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="py-3 text-slate-400 font-medium">{{ $i + 1 }}</td>
                    <td class="py-3">
                        <a href="{{ $page['url'] }}" target="_blank"
                           class="text-blue-600 hover:underline font-medium break-all">
                            {{ $page['url'] }}
                        </a>
                    </td>
                    <td class="py-3 text-right text-slate-600">{{ number_format($page['visits']) }}</td>
                    <td class="py-3 text-right">
                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-bold
                            {{ $page['bounce_rate'] >= 80 ? 'bg-red-100 text-red-700' : ($page['bounce_rate'] >= 60 ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700') }}">
                            {{ $page['bounce_rate'] }}%
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@if(empty($summary) && empty($topPages))
<div class="bg-slate-50 border border-slate-200 rounded-xl p-10 text-center text-slate-500">
    <p class="text-lg font-semibold mb-1">Veri Bulunamadı</p>
    <p class="text-sm">Seçilen dönem için Yandex Metrika'dan veri alınamadı. Token ve Counter ID'yi kontrol edin.</p>
</div>
@endif

@endif {{-- configured --}}
@endsection
