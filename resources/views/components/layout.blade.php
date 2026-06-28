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
                <div class="font-brand text-3xl font-black text-blue-500 italic flex items-center tracking-tight">
                    <span class="text-red-500">Pre</span>dict<span class="text-red-500 ml-1">Score</span>
                </div>
                <div class="hidden md:block w-px h-6 bg-slate-700 mx-3"></div>
                <div class="hidden md:block text-xs font-semibold tracking-widest text-slate-300 uppercase font-sans">
                    The smart money runs on data
                </div>
            </div>

            <div class="flex items-center space-x-5 text-slate-400">
                <svg class="w-5 h-5 hover:text-white cursor-pointer transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-600 to-red-600 flex items-center justify-center cursor-pointer hover:opacity-90 shadow-[0_0_12px_rgba(239,68,68,0.3)] transition-all">
                    <span class="text-xs font-bold text-white">AJ</span>
                </div>
            </div>
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
    <main class="w-full mx-auto px-4 py-8">
        {{ $slot }}
    </main>

</body>
</html>