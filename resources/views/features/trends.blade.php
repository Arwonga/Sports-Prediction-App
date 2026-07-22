<x-layout title="Market Trends | Alpha Predictions">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        
        <!-- Header -->
        <div class="bg-slate-900 px-6 py-5 border-b-4 border-red-600 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-white tracking-wide">{{ __('Global Market Trends') }}</h2>
                <p class="text-xs text-slate-400 mt-1">{{ __('Track where the smart money is moving across top leagues.') }}</p>
            </div>
            
            <!-- Interactive Market Filter Dropdown -->
            <select id="market-filter" onchange="filterMarketTrends()" class="bg-slate-800 text-slate-300 text-xs font-bold border border-slate-700 rounded-lg px-3 py-2 focus:outline-none focus:border-red-500 transition-colors cursor-pointer">
                <option value="all">All Markets</option>
                <option value="over-under">Over/Under Goals</option>
                <option value="btts">Both Teams to Score</option>
                <option value="home-away">Home/Away Wins</option>
            </select>
        </div>

        <!-- Content Area -->
        <div class="p-6 space-y-8">
            
            <!-- SECTION 1: OVER / UNDER GOALS -->
            <div class="market-section" data-market="over-under">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4 border-b border-slate-100 pb-2">Over / Under Goals Market</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($over25Trends as $trend)
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-red-100 text-red-600 text-[10px] font-black px-2 py-1 rounded uppercase tracking-wider">Over 2.5 Goals</span>
                                <span class="text-sm font-black text-slate-800">{{ $trend->prediction->over_25_prob }}% Prob</span>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 mb-2">
                                {{ $trend->homeTeam->name }} vs {{ $trend->awayTeam->name }}
                            </h3>
                            <p class="text-xs text-slate-500 font-medium leading-relaxed mb-3">
                                The quantitative model heavily favors a high-scoring game here, projecting a combined {{ number_format(($trend->prediction->home_xg + $trend->prediction->away_xg), 2) }} Expected Goals (xG).
                            </p>
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider border-t border-slate-200 pt-3">
                                Kickoff: {{ \Carbon\Carbon::parse($trend->match_at)->format('d M Y - H:i') }}
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full p-4 bg-slate-50 rounded text-center text-sm text-slate-500 font-semibold border border-slate-200">
                            No Over 2.5 Goal trends detected for today.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- SECTION 2: BOTH TEAMS TO SCORE (BTTS) -->
            <div class="market-section" data-market="btts">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4 border-b border-slate-100 pb-2">Both Teams to Score (BTTS) Market</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($bttsTrends as $trend)
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-blue-100 text-blue-600 text-[10px] font-black px-2 py-1 rounded uppercase tracking-wider">BTTS: YES</span>
                                <span class="text-sm font-black text-slate-800">{{ $trend->prediction->btts_yes_prob }}% Prob</span>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 mb-2">
                                {{ $trend->homeTeam->name }} vs {{ $trend->awayTeam->name }}
                            </h3>
                            <p class="text-xs text-slate-500 font-medium leading-relaxed mb-3">
                                Both offensive units are showing strong metrics. The model indicates a high probability of both teams finding the back of the net.
                            </p>
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider border-t border-slate-200 pt-3">
                                Kickoff: {{ \Carbon\Carbon::parse($trend->match_at)->format('d M Y - H:i') }}
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full p-4 bg-slate-50 rounded text-center text-sm text-slate-500 font-semibold border border-slate-200">
                            No BTTS trends detected for today.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- SECTION 3: HOME / AWAY WINS (Placeholder ready for data expansion) -->
            <!-- SECTION 3: HOME / AWAYS WINS -->
            <div class="market-section" data-market="home-away">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4 border-b border-slate-100 pb-2">Top Home / Away Win Probabilities</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($homeAwayTrends as $trend)
                        @php
                            $isHomeFavored = ($trend->prediction->home_win_prob ?? 0) >= ($trend->prediction->away_win_prob ?? 0);
                            $favoredTeam = $isHomeFavored ? ($trend->homeTeam->name ?? 'Home') : ($trend->awayTeam->name ?? 'Away');
                            $favoredProb = $isHomeFavored ? $trend->prediction->home_win_prob : $trend->prediction->away_win_prob;
                        @endphp
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-emerald-100 text-emerald-600 text-[10px] font-black px-2 py-1 rounded uppercase tracking-wider">{{ $isHomeFavored ? 'Home Win Favored' : 'Away Win Favored' }}</span>
                                <span class="text-sm font-black text-slate-800">{{ $favoredProb }}% Prob</span>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 mb-2">
                                {{ $trend->homeTeam->name }} vs {{ $trend->awayTeam->name }}
                            </h3>
                            <p class="text-xs text-slate-500 font-medium leading-relaxed mb-3">
                                Model indicates strong confidence in <span class="font-bold text-slate-700">{{ $favoredTeam }}</span> taking control of this fixture based on recent performance metrics.
                            </p>
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider border-t border-slate-200 pt-3">
                                Kickoff: {{ \Carbon\Carbon::parse($trend->match_at)->format('d M Y - H:i') }}
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full p-4 bg-slate-50 rounded text-center text-sm text-slate-500 font-semibold border border-slate-200">
                            No high-probability win trends detected for today.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

    <!-- Filtering JavaScript Script -->
    <script>
        function filterMarketTrends() {
            let selectedValue = document.getElementById('market-filter').value;
            let sections = document.querySelectorAll('.market-section');

            sections.forEach(section => {
                let marketType = section.getAttribute('data-market');
                if (selectedValue === 'all' || selectedValue === marketType) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }
    </script>

</x-layout>