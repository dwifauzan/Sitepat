<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LATELINK SMAKENSA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    @stack('styles')
</head>
<body class="font-sans bg-slate-50 text-slate-800 antialiased">
    <div class="min-h-screen flex" x-data="{ sidebarOpen: true }">
        {{-- Sidebar --}}
        <aside class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-slate-200 shadow-sm transform transition-transform duration-300 ease-in-out lg:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="flex items-center gap-3 px-6 h-16 border-b border-slate-100">
                <div class="w-8 h-8 rounded-lg bg-primary-600 flex items-center justify-center">
                    <span class="text-white font-bold text-sm">L</span>
                </div>
                <span class="font-bold text-lg text-slate-800">LATELINK</span>
            </div>

            @auth
            <nav class="p-4 space-y-1">
                <p class="px-3 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Main</p>
                <a href="{{ route('dash') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150 {{ request()->routeIs('dash') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                    <i class="fas fa-chart-bar w-5 text-center {{ request()->routeIs('dash') ? 'text-primary-600' : 'text-slate-400' }}"></i>
                    Dashboard
                </a>

                @if (Auth::user()->role_id == 1)
                <p class="px-3 mt-6 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Manage Data</p>
                <a href="{{ route('manage') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150 {{ request()->routeIs('manage') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                    <i class="fas fa-users w-5 text-center {{ request()->routeIs('manage') ? 'text-primary-600' : 'text-slate-400' }}"></i>
                    Data Siswa
                </a>
                <a href="{{ route('create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150 {{ request()->routeIs('create') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                    <i class="fas fa-user-plus w-5 text-center {{ request()->routeIs('create') ? 'text-primary-600' : 'text-slate-400' }}"></i>
                    Tambah Siswa
                </a>
                <a href="{{ route('jurusan') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150 {{ request()->routeIs('jurusan') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                    <i class="fas fa-flask w-5 text-center {{ request()->routeIs('jurusan') ? 'text-primary-600' : 'text-slate-400' }}"></i>
                    Jurusan
                </a>
                <a href="{{ route('kelas') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150 {{ request()->routeIs('kelas') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                    <i class="fas fa-building w-5 text-center {{ request()->routeIs('kelas') ? 'text-primary-600' : 'text-slate-400' }}"></i>
                    Kelas
                </a>
                @endif

                <p class="px-3 mt-6 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">QR Scan</p>
                <a href="{{ route('lateTable') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150 {{ request()->routeIs('lateTable') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                    <i class="fas fa-clock w-5 text-center {{ request()->routeIs('lateTable') ? 'text-primary-600' : 'text-slate-400' }}"></i>
                    Terlambat
                </a>
                <a href="{{ route('scanSiswa') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150 {{ request()->routeIs('scanSiswa') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                    <i class="fas fa-qrcode w-5 text-center {{ request()->routeIs('scanSiswa') ? 'text-primary-600' : 'text-slate-400' }}"></i>
                    Scan Siswa
                </a>
            </nav>
            @endauth
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col lg:ml-64">
            {{-- Navbar --}}
            <header class="sticky top-0 z-20 bg-primary-600 shadow">
                <div class="flex items-center justify-between px-4 lg:px-6 h-16">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-white/80 hover:text-white transition-colors lg:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="flex items-center gap-2 text-white">
                        <span class="text-sm font-medium">LATELINK SMAKENSA</span>
                    </div>
                    <div class="flex items-center gap-3">
                        @auth
                            <div class="flex items-center gap-3">
                                <span class="text-white/80 text-sm hidden sm:block">{{ Auth::user()->name }}</span>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 text-sm text-white/80 hover:text-white bg-white/10 hover:bg-white/20 rounded-lg transition-colors">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span class="hidden sm:inline">Logout</span>
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 p-4 lg:p-6">
                <div class="max-w-7xl mx-auto space-y-6">
                    @if (session('success'))
                        <x-alert variant="success" :message="session('success')" />
                    @endif
                    @if (session('error'))
                        <x-alert variant="danger" :message="session('error')" />
                    @endif
                    @yield('content')
                </div>
            </main>

            {{-- Footer --}}
            <footer class="py-4 px-6 text-center text-xs text-slate-400 border-t border-slate-200">
                &copy; {{ date('Y') }} LATELINK SMAKENSA. All rights reserved.
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')
</body>
</html>
