@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Ringkasan Dashboard')
@section('page-subtitle', 'Selamat datang di Panel Kontrol CMS Portofolio Anda')

@section('content')
<div class="space-y-8">
    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
        <!-- Messages -->
        <a href="{{ route('admin.messages') }}" class="p-5 rounded-2xl bg-slate-900 border border-slate-800 hover:border-blue-500/50 transition-all group block shadow-lg">
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 group-hover:scale-110 transition-transform">
                <i data-lucide="inbox" class="w-5 h-5"></i>
            </div>
            <div class="mt-3">
                <p class="text-[11px] text-slate-400 font-medium">Pesan Masuk</p>
                <p class="text-xl font-bold text-white mt-0.5">{{ $stats['messages_count'] }}</p>
            </div>
        </a>

        <!-- Certificates -->
        <a href="{{ route('admin.certificates') }}" class="p-5 rounded-2xl bg-slate-900 border border-slate-800 hover:border-emerald-500/50 transition-all group block shadow-lg">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 group-hover:scale-110 transition-transform">
                <i data-lucide="award" class="w-5 h-5"></i>
            </div>
            <div class="mt-3">
                <p class="text-[11px] text-slate-400 font-medium">Sertifikat</p>
                <p class="text-xl font-bold text-emerald-400 mt-0.5">{{ $stats['certificates_count'] }}</p>
            </div>
        </a>

        <!-- Projects -->
        <a href="{{ route('admin.projects') }}" class="p-5 rounded-2xl bg-slate-900 border border-slate-800 hover:border-purple-500/50 transition-all group block shadow-lg">
            <div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400 group-hover:scale-110 transition-transform">
                <i data-lucide="folder-kanban" class="w-5 h-5"></i>
            </div>
            <div class="mt-3">
                <p class="text-[11px] text-slate-400 font-medium">Portofolio</p>
                <p class="text-xl font-bold text-purple-400 mt-0.5">{{ $stats['projects_count'] }}</p>
            </div>
        </a>

        <!-- Experiences -->
        <a href="{{ route('admin.experiences') }}" class="p-5 rounded-2xl bg-slate-900 border border-slate-800 hover:border-amber-500/50 transition-all group block shadow-lg">
            <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 group-hover:scale-110 transition-transform">
                <i data-lucide="briefcase" class="w-5 h-5"></i>
            </div>
            <div class="mt-3">
                <p class="text-[11px] text-slate-400 font-medium">Pengalaman</p>
                <p class="text-xl font-bold text-amber-400 mt-0.5">{{ $stats['experiences_count'] }}</p>
            </div>
        </a>

        <!-- Educations -->
        <a href="{{ route('admin.educations') }}" class="p-5 rounded-2xl bg-slate-900 border border-slate-800 hover:border-cyan-500/50 transition-all group block shadow-lg">
            <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 group-hover:scale-110 transition-transform">
                <i data-lucide="graduation-cap" class="w-5 h-5"></i>
            </div>
            <div class="mt-3">
                <p class="text-[11px] text-slate-400 font-medium">Pendidikan</p>
                <p class="text-xl font-bold text-cyan-400 mt-0.5">{{ $stats['educations_count'] }}</p>
            </div>
        </a>

        <!-- Skills -->
        <a href="{{ route('admin.skills') }}" class="p-5 rounded-2xl bg-slate-900 border border-slate-800 hover:border-pink-500/50 transition-all group block shadow-lg">
            <div class="w-10 h-10 rounded-xl bg-pink-500/10 border border-pink-500/20 flex items-center justify-center text-pink-400 group-hover:scale-110 transition-transform">
                <i data-lucide="sparkles" class="w-5 h-5"></i>
            </div>
            <div class="mt-3">
                <p class="text-[11px] text-slate-400 font-medium">Keahlian</p>
                <p class="text-xl font-bold text-pink-400 mt-0.5">{{ $stats['skills_count'] }}</p>
            </div>
        </a>
    </div>

    <!-- Quick Profile & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Overview Card -->
        <div class="lg:col-span-1 p-6 rounded-3xl bg-slate-900 border border-slate-800 shadow-xl flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                    <h3 class="text-sm font-bold text-white flex items-center gap-2">
                        <i data-lucide="user-check" class="w-4 h-4 text-blue-400"></i>
                        <span>Profil Pemilik Portofolio</span>
                    </h3>
                    <a href="{{ route('admin.profile') }}" class="text-xs text-blue-400 hover:text-blue-300 font-medium">
                        Ubah Profil
                    </a>
                </div>

                <div class="mt-5 text-center">
                    <div class="w-20 h-20 mx-auto rounded-full p-1 bg-gradient-to-tr from-blue-500 to-indigo-600 shadow-lg">
                        <img src="{{ asset($profile->avatar_path ?? 'foto-syahrul.jpg') }}" 
                            alt="{{ $profile->name ?? 'Foto Syahrul' }}" 
                            class="w-full h-full object-cover object-top rounded-full bg-slate-800">
                    </div>
                    <h4 class="text-base font-bold text-white mt-3">{{ $profile->name ?? 'Muhammad Syahrul Rajabi' }}, {{ $profile->degree ?? 'S.Kom' }}</h4>
                    <p class="text-xs text-blue-400 font-medium mt-0.5">{{ $profile->title ?? 'Information Systems Specialist' }}</p>
                    <p class="text-xs text-slate-400 mt-2 flex items-center justify-center gap-1">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-500"></i>
                        <span>{{ $profile->location ?? 'Jakarta, Indonesia' }}</span>
                    </p>
                </div>

                <div class="mt-5 pt-4 border-t border-slate-800 text-xs text-slate-400 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Email:</span>
                        <span class="text-slate-200 font-mono text-[11px]">{{ $profile->email }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">WhatsApp:</span>
                        <span class="text-slate-200 font-mono text-[11px]">{{ $profile->phone }}</span>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.profile') }}" class="mt-6 w-full py-2.5 px-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold flex items-center justify-center gap-2 transition-colors border border-slate-700">
                <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                <span>Kelola Bio, Teks & Foto</span>
            </a>
        </div>

        <!-- Recent Messages (Inbox Snapshot) -->
        <div class="lg:col-span-2 p-6 rounded-3xl bg-slate-900 border border-slate-800 shadow-xl flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                    <div>
                        <h3 class="text-sm font-bold text-white flex items-center gap-2">
                            <i data-lucide="message-square" class="w-4 h-4 text-emerald-400"></i>
                            <span>Pesan Kontak Terbaru</span>
                        </h3>
                        <p class="text-xs text-slate-400 mt-0.5">Pengunjung yang mengirim pesan melalui formulir portofolio</p>
                    </div>
                    <a href="{{ route('admin.messages') }}" class="text-xs text-blue-400 hover:text-blue-300 font-medium flex items-center gap-1">
                        <span>Lihat Semua</span>
                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </a>
                </div>

                <div class="mt-4 space-y-3">
                    @forelse($recentMessages as $msg)
                        <div class="p-3.5 rounded-2xl bg-slate-950/60 border border-slate-800/80 flex items-start justify-between gap-4">
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2">
                                    <span class="font-semibold text-white text-xs truncate">{{ $msg->name }}</span>
                                    <span class="text-[10px] text-slate-500 font-mono">{{ $msg->email }}</span>
                                    @if($msg->synced_to_sheets)
                                        <span class="px-1.5 py-0.5 rounded text-[9px] bg-emerald-500/10 text-emerald-400 font-medium">Sheets</span>
                                    @endif
                                </div>
                                <p class="text-xs font-medium text-slate-300 mt-1 truncate">{{ $msg->subject }}</p>
                                <p class="text-[11px] text-slate-400 line-clamp-1 mt-0.5">{{ $msg->message }}</p>
                            </div>
                            <span class="text-[10px] text-slate-500 whitespace-nowrap">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i data-lucide="inbox" class="w-8 h-8 text-slate-600 mx-auto mb-2"></i>
                            <p class="text-xs text-slate-400">Belum ada pesan kontak dari pengunjung.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-800 flex items-center justify-between text-xs">
                <span class="text-slate-400">Total: <strong class="text-white">{{ $stats['messages_count'] }}</strong> pesan</span>
                <a href="{{ route('admin.messages') }}" class="text-blue-400 hover:underline">Kelola & Hapus Pesan</a>
            </div>
        </div>
    </div>
</div>
@endsection
