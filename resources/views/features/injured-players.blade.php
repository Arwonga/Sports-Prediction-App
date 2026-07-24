<x-layout title="Injury & Suspension Center | Alpha Predictions">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden min-h-[600px]">
        
        <!-- Premium Header & Search -->
        <div class="bg-slate-900 px-8 py-10 border-b-4 border-red-600 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-red-600 opacity-10 blur-3xl"></div>

            <div class="relative z-10 max-w-4xl">
                <h2 class="text-3xl font-black text-white tracking-tight mb-2">{{ __('Medical & Disciplinary Center') }}</h2>
                <p class="text-slate-400 text-sm mb-8 font-medium">Track real-time player availabilities, suspensions, and medical return dates across all major leagues.</p>

                <form action="{{ route('features.injured-players') }}" method="GET" class="relative group">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="block w-full p-4 pl-14 text-sm text-slate-900 bg-white border-0 rounded-2xl focus:ring-4 focus:ring-red-500/20 font-bold shadow-lg transition-all" 
                        placeholder="Search for a player or team..." required>
                    <button type="submit" class="absolute right-2 bottom-2 top-2 bg-slate-900 text-white hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-bold rounded-xl text-sm px-6 transition-all shadow-md">
                        Search
                    </button>
                </form>
            </div>
        </div>

        <div class="p-8">
            @if($searchTerm)
                <!-- ================= SEARCH RESULTS ================= -->
                <div class="flex items-center justify-between mb-8 border-b border-slate-100 pb-4">
                    <h3 class="text-sm font-bold text-slate-500">Search results for: <span class="text-slate-900 text-base">"{{ $searchTerm }}"</span></h3>
                    <a href="{{ route('features.injured-players') }}" class="text-xs font-bold text-red-600 hover:text-red-700 hover:underline px-3 py-1.5 bg-red-50 rounded-lg transition-colors">Clear Search &times;</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($injuries as $injury)
                        <div class="bg-white border border-slate-200 rounded-2xl p-5 hover:border-slate-300 hover:shadow-lg transition-all flex flex-col group">
                            <div class="flex justify-between items-start mb-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full border border-slate-100 bg-slate-50 p-1.5 flex items-center justify-center">
                                        <img src="{{ $injury->team_logo }}" alt="Logo" class="w-full h-full object-contain">
                                    </div>
                                    <span class="text-[11px] font-black text-slate-400 uppercase tracking-widest">{{ $injury->team_name }}</span>
                                </div>
                                
                                @php
                                    $statusClass = 'bg-slate-100 text-slate-600';
                                    if($injury->status === 'OUT') $statusClass = 'bg-red-50 text-red-600 border border-red-100';
                                    elseif($injury->status === 'SUSPENDED') $statusClass = 'bg-orange-50 text-orange-600 border border-orange-100';
                                    elseif($injury->status === 'DOUBTFUL') $statusClass = 'bg-yellow-50 text-yellow-700 border border-yellow-100';
                                @endphp
                                <span class="{{ $statusClass }} text-[10px] font-black px-2.5 py-1 rounded-md shadow-sm uppercase tracking-wider">
                                    {{ $injury->status }}
                                </span>
                            </div>
                            <h4 class="text-xl font-black text-slate-800 mb-3 group-hover:text-red-600 transition-colors">{{ $injury->player_name }}</h4>
                            <div class="bg-slate-50 rounded-xl p-3.5 mb-5 border border-slate-100">
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Reason / Diagnosis</span>
                                <span class="text-sm font-bold text-slate-700">{{ $injury->type }}</span>
                            </div>
                            <div class="mt-auto flex items-center justify-between">
                                <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">Est. Return</span>
                                <span class="text-xs font-black text-slate-800 bg-slate-100 px-2.5 py-1 rounded-md">
                                    {{ $injury->return_date !== 'Unknown' ? \Carbon\Carbon::parse($injury->return_date)->format('d M Y') : 'TBD' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <h3 class="text-base font-bold text-slate-700 mb-1">No matches found</h3>
                            <p class="text-sm text-slate-500">Try adjusting your search terms.</p>
                        </div>
                    @endforelse
                </div>

            @else
                <!-- ================= FEATURED SQUADS ================= -->
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-red-600 animate-pulse"></span>
                        Live Squad Reports
                    </h3>
                    <div class="hidden md:flex items-center gap-4 text-[10px] font-bold uppercase tracking-wider text-slate-500 bg-slate-50 px-4 py-2 rounded-lg border border-slate-100">
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-red-500 shadow-sm"></span> Out</span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-yellow-400 shadow-sm"></span> Doubtful</span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-orange-500 shadow-sm"></span> Suspended</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($featuredReports as $report)
                        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                            <!-- Team Header -->
                            <div class="bg-gradient-to-r from-slate-50 to-white border-b border-slate-100 p-5 flex items-center gap-4">
                                <div class="w-14 h-14 bg-white rounded-xl shadow-sm border border-slate-100 p-2 flex items-center justify-center shrink-0">
                                    <!-- NOW USING OBJECT NOTATION '->' INSTEAD OF ARRAYS '[]' -->
                                    <img src="{{ $report->logo_Url }}" alt="Logo" class="w-full h-full object-contain">
                                </div>
                                <div>
                                    <h4 class="text-lg font-black text-slate-800">{{ $report->team_name }}</h4>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ count($report->players) }} Reported Absences</span>
                                </div>
                            </div>
                            
                            <!-- Players List -->
                            <div class="divide-y divide-slate-50 flex-1 bg-white">
                                @foreach($report->players as $player)
                                    <div class="p-4 hover:bg-slate-50/50 transition-colors flex items-center justify-between group">
                                        <div>
                                            <h5 class="text-sm font-bold text-slate-800 mb-0.5">{{ $player->player_name }}</h5>
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs text-slate-500">{{ $player->type }}</span>
                                                <span class="text-slate-300">&bull;</span>
                                                <span class="text-[10px] font-bold text-slate-400 uppercase">
                                                    {{ $player->return_date !== 'Unknown' ? \Carbon\Carbon::parse($player->return_date)->format('d M') : 'TBD' }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        @php
                                            $badge = 'bg-slate-100 text-slate-600';
                                            if($player->status === 'OUT') $badge = 'bg-red-50 text-red-600 border-red-100';
                                            elseif($player->status === 'SUSPENDED') $badge = 'bg-orange-50 text-orange-600 border-orange-100';
                                            elseif($player->status === 'DOUBTFUL') $badge = 'bg-yellow-50 text-yellow-700 border-yellow-100';
                                        @endphp
                                        <span class="{{ $badge }} border text-[9px] font-black px-2.5 py-1 rounded-md uppercase tracking-wider shrink-0 shadow-sm">
                                            {{ $player->status }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

</x-layout>