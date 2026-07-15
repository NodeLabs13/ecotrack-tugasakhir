<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Eco Track</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: {
                            50: '#f0fdf4', 100:'#dcfce7', 200:'#bbf7d0', 300:'#86efac',
                            400:'#4ade80', 500:'#22c55e', 600:'#16a34a', 700:'#15803d',
                            800:'#166534', 900:'#14532d', 950:'#052e16'
                        },
                        accent: {
                            50: '#f0fdfa', 100:'#ccfbf1', 200:'#99f6e4', 300:'#5eead4',
                            400:'#2dd4bf', 500:'#14b8a6', 600:'#0d9488', 700:'#0f766e',
                            800:'#115e59', 900:'#134e4a'
                        },
                        forest: {
                            50: '#f0fdf4', 100:'#dcfce7', 200:'#bbf7d0', 300:'#86efac',
                            400:'#4ade80', 500:'#22c55e', 600:'#16a34a', 700:'#15803d',
                            800:'#166534', 900:'#14532d'
                        },
                    },
                    boxShadow: {
                        'eco': '0 4px 14px 0 rgba(34, 197, 94, 0.15)',
                        'eco-lg': '0 10px 40px -10px rgba(34, 197, 94, 0.25)',
                        'eco-xl': '0 20px 60px -15px rgba(34, 197, 94, 0.2)',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Sidebar styling */
        .sidebar-gradient {
            background: linear-gradient(145deg, #065f46 0%, #059669 30%, #0d9488 70%, #0f766e 100%);
        }
        .nav-item {
            transition: all 0.2s ease;
        }
        .nav-item:hover {
            background: rgba(255,255,255,0.08);
        }
        .nav-item-active {
            background: linear-gradient(135deg, rgba(255,255,255,0.15), rgba(255,255,255,0.05));
            border-left: 3px solid #6ee7b7;
        }

        /* Content fade-in */
        .fade-in { animation: fadeIn 0.35s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Modern card hover */
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -12px rgba(5, 150, 105, 0.2);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #064e3b; }
        ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 3px; }

        /* Stats card glow */
        .stat-glow {
            position: relative;
        }
        .stat-glow::after {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: inherit;
            background: linear-gradient(135deg, rgba(16,185,129,0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        .stat-glow:hover::after {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
<div class="flex min-h-screen">

    <!-- ===== SIDEBAR ===== -->
    <aside class="w-72 sidebar-gradient text-white flex flex-col fixed h-full shadow-2xl overflow-hidden z-20">

        <!-- Decorative dot grid -->
        <div class="absolute inset-0 pointer-events-none opacity-[0.04]"
             style="background-image: radial-gradient(rgba(255,255,255,0.6) 1px, transparent 1px); background-size: 24px 24px;">
        </div>

        <!-- Logo & Brand -->
        <div class="relative px-6 py-7 flex items-center gap-3 border-b border-white/10">
            <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center flex-shrink-0 shadow-lg">
                <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17.98.3 1.34.3C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8z"/>
                </svg>
            </div>
            <div>
                <p class="font-extrabold text-lg leading-tight tracking-tight">Eco Track</p>
                <p class="text-xs text-emerald-200 leading-tight font-medium">Sistem Monitoring Proyek</p>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="relative flex-1 px-3 py-5 space-y-1 text-sm overflow-y-auto">

            <p class="px-4 py-2 text-[10px] font-bold uppercase tracking-widest text-emerald-300/60">Menu Utama</p>

            <a href="{{ route('dashboard') }}"
               class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'nav-item-active font-semibold' : 'text-emerald-100 hover:text-white' }}">
                <div class="w-8 h-8 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-emerald-400/20' : 'bg-white/5' }} flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('proyek.index') }}"
               class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('proyek.*') ? 'nav-item-active font-semibold' : 'text-emerald-100 hover:text-white' }}">
                <div class="w-8 h-8 rounded-lg {{ request()->routeIs('proyek.*') ? 'bg-emerald-400/20' : 'bg-white/5' }} flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span>Proyek</span>
            </a>

            @if(auth()->check() && in_array(auth()->user()->role, ['civil_engineer', 'direktur', 'perizinan_lingkungan', 'admin']))
            <a href="{{ route('klien.index') }}"
               class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('klien.*') ? 'nav-item-active font-semibold' : 'text-emerald-100 hover:text-white' }}">
                <div class="w-8 h-8 rounded-lg {{ request()->routeIs('klien.*') ? 'bg-emerald-400/20' : 'bg-white/5' }} flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span>Data Klien</span>
            </a>
            @endif

            @if(auth()->check() && auth()->user()->role === 'admin')
            @endif
        </nav>

        <!-- User Profile & Logout -->
        <div class="relative px-4 py-5 border-t border-white/10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-bold shadow-lg text-sm">
                    {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold truncate">{{ auth()->user()->name ?? '-' }}</p>
                    <p class="text-xs text-emerald-200 truncate font-medium">{{ ucfirst(str_replace('_',' ', auth()->user()->role ?? '')) }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-xs bg-white/10 hover:bg-red-400/20 text-emerald-100 hover:text-white rounded-lg py-2.5 transition-all duration-200 flex items-center justify-center gap-1.5 font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="flex-1 ml-72">
        <!-- Header -->
        <header class="bg-white/80 backdrop-blur-md border-b border-gray-100 px-8 py-4 flex items-center justify-between sticky top-0 z-10 shadow-sm">
            <div class="flex items-center gap-4">
                <h1 class="text-xl font-bold text-gray-900">@yield('title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 text-sm text-gray-500 bg-gray-50 px-3 py-1.5 rounded-full border border-gray-100">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="font-medium">{{ now()->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
        </header>

        <main class="p-8 fade-in">
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-xl text-sm flex items-start gap-3 shadow-sm">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif
            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl text-sm shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>