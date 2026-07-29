<x-layout title="About Us | Alpha Predictions">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        
        <!-- Compact Premium Hero Section -->
        <div class="bg-slate-900 px-6 py-8 md:py-10 border-b-4 border-red-600 relative overflow-hidden text-center">
            <!-- Background Accent -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 -mt-20 w-72 h-72 rounded-full bg-red-600 opacity-10 blur-3xl"></div>

            <div class="relative z-10 max-w-2xl mx-auto">
                <span class="text-red-500 font-black tracking-widest text-[10px] uppercase mb-2 block">Alpha Predictions</span>
                <h1 class="text-2xl md:text-3xl font-black text-white tracking-tight mb-3">The Smart Money Runs on Data.</h1>
                <p class="text-slate-400 text-xs md:text-sm font-medium leading-relaxed max-w-lg mx-auto">
                    We engineer quantitative sports models that eliminate human bias. By aggregating live API data, tracking global medical reports, and simulating historical head-to-head metrics, we deliver the mathematical edge.
                </p>
            </div>
        </div>

        <!-- Core Philosophy Grid -->
        <div class="p-6 md:p-8 max-w-4xl mx-auto">
            
            <div class="text-center mb-8">
                <h2 class="text-lg md:text-xl font-black text-slate-800 tracking-tight">Our System Architecture</h2>
                <div class="w-8 h-1 bg-red-600 mx-auto mt-3 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">
                <!-- Feature 1 -->
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 bg-white rounded-lg shadow-sm border border-slate-200 flex items-center justify-center text-red-600 mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-sm font-black text-slate-800 mb-1.5">Algorithmic Precision</h3>
                    <p class="text-[11px] text-slate-500 font-medium leading-relaxed">We process thousands of data points—from Expected Goals (xG) to possession phases—to calculate exact probabilities for over/under and moneyline markets.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 bg-white rounded-lg shadow-sm border border-slate-200 flex items-center justify-center text-blue-600 mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-sm font-black text-slate-800 mb-1.5">Bias Elimination</h3>
                    <p class="text-[11px] text-slate-500 font-medium leading-relaxed">Fan loyalty destroys bankrolls. Our system is engineered to ignore the noise and strictly evaluate the raw, underlying metrics of every matchup.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 bg-white rounded-lg shadow-sm border border-slate-200 flex items-center justify-center text-emerald-600 mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-sm font-black text-slate-800 mb-1.5">Real-Time Intelligence</h3>
                    <p class="text-[11px] text-slate-500 font-medium leading-relaxed">From sudden injury reports to last-minute suspensions, our global database updates continuously to ensure you are never caught off-guard.</p>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="bg-slate-900 rounded-xl p-6 md:p-8 text-center relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-lg md:text-xl font-black text-white mb-2">Ready to upgrade your analytics?</h3>
                    <p class="text-slate-400 text-xs font-medium mb-6 max-w-md mx-auto">Stop guessing and start analyzing. Access our full suite of predictive tools, head-to-head trackers, and live injury databases.</p>
                    <a href="{{ url('/') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-black tracking-widest uppercase text-[10px] px-6 py-2.5 rounded-lg transition-colors shadow-sm">
                        View Today's Predictions
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-layout>