<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') | Portofolio M. Syahrul Rajabi</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#10B981',
                        dark: '#0F172A',
                        darkcard: '#1E293B',
                        accent: '#6366F1'
                    }
                }
            }
        }
    </script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen font-sans antialiased selection:bg-blue-500 selection:text-white flex flex-col md:flex-row">

    <!-- Mobile Header -->
    <header class="md:hidden bg-slate-900 border-b border-slate-800 px-4 py-3 flex items-center justify-between sticky top-0 z-40">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-xs shadow-md shadow-blue-500/20">
                SR
            </div>
            <span class="text-xs font-bold text-white">Admin Panel</span>
        </div>
        <button id="mobileMenuBtn" class="p-2 rounded-lg bg-slate-800 text-slate-300 hover:text-white">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
    </header>

    <!-- Sidebar Navigation -->
    <aside id="sidebar" class="hidden md:flex flex-col w-64 bg-slate-900/95 border-r border-slate-800/80 min-h-screen p-4 sticky top-0 z-50">
        <!-- Brand -->
        <div class="flex items-center gap-3 px-2 py-3 mb-6 border-b border-slate-800/80">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-md shadow-blue-500/20">
                SR
            </div>
            <div>
                <span class="block text-xs font-bold text-white">CMS Admin Panel</span>
                <span class="block text-[10px] text-slate-400">Portofolio Syahrul Rajabi</span>
            </div>
        </div>

        <!-- Menu Links -->
        <nav class="flex-1 space-y-1 text-xs">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                <span>Dashboard Overview</span>
            </a>

            <div class="pt-3 pb-1 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                Konten Portofolio
            </div>

            <a href="{{ route('admin.profile') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl font-medium transition-all {{ request()->routeIs('admin.profile') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                <i data-lucide="user" class="w-4 h-4"></i>
                <span>Profil & Teks Utama</span>
            </a>

            <a href="{{ route('admin.certificates') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl font-medium transition-all {{ request()->routeIs('admin.certificates') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                <i data-lucide="award" class="w-4 h-4"></i>
                <span>Sertifikat & Lisensi</span>
            </a>

            <a href="{{ route('admin.projects') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl font-medium transition-all {{ request()->routeIs('admin.projects') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                <i data-lucide="folder-kanban" class="w-4 h-4"></i>
                <span>Portofolio Proyek</span>
            </a>

            <a href="{{ route('admin.experiences') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl font-medium transition-all {{ request()->routeIs('admin.experiences') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                <i data-lucide="briefcase" class="w-4 h-4"></i>
                <span>Pengalaman Kerja</span>
            </a>

            <a href="{{ route('admin.educations') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl font-medium transition-all {{ request()->routeIs('admin.educations') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                <span>Riwayat Pendidikan</span>
            </a>

            <a href="{{ route('admin.skills') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl font-medium transition-all {{ request()->routeIs('admin.skills') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
                <span>Keahlian & Tools</span>
            </a>

            <div class="pt-3 pb-1 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                Interaksi Pengunjung
            </div>

            <a href="{{ route('admin.messages') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl font-medium transition-all {{ request()->routeIs('admin.messages') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                <i data-lucide="inbox" class="w-4 h-4"></i>
                <span>Pesan Masuk (Inbox)</span>
            </a>
        </nav>

        <!-- Bottom User & Live Site Actions -->
        <div class="pt-4 border-t border-slate-800/80 space-y-2">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between px-3 py-2 rounded-xl bg-slate-800/50 hover:bg-slate-800 text-slate-300 text-xs font-medium transition-colors border border-slate-700/60">
                <span class="flex items-center gap-2">
                    <i data-lucide="external-link" class="w-3.5 h-3.5 text-blue-400"></i>
                    <span>Lihat Website</span>
                </span>
                <i data-lucide="arrow-up-right" class="w-3 h-3 text-slate-500"></i>
            </a>

            <div class="flex items-center justify-between px-3 py-2 rounded-xl bg-slate-950/60 border border-slate-800">
                <div class="truncate mr-2">
                    <span class="block text-xs font-semibold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</span>
                    <span class="block text-[10px] text-slate-500 truncate">{{ Auth::user()->email ?? 'admin@syahrul.com' }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-400 hover:bg-slate-800 transition-colors" title="Logout">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 min-w-0 flex flex-col">
        <!-- Top Navbar -->
        <header class="hidden md:flex items-center justify-between px-8 py-4 bg-slate-900/60 backdrop-blur-md border-b border-slate-800/80">
            <div>
                <h1 class="text-base font-bold text-white">@yield('page-title', 'Dashboard')</h1>
                <p class="text-xs text-slate-400">@yield('page-subtitle', 'Kelola semua konten dan aset portofolio secara instan')</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="px-3.5 py-1.5 rounded-xl bg-blue-600/10 hover:bg-blue-600/20 text-blue-400 border border-blue-500/20 text-xs font-semibold flex items-center gap-1.5 transition-colors">
                    <i data-lucide="globe" class="w-3.5 h-3.5"></i>
                    <span>Lihat Halaman Publik</span>
                </a>
            </div>
        </header>

        <!-- Body Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto">
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs flex items-center gap-3 shadow-lg">
                    <i data-lucide="check-circle-2" class="w-5 h-5 flex-shrink-0"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs flex items-center gap-3 shadow-lg">
                    <i data-lucide="alert-octagon" class="w-5 h-5 flex-shrink-0"></i>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs shadow-lg">
                    <div class="flex items-center gap-2 font-semibold mb-1">
                        <i data-lucide="alert-circle" class="w-4 h-4"></i>
                        <span>Mohon periksa kesalahan input:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 text-[11.5px]">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        lucide.createIcons();

        // Mobile drawer toggle
        const menuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');
        if (menuBtn && sidebar) {
            menuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('fixed');
                sidebar.classList.toggle('inset-0');
            });
        }
    </script>
    @yield('scripts')
</body>
</html>
