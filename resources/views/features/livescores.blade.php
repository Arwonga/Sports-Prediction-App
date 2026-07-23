<x-layout title="Live Match Scores | Alpha Predictions">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        
        <!-- Header -->
        <div class="bg-slate-900 px-6 py-5 border-b-4 border-red-600 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-white tracking-wide">{{ __('Real-Time Livescores') }}</h2>
                <p class="text-xs text-slate-400 mt-1">{{ __('Live match updates, scores, and fixture statuses for today.') }}</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                </span>
                <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Live Feed Active</span>
            </div>
        </div>

        <!-- Content Table -->
        <div class="w-full pb-4">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="py-4 pl-6 text-left">{{ __('Status / Time') }}</th>
                        <th class="py-4 text-left">{{ __('Fixture') }}</th>
                        <th class="py-4 text-center">{{ __('Score') }}</th>
                        <th class="py-4 text-center">{{ __('Model Verdict') }}</th>
                        <th class="py-4 text-right pr-6">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($fixtures as $fixture)
                        @php
                            $homeScore = $fixture->home_score;
                            $awayScore = $fixture->away_score;
                            $isLive = !is_null($homeScore) && is_null($fixture->full_time_status); // Example indicator logic
                            $status = !is_null($homeScore) ? 'FT / LIVE' : \Carbon\Carbon::parse($fixture->match_at)->format('H:i');
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 pl-6 text-xs font-black text-slate-600 whitespace-nowrap">
                                <span class="bg-slate-100 text-slate-700 px-2 py-1 rounded border border-slate-200">
                                    {{ $status }}
                                </span>
                            </td>

                            <td class="py-4 text-xs font-bold text-slate-800">
                                <div class="flex items-center gap-2">
                                    <span class="text-blue-600">H:</span> {{ $fixture->homeTeam->name ?? 'Home' }}
                                </div>
                                <div class="flex items-center gap-2 mt-1 text-slate-500">
                                    <span class="text-red-600">A:</span> {{ $fixture->awayTeam->name ?? 'Away' }}
                                </div>
                            </td>

                            <td class="py-4 text-sm font-black text-center text-slate-900 whitespace-nowrap">
                                {{ $homeScore ?? '-' }} : {{ $awayScore ?? '-' }}
                            </td>

                            <td class="py-4 text-center whitespace-nowrap">
                                <span class="bg-yellow-400 text-slate-900 text-[10px] font-black px-2.5 py-1 rounded shadow-sm uppercase">
                                    {{ $fixture->prediction->verdict ?? 'ANALYZING' }}
                                </span>
                            </td>

                            <td class="py-4 text-right pr-6 whitespace-nowrap">
                                <a href="{{ route('predictions.show', $fixture->id) }}" class="text-xs font-bold text-blue-600 hover:underline">
                                    Details &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400 text-sm font-semibold">
                                No fixtures available for livescore tracking today.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</x-layout>