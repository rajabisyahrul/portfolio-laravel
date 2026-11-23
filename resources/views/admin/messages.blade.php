@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk (Inbox)')
@section('page-subtitle', 'Kelola semua pesan kontak yang dikirim oleh pengunjung web portofolio Anda')

@section('content')
<div class="space-y-6">
    <!-- Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                <i data-lucide="inbox" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Total Pesan Tersimpan</p>
                <p class="text-2xl font-bold text-white">{{ $messages->count() }}</p>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                <i data-lucide="file-spreadsheet" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Tersinkron ke Google Sheets</p>
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
    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-xl">
        <div class="p-5 border-b border-slate-800 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-bold text-white">Daftar Formulir Kontak Masuk</h3>
                <p class="text-xs text-slate-400 mt-0.5">Tersimpan aman di tabel database <code class="text-blue-400 font-mono">contact_messages</code></p>
            </div>
        </div>

        @if($messages->isEmpty())
            <div class="text-center py-16 px-4">
                <div class="w-16 h-16 rounded-full bg-slate-800/80 border border-slate-700 flex items-center justify-center mx-auto text-slate-500 mb-3">
                    <i data-lucide="mail-open" class="w-7 h-7"></i>
                </div>
                <h4 class="text-sm font-medium text-slate-300">Belum Ada Pesan Masuk</h4>
                <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1">Pesan yang dikirim pengunjung melalui formulir kontak portofolio Anda akan otomatis muncul di sini dan disinkronkan ke WhatsApp & Google Sheets.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-slate-800 bg-slate-950/60 text-slate-400 font-semibold uppercase tracking-wider text-[11px]">
                            <th class="py-3.5 px-5">Waktu</th>
                            <th class="py-3.5 px-5">Pengirim</th>
                            <th class="py-3.5 px-5">Subjek</th>
                            <th class="py-3.5 px-5">Isi Pesan</th>
                            <th class="py-3.5 px-5 text-center">Sheets</th>
                            <th class="py-3.5 px-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">
                        @foreach($messages as $msg)
                            <tr class="hover:bg-slate-800/30 transition-colors">
                                <td class="py-4 px-5 whitespace-nowrap text-slate-400">
                                    <div class="font-medium text-slate-200">{{ $msg->created_at->format('d M Y') }}</div>
                                    <div class="text-[10px] text-slate-500">{{ $msg->created_at->format('H:i') }} ({{ $msg->created_at->diffForHumans() }})</div>
                                </td>
                                <td class="py-4 px-5 whitespace-nowrap">
                                    <div class="font-semibold text-white">{{ $msg->name }}</div>
                                    <a href="mailto:{{ $msg->email }}" class="text-[11px] text-blue-400 hover:underline flex items-center gap-1 mt-0.5">
                                        <i data-lucide="mail" class="w-3 h-3"></i>
                                        <span>{{ $msg->email }}</span>
                                    </a>
                                </td>
                                <td class="py-4 px-5 font-medium text-slate-300 whitespace-nowrap">
                                    {{ $msg->subject }}
                                </td>
                                <td class="py-4 px-5 text-slate-300 max-w-md">
                                    <div class="bg-slate-950/60 p-3 rounded-xl border border-slate-800/80 text-[11.5px] leading-relaxed whitespace-pre-wrap font-sans">
                                        {{ $msg->message }}
                                    </div>
                                </td>
                                <td class="py-4 px-5 text-center whitespace-nowrap">
                                    @if($msg->synced_to_sheets)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                                            <i data-lucide="check-circle" class="w-3 h-3"></i>
                                            Tersinkron
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/30">
                                            <i data-lucide="clock" class="w-3 h-3"></i>
                                            Lokal
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-5 text-center whitespace-nowrap">
                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan dari {{ $msg->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 transition-colors" title="Hapus Pesan">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
