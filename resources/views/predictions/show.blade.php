<x-layout>
    <div class="w-full">
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-6">
            
            <div class="flex justify-center mb-6">
                <div class="flex items-center bg-slate-100 rounded-full p-1 shadow-inner">
                    <button class="px-6 py-1.5 text-xs font-bold bg-slate-800 text-white rounded-full shadow-sm">Prediction</button>
                    <button class="px-6 py-1.5 text-xs font-bold text-slate-500 hover:text-slate-800 transition-colors">Preview</button>
                </div>
            </div>

            <div class="text-center mb-10">
                <h1 class="text-3xl font-black text-slate-800 mb-3 tracking-tight">Portugal <span class="text-slate-300 font-light mx-3">VS</span> Spain</h1>
                <div class="flex items-center justify-center gap-3 text-xs text-slate-500 font-bold uppercase tracking-wider">
                    <span>Dallas Stadium</span>
                    <span class="text-slate-300">•</span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                        38°
                    </span>
                    <span class="text-slate-300">•</span>
                    <span>06/07/2026 22:00</span>
                </div>
            </div>

            <div class="flex justify-between items-center px-10">
                
                <div class="flex flex-col items-center gap-4">
                    <div class="w-28 h-28 bg-green-600 rounded-2xl shadow-md flex items-center justify-center text-white font-black text-3xl border border-slate-100">
                        POR
                    </div>
                    <div class="flex gap-1.5 text-[10px] font-black text-white">
                        <span class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center shadow-sm">W</span>
                        <span class="w-6 h-6 rounded-full bg-yellow-400 flex items-center justify-center shadow-sm">D</span>
                        <span class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center shadow-sm">W</span>
                        <span class="w-6 h-6 rounded-full bg-yellow-400 flex items-center justify-center shadow-sm">D</span>
                        <span class="w-6 h-6 rounded-full bg-red-500 flex items-center justify-center shadow-sm">L</span>
                    </div>
                </div>

                <div class="flex flex-col items-center px-4">
                    <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center text-slate-900 font-black mb-4 shadow-md text-xl">
                        X
                    </div>
                    <div class="px-5 py-2 border-2 border-yellow-400 rounded-full text-slate-800 font-bold text-sm shadow-sm bg-yellow-50/50">
                        Draw Probability 44%
                    </div>
                </div>

                <div class="flex flex-col items-center gap-4">
                    <div class="w-28 h-28 bg-red-600 rounded-2xl shadow-md flex items-center justify-center text-white font-black text-3xl border border-slate-100">
                        ESP
                    </div>
                    <div class="flex gap-1.5 text-[10px] font-black text-white">
                        <span class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center shadow-sm">W</span>
                        <span class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center shadow-sm">W</span>
                        <span class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center shadow-sm">W</span>
                        <span class="w-6 h-6 rounded-full bg-yellow-400 flex items-center justify-center shadow-sm">D</span>
                        <span class="w-6 h-6 rounded-full bg-yellow-400 flex items-center justify-center shadow-sm">D</span>
                    </div>
                </div>

            </div>
        </div>
        
        <!-- Market Navigation Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-6">
            <button class="px-5 py-2 text-xs font-bold bg-slate-700 text-white rounded-full shadow-sm">Under/Over 2.5</button>
            <button class="px-5 py-2 text-xs font-bold text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-800 rounded-full border border-slate-200 transition-colors shadow-sm">Half Time</button>
            <button class="px-5 py-2 text-xs font-bold text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-800 rounded-full border border-slate-200 transition-colors shadow-sm">HT/FT</button>
            <button class="px-5 py-2 text-xs font-bold text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-800 rounded-full border border-slate-200 transition-colors shadow-sm">Btts</button>
            <button class="px-5 py-2 text-xs font-bold text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-800 rounded-full border border-slate-200 transition-colors shadow-sm">Scorers</button>
            <button class="px-5 py-2 text-xs font-bold text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-800 rounded-full border border-slate-200 transition-colors shadow-sm">Corners</button>
            <button class="px-5 py-2 text-xs font-bold text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-800 rounded-full border border-slate-200 transition-colors shadow-sm">Cards</button>
        </div>

        <!-- The Quantitative Summary Row (Dummy Data) -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="w-full min-w-max">
                    <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="py-4 pl-6 text-left">Teams</th>
                            <th class="py-4 text-center">Prob. % <br> <span class="text-slate-500 font-black mt-1 block">O &nbsp;&nbsp;&nbsp;&nbsp; U</span></th>
                            <th class="py-4 text-center">Pred</th>
                            <th class="py-4 text-center">Correct <br> Score</th>
                            <th class="py-4 text-center">Avg. <br> Goals</th>
                            <th class="py-4 text-center">Weather</th>
                            <th class="py-4 text-center">Coef.</th>
                            <th class="py-4 pr-6 text-center">Score</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <!-- Teams -->
                            <td class="py-4 pl-6 text-left font-bold text-slate-800">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span class="w-4 h-4 rounded-full bg-green-600 text-[8px] flex items-center justify-center text-white shrink-0 shadow-sm">P</span>
                                    <span>Portugal</span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-500">
                                    <span class="w-4 h-4 rounded-full bg-red-600 text-[8px] flex items-center justify-center text-white shrink-0 shadow-sm">S</span>
                                    <span>Spain</span>
                                </div>
                            </td>
                            <!-- Probabilities (O/U Highlighted) -->
                            <td class="py-4 text-xs font-bold text-center">
                                <div class="flex justify-center items-center gap-4">
                                    <span class="w-6 text-right text-green-500">55</span>
                                    <span class="w-6 text-left text-slate-700">45</span>
                                </div>
                            </td>
                            <!-- Pred Bubble -->
                            <td class="py-4 text-center">
                                <span class="bg-yellow-400 text-slate-900 text-[10px] font-black w-7 h-7 rounded-full flex items-center justify-center mx-auto shadow-sm">O</span>
                            </td>
                            <!-- Correct Score -->
                            <td class="py-4 text-xs font-bold text-slate-700 text-center">1 - 1</td>
                            <!-- Avg Goals -->
                            <td class="py-4 text-xs font-bold text-slate-700 text-center">2.45</td>
                            <!-- Weather -->
                            <td class="py-4 text-xs font-bold text-slate-500 text-center">
                                <div class="flex justify-center items-center gap-1">
                                    38° <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                                </div>
                            </td>
                            <!-- Coefficient -->
                            <td class="py-4 text-xs font-bold text-blue-600 text-center">3.50</td>
                            <!-- Final Score -->
                            <td class="py-4 pr-6 text-center">
                                <span class="text-slate-400 font-black text-xs">-</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layout>