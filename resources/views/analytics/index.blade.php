<x-layout title="Alpha Predictions | Performance Analytics">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6">
        
        <div class="bg-slate-900 px-6 py-4 border-b-4 border-red-600">
            <h2 class="text-lg font-bold text-white tracking-wide">{{ __('Algorithm Strike Rate') }}</h2>
            <p class="text-slate-400 text-xs mt-1">{{ __('Historical performance and mathematical edge.') }}</p>
        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Overall Accuracy Card -->
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-6 text-center shadow-sm">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">{{ __('Overall Accuracy') }}</h3>
                <div class="text-5xl font-black {{ $overallRate >= 65 ? 'text-emerald-500' : 'text-blue-500' }}">
                    {{ $overallRate }}%
                </div>
                <p class="text-xs text-slate-500 mt-3 font-semibold uppercase tracking-wider">
                    {{ $won }} {{ __('Won') }} / {{ $total }} {{ __('Graded') }}
                </p>
            </div>

            <!-- Goal Markets Card -->
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-6 text-center shadow-sm">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">{{ __('Goals & BTTS') }}</h3>
                <div class="text-4xl font-black text-slate-700">
                    {{ $goalRate }}%
                </div>
                <p class="text-xs text-slate-500 mt-3 font-semibold uppercase tracking-wider">
                    {{ $goalWon }} {{ __('Won') }} / {{ $goalTotal }} {{ __('Graded') }}
                </p>
            </div>

            <!-- Match Outcomes Card -->
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-6 text-center shadow-sm">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">{{ __('Match Outcomes') }}</h3>
                <div class="text-4xl font-black text-slate-700">
                    {{ $resultRate }}%
                </div>
                <p class="text-xs text-slate-500 mt-3 font-semibold uppercase tracking-wider">
                    {{ $resultWon }} {{ __('Won') }} / {{ $resultTotal }} {{ __('Graded') }}
                </p>
            </div>

        </div>
    </div>

</x-layout>