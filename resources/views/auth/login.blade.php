<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Panel | Portofolio M. Syahrul Rajabi</title>
    
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
<body class="bg-slate-950 text-slate-100 min-h-screen flex items-center justify-center p-4 selection:bg-blue-500 selection:text-white relative overflow-hidden font-sans">

    <!-- Background Glow Effects -->
    <div class="absolute top-1/4 -left-20 w-96 h-96 bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-indigo-600/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo / Brand Header -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-blue-500/30 group-hover:scale-105 transition-transform">
                    SR
                </div>
            </a>
            <h1 class="text-2xl font-bold text-white mt-4 tracking-tight">Admin Dashboard</h1>
            <p class="text-xs text-slate-400 mt-1">Masuk untuk mengelola profil, teks, sertifikat, dan pesan masuk</p>
        </div>

        <!-- Login Card -->
        <div class="bg-slate-900/90 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl shadow-black/60">
            <!-- Alert Session / Error -->
            @if(session('info'))
                <div class="mb-5 p-3.5 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs flex items-center gap-2">
                    <i data-lucide="info" class="w-4 h-4 flex-shrink-0"></i>
                    <span>{{ session('info') }}</span>
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="mb-5 p-3.5 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs flex items-start gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0 mt-0.5"></i>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Email Administrator
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email', 'admin@syahrul.com') }}" required autofocus
                            placeholder="admin@syahrul.com"
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-950/70 border border-slate-700/80 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 placeholder-slate-500 text-xs outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                            placeholder="••••••••"
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-950/70 border border-slate-700/80 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 placeholder-slate-500 text-xs outline-none transition-all">
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-400 hover:text-slate-200">
                        <input type="checkbox" name="remember" class="rounded bg-slate-950 border-slate-700 text-blue-600 focus:ring-blue-500">
                        <span>Ingat saya</span>
                    </label>
                    <span class="text-slate-500 text-[11px]">Sistem Terproteksi</span>
                </div>

                <button type="submit" class="w-full mt-2 py-3 px-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold text-xs transition-all shadow-lg shadow-blue-500/25 flex items-center justify-center gap-2 hover:scale-[1.01] active:scale-[0.99]">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    <span>Masuk ke Panel Admin</span>
                </button>
            </form>

            <!-- Quick Credentials Notice -->
            <div class="mt-6 pt-5 border-t border-slate-800 text-center">
                <div class="p-3 rounded-xl bg-slate-950/80 border border-slate-800/80 text-[11px] text-slate-400 text-left">
                    <div class="font-semibold text-slate-300 flex items-center gap-1.5 mb-1 text-xs">
                        <i data-lucide="key" class="w-3.5 h-3.5 text-blue-400"></i>
                        <span>Akses Default Sistem:</span>
                    </div>
                    <div class="space-y-0.5 text-slate-400">
                        <p>• Email: <code class="text-blue-400 font-mono">admin@syahrul.com</code> atau <code class="text-blue-400 font-mono">rajabisyahrul@gmail.com</code></p>
                        <p>• Password: <code class="text-emerald-400 font-mono">admin123</code></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Website -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs text-slate-400 hover:text-white transition-colors">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali ke Halaman Portofolio</span>
            </a>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
