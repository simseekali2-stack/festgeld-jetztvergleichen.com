<div class="flex items-center w-max animate-marquee-slow cursor-default">
    @for ($i = 0; $i < 2; $i++)
        <div class="flex items-center gap-6 sm:gap-10 px-4 sm:px-5">
            @foreach($tickerRows as $idx => $item)
                <div class="flex items-center gap-1.5 sm:gap-2 whitespace-nowrap">
                    <span 
                        class="font-bold {{ ['text-sky-300', 'text-emerald-300', 'text-amber-200', 'text-cyan-300', 'text-lime-200'][$idx % 5] }}" 
                        title="{{ $item['name'] }}">
                        {{ $item['name'] }}
                    </span>
                    <span class="text-primary-700/80 select-none" aria-hidden="true">•</span>
                    <span class="text-green-400 font-black tabular-nums">{{ number_format($item['rate'], 2, ',', '.') }}% p.a.</span>
                </div>
            @endforeach
            @if(count($tickerRows) === 0)
                <div class="text-slate-400 text-xs tracking-wider">Lade aktuelle Zinsen...</div>
            @endif
        </div>
    @endfor
</div>