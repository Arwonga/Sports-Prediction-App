<x-layout>
    <div class="w-full">
        
        <!-- Match Hero Section (Dynamic Data) -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-6">
            
            <!-- Top Toggles -->
            <div class="flex justify-center mb-6">
                <div class="flex items-center bg-slate-100 rounded-full p-1 shadow-inner">
                    <button class="px-6 py-1.5 text-xs font-bold bg-slate-800 text-white rounded-full shadow-sm">{{ __('Prediction') }}</button>
                    <button class="px-6 py-1.5 text-xs font-bold text-slate-500 hover:text-slate-800 transition-colors">{{ __('Preview') }}</button>
                </div>
            </div>

            <!-- Match Title & Meta -->
            <div class="text-center mb-10">
                <h1 class="text-3xl font-black text-slate-800 mb-3 tracking-tight">
                    {{ $fixture->homeTeam->name ?? 'Home' }} 
                    <span class="text-slate-300 font-light mx-3">VS</span> 
                    {{ $fixture->awayTeam->name ?? 'Away' }}
                </h1>
                <div class="flex items-center justify-center gap-3 text-xs text-slate-500 font-bold uppercase tracking-wider">
                    <span>{{ $fixture->venue_name ?? 'Stadium TBA' }}</span>
                    <span class="text-slate-300">•</span>
                    <span>{{ \Carbon\Carbon::parse($fixture->match_at)->timezone(session('timezone', 'Africa/Nairobi'))->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            <!-- Visuals & Form -->
            <div class="flex justify-between items-center px-10">
                
                <!-- Home Team -->
                <div class="flex flex-col items-center gap-4">
                    <div class="w-28 h-28 bg-white rounded-2xl shadow-md flex items-center justify-center border border-slate-100 overflow-hidden p-3">
                        @if($fixture->homeTeam->logo_url)
                            <img src="{{ $fixture->homeTeam->logo_url }}" alt="{{ $fixture->homeTeam->name }}" class="w-full h-full object-contain">
                        @else
                            <div class="w-full h-full bg-slate-800 rounded-xl flex items-center justify-center text-white font-black text-3xl uppercase">
                                {{ substr($fixture->homeTeam->name ?? 'HOM', 0, 3) }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Center Prediction Highlight (Dynamic Calculation) -->
                @php
                    $pred = $fixture->prediction;
                    $bestMarket = 'NO BET';
                    $bestProb = 0;
                    $icon = '-';
                    $color = 'slate-400';

                    if($pred) {
                        $markets = [
                            ['name' => 'Over 2.5', 'prob' => $pred->over_25_prob, 'icon' => 'O', 'color' => 'green-500'],
                            ['name' => 'Under 2.5', 'prob' => $pred->under_25_prob, 'icon' => 'U', 'color' => 'blue-500'],
                            ['name' => 'BTTS Yes', 'prob' => $pred->btts_yes_prob, 'icon' => 'Y', 'color' => 'green-500'],
                            ['name' => 'BTTS No', 'prob' => $pred->btts_no_prob, 'icon' => 'N', 'color' => 'blue-500']
                        ];

                        foreach($markets as $market) {
                            if($market['prob'] > $bestProb) {
                                $bestProb = $market['prob'];
                                $bestMarket = $market['name'];
                                $icon = $market['icon'];
                                $color = $market['color'];
                            }
                        }
                    }
                @endphp
                <div class="flex flex-col items-center px-4">
                    <div class="w-12 h-12 bg-{{ $color }} rounded-full flex items-center justify-center text-white font-black mb-4 shadow-md text-xl">
                        {{ $icon }}
                    </div>
                    <div class="px-5 py-2 border-2 border-{{ $color }} rounded-full text-slate-800 font-bold text-sm shadow-sm bg-slate-50">
                        {{ $bestMarket }} Probability {{ $bestProb }}%
                    </div>
                </div>

                <!-- Away Team -->
                <div class="flex flex-col items-center gap-4">
                    <div class="w-28 h-28 bg-white rounded-2xl shadow-md flex items-center justify-center border border-slate-100 overflow-hidden p-3">
                        @if($fixture->awayTeam->logo_url)
                            <img src="{{ $fixture->awayTeam->logo_url }}" alt="{{ $fixture->awayTeam->name }}" class="w-full h-full object-contain">
                        @else
                            <div class="w-full h-full bg-slate-800 rounded-xl flex items-center justify-center text-white font-black text-3xl uppercase">
                                {{ substr($fixture->awayTeam->name ?? 'AWA', 0, 3) }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        
        <!-- Market Navigation Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-6">
            <button class="px-5 py-2 text-xs font-bold bg-slate-700 text-white rounded-full shadow-sm">{{ __('Under/Over 2.5') }}</button>
            <button class="px-5 py-2 text-xs font-bold text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-800 rounded-full border border-slate-200 transition-colors shadow-sm">{{ __('Half Time') }}</button>
            <button class="px-5 py-2 text-xs font-bold text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-800 rounded-full border border-slate-200 transition-colors shadow-sm">{{ __('HT/FT') }}</button>
            <button class="px-5 py-2 text-xs font-bold text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-800 rounded-full border border-slate-200 transition-colors shadow-sm">{{ __('Btts') }}</button>
            <button class="px-5 py-2 text-xs font-bold text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-800 rounded-full border border-slate-200 transition-colors shadow-sm">{{ __('Scorers') }}</button>
            <button class="px-5 py-2 text-xs font-bold text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-800 rounded-full border border-slate-200 transition-colors shadow-sm">{{ __('Corners') }}</button>
            <button class="px-5 py-2 text-xs font-bold text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-800 rounded-full border border-slate-200 transition-colors shadow-sm">{{ __('Cards') }}</button>
        </div>

        <!-- The Quantitative Summary Row (Dynamic Data) -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="w-full min-w-max">
                    <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="py-4 pl-6 text-left">{{ __('Teams') }}</th>
                            <th class="py-4 text-center">{{ __('Prob. %') }} <br> <span class="text-slate-500 font-black mt-1 block">O &nbsp;&nbsp;&nbsp;&nbsp; U</span></th>
                            <th class="py-4 text-center">{{ __('Pred') }}</th>
                            <th class="py-4 text-center">{{ __('Correct') }} <br> {{ __('Score') }}</th>
                            <th class="py-4 text-center">{{ __('Avg.') }} <br> {{ __('Goals') }}</th>
                            <th class="py-4 text-center">{{ __('Weather') }}
                            <th class="py-4 text-center">{{ __('Coef.') }}</th>
                            <th class="py-4 pr-6 text-center">{{ __('Score') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <!-- Teams -->
                            <td class="py-4 pl-6 text-left font-bold text-slate-800">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span class="w-4 h-4 rounded-full bg-slate-800 text-[8px] flex items-center justify-center text-white shrink-0 shadow-sm">{{ substr($fixture->homeTeam->name ?? 'H', 0, 1) }}</span>
                                    <span>{{ $fixture->homeTeam->name ?? 'Home Team' }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-500">
                                    <span class="w-4 h-4 rounded-full bg-slate-500 text-[8px] flex items-center justify-center text-white shrink-0 shadow-sm">{{ substr($fixture->awayTeam->name ?? 'A', 0, 1) }}</span>
                                    <span>{{ $fixture->awayTeam->name ?? 'Away Team' }}</span>
                                </div>
                            </td>
                            
                            <!-- Probabilities (O/U Highlighted) -->
                            @php
                                $over25 = $fixture->prediction->over_25_prob ?? 0;
                                $under25 = $fixture->prediction->under_25_prob ?? 0;
                                $predBubble = $over25 > $under25 ? 'O' : 'U';
                                // Fallback math if avg_goals column doesn't exist yet
                                $calcAvg = number_format(($over25 / 100) * 3.2 + ($under25 / 100) * 1.5, 2);
                            @endphp
                            <td class="py-4 text-xs font-bold text-center">
                                <div class="flex justify-center items-center gap-4">
                                    <span class="w-6 text-right {{ $over25 > $under25 ? 'text-green-500' : 'text-slate-700' }}">{{ $over25 }}</span>
                                    <span class="w-6 text-left {{ $under25 > $over25 ? 'text-green-500' : 'text-slate-700' }}">{{ $under25 }}</span>
                                </div>
                            </td>
                            
                            <!-- Pred Bubble -->
                            <td class="py-4 text-center">
                                <span class="bg-yellow-400 text-slate-900 text-[10px] font-black w-7 h-7 rounded-full flex items-center justify-center mx-auto shadow-sm">{{ $predBubble }}</span>
                            </td>
                            
                            <!-- Correct Score (Fallback if no DB column) -->
                            <td class="py-4 text-xs font-bold text-slate-700 text-center">
                                {{ $fixture->prediction->exact_score ?? 'N/A' }}
                            </td>
                            
                            <!-- Avg Goals -->
                            <td class="py-4 text-xs font-bold text-slate-700 text-center">
                                {{ $fixture->prediction->avg_goals ?? $calcAvg }}
                            </td>
                            
                            <!-- Weather (Pending API Integration) -->
                            <td class="py-4 text-xs font-bold text-slate-500 text-center">
                                <div class="flex justify-center items-center gap-1">
                                    - <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                                </div>
                            </td>
                            
                            <!-- Coefficient/Odds -->
                            <td class="py-4 text-xs font-bold text-blue-600 text-center">
                                {{ $fixture->odds ?? '-' }}
                            </td>
                            
                            <!-- Final Score -->
                            <td class="py-4 pr-6 text-center">
                                @if(!is_null($fixture->home_score) && !is_null($fixture->away_score))
                                    <span class="font-black text-slate-800 text-sm">{{ $fixture->home_score }} - {{ $fixture->away_score }}</span>
                                @else
                                    <span class="text-slate-400 font-black text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Form -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-md bg-slate-800 flex items-center justify-center text-white text-[10px] font-black shadow-sm uppercase">{{ substr($fixture->homeTeam->name ?? 'HOM', 0, 3) }}</div>
                        <span class="text-sm font-bold text-slate-800">{{ $fixture->homeTeam->name ?? 'Home Team' }}</span>
                    </div>
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Recent Form') }}</h3>
                </div>

                <div class="space-y-2">
                    @php $homeForm = $fixture->homeTeamForm ?? []; @endphp
                    @forelse($homeForm as $match)
                        @php
                            // Determine Win/Draw/Loss color
                            $isWin = false; $isDraw = false; $isLoss = false;
                            $teamScore = $match->home_team_id == $fixture->home_team_id ? $match->home_score : $match->away_score;
                            $oppScore = $match->home_team_id == $fixture->home_team_id ? $match->away_score : $match->home_score;
                            
                            if($teamScore > $oppScore) { $isWin = true; $bgColor = 'bg-green-100/50 border-green-200'; $textColor = 'text-green-700'; }
                            elseif($teamScore == $oppScore) { $isDraw = true; $bgColor = 'bg-yellow-100/50 border-yellow-200'; $textColor = 'text-yellow-700'; }
                            else { $isLoss = true; $bgColor = 'bg-red-100/50 border-red-200'; $textColor = 'text-red-700'; }
                        @endphp
                        <div class="flex items-center justify-between text-xs hover:bg-slate-50 p-2.5 rounded-xl transition-colors group">
                            <div class="text-[10px] text-slate-400 font-bold w-12 leading-tight">
                                {{ \Carbon\Carbon::parse($match->match_date)->format('d/m') }}<br>
                                {{ \Carbon\Carbon::parse($match->match_date)->format('Y') }}
                            </div>
                            <div class="flex-1 flex items-center justify-center gap-4">
                                <span class="text-slate-800 font-bold text-right w-24 truncate">{{ $match->homeTeam->name ?? 'Home' }}</span>
                                <div class="flex flex-col items-center justify-center w-14 {{ $bgColor }} border rounded py-1">
                                    <span class="font-black {{ $textColor }}">{{ $match->home_score }} - {{ $match->away_score }}</span>
                                </div>
                                <span class="text-slate-500 font-medium text-left w-24 truncate">{{ $match->awayTeam->name ?? 'Away' }}</span>
                            </div>
                            <div class="text-[9px] text-slate-400 font-bold uppercase w-8 text-right">{{ substr($match->league->name ?? 'LGE', 0, 3) }}</div>
                        </div>
                    @empty
                        <div class="text-center text-xs text-slate-400 py-6 font-bold">No recent matches found.</div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-md bg-slate-500 flex items-center justify-center text-white text-[10px] font-black shadow-sm uppercase">{{ substr($fixture->awayTeam->name ?? 'AWA', 0, 3) }}</div>
                        <span class="text-sm font-bold text-slate-800">{{ $fixture->awayTeam->name ?? 'Away Team' }}</span>
                    </div>
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Recent Form') }}</h3>
                </div>

                <div class="space-y-2">
                    @php $awayForm = $fixture->awayTeamForm ?? []; @endphp
                    @forelse($awayForm as $match)
                        @php
                            $isWin = false; $isDraw = false; $isLoss = false;
                            $teamScore = $match->home_team_id == $fixture->away_team_id ? $match->home_score : $match->away_score;
                            $oppScore = $match->home_team_id == $fixture->away_team_id ? $match->away_score : $match->home_score;
                            
                            if($teamScore > $oppScore) { $isWin = true; $bgColor = 'bg-green-100/50 border-green-200'; $textColor = 'text-green-700'; }
                            elseif($teamScore == $oppScore) { $isDraw = true; $bgColor = 'bg-yellow-100/50 border-yellow-200'; $textColor = 'text-yellow-700'; }
                            else { $isLoss = true; $bgColor = 'bg-red-100/50 border-red-200'; $textColor = 'text-red-700'; }
                        @endphp
                        <div class="flex items-center justify-between text-xs hover:bg-slate-50 p-2.5 rounded-xl transition-colors group">
                            <div class="text-[10px] text-slate-400 font-bold w-12 leading-tight">
                                {{ \Carbon\Carbon::parse($match->match_date)->format('d/m') }}<br>
                                {{ \Carbon\Carbon::parse($match->match_date)->format('Y') }}
                            </div>
                            <div class="flex-1 flex items-center justify-center gap-4">
                                <span class="text-slate-800 font-bold text-right w-24 truncate">{{ $match->homeTeam->name ?? 'Home' }}</span>
                                <div class="flex flex-col items-center justify-center w-14 {{ $bgColor }} border rounded py-1">
                                    <span class="font-black {{ $textColor }}">{{ $match->home_score }} - {{ $match->away_score }}</span>
                                </div>
                                <span class="text-slate-500 font-medium text-left w-24 truncate">{{ $match->awayTeam->name ?? 'Away' }}</span>
                            </div>
                            <div class="text-[9px] text-slate-400 font-bold uppercase w-8 text-right">{{ substr($match->league->name ?? 'LGE', 0, 3) }}</div>
                        </div>
                    @empty
                        <div class="text-center text-xs text-slate-400 py-6 font-bold">No recent matches found.</div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- 2-Column Grid for H2H and Match Intro -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            
            <!-- Task 4: Head to Head (Dynamic Data) -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest text-center mb-6">{{ __('Head to Head') }}</h3>
                
                <!-- Filters -->
                <div class="flex flex-wrap gap-2 mb-6 border-b border-slate-100 pb-4 justify-center">
                    <button class="px-4 py-1.5 text-[10px] font-bold bg-slate-700 text-white rounded-full">{{ __('All') }}</button>
                    <button class="px-4 py-1.5 text-[10px] font-bold text-slate-500 bg-slate-50 rounded-full hover:bg-slate-100 border border-slate-100 transition-colors">{{ __('League') }}</button>
                </div>

                <!-- Match List -->
                <div class="space-y-2 mb-8 max-h-[250px] overflow-y-auto pr-2 custom-scrollbar">
                    @php
                        // We assume $fixture->h2h will be an array/collection of historical matches
                        $h2hMatches = $fixture->h2h ?? [];
                        $homeWins = 0;
                        $awayWins = 0;
                        $draws = 0;
                        $totalMatches = count($h2hMatches);
                    @endphp

                    @forelse($h2hMatches as $match)
                        @php
                            // Calculate stats for the distribution bar
                            if($match->home_score > $match->away_score) {
                                if($match->home_team_id == $fixture->home_team_id) $homeWins++; else $awayWins++;
                            } elseif($match->away_score > $match->home_score) {
                                if($match->away_team_id == $fixture->home_team_id) $homeWins++; else $awayWins++;
                            } else {
                                $draws++;
                            }
                        @endphp
                        <div class="flex items-center justify-between text-xs hover:bg-slate-50 p-2.5 rounded-xl transition-colors group">
                            <div class="text-[10px] text-slate-400 font-bold w-12 leading-tight">
                                {{ \Carbon\Carbon::parse($match->match_date)->format('d/m') }}<br>
                                {{ \Carbon\Carbon::parse($match->match_date)->format('Y') }}
                            </div>
                            <div class="flex-1 flex items-center justify-center gap-4">
                                <span class="text-slate-700 font-bold text-right w-20 truncate">{{ $match->homeTeam->name ?? 'Home' }}</span>
                                <div class="flex flex-col items-center justify-center w-14 bg-slate-100 rounded py-1 group-hover:bg-white group-hover:shadow-sm transition-all">
                                    <span class="font-black text-slate-800">{{ $match->home_score }} - {{ $match->away_score }}</span>
                                    <span class="text-[9px] text-slate-400 mt-0.5">({{ $match->ht_home_score ?? 0 }} - {{ $match->ht_away_score ?? 0 }})</span>
                                </div>
                                <span class="text-slate-700 font-bold text-left w-20 truncate">{{ $match->awayTeam->name ?? 'Away' }}</span>
                            </div>
                            <div class="text-[9px] text-slate-400 font-bold uppercase w-8 text-right">{{ substr($match->league->name ?? 'LGE', 0, 3) }}</div>
                        </div>
                    @empty
                        <div class="text-center text-xs text-slate-400 py-6 font-bold">
                            {{ __('No historical H2H data available yet.') }}
                        </div>
                    @endforelse
                </div>

                <!-- Win Distribution Bar -->
                @php
                    $homePct = $totalMatches > 0 ? round(($homeWins / $totalMatches) * 100) : 0;
                    $drawPct = $totalMatches > 0 ? round(($draws / $totalMatches) * 100) : 0;
                    $awayPct = $totalMatches > 0 ? round(($awayWins / $totalMatches) * 100) : 0;
                @endphp
                <div class="mb-2">
                    <div class="flex h-2.5 rounded-full overflow-hidden w-full mb-4 bg-slate-100">
                        <div class="bg-green-500 transition-all duration-500" style="width: {{ $homePct }}%"></div>
                        <div class="bg-yellow-400 relative transition-all duration-500" style="width: {{ $drawPct }}%">
                            @if($drawPct > 0)<div class="absolute inset-y-0 right-0 w-px bg-white/50"></div>@endif
                        </div>
                        <div class="bg-red-500 transition-all duration-500" style="width: {{ $awayPct }}%"></div>
                    </div>
                    <div class="flex justify-between text-center text-[10px] font-bold text-slate-500">
                        <div><span class="text-slate-800 block mb-1">{{ substr($fixture->homeTeam->name ?? 'Home', 0, 10) }} {{ $homeWins }}</span> {{ $homePct }}%</div>
                        <div><span class="text-slate-800 block mb-1">Draw {{ $draws }}</span> {{ $drawPct }}%</div>
                        <div><span class="text-slate-800 block mb-1">{{ substr($fixture->awayTeam->name ?? 'Away', 0, 10) }} {{ $awayWins }}</span> {{ $awayPct }}%</div>
                    </div>
                </div>
                
                <!-- View All Button -->
                <div class="text-center mt-8">
                    <button class="text-[10px] font-bold text-slate-500 border border-slate-200 rounded-full px-8 py-2.5 hover:bg-slate-50 hover:text-slate-800 transition-colors shadow-sm">{{ __('View all') }}</button>
                </div>
            </div>

            <!-- Task 5: Match Intro (Dummy Data) -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col">
                <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest text-center mb-6">{{ __('Match Intro') }}</h3>
                
                <div class="text-sm text-slate-600 space-y-5 leading-relaxed flex-1">
                    <p>{{ $fixture->homeTeam->name ?? 'Home' }} and {{ $fixture->awayTeam->name ?? 'Away' }} meet in the {{ $fixture->league->name ?? 'League' }} at {{ $fixture->venue_name ?? 'the stadium' }} on {{ \Carbon\Carbon::parse($fixture->match_at)->format('j F Y') }}.</p>
                    
                    <p>{{ __('Looking at historical data, we have recorded') }} {{ $totalMatches ?? 0 }} {{ __('direct encounters between these two sides.') }} {{ $fixture->homeTeam->name ?? 'The home team' }} {{ __('has secured') }} {{ $homeWins ?? 0 }} {{ __('victories, while') }} {{ $fixture->awayTeam->name ?? 'the visitors' }} {{ __('have won') }} {{ $awayWins ?? 0 }} {{ __('times. They have drawn') }} {{ $draws ?? 0 }} {{ __('matches.') }}</p>
                    
                    <div class="mt-8 p-4 bg-yellow-50/80 rounded-xl border border-yellow-200/60 shadow-sm flex items-start gap-3">
                        <div class="mt-0.5 text-yellow-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <p class="font-bold text-slate-800">{{ __('Our algorithm predicts the highest probability edge on the') }} <span class="uppercase text-yellow-600 font-black">{{ $bestMarket ?? 'NO BET' }}</span> {{ __('market.') }}</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- League Standing -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-6">
            <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest text-center mb-6">{{ __('Standings of Both Teams') }}</h3>
            
            <div class="overflow-x-auto space-y-8">
                
                @php $homeStandings = $fixture->homeStandings ?? []; @endphp
                @if(count($homeStandings) > 0)
                <table class="w-full min-w-max text-xs text-slate-600">
                    <thead class="text-[10px] uppercase font-bold text-slate-400 border-b border-slate-100">
                        <tr>
                            <th class="text-left py-3 pl-4">{{ $fixture->league->name ?? 'League' }} (Home)</th>
                            <th class="py-3 text-center w-12">{{ __('Pts') }}</th>
                            <th class="py-3 text-center w-10">{{ __('GP') }}</th>
                            <th class="py-3 text-center w-10">{{ __('W') }}</th>
                            <th class="py-3 text-center w-10">{{ __('D') }}</th>
                            <th class="py-3 text-center w-10">{{ __('L') }}</th>
                            <th class="py-3 text-center w-10">{{ __('GF') }}</th>
                            <th class="py-3 text-center w-10">{{ __('GA') }}</th>
                            <th class="py-3 text-center w-10">{{ __('+/-') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($homeStandings as $row)
                        <tr class="{{ $row->team_id == $fixture->home_team_id ? 'bg-yellow-50/60 border-l-4 border-yellow-400 hover:bg-yellow-100/50' : 'hover:bg-slate-50' }} transition-colors">
                            <td class="py-3 pl-3 flex items-center gap-3">
                                <span class="text-slate-400 font-bold w-4 text-right">{{ $row->rank }}</span>
                                <span class="{{ $row->team_id == $fixture->home_team_id ? 'font-bold text-slate-900' : '' }}">{{ $row->team->name ?? 'Team' }}</span>
                            </td>
                            <td class="text-center font-black text-slate-900">{{ $row->points }}</td>
                            <td class="text-center">{{ $row->played }}</td>
                            <td class="text-center">{{ $row->win }}</td>
                            <td class="text-center">{{ $row->draw }}</td>
                            <td class="text-center">{{ $row->lose }}</td>
                            <td class="text-center">{{ $row->goals_for }}</td>
                            <td class="text-center">{{ $row->goals_against }}</td>
                            <td class="text-center">{{ $row->goals_diff }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="text-center text-xs text-slate-400 font-bold mb-4">{{ __('No league standings found for') }} {{ $fixture->homeTeam->name ?? 'Home Team' }}.</div>
                @endif

                @php $awayStandings = $fixture->awayStandings ?? []; @endphp
                @if(count($awayStandings) > 0)
                <table class="w-full min-w-max text-xs text-slate-600">
                    <thead class="text-[10px] uppercase font-bold text-slate-400 border-b border-slate-100">
                        <tr>
                            <th class="text-left py-3 pl-4">{{ $fixture->league->name ?? 'League' }} (Away)</th>
                            <th class="py-3 text-center w-12">{{ __('Pts') }}</th>
                            <th class="py-3 text-center w-10">{{ __('GP') }}</th>
                            <th class="py-3 text-center w-10">{{ __('W') }}</th>
                            <th class="py-3 text-center w-10">{{ __('D') }}</th>
                            <th class="py-3 text-center w-10">{{ __('L') }}</th>
                            <th class="py-3 text-center w-10">{{ __('GF') }}</th>
                            <th class="py-3 text-center w-10">{{ __('GA') }}</th>
                            <th class="py-3 text-center w-10">{{ __('+/-') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($awayStandings as $row)
                        <tr class="{{ $row->team_id == $fixture->away_team_id ? 'bg-yellow-50/60 border-l-4 border-yellow-400 hover:bg-yellow-100/50' : 'hover:bg-slate-50' }} transition-colors">
                            <td class="py-3 pl-3 flex items-center gap-3">
                                <span class="text-slate-400 font-bold w-4 text-right">{{ $row->rank }}</span>
                                <span class="{{ $row->team_id == $fixture->away_team_id ? 'font-bold text-slate-900' : '' }}">{{ $row->team->name ?? 'Team' }}</span>
                            </td>
                            <td class="text-center font-black text-slate-900">{{ $row->points }}</td>
                            <td class="text-center">{{ $row->played }}</td>
                            <td class="text-center">{{ $row->win }}</td>
                            <td class="text-center">{{ $row->draw }}</td>
                            <td class="text-center">{{ $row->lose }}</td>
                            <td class="text-center">{{ $row->goals_for }}</td>
                            <td class="text-center">{{ $row->goals_against }}</td>
                            <td class="text-center">{{ $row->goals_diff }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="text-center text-xs text-slate-400 font-bold">{{ __('No league standings found for') }} {{ $fixture->awayTeam->name ?? 'Away Team' }}.</div>
                @endif

            </div>
        </div>

        

    </div>
</x-layout>