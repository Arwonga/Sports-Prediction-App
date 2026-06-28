<aside class="w-64 bg-white border-r border-slate-200 p-4 shrink-0 hidden lg:block h-full">
    
    <!-- My Leagues Section -->
    <div class="mb-8">
        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">My Leagues</h3>
        <select class="w-full bg-slate-50 border border-slate-200 rounded px-3 py-2 text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-blue-500 outline-none">
            <option>Kenya</option>
            <option>England</option>
            <option>Spain</option>
        </select>
        <ul class="mt-4 space-y-2">
            <li class="flex items-center gap-2 text-sm font-bold text-slate-700 hover:text-blue-600 cursor-pointer">
                <span class="text-yellow-500">★</span> Premier League
            </li>
        </ul>
    </div>

    <!-- Football Predictions Menu -->
    <div>
        <h3 class="text-xs font-bold text-red-400 uppercase tracking-wider mb-3">Football</h3>
        <ul class="space-y-1">
            @php
                $menuItems = [
                    ['name' => 'Predictions for TODAY', 'count' => '252'],
                    ['name' => 'LIVE predictions', 'count' => '45'],
                    ['name' => 'Predictions for TOMORROW', 'count' => '40'],
                    ['name' => 'Predictions for the WEEKEND', 'count' => '634'],
                    ['name' => 'Predictions from YESTERDAY', 'count' => '1014'],
                    ['name' => 'ALL predictions', 'count' => '573'],
                    ['name' => 'TOP predictions', 'count' => '80'],
                ];
            @endphp
            
            @foreach($menuItems as $item)
                <li class="flex justify-between items-center py-2 px-2 hover:bg-slate-100 rounded cursor-pointer text-sm font-semibold text-slate-600">
                    {{ $item['name'] }}
                    <span class="bg-yellow-100 text-yellow-700 text-[10px] font-black px-1.5 py-0.5 rounded">{{ $item['count'] }}</span>
                </li>
            @endforeach
            <li class="py-2 px-2 hover:bg-slate-100 rounded cursor-pointer text-sm font-semibold text-slate-600">Favourites</li>
            <li class="py-2 px-2 hover:bg-slate-100 rounded cursor-pointer text-sm font-semibold text-slate-600">Lists</li>
        </ul>
    </div>

    <!-- Popular Leagues Section -->
    <div class="mb-8">
    <h3 class="text-xs font-bold text-red-400 uppercase tracking-wider mb-3">Popular Leagues</h3>
    <ul class="space-y-2">
        @php
            $popularLeagues = [
                ['name' => 'World Cup', 'count' => '4'],
                ['name' => 'UEFA Champions League', 'count' => ''],
                ['name' => 'UEFA Europa League', 'count' => ''],
                ['name' => 'UEFA Europa Conference League', 'count' => ''],
                ['name' => 'Premier League', 'count' => ''],
                ['name' => 'LaLiga', 'count' => ''],
                ['name' => 'Bundesliga', 'count' => ''],
                ['name' => 'Serie A', 'count' => ''],
                ['name' => 'Ligue 1', 'count' => ''],
                ['name' => 'Eredivisie', 'count' => ''],
                ['name' => 'Liga Portugal', 'count' => ''],
                ['name' => 'Brasileiro Serie A', 'count' => '12'],
                ['name' => 'Scottish Premiership', 'count' => ''],
                ['name' => 'Süper Lig', 'count' => ''],
                ['name' => 'Saudi Pro League', 'count' => ''],
            ];
        @endphp
        @foreach($popularLeagues as $league)
            <li class="flex justify-between items-center text-sm font-semibold text-slate-700 hover:text-blue-600 cursor-pointer py-1">
                {{ $league['name'] }}
                @if($league['count'])
                    <span class="bg-blue-100 text-blue-700 text-[10px] font-black px-1.5 py-0.5 rounded">{{ $league['count'] }}</span>
                @endif
            </li>
        @endforeach
    </ul>
</div>

</aside>