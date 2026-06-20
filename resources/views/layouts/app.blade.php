<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LATELINK') · SMAKENSA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    @stack('styles')
    <style>
        [x-cloak] { display: none !important; }
        @media (prefers-reduced-motion: no-preference) {
            .fade-in { animation: fadeIn 150ms ease-out; }
            .slide-up { animation: slideUp 250ms ease-out; }
            .page-enter { animation: pageEnter 350ms ease-out; }
            .stagger-fade > * {
                animation: staggerFadeIn 350ms ease-out both;
                animation-delay: calc(var(--i, 0) * 60ms);
            }
            .sidebar-indicator {
                position: relative;
            }
            .sidebar-indicator::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                width: 3px;
                height: 0;
                background: #2563EB;
                border-radius: 0 3px 3px 0;
                animation: indicatorGrow 250ms ease-out forwards;
            }
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes pageEnter { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes staggerFadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes indicatorGrow { from { height: 0; } to { height: 100%; } }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-4px); } 75% { transform: translateX(4px); } }
        .shake { animation: shake 300ms ease; }
    </style>
</head>
<body class="font-sans bg-slate-100 text-slate-800 antialiased">
    <div class="min-h-screen" x-data="{ sidebarOpen: false }" x-cloak>
        {{-- Top Navbar --}}
        <header class="fixed top-0 left-0 right-0 z-50 h-14 bg-blue-600 shadow-md">
            <div class="flex items-center justify-between h-full px-4 lg:px-6">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-white/80 hover:text-white transition-colors lg:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <span class="text-white font-bold text-base tracking-wide">LATELINK</span>
                    <span class="text-white/50 hidden sm:inline text-sm">|</span>
                    <span class="text-white/70 text-sm hidden sm:inline">SMAKENSA</span>
                </div>
                @auth
                <div class="flex items-center gap-4">
                    <button class="relative text-white/80 hover:text-white transition-colors" aria-label="Notifikasi">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-600 rounded-full flex items-center justify-center text-[10px] font-bold text-white">3</span>
                    </button>
                    <div class="flex items-center gap-2" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 text-white/90 hover:text-white transition-colors text-sm">
                            <div class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-user text-xs"></i>
                            </div>
                            <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-4 top-full mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-200 py-1 z-50" style="display: none;">
                            <div class="px-4 py-2 border-b border-slate-100">
                                <p class="text-sm font-medium text-slate-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500">{{ Auth::user()->role_id == 1 ? 'Admin' : 'Operator' }}</p>
                            </div>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-red-600 transition-colors flex items-center gap-2">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </header>

        {{-- Sidebar Overlay (mobile) --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-30 bg-slate-900/60 lg:hidden" style="display: none;"></div>

        {{-- Sidebar --}}
        <aside class="fixed left-0 top-14 bottom-0 z-40 w-64 bg-white border-r border-slate-200 transform transition-transform duration-250 ease-in-out lg:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <nav class="p-4 space-y-1 overflow-y-auto h-full pb-6">
                <p class="px-4 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-widest">Utama</p>
                <a href="{{ route('dash') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg mx-2 text-sm font-medium transition-all duration-150 {{ request()->routeIs('dash') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 hover:pl-5' }}">
                    <i class="fas fa-chart-bar w-[18px] text-center"></i>
                    Dashboard
                </a>
                <a href="{{ route('manage') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg mx-2 text-sm font-medium transition-all duration-150 {{ request()->routeIs('manage') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 hover:pl-5' }}">
                    <i class="fas fa-users w-[18px] text-center"></i>
                    Data Siswa
                </a>
                <a href="{{ route('scanSiswa') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg mx-2 text-sm font-medium transition-all duration-150 {{ request()->routeIs('scanSiswa') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 hover:pl-5' }}">
                    <i class="fas fa-qrcode w-[18px] text-center"></i>
                    Scan Keterlambatan
                </a>
                <a href="{{ route('lateTable') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg mx-2 text-sm font-medium transition-all duration-150 {{ request()->routeIs('lateTable') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 hover:pl-5' }}">
                    <i class="fas fa-clock w-[18px] text-center"></i>
                    Rekap Keterlambatan
                </a>

                @if (Auth::user()->role_id == 1)
                <p class="px-4 mt-6 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-widest">Master Data</p>
                <a href="{{ route('kelas') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg mx-2 text-sm font-medium transition-all duration-150 {{ request()->routeIs('kelas') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 hover:pl-5' }}">
                    <i class="fas fa-school w-[18px] text-center"></i>
                    Kelas
                </a>
                <a href="{{ route('jurusan') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg mx-2 text-sm font-medium transition-all duration-150 {{ request()->routeIs('jurusan') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 hover:pl-5' }}">
                    <i class="fas fa-book w-[18px] text-center"></i>
                    Jurusan
                </a>

                <p class="px-4 mt-6 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-widest">Manajemen</p>
                <a href="{{ route('dash') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg mx-2 text-sm font-medium transition-all duration-150 text-slate-600 hover:bg-slate-100 hover:text-slate-900 hover:pl-5">
                    <i class="fas fa-user-shield w-[18px] text-center"></i>
                    Pengguna
                </a>
                @endif
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="lg:ml-64 pt-14">
            <main class="p-6">
                <div class="max-w-7xl mx-auto page-enter">
                    @if (session('success'))
                        <x-alert variant="success" :message="session('success')" />
                    @endif
                    @if (session('error'))
                        <x-alert variant="danger" :message="session('error')" />
                    @endif

                    {{-- Page Header --}}
                    @hasSection('page-header')
                        <div class="mb-6">
                            @hasSection('breadcrumb')
                            <nav class="text-sm text-slate-500 mb-1">
                                @yield('breadcrumb')
                            </nav>
                            @endif
                            <div class="flex items-center justify-between">
                                <h1 class="text-2xl font-bold text-slate-900">@yield('page-header')</h1>
                                @hasSection('page-action')
                                <div class="flex items-center gap-3">
                                    @yield('page-action')
                                </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>

            <footer class="py-4 px-6 text-center text-xs text-slate-400 border-t border-slate-200">
                &copy; {{ date('Y') }} SMKN 1 Bondowoso. All rights reserved.
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')
</body>
</html>
