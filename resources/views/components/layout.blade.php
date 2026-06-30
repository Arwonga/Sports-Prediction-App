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

    <span class="text-red-500">Score</span>
    </a>
            <div class="hidden md:block w-px h-6 bg-slate-700 mx-3"></div>
            <div class="hidden md:block text-xs font-semibold tracking-widest text-slate-300 uppercase font-sans">
                The smart money runs on data
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
    <div class="relative" id="more-menu-container">
        
        <!-- 3-Dot Trigger Button -->
        <button onclick="toggleMoreMenu()" class="flex flex-col items-center justify-center text-slate-300 hover:text-white transition-colors group mt-1">
            <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01"></path>
            </svg>
            <span class="text-[9px] font-bold mt-0.5 tracking-wider">More</span>
        </button>

    <!-- The Dropdown Panel -->
    <div id="more-dropdown" class="hidden absolute right-0 mt-4 w-72 bg-white rounded-xl shadow-2xl border border-slate-200 z-50 text-sm overflow-hidden transform opacity-100 scale-100">
        
        <!-- Section 1: Features -->
        <div class="p-5 border-b border-slate-100">
            <h3 class="font-black text-slate-800 mb-4 text-base">More</h3>
            <ul class="space-y-4">
                <li><a href="#" class="flex items-center text-slate-600 hover:text-red-600 font-semibold transition-colors"><svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg> Previews</a></li>
                <li><a href="#" class="flex items-center text-slate-600 hover:text-red-600 font-semibold transition-colors"><svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg> Trends</a></li>
                <li><a href="#" class="flex items-center text-slate-600 hover:text-red-600 font-semibold transition-colors"><svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> Top Trends</a></li>
                <li><a href="#" class="flex items-center text-slate-600 hover:text-red-600 font-semibold transition-colors"><svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Livescore</a></li>
                <li><a href="#" class="flex items-center text-slate-600 hover:text-red-600 font-semibold transition-colors"><svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> Injured players</a></li>
                <li><a href="#" class="flex items-center text-slate-600 hover:text-red-600 font-semibold transition-colors"><svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg> Team Comparison</a></li>
            </ul>
            
            <!-- Language Selector -->
            <div class="mt-5 flex justify-between items-center text-slate-600 hover:text-slate-900 cursor-pointer group">
                <div class="flex items-center font-semibold"><svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg> Language</div>
                <div class="flex items-center text-xs font-bold text-slate-800">English <svg class="w-3 h-3 ml-1 text-slate-400 group-hover:text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></div>
            </div>
        </div>

        <!-- Section 2: Settings -->
        <div class="p-5 border-b border-slate-100 bg-slate-50">
            <h3 class="font-black text-slate-800 mb-4 text-base">Settings</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="flex items-center text-slate-600 text-xs font-semibold"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Time Zone</span>
                    <select class="text-xs bg-white border border-slate-300 rounded-md px-2 py-1.5 outline-none text-slate-700 font-bold shadow-sm focus:border-red-500 cursor-pointer">
                        <option>BY DEFAULT</option>
                        <option>Africa/Nairobi</option>
                    </select>
                </div>
                <div class="flex justify-between items-center">
                    <span class="flex items-center text-slate-600 text-xs font-semibold"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg> % COEF</span>
                    <select class="text-xs bg-white border border-slate-300 rounded-md px-2 py-1.5 outline-none text-slate-700 font-bold shadow-sm focus:border-red-500 cursor-pointer">
                        <option>Decimal (European)</option>
                        <option>Fractional (UK)</option>
                        <option>American (US)</option>
                    </select>
                </div>
                <button class="w-full mt-2 bg-slate-200 hover:bg-slate-300 text-slate-800 text-xs font-black tracking-wide py-2.5 rounded-full transition-colors">Save</button>
            </div>
        </div>

        <!-- Section 3: About Us -->
        <div class="p-5 bg-white">
            <a href="#" class="flex justify-between items-center text-slate-800 font-black hover:text-red-600 transition-colors">
                About us
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7-7"></path></svg>
            </a>
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
</html>