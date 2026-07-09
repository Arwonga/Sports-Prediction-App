<x-layout title="Alpha Predictions | Quantitative Data">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    
    <div class="bg-slate-900 px-6 py-4 border-b-4 border-red-600">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-white tracking-wide">Precise Mathematical Predictions</h2>
            
            <div class="flex items-center gap-3">
                <span class="text-xs text-slate-300 font-semibold uppercase tracking-wider">Form</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="" class="sr-only peer">
                    <div class="w-9 h-5 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-500 shadow-inner"></div>
                </label>
            </div>
        </div>

        <!-- Date Navigation Tabs -->
        <div class="flex items-center justify-center space-x-6 mt-4">
            @foreach($navigationDates as $nav)
                <a href="{{ url('/?date=' . $nav['date_string']) }}" 
                class="px-4 py-1.5 rounded-full text-sm font-bold transition-all duration-200 
                {{ $nav['is_active'] ? 'bg-slate-700 text-white shadow-inner' : 'text-slate-400 hover:text-white' }}">
                    {{ $nav['label'] }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-center whitespace-nowrap">
            <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-wider border-b border-slate-200">
                <tr>
                    <th class="py-4 pl-6 text-left">Home / Away</th>
                    <th class="py-4">Win % <br> <span class="text-slate-500 font-black mt-1 block">1 &nbsp;&nbsp;&nbsp;&nbsp; 2</span></th>
                    <th class="py-4">BTTS % <br> <span class="text-slate-500 font-black mt-1 block">Y &nbsp;&nbsp;&nbsp;&nbsp; N</span></th>
                    <th class="py-4">O/U 2.5 <br> <span class="text-slate-500 font-black mt-1 block">O &nbsp;&nbsp;&nbsp;&nbsp; U</span></th>
                    <th class="py-4">Avg <br> Goals</th>
                    <th class="py-4">Coef. <br> &nbsp;</th>
                    <th class="py-4">Verdict <br> &nbsp;</th>
                    <th class="py-4">FT <br> Score</th>
                    <th class="py-4 pr-6">More <br> &nbsp;</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($fixtures ?? [] as $index => $fixture)
    @php
        $pred = $fixture->prediction;
        
        // 1. Calculate Average Goals on the fly (Home xG + Away xG)
        $avgGoals = ($pred->home_xg ?? 0) + ($pred->away_xg ?? 0);
        
        // 2. Calculate Implied Odds (Coefficient) based on highest win probability
        $maxProb = max($pred->home_win_prob ?? 1, $pred->away_win_prob ?? 1);
        $coefficient = $maxProb > 0 ? (100 / $maxProb) : 0.00;
        
        // 3. Handle Full Time Score 
        $homeScore = $fixture->home_goals; 
        $awayScore = $fixture->away_goals;
        $isPlayed = !is_null($homeScore) && !is_null($awayScore);
    @endphp
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <!-- Teams & Match Time -->
                        <td class="py-4 pl-6 text-left font-bold text-slate-800">
                        <a href="{{ route('predictions.show', $fixture->id) }}" class="group/link block">
                            <div class="flex items-center gap-2 mb-1.5">
                                <div class="flex items-center justify-center px-1.5 py-0.5 bg-blue-500/10 border border-blue-500/20 rounded shadow-sm shrink-0">
                                    <span class="text-blue-600 text-[10px] font-black mr-1">H</span>
                                    <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                </div>
                                <span class="truncate group-hover/link:text-blue-600 transition-colors">{{ $fixture->homeTeam->name ?? 'Home Team' }}</span>
                            </div>
                            
                            <div class="flex items-center gap-2 text-slate-500">
                                <div class="flex items-center justify-center px-1.5 py-0.5 bg-red-500/10 border border-red-500/20 rounded shadow-sm shrink-0">
                                    <span class="text-red-600 text-[10px] font-black mr-1">A</span>
                                    <svg class="w-3 h-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <span class="truncate group-hover/link:text-blue-600 transition-colors">{{ $fixture->awayTeam->name ?? 'Away Team' }}</span>
                            </div>
                        </a>

                        <div class="flex items-center gap-1.5 mt-2 text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ \Carbon\Carbon::parse($fixture->match_at)->timezone(session('timezone', 'Africa/Nairobi'))->format('H:i') }}</span>
                        </div>
                        </td>

                        <td class="py-4 text-xs font-bold text-center">
            @php
                $homeWin = $pred->home_win_prob ?? 57;
                $awayWin = $pred->away_win_prob ?? 18;
            @endphp
            <div class="flex justify-center items-center gap-4">
                <span class="w-6 text-right {{ $homeWin > $awayWin ? 'text-green-500' : 'text-slate-700' }}">{{ $homeWin }}</span>
                <span class="w-6 text-left {{ $awayWin > $homeWin ? 'text-green-500' : 'text-slate-700' }}">{{ $awayWin }}</span>
            </div>
        </td>

        <td class="py-4 text-xs font-bold text-center">
            @php
                $bttsYes = $pred->btts_yes_prob ?? 61;
                $bttsNo = $pred->btts_no_prob ?? 39;
            @endphp
            <div class="flex justify-center items-center gap-4">
                <span class="w-6 text-right {{ $bttsYes > $bttsNo ? 'text-green-500' : 'text-slate-700' }}">{{ $bttsYes }}</span>
                <span class="w-6 text-left {{ $bttsNo > $bttsYes ? 'text-green-500' : 'text-slate-700' }}">{{ $bttsNo }}</span>
            </div>
        </td>

        <td class="py-4 text-xs font-bold text-center">
            @php
                $over25 = $pred->over_25_prob ?? 60;
                $under25 = $pred->under_25_prob ?? 40;
            @endphp
            <div class="flex justify-center items-center gap-4">
                <span class="w-6 text-right {{ $over25 > $under25 ? 'text-green-500' : 'text-slate-700' }}">{{ $over25 }}</span>
                <span class="w-6 text-left {{ $under25 > $over25 ? 'text-green-500' : 'text-slate-700' }}">{{ $under25 }}</span>
            </div>
        </td>

                            <!-- 1. Average Goals Prediction -->
                            <td class="py-4 text-xs font-bold text-slate-700 text-center">
                                {{ number_format($avgGoals, 2) }}
                            </td>

                        <!-- 2. Coefficient (Implied Odds) -->
                        <td class="py-4 text-xs font-bold text-blue-600 text-center">
                            {{ number_format($coefficient, 2) }}
                        </td>

                        <!-- 3. Final Verdict Bubble -->
                        <td class="py-4 text-center">
                                @php
                                    $verdict = 'AWAITING DATA';
                                    
                                    if ($fixture->prediction) {
                                        // 1. Fetch 1X2 Probabilities
                                        $homeProb = $fixture->prediction->home_win_prob ?? 0;
                                        $drawProb = $fixture->prediction->draw_prob ?? 0;
                                        $awayProb = $fixture->prediction->away_win_prob ?? 0;
                                        
                                        // 2. Fetch and Sort Goal/Action Markets (The Fallback)
                                        $goalMarkets = [
                                            'OVER 2.5' => $fixture->prediction->over_25_prob ?? 0,
                                            'UNDER 2.5' => $fixture->prediction->under_25_prob ?? 0,
                                            'BTTS YES' => $fixture->prediction->btts_yes_prob ?? 0,
                                            'BTTS NO' => $fixture->prediction->btts_no_prob ?? 0,
                                        ];
                                        arsort($goalMarkets);
                                        $bestGoalMarket = key($goalMarkets); // Gets the name of the highest goal market
                                        
                                        // 3. The Quantitative Filter (Risk Management)
                                        // Any win probability below this percentage is considered "too tricky"
                                        $confidenceThreshold = 40; 

                                        if ($drawProb >= $homeProb && $drawProb >= $awayProb) {
                                            // RISK DETECTED: Draw is the most likely outcome. Pivot to goals.
                                            $verdict = $bestGoalMarket;
                                        } elseif ($homeProb > $awayProb && $homeProb >= $confidenceThreshold) {
                                            // STRONG SIGNAL: Home team has the edge and passes the safety threshold.
                                            $verdict = 'HOME WIN';
                                        } elseif ($awayProb > $homeProb && $awayProb >= $confidenceThreshold) {
                                            // STRONG SIGNAL: Away team has the edge and passes the safety threshold.
                                            $verdict = 'AWAY WIN';
                                        } else {
                                            // TRICKY MATCH: No clear favorite passes the confidence threshold. Pivot to goals.
                                            $verdict = $bestGoalMarket;
                                        }
                                    }
                                @endphp
                                
                                <span class="bg-yellow-400 text-slate-900 text-[10px] font-black px-3 py-1.5 rounded shadow-sm uppercase whitespace-nowrap">
                                    {{ strtoupper($verdict) }}
                                </span>
                            </td>

        <!-- 4. Full Time Score -->
        <td class="py-4 text-center">
            @if(!is_null($fixture->home_score) && !is_null($fixture->away_score))
                <div class="flex flex-col items-center justify-center">
                    <span class="font-black text-slate-800 text-sm tracking-widest bg-slate-100 px-2 py-1 rounded shadow-inner">
                        {{ $fixture->home_score }} - {{ $fixture->away_score }}
                    </span>
                </div>
            @else
                <span class="text-slate-300 font-black text-sm">-</span>
            @endif
        </td>

        <!-- 5. Toggle More Markets Button -->
        <td class="py-4 pr-6 text-center">
            <button onclick="document.getElementById('markets-{{ $index }}').classList.toggle('hidden')" class="text-slate-400 hover:text-blue-600 transition-colors">
                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
        </td>                  
                    </tr>

                    <tr id="markets-{{ $index }}" class="hidden bg-slate-900 border-b-4 border-slate-800">
                        <td colspan="6" class="p-6">
                            <div class="grid grid-cols-4 gap-6 text-left">
                                <div class="bg-slate-800 p-4 rounded-lg border border-slate-700">
                                    <h4 class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-3">Expected Goals (xG)</h4>
                                    <div class="flex justify-between text-sm font-black text-white mb-2">
                                        <span>Home xG:</span> <span class="text-blue-400">{{ $fixture->prediction->home_xg ?? '1.84' }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm font-black text-white">
                                        <span>Away xG:</span> <span class="text-red-400">{{ $fixture->prediction->away_xg ?? '0.92' }}</span>
                                    </div>
                                </div>

                                <div class="bg-slate-800 p-4 rounded-lg border border-slate-700">
                                    <h4 class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-3">Top Scores</h4>
                                    <div class="space-y-1">
                                        @if(isset($fixture->prediction->top_scores) && is_iterable($fixture->prediction->top_scores))
                                        @foreach($fixture->prediction->top_scores as $score => $prob)
                                            <div class="flex justify-between text-xs font-bold text-slate-300">
                                            <span>{{ $score }}</span> <span class="text-yellow-400">{{ $prob }}%</span>
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class="bg-slate-800 p-4 rounded-lg border border-slate-700">
                                    <h4 class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-3">Model Confidence</h4>
                                    <div class="flex items-end gap-2">
                                        <span class="text-3xl font-black text-green-400">{{ $fixture->prediction->confidence ?? '84' }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-700 h-1.5 mt-3 rounded-full overflow-hidden">
                                        <div class="bg-green-400 h-full w-[84%]"></div>
                                    </div>
                                </div>

                                <div class="bg-slate-800 p-4 rounded-lg border border-slate-700 space-y-3">
                                    <div>
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest block mb-1">Risk Rating</span>
                                        <span class="bg-green-500/20 text-green-400 text-[10px] font-black px-2 py-1 rounded border border-green-500/30">{{ $fixture->prediction->risk ?? 'LOW' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest block mb-1">Value Rating</span>
                                        <span class="bg-blue-500/20 text-blue-400 text-[10px] font-black px-2 py-1 rounded border border-blue-500/30">{{ $fixture->prediction->value ?? 'HIGH' }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-400 text-sm font-semibold">
                            No fixtures found for today.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function filterMatches() {
        // Get the search input value and convert to lowercase
        let input = document.getElementById('match-search').value.toLowerCase();
        let tableBody = document.querySelector('tbody');
        
        // Target all the main match rows (they have the 'group' class)
        let matchRows = tableBody.querySelectorAll('tr.group');
        let noMatchRow = document.getElementById('no-match-message');
        let matchFound = false;

        matchRows.forEach(row => {
            // The first column contains the team names
            let teamNames = row.querySelector('td:first-child').textContent.toLowerCase();
            let analyticsRow = row.nextElementSibling; // The hidden dropdown row underneath

            // If the search term is found in the team names
            if (teamNames.includes(input)) {
                row.style.display = ''; // Show match
                matchFound = true;
            } else {
                row.style.display = 'none'; // Hide match
                // Ensure the expanded analytics row hides too if it was open
                if (analyticsRow && analyticsRow.id.startsWith('markets-')) {
                    analyticsRow.classList.add('hidden');
                }
            }
        });

        // Handle the "No match found" message
        if (!matchFound && input !== '') {
            if (!noMatchRow) {
                // Create the message row if it doesn't exist
                tableBody.insertAdjacentHTML('beforeend', '<tr id="no-match-message"><td colspan="8" class="py-12 text-center text-slate-400 text-sm font-semibold">No matches found for "' + input + '".</td></tr>');
            } else {
                // Update text and show if it does exist
                noMatchRow.querySelector('td').innerText = 'No matches found for "' + input + '".';
                noMatchRow.style.display = '';
            }
        } else if (noMatchRow) {
            // Hide the message if matches are found or input is cleared
            noMatchRow.style.display = 'none';
        }
    }
</script>

</x-layout>