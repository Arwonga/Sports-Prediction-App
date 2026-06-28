<x-layout title="Alpha Predictions | Quantitative Data">
    
    <div class="bg-white shadow-sm border border-slate-200 rounded-lg overflow-hidden">
        
        <div class="bg-zinc-800 px-6 py-4 flex justify-between items-center border-b border-zinc-900">
            <h2 class="text-white font-bold text-lg tracking-wide">Mathematical Predictions and Statistics</h2>
            <div class="bg-zinc-700 text-zinc-300 text-xs font-semibold px-3 py-1 rounded-full">
                Alternative Markets
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs text-zinc-500 bg-slate-50 uppercase border-b border-slate-200">
                    <tr class="bg-white hover:bg-slate-50 transition-colors duration-150 cursor-pointer" onclick="window.location='{{ route('predictions.show', $fixture->id) }}'">
                        <th scope="col" class="px-6 py-3 font-bold w-32">Date / Status</th>
                        <th scope="col" class="px-6 py-3 font-bold text-right w-1/4">Home Team</th>
                        <th scope="col" class="px-2 py-3 text-center"></th>
                        <th scope="col" class="px-6 py-3 font-bold text-left w-1/4">Away Team</th>
                        
                        <th scope="col" class="px-3 py-3 font-bold text-center border-l border-slate-200 bg-slate-100">O 2.5 %</th>
                        <th scope="col" class="px-3 py-3 font-bold text-center bg-slate-100">U 2.5 %</th>
                        <th scope="col" class="px-3 py-3 font-bold text-center border-l border-slate-200 bg-slate-100">BTTS Y %</th>
                        <th scope="col" class="px-3 py-3 font-bold text-center bg-slate-100">BTTS N %</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    
                    @forelse ($fixtures as $fixture)
                        <tr class="bg-white hover:bg-slate-50 transition-colors duration-150">
                            
                            <td class="px-6 py-3 whitespace-nowrap">
                                <div class="text-xs font-semibold text-slate-400">{{ $fixture->match_at->format('d/m H:i') }}</div>
                                <div class="text-[10px] font-bold mt-0.5 {{ $fixture->status == 'NS' ? 'text-slate-400' : 'text-rose-500' }}">
                                    {{ $fixture->status }}
                                </div>
                            </td>

                            <td class="px-6 py-3 text-right font-bold text-slate-800">
                                {{ $fixture->homeTeam->name }}
                            </td>
                            
                            <td class="px-2 py-3 text-center text-xs font-bold text-slate-300">
                                -
                            </td>

                            <td class="px-6 py-3 text-left font-bold text-slate-800">
                                {{ $fixture->awayTeam->name }}
                            </td>

                            @if($fixture->prediction)
                                <td class="px-3 py-3 text-center font-bold text-emerald-600 border-l border-slate-50 bg-emerald-50/10">
                                    {{ $fixture->prediction->prob_over_2_5 }}
                                </td>
                                <td class="px-3 py-3 text-center font-bold text-rose-500 bg-rose-50/10">
                                    {{ $fixture->prediction->prob_under_2_5 }}
                                </td>
                                <td class="px-3 py-3 text-center font-bold text-emerald-600 border-l border-slate-50 bg-emerald-50/10">
                                    {{ $fixture->prediction->prob_btts_yes }}
                                </td>
                                <td class="px-3 py-3 text-center font-bold text-rose-500 bg-rose-50/10">
                                    {{ $fixture->prediction->prob_btts_no }}
                                </td>
                            @else
                                <td colspan="4" class="px-6 py-3 text-center text-xs text-slate-400 italic border-l border-slate-50">
                                    Awaiting model calculation...
                                </td>
                            @endif

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-500 font-medium">
                                No fixtures found for today.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</x-layout>