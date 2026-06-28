<aside class="w-80 bg-white border-l border-slate-200 p-4 shrink-0 h-full space-y-6 overflow-y-auto">
    
    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-slate-800">June 2026</h3>
        </div>
        <div class="grid grid-cols-7 gap-1 text-center text-[10px] font-bold text-slate-400">
            <div>M</div><div>T</div><div>W</div><div>T</div><div>F</div><div>S</div><div>S</div>
            @for ($i = 1; $i <= 30; $i++)
                <div class="py-1 {{ $i == 28 ? 'bg-red-600 text-white rounded-full' : '' }}">{{ $i }}</div>
            @endfor
        </div>
    </div>

    <div class="bg-slate-900 rounded-lg p-4 text-white shadow-lg border-t-4 border-blue-500">
        <div class="flex justify-between items-center mb-2">
            <span class="text-[10px] font-bold uppercase text-blue-500 tracking-wider">Featured match</span>
            <span class="bg-blue-500 text-white text-[10px] font-black px-1 rounded">2</span>
        </div>
        <p class="text-sm font-bold">Sportivo Barracas</p>
        <p class="text-xs text-slate-400 mb-2">Club Luján</p>
        <p class="text-[10px] text-slate-500">28/06/2026 19:00</p>
    </div>

    <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
        <div class="bg-slate-100 px-4 py-2 text-xs font-bold text-slate-600 border-b border-slate-200">Regular Season</div>
        <table class="w-full text-[11px] text-center">
            <thead>
                <tr class="text-slate-400">
                    <th class="py-2 text-left pl-4">Team</th>
                    <th class="py-2">PTS</th>
                    <th class="py-2">GD</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($standings ?? [] as $team)
                    <tr class="font-bold text-slate-800">
                        <td class="py-2 text-left pl-4">
                            <span class="text-slate-400 mr-2">{{ $team['rank'] ?? $loop->iteration }}</span> 
                            {{ $team['team']['name'] ?? 'Unknown' }}
                        </td>
                        <td class="py-2">{{ $team['points'] ?? 0 }}</td>
                        <td class="py-2">{{ $team['goalsDiff'] ?? 0 }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-slate-400">No standings available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="#" class="block text-center py-2 text-[10px] font-bold text-red-600 hover:text-red-800 uppercase tracking-wide border-t border-slate-100">
            View Full Standings &rarr;
        </a>
    </div>
</aside>