<aside class="w-[320px] bg-white border-l border-slate-200 p-4 shrink-0 h-full min-h-screen overflow-y-auto space-y-6 relative z-10">
    
        @php
        // 1. Get the date from the URL (or default to today's real date)
        $calDate = request('date') ? \Carbon\Carbon::parse(request('date')) : \Carbon\Carbon::now();
        
        // 2. Figure out the math for the current month
        $startOfMonth = $calDate->copy()->startOfMonth();
        $daysInMonth = $calDate->daysInMonth;
        
        // 3. Find out what day of the week the 1st lands on (1 = Monday, 7 = Sunday)
        $startDayOfWeek = $startOfMonth->dayOfWeekIso; 
        @endphp

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm mb-6">
            <!-- Month and Year Header -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-slate-800 text-sm">{{ $calDate->format('F Y') }}</h3>
                <div class="flex gap-3 text-slate-400 text-xs font-bold">
                    <!-- Functional Arrows to skip months -->
                    <a href="{{ url('/?date=' . $calDate->copy()->subMonth()->toDateString()) }}" class="hover:text-slate-800 transition-colors">&lt;</a>
                    <a href="{{ url('/?date=' . $calDate->copy()->addMonth()->toDateString()) }}" class="hover:text-slate-800 transition-colors">&gt;</a>
                </div>
            </div>

            <div class="grid grid-cols-7 gap-y-3 text-center">
                <!-- Day Headers (Mon, Tue, Wed...) -->
                @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $dayName)
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $dayName }}</div>
                @endforeach

                <!-- Empty slots to push the 1st of the month to the correct weekday -->
                @for($i = 1; $i < $startDayOfWeek; $i++)
                    <div></div>
                @endfor

                <!-- The actual days of the month -->
                @for($day = 1; $day <= $daysInMonth; $day++)
                    @php
                        $currentLoopDate = $calDate->copy()->day($day);
                        $isActive = $currentLoopDate->isSameDay($calDate);
                    @endphp
                    
                    <a href="{{ url('/?date=' . $currentLoopDate->toDateString()) }}" 
                    class="text-xs font-bold w-7 h-7 mx-auto flex items-center justify-center rounded-full transition-all duration-200
                    {{ $isActive ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-red-600' }}">
                        <!-- Pads single digits with a zero (e.g., 01, 02) -->
                        {{ str_pad($day, 2, '0', STR_PAD_LEFT) }}
                    </a>
                @endfor
            </div>
        </div>

    <div class="space-y-4">
        @forelse($featuredMatches ?? [] as $match)
            <div class="bg-slate-800 rounded-xl p-4 text-white shadow-lg border-t-4 border-red-500 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-16 h-16 bg-red-500/10 rounded-bl-full"></div>
                <div class="flex justify-between items-center mb-3 relative z-10">
                    <span class="text-[10px] font-bold uppercase text-red-400 tracking-wider">{{ __('Featured Match') }}</span>
                    <span class="bg-red-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full shadow-sm">{{ $loop->iteration }}</span>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-1">
                        <p class="text-sm font-bold text-white">{{ $match->homeTeam->name ?? 'TBD' }}</p>
                    </div>
                    <div class="flex items-center gap-2 mb-3">
                        <p class="text-sm font-bold text-slate-300">{{ $match->awayTeam->name ?? 'TBD' }}</p>
                    </div>
                    <p class="text-[10px] text-slate-400 font-medium border-t border-slate-700 pt-2">
                        {{ \Carbon\Carbon::parse($match->match_at)->format('d/m/Y H:i') }}
                    </p>
                </div>
            </div>
        @empty
            <div class="bg-slate-50 border border-slate-200 p-4 rounded-xl text-xs text-center font-semibold text-slate-400">
                {{ __('No featured matches today.') }}
            </div>
        @endforelse
    </div>

   <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mt-6">
        <div class="bg-slate-50 px-4 py-3 border-b border-slate-200 flex justify-between items-center">
            <span class="text-xs font-bold text-slate-700 uppercase tracking-wide">{{ __('Regular Season Top 8') }}</span>
        </div>
        <table class="w-full text-xs text-center">
            <thead class="bg-white">
                <tr class="text-slate-400 text-[10px] uppercase tracking-wider">
                    <th class="py-3 text-left pl-4 font-semibold">{{ __('Team') }}</th>
                    <th class="py-3 font-semibold">{{ __('PTS') }}</th>
                    <th class="py-3 font-semibold">{{ __('GD') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse(array_slice($standings ?? [], 0, 8) as $team)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-3 text-left pl-4 font-bold text-slate-800 flex items-center gap-2 truncate max-w-[140px]">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full {{ $loop->iteration <= 3 ? 'bg-orange-100 text-orange-600' : 'text-slate-400' }} text-[10px] shrink-0">
                                {{ $team['rank'] ?? $loop->iteration }}
                            </span>
                            <span class="truncate">{{ $team['team']['name'] ?? 'Unknown' }}</span>
                        </td>
                        <td class="py-3 font-black text-slate-700">{{ $team['points'] ?? 0 }}</td>
                        <td class="py-3 text-slate-500 font-medium">
                            {{ $team['goalsDiff'] > 0 ? '+'.$team['goalsDiff'] : $team['goalsDiff'] }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-6 text-center text-slate-400 text-xs font-medium">
                            {{ __('Select a league to view live standings.') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <a href="#" class="block w-full text-center py-3 text-[10px] font-bold text-blue-600 hover:text-blue-800 hover:bg-slate-50 uppercase tracking-wide border-t border-slate-100 transition-colors cursor-pointer">
            View Full Standings &rarr;
        </a>
    </div>
</aside>