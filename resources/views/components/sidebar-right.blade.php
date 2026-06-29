<aside class="w-[320px] bg-white border-l border-slate-200 p-4 shrink-0 h-full min-h-screen overflow-y-auto space-y-6">
    
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-slate-800 text-sm">June 2026</h3>
            <div class="flex gap-3 text-slate-400 text-xs">
                <button class="hover:text-blue-600">&lt;</button>
                <button class="hover:text-blue-600">&gt;</button>
            </div>
        </div>
        <div class="grid grid-cols-7 gap-y-2 text-center text-xs font-bold text-slate-400 mb-2">
            <div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div><div>Sun</div>
        </div>
        <div class="grid grid-cols-7 gap-y-2 text-center text-sm font-medium text-slate-700">
            <div class="py-1">01</div><div class="py-1">02</div><div class="py-1">03</div><div class="py-1">04</div><div class="py-1">05</div><div class="py-1">06</div><div class="py-1">07</div>
            <div class="py-1">08</div><div class="py-1">09</div><div class="py-1">10</div><div class="py-1">11</div><div class="py-1">12</div><div class="py-1">13</div><div class="py-1">14</div>
            <div class="py-1">15</div><div class="py-1">16</div><div class="py-1">17</div><div class="py-1">18</div><div class="py-1">19</div><div class="py-1">20</div><div class="py-1">21</div>
            <div class="py-1">22</div><div class="py-1">23</div><div class="py-1">24</div><div class="py-1">25</div><div class="py-1">26</div><div class="py-1">27</div><div class="py-1">28</div>
            <div class="py-1 bg-slate-800 text-white rounded-full font-bold shadow-md">29</div><div class="py-1">30</div>
        </div>
    </div>

    <div class="space-y-4">
        @forelse($featuredMatches ?? [] as $match)
            <div class="bg-slate-800 rounded-xl p-4 text-white shadow-lg border-t-4 border-red-500 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-16 h-16 bg-red-500/10 rounded-bl-full"></div>
                <div class="flex justify-between items-center mb-3 relative z-10">
                    <span class="text-[10px] font-bold uppercase text-red-400 tracking-wider">Featured Match</span>
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
                No featured matches today.
            </div>
        @endforelse
    </div>

   <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mt-6">
        <div class="bg-slate-50 px-4 py-3 border-b border-slate-200 flex justify-between items-center">
            <span class="text-xs font-bold text-slate-700 uppercase tracking-wide">Regular Season Top 8</span>
        </div>
        <table class="w-full text-xs text-center">
            <thead class="bg-white">
                <tr class="text-slate-400 text-[10px] uppercase tracking-wider">
                    <th class="py-3 text-left pl-4 font-semibold">Team</th>
                    <th class="py-3 font-semibold">PTS</th>
                    <th class="py-3 font-semibold">GD</th>
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
                            Select a league to view live standings.
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