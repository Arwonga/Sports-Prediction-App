<x-layout title="Match Previews | Alpha Predictions">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        
        <!-- Header -->
        <div class="bg-slate-900 px-6 py-5 border-b-4 border-red-600 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-white tracking-wide">{{ __('Expert Match Previews') }}</h2>
                <p class="text-xs text-slate-400 mt-1">{{ __('Deep dive into quantitative analysis and tactical previews for today fixtures.') }}</p>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @forelse($previews as $preview)
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 hover:shadow-md transition-shadow flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-center mb-3">
                                <span class="bg-blue-100 text-blue-600 text-[10px] font-black px-2 py-1 rounded uppercase tracking-wider">Match Preview</span>
                                <span class="text-xs font-bold text-slate-400">{{ \Carbon\Carbon::parse($preview->match_at)->format('H:i') }}</span>
                            </div>

                            <h3 class="text-sm font-bold text-slate-800 mb-2">
                                {{ $preview->homeTeam->name ?? 'Home' }} vs {{ $preview->awayTeam->name ?? 'Away' }}
                            </h3>

                            <p class="text-xs text-slate-500 font-medium leading-relaxed mb-4">
                                Quantitative outlook projects an open game. Combined expected goals (xG) stand at <span class="font-bold text-slate-700">{{ number_format(($preview->prediction->home_xg ?? 1.2) + ($preview->prediction->away_xg ?? 1.0), 2) }}</span> with a model confidence score of <span class="font-bold text-slate-700">{{ $preview->prediction->confidence ?? 75 }}%</span>.
                            </p>
                        </div>

                        <div class="border-t border-slate-200 pt-3 flex items-center justify-between">
                            <span class="text-[10px] font-black uppercase text-slate-400">Risk: <span class="text-slate-700">{{ $preview->prediction->risk ?? 'LOW' }}</span></span>
                            <a href="{{ route('predictions.show', $preview->id) }}" class="text-xs font-bold text-red-600 hover:underline">Full Breakdown &rarr;</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-8 bg-slate-50 rounded-xl text-center text-sm text-slate-500 font-semibold border border-slate-200">
                        No match previews available for today.
                    </div>
                @endforelse

            </div>
        </div>

    </div>

</x-layout>