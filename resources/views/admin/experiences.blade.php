@extends('layouts.admin')

@section('title', 'Kelola Pengalaman')
@section('page-title', 'Kelola Pengalaman Kerja')
@section('page-subtitle', 'Kelola riwayat karir, posisi, instansi/perusahaan, dan uraian tugas operasional')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-sm font-bold text-white flex items-center gap-2">
            <i data-lucide="briefcase" class="w-4 h-4 text-amber-400"></i>
            <span>Daftar Pengalaman Kerja ({{ $experiences->count() }})</span>
        </h2>
        <button onclick="openModal('addExpModal')" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold flex items-center gap-2 transition-all shadow-md shadow-blue-500/20">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Tambah Pengalaman Baru</span>
        </button>
    </div>

    <div class="space-y-4">
        @forelse($experiences as $exp)
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-xl flex flex-col md:flex-row items-start justify-between gap-6">
                <div class="space-y-2 flex-1">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                            #{{ $exp->order }}
                        </span>
                        <h3 class="text-base font-bold text-white">{{ $exp->role }}</h3>
                        <span class="text-slate-500 text-xs">•</span>
                        <span class="text-xs font-semibold text-blue-400">{{ $exp->company }}</span>
                    </div>

                    <div class="flex items-center gap-4 text-xs text-slate-400">
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-500"></i>
                            <span>{{ $exp->period }}</span>
                        </span>
                        @if($exp->location)
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-500"></i>
                                <span>{{ $exp->location }}</span>
                            </span>
                        @endif
                    </div>

                    <div class="pt-2 text-xs text-slate-300 leading-relaxed whitespace-pre-line bg-slate-950/60 p-4 rounded-2xl border border-slate-800/80">
                        {{ $exp->description }}
                    </div>
                </div>

                <div class="flex items-center gap-2 flex-shrink-0">
                    <button onclick='editExp(@json($exp))' class="px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-medium flex items-center gap-1.5 transition-colors">
                        <i data-lucide="edit-2" class="w-3.5 h-3.5 text-blue-400"></i>
                        <span>Edit</span>
                    </button>

                    <form action="{{ route('admin.experiences.destroy', $exp->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat pengalaman ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3.5 py-2 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 text-xs font-medium flex items-center gap-1.5 transition-colors border border-rose-500/20">
                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            <span>Hapus</span>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="py-16 text-center bg-slate-900 border border-slate-800 rounded-3xl">
                <i data-lucide="briefcase" class="w-12 h-12 text-slate-600 mx-auto mb-3"></i>
                <h3 class="text-sm font-semibold text-white">Belum Ada Pengalaman Kerja</h3>
                <p class="text-xs text-slate-400 mt-1">Tambahkan pengalaman kerja atau magang Anda.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah Pengalaman -->
<div id="addExpModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-lg p-6 shadow-2xl overflow-y-auto max-h-[90vh]">
        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4 text-amber-400"></i>
                <span>Tambah Pengalaman Baru</span>
            </h3>
            <button onclick="closeModal('addExpModal')" class="text-slate-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="{{ route('admin.experiences.store') }}" method="POST" class="mt-5 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Nama Perusahaan / Instansi *</label>
                <input type="text" name="company" required placeholder="Contoh: PT SAP TBK"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Posisi / Jabatan *</label>
                <input type="text" name="role" required placeholder="Contoh: Staf Administrasi & Data Operasional"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Periode Waktu *</label>
                    <input type="text" name="period" required placeholder="Contoh: Nov 2022 - Des 2023"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Lokasi</label>
                    <input type="text" name="location" placeholder="Jakarta Utara"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Urutan Tampil</label>
                <input type="number" name="order" value="1"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Uraian Tanggung Jawab & Capaian</label>
                <textarea name="description" rows="4" placeholder="• Menginput data...&#10;• Mengembangkan lembar kontrol..."
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500 leading-relaxed"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-800">
                <button type="button" onclick="closeModal('addExpModal')" class="px-4 py-2 rounded-xl bg-slate-800 text-xs text-slate-300">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-amber-600 hover:bg-amber-500 text-xs font-semibold text-white">Simpan Pengalaman</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Pengalaman -->
<div id="editExpModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-lg p-6 shadow-2xl overflow-y-auto max-h-[90vh]">
        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4 text-amber-400"></i>
                <span>Edit Riwayat Pengalaman</span>
            </h3>
            <button onclick="closeModal('editExpModal')" class="text-slate-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="editExpForm" method="POST" class="mt-5 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Nama Perusahaan / Instansi *</label>
                <input type="text" name="company" id="edit_exp_company" required
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Posisi / Jabatan *</label>
                <input type="text" name="role" id="edit_exp_role" required
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Periode Waktu *</label>
                    <input type="text" name="period" id="edit_exp_period" required
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Lokasi</label>
                    <input type="text" name="location" id="edit_exp_location"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Urutan Tampil</label>
                <input type="number" name="order" id="edit_exp_order"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Uraian Tanggung Jawab & Capaian</label>
                <textarea name="description" id="edit_exp_description" rows="4"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500 leading-relaxed"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-800">
                <button type="button" onclick="closeModal('editExpModal')" class="px-4 py-2 rounded-xl bg-slate-800 text-xs text-slate-300">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-amber-600 hover:bg-amber-500 text-xs font-semibold text-white">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function editExp(exp) {
        document.getElementById('edit_exp_company').value = exp.company || '';
        document.getElementById('edit_exp_role').value = exp.role || '';
        document.getElementById('edit_exp_period').value = exp.period || '';
        document.getElementById('edit_exp_location').value = exp.location || '';
        document.getElementById('edit_exp_order').value = exp.order || 0;
        document.getElementById('edit_exp_description').value = exp.description || '';
        
        document.getElementById('editExpForm').action = "/admin/experiences/" + exp.id;
        openModal('editExpModal');
    }
</script>
@endsection
