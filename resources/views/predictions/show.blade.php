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

        <!-- 2-Column Grid for H2H and Match Intro -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            
            <!-- Task 4: Head to Head (Dummy Data) -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest text-center mb-6">Head to Head</h3>
                
                <!-- Filters -->
                <div class="flex flex-wrap gap-2 mb-6 border-b border-slate-100 pb-4 justify-center">
                    <button class="px-4 py-1.5 text-[10px] font-bold bg-slate-700 text-white rounded-full">All</button>
                    <button class="px-4 py-1.5 text-[10px] font-bold text-slate-500 bg-slate-50 rounded-full hover:bg-slate-100 border border-slate-100 transition-colors">World Cup 2026</button>
                    <button class="px-4 py-1.5 text-[10px] font-bold text-slate-500 bg-slate-50 rounded-full hover:bg-slate-100 border border-slate-100 transition-colors">UEFA Nations</button>
                </div>

                <!-- Match List -->
                <div class="space-y-2 mb-8">
                    <!-- Row 1 -->
                    <div class="flex items-center justify-between text-xs hover:bg-slate-50 p-2.5 rounded-xl transition-colors group">
                        <div class="text-[10px] text-slate-400 font-bold w-12 leading-tight">08/06<br>2025</div>
                        <div class="flex-1 flex items-center justify-center gap-4">
                            <span class="text-slate-700 font-bold text-right w-20 truncate">Portugal</span>
                            <div class="flex flex-col items-center justify-center w-14 bg-slate-100 rounded py-1 group-hover:bg-white group-hover:shadow-sm transition-all">
                                <span class="font-black text-slate-800">2 - 2</span>
                                <span class="text-[9px] text-slate-400 mt-0.5">(1 - 2)</span>
                            </div>
                            <span class="text-slate-700 font-bold text-left w-20 truncate">Spain</span>
                        </div>
                        <div class="text-[9px] text-slate-400 font-bold uppercase w-8 text-right">UNL</div>
                    </div>
                    
                    <!-- Row 2 -->
                    <div class="flex items-center justify-between text-xs hover:bg-slate-50 p-2.5 rounded-xl transition-colors bg-slate-50/50 group">
                        <div class="text-[10px] text-slate-400 font-bold w-12 leading-tight">27/09<br>2022</div>
                        <div class="flex-1 flex items-center justify-center gap-4">
                            <span class="text-slate-700 font-bold text-right w-20 truncate">Portugal</span>
                            <div class="flex flex-col items-center justify-center w-14 bg-white shadow-sm rounded py-1">
                                <span class="font-black text-slate-800">0 - 1</span>
                                <span class="text-[9px] text-slate-400 mt-0.5">(0 - 0)</span>
                            </div>
                            <span class="text-slate-700 font-bold text-left w-20 truncate">Spain</span>
                        </div>
                        <div class="text-[9px] text-slate-400 font-bold uppercase w-8 text-right">UNL</div>
                    </div>

                    <!-- Row 3 -->
                    <div class="flex items-center justify-between text-xs hover:bg-slate-50 p-2.5 rounded-xl transition-colors group">
                        <div class="text-[10px] text-slate-400 font-bold w-12 leading-tight">15/06<br>2018</div>
                        <div class="flex-1 flex items-center justify-center gap-4">
                            <span class="text-slate-700 font-bold text-right w-20 truncate">Portugal</span>
                            <div class="flex flex-col items-center justify-center w-14 bg-slate-100 rounded py-1 group-hover:bg-white group-hover:shadow-sm transition-all">
                                <span class="font-black text-slate-800">3 - 3</span>
                                <span class="text-[9px] text-slate-400 mt-0.5">(2 - 1)</span>
                            </div>
                            <span class="text-slate-700 font-bold text-left w-20 truncate">Spain</span>
                        </div>
                        <div class="text-[9px] text-slate-400 font-bold uppercase w-8 text-right">WC</div>
                    </div>
                </div>

                <!-- Win Distribution Bar -->
                <div class="mb-2">
                    <div class="flex h-2.5 rounded-full overflow-hidden w-full mb-4 bg-slate-100">
                        <div class="bg-green-500 w-[0%]"></div>
                        <div class="bg-yellow-400 w-[67%] relative"><div class="absolute inset-y-0 right-0 w-px bg-white/50"></div></div>
                        <div class="bg-red-500 w-[33%]"></div>
                    </div>
                    <div class="flex justify-between text-center text-[10px] font-bold text-slate-500">
                        <div><span class="text-slate-800 block mb-1">Portugal 0</span> 0%</div>
                        <div><span class="text-slate-800 block mb-1">Draw 4</span> 67%</div>
                        <div><span class="text-slate-800 block mb-1">Spain 2</span> 33%</div>
                    </div>
                </div>
                
                <!-- View All Button -->
                <div class="text-center mt-8">
                    <button class="text-[10px] font-bold text-slate-500 border border-slate-200 rounded-full px-8 py-2.5 hover:bg-slate-50 hover:text-slate-800 transition-colors shadow-sm">View all</button>
                </div>
            </div>

            <!-- Task 5: Match Intro (Dummy Data) -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col">
                <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest text-center mb-6">Match Intro</h3>
                
                <div class="text-sm text-slate-600 space-y-5 leading-relaxed flex-1">
                    <p>Portugal and Spain meet in the World Cup 2026 Round of 16 at Estádio Nacional on 6 July 2026 GMT.</p>
                    
                    <p>Portugal reached this knockout match after a 2-1 win over Croatia, while Spain moved on with a convincing 3-0 victory against Austria.</p>
                    
                    <p>The Portuguese have won 50% of their four matches in the tournament, mixing a heavy 5-0 victory over Uzbekistan with draws against DR Congo and Colombia.</p>
                    
                    <p>Spain have built stronger momentum, winning 67% of their last six matches and keeping control in recent World Cup games, including wins over Saudi Arabia, Uruguay and Austria.</p>
                    
                    <!-- Verdict Highlight -->
                    <div class="mt-8 p-4 bg-yellow-50/80 rounded-xl border border-yellow-200/60 shadow-sm flex items-start gap-3">
                        <div class="mt-0.5 text-yellow-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <p class="font-bold text-slate-800">Our algorithm predicts Portugal and Spain to draw 1-1.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-layout>