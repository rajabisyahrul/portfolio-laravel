<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Masuk (Inbox) | Portofolio M. Syahrul Rajabi</title>
    
    <!-- Tailwind CSS -->
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
<body class="bg-slate-950 text-slate-100 min-h-screen font-sans antialiased selection:bg-blue-500 selection:text-white">
    <!-- Top Navigation -->
    <nav class="border-b border-slate-800 bg-slate-900/80 backdrop-blur-md sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-md shadow-blue-500/20">
                    SR
                </a>
                <div>
                    <h1 class="text-sm font-bold text-white flex items-center gap-2">
                        <span>Database Pesan Masuk</span>
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20 font-semibold">Laravel 10</span>
                    </h1>
                    <p class="text-xs text-slate-400">Pesan dari formulir kontak portofolio</p>
                </div>
            </div>
            <div class="flex items-center gap-2.5">
                <a href="{{ route('home') }}" class="px-3.5 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-medium transition flex items-center gap-1.5 border border-slate-700">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    <span>Kembali ke Website</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Content Area -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Summary -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                    <i data-lucide="inbox" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-medium">Total Pesan Masuk</p>
                    <p class="text-2xl font-bold text-white">{{ $messages->count() }}</p>
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                    <i data-lucide="file-spreadsheet" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-medium">Tersinkron Google Sheets</p>
                    <p class="text-2xl font-bold text-emerald-400">{{ $messages->where('synced_to_sheets', true)->count() }}</p>
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400">
                    <i data-lucide="database" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-medium">Driver Database</p>
                    <p class="text-lg font-bold text-white uppercase">{{ config('database.default') }}</p>
                </div>
            </div>
        </div>

        <!-- Messages List / Table -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="p-5 border-b border-slate-800 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-semibold text-white">Daftar Kontak Tersimpan</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Semua data pesan tersimpan aman di tabel <code class="text-blue-400 bg-slate-800 px-1.5 py-0.5 rounded text-[11px]">contact_messages</code></p>
                </div>
            </div>

            @if($messages->isEmpty())
                <div class="text-center py-16 px-4">
                    <div class="w-16 h-16 rounded-full bg-slate-800/80 border border-slate-700 flex items-center justify-center mx-auto text-slate-500 mb-3">
                        <i data-lucide="mail-open" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-base font-medium text-slate-300">Belum Ada Pesan Masuk</h3>
                    <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1">Pesan yang dikirim pengunjung melalui formulir kontak portofolio Anda akan otomatis muncul di sini dan disinkronkan ke Google Sheets.</p>
                    <a href="{{ route('home') }}#contact" class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-medium transition shadow-md shadow-blue-500/20">
                        <i data-lucide="send" class="w-3.5 h-3.5"></i>
                        <span>Coba Kirim Pesan Tes</span>
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-slate-800 bg-slate-950/50 text-slate-400 font-semibold uppercase tracking-wider text-[11px]">
                                <th class="py-3 px-4">Waktu</th>
                                <th class="py-3 px-4">Pengirim</th>
                                <th class="py-3 px-4">Subjek</th>
                                <th class="py-3 px-4">Isi Pesan</th>
                                <th class="py-3 px-4 text-center">Status Sheets</th>
                                <th class="py-3 px-4">IP Address</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            @foreach($messages as $msg)
                                <tr class="hover:bg-slate-800/30 transition-colors">
                                    <td class="py-3.5 px-4 whitespace-nowrap text-slate-400">
                                        <div class="font-medium text-slate-200">{{ $msg->created_at->format('d M Y') }}</div>
                                        <div class="text-[10px] text-slate-500">{{ $msg->created_at->format('H:i:s') }} ({{ $msg->created_at->diffForHumans() }})</div>
                                    </td>
                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                        <div class="font-semibold text-white">{{ $msg->name }}</div>
                                        <a href="mailto:{{ $msg->email }}" class="text-[11px] text-blue-400 hover:underline flex items-center gap-1 mt-0.5">
                                            <i data-lucide="mail" class="w-3 h-3"></i>
                                            <span>{{ $msg->email }}</span>
                                        </a>
                                    </td>
                                    <td class="py-3.5 px-4 font-medium text-slate-300">
                                        {{ $msg->subject }}
                                    </td>
                                    <td class="py-3.5 px-4 text-slate-300 max-w-md">
                                        <div class="bg-slate-950/60 p-3 rounded-xl border border-slate-800/80 text-[11.5px] leading-relaxed whitespace-pre-wrap font-sans">
                                            {{ $msg->message }}
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                        @if($msg->synced_to_sheets)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                                                <i data-lucide="check-circle" class="w-3 h-3"></i>
                                                Tersinkron
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/30">
                                                <i data-lucide="clock" class="w-3 h-3"></i>
                                                Hanya Lokal
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 whitespace-nowrap font-mono text-[11px] text-slate-500">
                                        {{ $msg->ip_address ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
