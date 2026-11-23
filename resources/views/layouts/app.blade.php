<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Muhammad Syahrul Rajabi | Web Developer & Information Systems')</title>
    
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
    
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="bg-slate-900 text-slate-100 font-sans antialiased selection:bg-blue-500 selection:text-white">

    <!-- Desktop Floating Pill Navbar (Hidden on Mobile) -->
    <header class="hidden md:flex fixed top-4 sm:top-6 inset-x-0 z-50 flex-col items-center px-4 pointer-events-none">
        <nav class="pointer-events-auto w-full max-w-5xl bg-slate-900/80 hover:bg-slate-900/90 backdrop-blur-xl border border-slate-700/70 rounded-full px-5 py-2 shadow-2xl shadow-black/60 transition-all duration-300 flex items-center justify-between gap-4 ring-1 ring-white/10" id="navbar">
            
            <!-- Left: Brand / Logo Pill -->
            <a href="{{ route('home') }}#hero" class="flex items-center gap-2.5 pl-1.5 pr-3 py-1 rounded-full hover:bg-slate-800/80 transition-colors group">
                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 via-indigo-600 to-purple-600 flex items-center justify-center text-white font-bold text-xs shadow-md shadow-blue-500/30 group-hover:scale-105 transition-transform">
                    SR
                </div>
                <div class="text-left">
                    <span class="block text-sm font-bold tracking-tight bg-gradient-to-r from-blue-300 to-indigo-200 bg-clip-text text-transparent">
                        M. Syahrul Rajabi
                    </span>
                    <span class="block text-[10px] text-slate-400 font-normal -mt-0.5">S.Kom • Sistem Informasi</span>
                </div>
            </a>

            <!-- Center: Desktop Nav Links (Pills) -->
            <div class="flex items-center space-x-1 text-xs font-medium text-slate-300">
                <a href="#hero" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-slate-800/80 transition-all">Beranda</a>
                <a href="#about" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-slate-800/80 transition-all">Tentang</a>
                <a href="#experience" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-slate-800/80 transition-all">Pengalaman</a>
                <a href="#education" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-slate-800/80 transition-all">Pendidikan</a>
                <a href="#certificates" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-slate-800/80 transition-all">Sertifikat</a>
                <a href="#skills" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-slate-800/80 transition-all">Keahlian</a>
                <a href="#projects" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-slate-800/80 transition-all">Portofolio</a>
            </div>

            <!-- Right: Actions (CTA) -->
            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-full bg-slate-800 hover:bg-slate-700 text-blue-400 font-semibold text-xs transition-all border border-slate-700 flex items-center gap-1.5">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                        <span>Admin</span>
                    </a>
                @endauth
                <a href="#contact" class="px-4 py-1.5 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold text-xs transition-all shadow-md shadow-blue-500/25 flex items-center gap-1.5 hover:scale-105 active:scale-95">
                    <i data-lucide="send" class="w-3 h-3"></i>
                    <span>Kirim Pesan</span>
                </a>
            </div>
        </nav>
    </header>

    <!-- Mobile Top Header Bar -->
    <div class="md:hidden fixed top-3 inset-x-3 z-40 flex items-center justify-between px-4 py-2 rounded-full bg-slate-900/85 backdrop-blur-xl border border-slate-700/70 shadow-lg shadow-black/40 ring-1 ring-white/10">
        <a href="#hero" class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white text-[11px] font-bold shadow-md shadow-blue-500/30">
                SR
            </div>
            <div>
                <span class="block text-xs font-bold tracking-tight bg-gradient-to-r from-blue-300 to-indigo-200 bg-clip-text text-transparent">
                    M. Syahrul Rajabi
                </span>
            </div>
        </a>
        <a href="#contact" class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-600 hover:bg-blue-500 text-[11px] font-semibold text-white shadow-sm transition-all">
            <i data-lucide="send" class="w-3 h-3"></i>
            <span>Kontak</span>
        </a>
    </div>

    <!-- Mobile Bottom Tab Bar (Dock Navigation) -->
    <nav class="md:hidden fixed bottom-3 inset-x-3 z-50 flex justify-center pointer-events-none" aria-label="Mobile Navigation">
        <div class="pointer-events-auto w-full max-w-md bg-slate-900/90 hover:bg-slate-900/95 backdrop-blur-2xl border border-slate-700/80 rounded-2xl px-2 py-1.5 shadow-2xl shadow-black/90 flex items-center justify-around ring-1 ring-white/10">
            <a href="#hero" class="bottom-tab-item flex flex-col items-center justify-center py-1 px-2.5 rounded-xl text-blue-400 hover:text-blue-300 active:scale-95 transition-all group">
                <i data-lucide="home" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                <span class="text-[10px] font-medium tracking-tight mt-0.5">Beranda</span>
            </a>
            <a href="#about" class="bottom-tab-item flex flex-col items-center justify-center py-1 px-2.5 rounded-xl text-slate-400 hover:text-blue-400 active:scale-95 transition-all group">
                <i data-lucide="user" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                <span class="text-[10px] font-medium tracking-tight mt-0.5">Tentang</span>
            </a>
            <a href="#contact" class="flex flex-col items-center -mt-6 group active:scale-95 transition-transform" title="Kirim Pesan">
                <div class="w-13 h-13 p-3 rounded-full bg-gradient-to-tr from-blue-600 via-indigo-600 to-purple-600 text-white shadow-xl shadow-blue-500/40 border-4 border-slate-900 group-hover:scale-110 transition-all flex items-center justify-center">
                    <i data-lucide="send" class="w-5 h-5 ml-0.5"></i>
                </div>
                <span class="text-[10px] font-bold text-blue-300 mt-0.5">Pesan</span>
            </a>
            <a href="#experience" class="bottom-tab-item flex flex-col items-center justify-center py-1 px-2.5 rounded-xl text-slate-400 hover:text-blue-400 active:scale-95 transition-all group">
                <i data-lucide="briefcase" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                <span class="text-[10px] font-medium tracking-tight mt-0.5">Karier</span>
            </a>
            <a href="#projects" class="bottom-tab-item flex flex-col items-center justify-center py-1 px-2.5 rounded-xl text-slate-400 hover:text-blue-400 active:scale-95 transition-all group">
                <i data-lucide="layers" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                <span class="text-[10px] font-medium tracking-tight mt-0.5">Karya</span>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="pt-8 pb-28 md:pb-8 bg-slate-950 border-t border-slate-800/80 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p>© {{ date('Y') }} Muhammad Syahrul Rajabi, S.Kom. Seluruh Hak Cipta Dilindungi (Laravel Edition).</p>
            <div class="flex items-center gap-6">
                <a href="#hero" class="hover:text-slate-300 transition-colors">Kembali ke Atas</a>
                <a href="#projects" class="hover:text-slate-300 transition-colors">Portofolio</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-400 hover:text-blue-300 font-semibold transition-colors flex items-center gap-1">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                        Panel Admin CMS
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1">
                        <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                        Login Admin
                    </a>
                @endauth
                <a href="#contact" class="hover:text-slate-300 transition-colors">Kontak</a>
            </div>
        </div>
    </footer>

    @yield('scripts')

    <script>
        // Inisialisasi ikon Lucide
        lucide.createIcons();

        // Indikator Tab Aktif Otomatis pada Mobile Bottom Tab Bar saat di-scroll
        const bottomTabs = document.querySelectorAll('.bottom-tab-item');
        const trackedSections = document.querySelectorAll('section[id]');

        function updateActiveBottomTab() {
            const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

            trackedSections.forEach(section => {
                const top = section.offsetTop - 200;
                const height = section.offsetHeight;
                const id = section.getAttribute('id');

                if (scrollPosition >= top && scrollPosition < top + height) {
                    bottomTabs.forEach(tab => {
                        const targetHash = tab.getAttribute('href');
                        if (targetHash === '#' + id) {
                            tab.classList.add('text-blue-400');
                            tab.classList.remove('text-slate-400');
                        } else {
                            tab.classList.remove('text-blue-400');
                            tab.classList.add('text-slate-400');
                        }
                    });
                }
            });
        }

        window.addEventListener('scroll', updateActiveBottomTab, { passive: true });
    </script>
</body>
</html>
