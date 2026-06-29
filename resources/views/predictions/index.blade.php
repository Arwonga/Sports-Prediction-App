<x-layout title="Alpha Predictions | Quantitative Data">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    
    <div class="bg-slate-900 px-6 py-4 border-b-4 border-red-600">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-boldb text-center text-white tracking-wide">Precise Mathematical Predictions and Statistics</h2>
            
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
                    <th class="py-4 pl-6 text-left">Home Team <br> <span class="mt-1 block">Away Team</span></th>
                    <th class="py-4">Prob. % <br> <span class="text-slate-500 font-black mt-1 block">1 &nbsp;&nbsp;&nbsp;&nbsp; 2</span></th>
                    <th class="py-4">Pred</th>
                    <th class="py-4">Correct <br> Score</th>
                    <th class="py-4">Avg. <br> Goals</th>
                    <th class="py-4">Weather</th>
                    <th class="py-4">Odds</th>
                    <th class="py-4 pr-6">Score</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($fixtures ?? [] as $fixture)
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
                        </td>

                        <td class="py-4 text-xs font-bold text-slate-700 tracking-widest">
                            48 &nbsp;&nbsp;&nbsp; 24
                        </td>

                        <td class="py-4">
                            <span class="bg-yellow-400 text-slate-900 text-xs font-black px-2.5 py-1 rounded-full shadow-sm">1</span>
                        </td>

                        <td class="py-4 text-xs font-bold text-slate-700">3 - 1</td>

                        <td class="py-4 text-xs font-semibold text-slate-600">3.63</td>

                        <td class="py-4 text-xs font-semibold text-slate-500">
                            35° <span class="text-slate-400 ml-1">⛅</span>
                        </td>

                        <td class="py-4 text-xs font-bold text-slate-700">
                            <span class="border border-slate-200 bg-white rounded px-2.5 py-1 shadow-sm">1.70</span>
                        </td>

                        <td class="py-4 pr-6 text-xs font-bold text-slate-400">
                            -
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center text-slate-400 text-sm font-semibold">
                            No fixtures found for today.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</x-layout>