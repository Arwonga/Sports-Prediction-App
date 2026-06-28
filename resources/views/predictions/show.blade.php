<x-layout title="{{ $fixture->homeTeam->name }} vs {{ $fixture->awayTeam->name }} | Match Centre">
    
    <div class="mb-4">
        <a href="/" class="text-sm text-blue-600 font-semibold hover:underline">&larr; Back to Dashboard</a>
    </div>

    <div class="bg-white shadow-sm border border-slate-200 rounded-xl overflow-hidden">
        
        <div class="bg-zinc-800 px-6 py-4 flex justify-center items-center border-b border-zinc-900">
            <h2 class="text-white font-bold text-lg tracking-wide">Match Centre & Deep Analysis</h2>
        </div>

        <div class="p-8">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-black text-slate-800">{{ $fixture->homeTeam->name }} <span class="text-slate-400 font-medium mx-2">VS</span> {{ $fixture->awayTeam->name }}</h1>
                <p class="text-sm text-slate-500 mt-1 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    World Cup 2026 <span class="mx-2">|</span>
                    {{ $fixture->match_at->format('d/m/Y H:i') }}
                </p>
            </div>

            <div class="flex justify-between items-center max-w-2xl mx-auto mb-8">
                
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-slate-100 rounded-lg flex items-center justify-center border border-slate-200 mb-3 shadow-sm">
                        <span class="text-slate-400 font-bold text-xs uppercase">{{ substr($fixture->homeTeam->name, 0, 3) }}</span>
                    </div>
                    <div class="flex gap-1">
                        <span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] font-bold">W</span>
                        <span class="w-5 h-5 rounded-full bg-rose-500 text-white flex items-center justify-center text-[10px] font-bold">L</span>
                        <span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] font-bold">W</span>
                        <span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] font-bold">W</span>
                        <span class="w-5 h-5 rounded-full bg-amber-400 text-white flex items-center justify-center text-[10px] font-bold">D</span>
                    </div>
                </div>

                <div class="flex flex-col items-center px-8">
                    @if($fixture->status == 'FT')
                        <div class="text-4xl font-black text-slate-800 tracking-wider mb-2">2 - 1</div> @else
                        <div class="text-4xl font-black text-slate-800 tracking-wider mb-2">- : -</div>
                    @endif
                    <span class="px-3 py-1 bg-slate-100 text-slate-500 text-xs font-bold rounded-full uppercase tracking-widest">
                        {{ $fixture->status }}
                    </span>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-slate-100 rounded-lg flex items-center justify-center border border-slate-200 mb-3 shadow-sm">
                        <span class="text-slate-400 font-bold text-xs uppercase">{{ substr($fixture->awayTeam->name, 0, 3) }}</span>
                    </div>
                    <div class="flex gap-1">
                        <span class="w-5 h-5 rounded-full bg-amber-400 text-white flex items-center justify-center text-[10px] font-bold">D</span>
                        <span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] font-bold">W</span>
                        <span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] font-bold">W</span>
                        <span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] font-bold">W</span>
                        <span class="w-5 h-5 rounded-full bg-amber-400 text-white flex items-center justify-center text-[10px] font-bold">D</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-slate-50 border-y border-slate-200 px-6 py-3 flex gap-2 justify-center">
            <button class="px-4 py-1.5 bg-zinc-800 text-white text-xs font-bold rounded-full shadow-sm">Over/Under 2.5</button>
            <button class="px-4 py-1.5 bg-white text-slate-600 border border-slate-200 text-xs font-bold rounded-full hover:bg-slate-100">BTTS</button>
            <button class="px-4 py-1.5 bg-white text-slate-600 border border-slate-200 text-xs font-bold rounded-full hover:bg-slate-100">Correct Score</button>
            <button class="px-4 py-1.5 bg-white text-slate-600 border border-slate-200 text-xs font-bold rounded-full hover:bg-slate-100">Weather</button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-center text-slate-600">
                <thead class="text-xs text-zinc-500 bg-slate-50 uppercase">
                    <tr>
                        <th class="px-6 py-4 font-bold border-b border-slate-200">Market</th>
                        <th class="px-6 py-4 font-bold border-b border-slate-200">Statistical Edge</th>
                        <th class="px-6 py-4 font-bold border-b border-slate-200">Calculated %</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @if($fixture->prediction)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-bold text-slate-800">Over 2.5 Goals</td>
                            <td class="px-6 py-4">
                                @if($fixture->prediction->prob_over_2_5 > 60)
                                    <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded text-xs font-bold">High Probability</span>
                                @else
                                    <span class="px-2 py-1 bg-slate-100 text-slate-500 rounded text-xs font-bold">Standard Risk</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-black text-emerald-600 text-lg">{{ $fixture->prediction->prob_over_2_5 }}%</td>
                        </tr>
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-bold text-slate-800">Under 2.5 Goals</td>
                            <td class="px-6 py-4">
                                @if($fixture->prediction->prob_under_2_5 > 60)
                                    <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded text-xs font-bold">High Probability</span>
                                @else
                                    <span class="px-2 py-1 bg-slate-100 text-slate-500 rounded text-xs font-bold">Standard Risk</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-black text-rose-500 text-lg">{{ $fixture->prediction->prob_under_2_5 }}%</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-slate-400 italic">Model calculations pending...</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</x-layout>