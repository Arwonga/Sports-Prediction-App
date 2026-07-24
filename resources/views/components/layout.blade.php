<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Predict Score | The smart money runs on data' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Premium Corporate Fonts: Inter (UI) & Exo 2 (Sporty/Tech Slants) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,400;0,700;0,900;1,700;1,900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-brand { font-family: 'Exo 2', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen relative overflow-x-hidden">

    <!-- Decorative Red & Blue Background Gradient Blend -->
<div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[400px] opacity-20 bg-gradient-to-r from-blue-500 via-purple-400 to-red-500 blur-3xl -z-10 pointer-events-none"></div>

    <!-- Main Premium Navigation Bar -->
    <nav class="bg-slate-900 border-b-2 border-red-600 sticky top-0 z-50 shadow-md w-full">
        <!-- Top Branding & User Bar -->
        <div class="w-full px-6 flex justify-between items-center h-16">
            <div class="flex items-center gap-3">
                <a href="/" class="group flex items-center text-[28px] font-black italic tracking-tight">
    <span class="text-red-500">Pre</span>
    
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 mx-0.5 text-white transition-transform duration-500 group-hover:rotate-90">
        <circle cx="12" cy="12" r="10"></circle>
        <path d="M12 12l3.5 2 1.5-3.5L12 7l-5 3.5 1.5 3.5z"></path>
        <path d="M12 7V2"></path>
        <path d="M17 10.5l4-2.5"></path>
        <path d="M15.5 14l2.5 5"></path>
        <path d="M8.5 14l-2.5 5"></path>
        <path d="M7 10.5L3 8"></path>
    </svg>

    <span class="text-red-500  ">Score</span>
    </a>
            <div class="hidden md:block w-px h-6 bg-slate-700 mx-3"></div>
            <div class="hidden md:block text-xs font-semibold tracking-widest text-slate-300 uppercase font-sans">
                {{ __('The smart money runs on data') }}
            </div>
            </div>


    <!-- Right Side Top Nav Features -->
<div class="flex flex-row items-center gap-4 ml-auto">
    <!-- Search Bar -->
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input type="text" id="match-search" onkeyup="filterMatches()" class="block py-1.5 pl-9 pr-3 text-xs text-white bg-slate-800 border border-slate-700 rounded-full focus:outline-none focus:border-slate-500 placeholder-slate-400 transition-all duration-300 focus:w-56 w-48 shadow-inner" placeholder="Search match...">
    </div>

    <!-- More Menu Container -->
    <div class="relative flex items-center" id="more-menu-container">
        
        <!-- 3-Dot Trigger Button -->
        <button onclick="toggleMoreMenu()" class="flex flex-col items-center justify-center text-slate-300 hover:text-white transition-colors group px-2">
            <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01"></path>
            </svg>
            <span class="text-[9px] font-bold mt-0.5 tracking-wider">More</span>
        </button>

        <!-- The Dropdown Panel -->
<div id="more-dropdown" class="hidden absolute right-0 top-12 mt-2 w-64 bg-white rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] border border-slate-200 z-[99999] text-xs pb-2">
    
    <!-- Section 1: Features -->
    <div class="px-3 pt-3 pb-2 border-b border-slate-100">
        <h3 class="font-black text-slate-400 uppercase tracking-widest mb-2 text-[10px] px-2">{{ __('Features') }}</h3>
        <ul class="space-y-1">
            <li>
                <a href="{{ route('features.previews') }}" class="flex items-center px-3 py-2 text-slate-600 hover:text-red-600 hover:bg-slate-50 rounded-xl font-bold transition-colors">
                    <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg> 
                    {{ __('Previews') }}
                </a>
            </li>

            <li>
                <a href="{{ route('features.trends') }}" class="flex items-center px-3 py-2 text-slate-600 hover:text-red-600 hover:bg-slate-50 rounded-xl font-bold transition-colors">
                    <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg> 
                    {{ __('Trends') }}
                </a>
            </li>
            
            <li>
                <a href="{{ route('features.livescores') }}" class="flex items-center px-3 py-2 text-slate-600 hover:text-red-600 hover:bg-slate-50 rounded-xl font-bold transition-colors">
                    <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> 
                    {{ __('Livescore') }}
                </a>
            </li>
            
            <li>
                <a href="{{ route('features.injured-players') }}" class="flex items-center px-3 py-2 text-slate-600 hover:text-red-600 hover:bg-slate-50 rounded-xl font-bold transition-colors">
                    <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> 
                    {{ __('Injured Players') }}
                </a>
            </li>
            
            <li>
                <a href="{{ route('features.team-comparison') }}" class="flex items-center px-3 py-2 text-slate-600 hover:text-red-600 hover:bg-slate-50 rounded-xl font-bold transition-colors">
                    <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg> 
                    {{ __('Team Comparison') }}
                </a>
            </li>
        </ul>
    </div>

    <!-- Language Selector -->
    <div class="relative group cursor-pointer px-3 py-2 border-b border-slate-100 bg-white">
        <div class="flex items-center justify-between text-slate-700 font-bold text-xs px-3 py-2 bg-slate-50 hover:bg-slate-100 rounded-lg transition-colors">
            <div class="flex items-center gap-2 group-hover:text-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                {{ __('Language') }}
            </div>
            <span class="text-[9px] uppercase bg-white px-2 py-0.5 rounded shadow-sm border border-slate-200">{{ app()->getLocale() }}</span>
        </div>
    
        <!-- The Language Dropdown Menu (Fixed: Flyout to the left) -->
        <div class="absolute right-full top-0 mr-2 w-48 bg-white rounded-xl shadow-xl border border-slate-200 hidden group-hover:block z-[999999] py-2">
            <a href="{{ route('language.switch', 'en') }}" class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-red-600 transition-colors">English</a>
            <a href="{{ route('language.switch', 'sw') }}" class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-red-600 transition-colors">Swahili</a>
            <a href="{{ route('language.switch', 'es') }}" class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-red-600 transition-colors">Español</a>
            <a href="{{ route('language.switch', 'fr') }}" class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-red-600 transition-colors">Français</a>
            <a href="{{ route('language.switch', 'zh') }}" class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-red-600 transition-colors">中文 (Chinese)</a>
            <a href="{{ route('language.switch', 'ar') }}" class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-red-600 transition-colors">العربية (Arabic)</a>
            <a href="{{ route('language.switch', 'pt') }}" class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-red-600 transition-colors">Português</a>
        </div>
    </div>

    <!-- Settings Form -->
    <form action="{{ route('settings.update') }}" method="POST" id="global-settings-form" class="p-3 bg-slate-50 m-3 mt-2 rounded-xl border border-slate-100">
        @csrf
        
        <div class="flex items-center gap-2 mb-3">
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <h4 class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ __('Settings') }}</h4>
        </div>
        
        <!-- Time Zone -->
        <div class="mb-2">
            <label class="block text-[10px] font-bold text-slate-500 mb-1.5">
                {{ __('Time Zone') }}
            </label>
            @php
                // Pull current session timezone, default to UTC if missing
                $currentTz = session('timezone', 'UTC'); 
                
                // List of major world timezones
                $timezones = [
                    'UTC' => 'UTC (Default)',
                    'Africa/Nairobi' => 'East Africa Time (EAT)',
                    'Africa/Lagos' => 'West Africa Time (WAT)',
                    'Europe/London' => 'London (GMT/BST)',
                    'Europe/Paris' => 'Central Europe (CET)',
                    'America/New_York' => 'Eastern Time (ET)',
                    'America/Los_Angeles' => 'Pacific Time (PT)',
                    'Asia/Dubai' => 'Dubai (GST)',
                    'Asia/Tokyo' => 'Tokyo (JST)',
                    'Australia/Sydney' => 'Sydney (AEST)',
                ];
                
                // If the auto-detected timezone isn't in our clean list, add it dynamically so the dropdown doesn't break
                if(!array_key_exists($currentTz, $timezones)) {
                    $timezones[$currentTz] = $currentTz . ' (Auto)';
                }
            @endphp
            <select name="timezone" class="w-full bg-white border border-slate-200 text-slate-700 text-[10px] font-bold rounded-lg px-2 py-2 focus:ring-2 focus:ring-red-500 outline-none shadow-sm cursor-pointer transition-shadow">
                @foreach($timezones as $value => $label)
                    <option value="{{ $value }}" {{ $currentTz === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="w-full mt-2 bg-slate-900 hover:bg-red-600 text-white font-black text-[10px] py-2 rounded-lg transition-colors uppercase tracking-widest shadow-md">
            Save Settings
        </button>
    </form>

    <!-- Section 3: About Us -->
    <div class="px-3 pt-1">
        <a href="#" class="flex justify-between items-center px-3 py-2 text-xs text-slate-600 font-bold hover:text-slate-800 hover:bg-slate-50 rounded-xl transition-colors group">
            {{ __('About Us') }}
            <svg class="w-3 h-3 opacity-50 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7-7"></path></svg>
        </a>
    </div>
</div>
    </div>
</div>
</div>


<script>
    function toggleMoreMenu() {
        const menu = document.getElementById('more-dropdown');
        menu.classList.toggle('hidden');
    }

    // Close the dropdown if the user clicks outside of it
    document.addEventListener('click', function(event) {
        const container = document.getElementById('more-menu-container');
        const menu = document.getElementById('more-dropdown');
        if (!container.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
        </div>

        <!-- Scrollable Sports Category Sub-Nav (Icon-Enhanced) -->
        <div class="bg-slate-800 border-b border-blue-900/50 w-full overflow-x-auto no-scrollbar">
            <div class="flex items-center h-12 min-w-full">
                
                <!-- Helper for Icon + Text -->
                @php
                    $sports = [
                        ['name' => 'Football', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z'],
                        ['name' => 'Basketball', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93z'],
                        ['name' => 'Tennis', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM4 12c0-4.42 3.58-8 8-8v16c-4.42 0-8-3.58-8-8z'],
                        ['name' => 'Hockey', 'icon' => 'M20 18H4v-2h16v2zM4 6h16v2H4V6zm0 5h16v2H4v-2z'],
                        ['name' => 'Baseball', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z'],
                        ['name' => 'American Football', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z'],
                        ['name' => 'MMA', 'icon' => 'M14.59 8L12 10.59 9.41 8 8 9.41 10.59 12 8 14.59 9.41 16 12 13.41 14.59 16 16 14.59 13.41 12 16 9.41 14.59 8z'],
                        ['name' => 'Rugby', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z'],
                        ['name' => 'Volleyball', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z'],
                        ['name' => 'Handball', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z'],
                        ['name' => 'Cricket', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z'],
                        ['name' => 'AFL', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z'],
                    ];
                @endphp

                @foreach($sports as $sport)
                    <a href="#" class="flex-1 flex justify-center items-center gap-2 px-4 h-full text-sm font-semibold text-slate-400 hover:text-white hover:bg-slate-700 hover:border-b-2 hover:border-blue-500 transition-all whitespace-nowrap {{ $sport['name'] == 'Football' ? 'bg-slate-700 text-white border-b-2 border-red-500' : '' }}">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="{{ $sport['icon'] }}"></path></svg>
                        {{ $sport['name'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </nav>

    <!-- Page Content Slot -->
    <main class="w-full mx-auto flex min-h-screen bg-slate-50 relative">
        
        <x-sidebar />

        <div class="flex-1 p-6 overflow-x-auto">
            {{ $slot }}
        </div>

        <x-sidebar-right />
        
    </main>

</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const storageKey = 'prescore_watchlist';
        
        // Helper function to extract the real team names from the dashboard DOM
        const extractMatchName = (id) => {
            const row = document.getElementById(`fixture-row-${id}`);
            if (row) {
                // Targets the span elements holding the team names in your index.blade.php
                const teamSpans = row.querySelectorAll('td:first-child span.truncate');
                if (teamSpans.length >= 2) {
                    return `${teamSpans[0].textContent.trim()} vs ${teamSpans[1].textContent.trim()}`;
                }
            }
            return null;
        };

        // Load memory and automatically format old string IDs into objects
        let rawData = JSON.parse(localStorage.getItem(storageKey)) || [];
        let watchlist = rawData.map(item => {
            return typeof item === 'string' ? { id: item, name: `Match #${item}` } : item;
        });

        // SELF-HEALING PROTOCOL: Upgrade old 'Match #ID' entries if they are visible on screen
        let memoryUpdated = false;
        watchlist.forEach(item => {
            if (item.name.startsWith('Match #')) {
                const realName = extractMatchName(item.id);
                if (realName) {
                    item.name = realName;
                    memoryUpdated = true;
                }
            }
        });
        
        // If we found and fixed any legacy names, save the corrected data back to the browser
        if (memoryUpdated) {
            localStorage.setItem(storageKey, JSON.stringify(watchlist));
        }

        const refreshWatchlistUI = () => {
            // 1. Force the colors directly
            document.querySelectorAll('.watchlist-toggle').forEach(btn => {
                const id = btn.getAttribute('data-fixture-id');
                const isStarred = watchlist.some(item => item.id === id);
                
                if (isStarred) {
                    btn.style.color = '#facc15'; // yellow-400
                } else {
                    btn.style.color = '#cbd5e1'; // slate-300
                }
            });

            // 2. Clear the sidebar container so we don't create duplicates
            const sidebarContainer = document.getElementById('sidebar-watchlist-container');
            if (sidebarContainer) sidebarContainer.innerHTML = '';

            // 3. Move starred rows to the top AND inject them into the sidebar
            [...watchlist].reverse().forEach(savedItem => {
                // Move table row
                const row = document.getElementById(`fixture-row-${savedItem.id}`);
                if (row && row.parentNode) {
                    row.parentNode.prepend(row);
                }

                // Inject into Sidebar with truncation and hover-title
                if (sidebarContainer) {
                    const sidebarHtml = `
                        <a href="/predictions/${savedItem.id}" class="flex items-center gap-2 px-3 py-2 text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors">
                            <svg class="w-4 h-4 text-yellow-400 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                            <span class="truncate" title="${savedItem.name}">${savedItem.name}</span>
                        </a>
                    `;
                    sidebarContainer.insertAdjacentHTML('beforeend', sidebarHtml);
                }
            });
        };

        refreshWatchlistUI();

        document.body.addEventListener('click', (e) => {
            const btn = e.target.closest('.watchlist-toggle');
            if (!btn) return; 
            
            e.preventDefault(); 
            
            const id = btn.getAttribute('data-fixture-id');
            const existsIndex = watchlist.findIndex(item => item.id === id);
            
            if (existsIndex > -1) {
                // If it already exists, remove it
                watchlist.splice(existsIndex, 1);
            } else {
                // Extract the true match name, falling back to the ID only if extraction fails
                let matchName = extractMatchName(id) || `Match #${id}`;
                
                // Save the ID and the dynamic Name
                watchlist.push({ id: id, name: matchName });
            }
            
            // Save and instantly trigger the visual update
            localStorage.setItem(storageKey, JSON.stringify(watchlist));
            refreshWatchlistUI();
        });
    });
</script>
</html>