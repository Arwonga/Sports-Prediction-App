@props(['fixture'])

<div class="group bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 hover:-translate-y-1 hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] transition-all duration-300 ease-out">
    
    <div class="flex justify-between items-center mb-5 pb-4 border-b border-slate-50">
        <div class="flex items-center text-sm font-semibold text-slate-400">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ $fixture->match_at->format('h:i A') }}
        </div>
        <span class="px-4 py-1.5 bg-blue-50/50 text-blue-600 text-xs font-bold rounded-full tracking-wide uppercase border border-blue-100">
            {{ $fixture->status }}
        </span>
    </div>

    <div class="flex justify-between items-center mb-6">
        <div class="flex-1 text-right">
            <h2 class="text-xl font-bold text-slate-800 tracking-tight">{{ $fixture->homeTeam->name }}</h2>
        </div>
        <div class="px-6 flex flex-col items-center">
            <span class="text-xs font-bold text-slate-300 mb-1">VS</span>
            <div class="h-8 w-px bg-slate-100"></div>
        </div>
        <div class="flex-1 text-left">
            <h2 class="text-xl font-bold text-slate-800 tracking-tight">{{ $fixture->awayTeam->name }}</h2>
        </div>
    </div>

    @if($fixture->prediction)
        <div class="grid grid-cols-4 gap-3 pt-2">
            <div class="bg-slate-50/50 rounded-2xl p-4 text-center border border-slate-100 group-hover:bg-emerald-50/30 transition-colors duration-300">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Over 2.5</p>
                <p class="text-2xl font-black text-emerald-500">{{ $fixture->prediction->prob_over_2_5 }}<span class="text-sm font-bold text-emerald-300">%</span></p>
            </div>
            
            <div class="bg-slate-50/50 rounded-2xl p-4 text-center border border-slate-100 group-hover:bg-rose-50/30 transition-colors duration-300">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Under 2.5</p>
                <p class="text-2xl font-black text-rose-500">{{ $fixture->prediction->prob_under_2_5 }}<span class="text-sm font-bold text-rose-300">%</span></p>
            </div>
            
            <div class="bg-slate-50/50 rounded-2xl p-4 text-center border border-slate-100 group-hover:bg-emerald-50/30 transition-colors duration-300">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">BTTS Yes</p>
                <p class="text-2xl font-black text-emerald-500">{{ $fixture->prediction->prob_btts_yes }}<span class="text-sm font-bold text-emerald-300">%</span></p>
            </div>
            
            <div class="bg-slate-50/50 rounded-2xl p-4 text-center border border-slate-100 group-hover:bg-rose-50/30 transition-colors duration-300">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">BTTS No</p>
                <p class="text-2xl font-black text-rose-500">{{ $fixture->prediction->prob_btts_no }}<span class="text-sm font-bold text-rose-300">%</span></p>
            </div>
        </div>
    @else
        <div class="pt-4 text-center text-sm text-slate-400 font-medium italic bg-slate-50 rounded-xl p-4 border border-slate-100">
            {{ __('Awaiting model calculation...') }}
        </div>
    @endif
</div>