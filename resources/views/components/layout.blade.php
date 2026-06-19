<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Alpha Predictions' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen relative overflow-x-hidden">
    
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[400px] opacity-20 bg-gradient-to-b from-blue-300 to-transparent blur-3xl -z-10 pointer-events-none"></div>

    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-extrabold tracking-tighter text-slate-900">
                ALPHA<span class="text-blue-600">PREDICTIONS</span>
            </div>
            <div class="text-sm font-semibold text-slate-500 uppercase tracking-widest">
                Quantitative Engine
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-12">
        {{ $slot }}
    </main>

</body>
</html>