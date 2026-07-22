<aside class="w-64 bg-white border-r border-slate-200 p-4 shrink-0 hidden lg:block h-full">
    
    <!-- My Leagues Section -->
    <div class="mb-8">
        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">My Leagues</h3>
        <select onchange="window.location.href='?league_id=' + this.value" class="w-full bg-slate-50 border border-slate-200 rounded px-3 py-2 text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
            <option value="39" {{ request('league_id') == 39 ? 'selected' : '' }}>England (Premier League)</option>
            <option value="373" {{ request('league_id') == 373 ? 'selected' : '' }}>Kenya (Premier League)</option>
        </select>
        <ul class="mt-4 space-y-2">
            <li class="flex items-center gap-2 text-sm font-bold text-slate-700 hover:text-blue-600 cursor-pointer">
                <span class="text-yellow-500">★</span> Premier League
            </li>
            <!-- Analytics Button -->
            <li>
                <a href="{{ route('analytics.index') }}" class="flex justify-between items-center py-2 px-2 mt-4 bg-slate-50 border border-slate-200 hover:bg-slate-100 hover:text-blue-600 rounded-lg cursor-pointer transition-colors text-sm font-bold text-slate-700">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        {{ __('Performance Analytics') }}
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <!-- Popular Leagues Section -->
    <div class="mt-8">
        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">{{ __('Popular Leagues') }}</h3>
        <ul class="space-y-1">
            @php
                $popularLeagues = [
                    'World Cup',
                    'UEFA Champions League',
                    'UEFA Europa League',
                    'UEFA Europa Conference League',
                    'Premier League',
                    'LaLiga',
                    'Bundesliga',
                    'Serie A',
                    'Ligue 1',
                    'Eredivisie',
                    'Liga Portugal',
                    'Brasileiro Serie A',
                    'Scottish Premiership',
                    'Süper Lig',
                    'Saudi Pro League'
                ];
            @endphp

            @foreach($popularLeagues as $league)
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['league' => $league]) }}" 
                    class="flex items-center py-2 px-2 hover:bg-slate-100 rounded cursor-pointer transition-colors {{ request('league') === $league ? 'bg-slate-100 text-blue-600 font-bold' : 'text-slate-600' }}">
                        <span class="text-sm">{{ __($league) }}</span>
                    </a>
                </li>
            @endforeach
            
            <!-- Clear Filter Button (Only visible when a league is currently selected) -->
            @if(request()->has('league'))
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['league' => null]) }}" class="flex items-center gap-2 py-2 px-2 mt-4 text-xs font-bold text-red-500 hover:bg-red-50 rounded transition-colors">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                        {{ __('Clear League Filter') }}
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <!-- Football Predictions Menu -->
    <div>
        <h3 class="text-xs font-bold text-red-400 uppercase tracking-wider mb-3">{{ __('Football') }}</h3>
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


</aside>