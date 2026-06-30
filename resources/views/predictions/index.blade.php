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

        <div class="flex justify-center items-center gap-2 mt-2">
            <button class="px-5 py-1.5 rounded-full text-xs font-bold text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">Sat</button>
            <button class="px-5 py-1.5 rounded-full text-xs font-bold text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">Sun</button>
            <button class="px-8 py-1.5 rounded-full text-xs font-bold bg-slate-700 text-white shadow-md border border-slate-600 transition-colors">Today</button>
            <button class="px-5 py-1.5 rounded-full text-xs font-bold text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">Tue</button>
            <button class="px-5 py-1.5 rounded-full text-xs font-bold text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">Wed</button>
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
                    <th class="py-4">Verdict</th>
                    <th class="py-4 pr-6">More</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($fixtures ?? [] as $index => $fixture)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="py-4 pl-6 text-left font-bold text-slate-800">
                            <div class="flex items-center gap-2 mb-1.5">
                                <div class="w-3 h-3 bg-blue-500 rounded-sm shrink-0"></div>
                                <span class="truncate">{{ $fixture->homeTeam->name ?? 'Home Team' }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-slate-500">
                                <div class="w-3 h-3 bg-red-500 rounded-sm shrink-0"></div>
                                <span class="truncate">{{ $fixture->awayTeam->name ?? 'Away Team' }}</span>
                            </div>
                            <!-- Match Start Time -->
                            <div class="flex items-center gap-1.5 mt-2 text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>{{ \Carbon\Carbon::parse($fixture->match_at)->timezone(session('timezone', 'Africa/Nairobi'))->format('H:i') }}</span>
                            </div>
                        </td>

                        <td class="py-4 text-xs font-bold text-slate-700 tracking-widest">
                            {{ $fixture->prediction->home_win_prob ?? '57' }} &nbsp;&nbsp;&nbsp; {{ $fixture->prediction->away_win_prob ?? '18' }}
                        </td>

                        <td class="py-4 text-xs font-bold text-slate-700 tracking-widest">
                            {{ $fixture->prediction->btts_yes_prob ?? '61' }} &nbsp;&nbsp;&nbsp; {{ $fixture->prediction->btts_no_prob ?? '39' }}
                        </td>

                        <td class="py-4 text-xs font-bold text-slate-700 tracking-widest">
                            {{ $fixture->prediction->over_25_prob ?? '60' }} &nbsp;&nbsp;&nbsp; {{ $fixture->prediction->under_25_prob ?? '40' }}
                        </td>

                        <td class="py-4">
                            <span class="bg-yellow-400 text-slate-900 text-[10px] font-black px-3 py-1.5 rounded-sm shadow-sm uppercase tracking-wide">
                                {{ $fixture->prediction->verdict ?? 'HOME WIN' }}
                            </span>
                        </td>

                        <td class="py-4 pr-6">
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
                                        @if(isset($fixture->prediction->top_scores))
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

</x-layout>