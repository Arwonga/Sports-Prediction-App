<x-layout title="Head-to-Head Analytics | Alpha Predictions">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden min-h-[500px]">
        
        <!-- Compact Header & Search -->
        <div class="bg-slate-900 px-6 py-6 border-b-4 border-red-600 relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="relative z-10">
                <h2 class="text-xl font-black text-white tracking-tight">{{ __('Head-to-Head Analytics') }}</h2>
                <p class="text-slate-400 text-xs font-medium mt-1">Deep quantitative comparison and historical matchups.</p>
            </div>
            
            <form action="{{ route('features.team-comparison') }}" method="GET" class="w-full md:w-72 relative group z-10">
                <input type="text" name="search" value="{{ $search }}" 
                    class="w-full bg-slate-800 border border-slate-700 text-white text-xs rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-red-500 outline-none placeholder-slate-500 transition-all shadow-inner" 
                    placeholder="Search team...">
                <button type="submit" class="absolute right-1.5 top-1.5 bottom-1.5 bg-red-600 hover:bg-red-700 text-white rounded px-3 text-[10px] font-black tracking-wider transition-colors">
                    FIND
                </button>
            </form>
        </div>

        <div class="p-6 bg-slate-50">
            
            @if($search)
                <!-- ================= COMPACT SEARCH RESULTS ================= -->
                <div class="flex items-center justify-between mb-4 border-b border-slate-200 pb-3">
                    <h3 class="text-xs font-bold text-slate-500">Results for: <span class="text-slate-900 text-sm">"{{ $search }}"</span></h3>
                    <a href="{{ route('features.team-comparison') }}" class="text-[10px] font-bold text-red-600 hover:underline">Clear &times;</a>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    @forelse($searchResults as $result)
                        <a href="{{ route('predictions.show', $result->id) }}" class="bg-white border border-slate-200 rounded-xl p-4 hover:shadow-md hover:border-red-300 transition-all group flex flex-col items-center">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-3">{{ \Carbon\Carbon::parse($result->match_at)->format('d M y') }}</span>
                            <div class="flex items-center justify-between w-full gap-2">
                                
                                <div class="flex flex-col items-center w-[45%]">
                                    <div class="w-10 h-10 mb-2 overflow-hidden rounded-full shadow-sm border border-slate-100 bg-slate-50 p-1">
                                        @if(isset($result->homeTeam->logo_url))
                                            <img src="{{ $result->homeTeam->logo_url }}" alt="{{ $result->homeTeam->name }}" class="w-full h-full object-contain">
                                        @else
                                            <div class="w-full h-full bg-slate-800 rounded-full flex items-center justify-center text-white font-black text-[10px] uppercase">
                                                {{ substr($result->homeTeam->name ?? 'HOM', 0, 3) }}
                                            </div>
                                        @endif
                                    </div>
                                    <span class="text-[10px] font-bold text-slate-800 text-center leading-tight truncate w-full">{{ $result->homeTeam->name }}</span>
                                </div>
                                
                                <div class="text-[9px] font-black text-slate-300 uppercase">VS</div>
                                
                                <div class="flex flex-col items-center w-[45%]">
                                    <div class="w-10 h-10 mb-2 overflow-hidden rounded-full shadow-sm border border-slate-100 bg-slate-50 p-1">
                                        @if(isset($result->awayTeam->logo_url))
                                            <img src="{{ $result->awayTeam->logo_url }}" alt="{{ $result->awayTeam->name }}" class="w-full h-full object-contain">
                                        @else
                                            <div class="w-full h-full bg-slate-800 rounded-full flex items-center justify-center text-white font-black text-[10px] uppercase">
                                                {{ substr($result->awayTeam->name ?? 'AWA', 0, 3) }}
                                            </div>
                                        @endif
                                    </div>
                                    <span class="text-[10px] font-bold text-slate-800 text-center leading-tight truncate w-full">{{ $result->awayTeam->name }}</span>
                                </div>
                                
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full py-8 text-center text-sm text-slate-500">No fixtures found for "{{ $search }}".</div>
                    @endforelse
                </div>

            @else
                <!-- ================= COMPACT COMPARISON BOARD ================= -->
                
                <!-- Restricted to max-w-2xl to prevent massive stretching -->
                <div class="max-w-2xl mx-auto bg-white border border-slate-200 rounded-2xl shadow-sm p-6 md:p-8">
                    
                    <!-- Teams Banner -->
                    <div class="flex items-center justify-center gap-4 md:gap-12 mb-6">
                        <!-- Home Team -->
                        <div class="flex flex-col items-center text-center w-1/3">
                            <div class="w-16 h-16 bg-slate-50 border border-slate-100 rounded-full shadow-sm flex items-center justify-center mb-3 overflow-hidden p-1.5">
                                @if(isset($fixture->homeTeam->logo_url))
                                    <img src="{{ $fixture->homeTeam->logo_url }}" alt="{{ $fixture->homeTeam->name ?? 'Home' }}" class="w-full h-full object-contain">
                                @else
                                    <div class="w-full h-full bg-slate-800 rounded-full flex items-center justify-center text-white font-black text-xs uppercase shadow-sm">
                                        {{ substr($fixture->homeTeam->name ?? 'HOM', 0, 3) }}
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-sm md:text-base font-black text-slate-800 leading-tight">{{ $fixture->homeTeam->name ?? 'Home' }}</h3>
                        </div>

                        <!-- VS Divider -->
                        <div class="flex flex-col items-center justify-center">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">{{ \Carbon\Carbon::parse($fixture->match_at)->format('d M') }}</span>
                            <div class="w-8 h-8 bg-slate-900 text-white rounded-full flex items-center justify-center text-xs font-black shadow-sm z-10">
                                VS
                            </div>
                        </div>

                        <!-- Away Team -->
                        <div class="flex flex-col items-center text-center w-1/3">
                            <div class="w-16 h-16 bg-slate-50 border border-slate-100 rounded-full shadow-sm flex items-center justify-center mb-3 overflow-hidden p-1.5">
                                @if(isset($fixture->awayTeam->logo_url))
                                    <img src="{{ $fixture->awayTeam->logo_url }}" alt="{{ $fixture->awayTeam->name ?? 'Away' }}" class="w-full h-full object-contain">
                                @else
                                    <div class="w-full h-full bg-slate-800 rounded-full flex items-center justify-center text-white font-black text-xs uppercase shadow-sm">
                                        {{ substr($fixture->awayTeam->name ?? 'AWA', 0, 3) }}
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-sm md:text-base font-black text-slate-800 leading-tight">{{ $fixture->awayTeam->name ?? 'Away' }}</h3>
                        </div>
                    </div>

                    <div class="text-center mb-8">
                        <a href="{{ isset($fixture->id) ? route('predictions.show', $fixture->id) : '#' }}" class="inline-flex items-center gap-2 text-blue-600 text-[11px] font-bold uppercase tracking-widest hover:underline">
                            View Full Match Data &rarr;
                        </a>
                    </div>

                    <!-- Form Guide -->
                    <div class="grid grid-cols-3 gap-2 mb-8 border-y border-slate-100 py-4">
                        <div class="flex justify-center gap-1">
                            @foreach($stats['home_form'] as $result)
                                <span class="w-5 h-5 rounded flex items-center justify-center text-[9px] font-black text-white 
                                    {{ $result === 'W' ? 'bg-emerald-500' : ($result === 'L' ? 'bg-red-500' : 'bg-slate-400') }}">
                                    {{ $result }}
                                </span>
                            @endforeach
                        </div>
                        <div class="text-center flex items-center justify-center">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Recent Form</span>
                        </div>
                        <div class="flex justify-center gap-1">
                            @foreach($stats['away_form'] as $result)
                                <span class="w-5 h-5 rounded flex items-center justify-center text-[9px] font-black text-white 
                                    {{ $result === 'W' ? 'bg-emerald-500' : ($result === 'L' ? 'bg-red-500' : 'bg-slate-400') }}">
                                    {{ $result }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Compact Stats Grid -->
                    <div class="space-y-5">
                        
                        <!-- Goals Scored -->
                        <div>
                            <div class="flex justify-between items-end mb-1.5">
                                <span class="text-sm font-black text-blue-600">{{ $stats['avg_goals_scored']['home'] }}</span>
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Avg Goals Scored</span>
                                <span class="text-sm font-black text-red-600">{{ $stats['avg_goals_scored']['away'] }}</span>
                            </div>
                            <div class="flex h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                <div class="bg-blue-500" style="width: {{ ($stats['avg_goals_scored']['home'] / max(1, $stats['avg_goals_scored']['home'] + $stats['avg_goals_scored']['away'])) * 100 }}%"></div>
                                <div class="bg-red-500" style="width: {{ ($stats['avg_goals_scored']['away'] / max(1, $stats['avg_goals_scored']['home'] + $stats['avg_goals_scored']['away'])) * 100 }}%"></div>
                            </div>
                        </div>

                        <!-- Goals Conceded -->
                        <div>
                            <div class="flex justify-between items-end mb-1.5">
                                <span class="text-sm font-black text-blue-600">{{ $stats['avg_goals_conceded']['home'] }}</span>
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Avg Goals Conceded</span>
                                <span class="text-sm font-black text-red-600">{{ $stats['avg_goals_conceded']['away'] }}</span>
                            </div>
                            <div class="flex h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                <div class="bg-blue-400" style="width: {{ ($stats['avg_goals_conceded']['away'] / max(1, $stats['avg_goals_conceded']['home'] + $stats['avg_goals_conceded']['away'])) * 100 }}%"></div>
                                <div class="bg-red-400" style="width: {{ ($stats['avg_goals_conceded']['home'] / max(1, $stats['avg_goals_conceded']['home'] + $stats['avg_goals_conceded']['away'])) * 100 }}%"></div>
                            </div>
                        </div>

                        <!-- Clean Sheets -->
                        <div class="grid grid-cols-3 text-center items-center py-2 bg-slate-50 rounded-lg border border-slate-100">
                            <div class="text-sm font-black text-slate-800">{{ $stats['clean_sheets']['home'] }}</div>
                            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Clean Sheets</div>
                            <div class="text-sm font-black text-slate-800">{{ $stats['clean_sheets']['away'] }}</div>
                        </div>

                    </div>
                </div>
            @endif

        </div>
    </div>
</x-layout>