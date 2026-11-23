@extends('layouts.admin')

@section('title', 'Kelola Pendidikan')
@section('page-title', 'Kelola Riwayat Pendidikan')
@section('page-subtitle', 'Kelola data jenjang perkuliahan, universitas, program studi, IPK, dan fokus bidang akademik')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-sm font-bold text-white flex items-center gap-2">
            <i data-lucide="graduation-cap" class="w-4 h-4 text-cyan-400"></i>
            <span>Daftar Riwayat Pendidikan ({{ $educations->count() }})</span>
        </h2>
        <button onclick="openModal('addEduModal')" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold flex items-center gap-2 transition-all shadow-md shadow-blue-500/20">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Tambah Pendidikan Baru</span>
        </button>
    </div>

    <div class="space-y-4">
        @forelse($educations as $edu)
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-xl flex flex-col md:flex-row items-start justify-between gap-6">
                <div class="space-y-2 flex-1">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">
                            #{{ $edu->order }}
                        </span>
                        <h3 class="text-base font-bold text-white">{{ $edu->institution }}</h3>
                        <span class="text-slate-500 text-xs">•</span>
                        <span class="text-xs font-semibold text-blue-400">{{ $edu->degree }}</span>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 text-xs text-slate-400">
                        <span class="font-medium text-slate-300">{{ $edu->major }}</span>
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-500"></i>
                            <span>{{ $edu->period }}</span>
                        </span>
                        @if($edu->gpa)
                            <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 font-mono text-[11px] font-semibold">
                                {{ $edu->gpa }}
                            </span>
                        @endif
                    </div>

                    @if($edu->description)
                        <div class="pt-2 text-xs text-slate-300 leading-relaxed bg-slate-950/60 p-4 rounded-2xl border border-slate-800/80">
                            {{ $edu->description }}
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-2 flex-shrink-0">
                    <button onclick='editEdu(@json($edu))' class="px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-medium flex items-center gap-1.5 transition-colors">
                        <i data-lucide="edit-2" class="w-3.5 h-3.5 text-blue-400"></i>
                        <span>Edit</span>
                    </button>

                    <form action="{{ route('admin.educations.destroy', $edu->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat pendidikan ini?')">
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
                <i data-lucide="graduation-cap" class="w-12 h-12 text-slate-600 mx-auto mb-3"></i>
                <h3 class="text-sm font-semibold text-white">Belum Ada Riwayat Pendidikan</h3>
                <p class="text-xs text-slate-400 mt-1">Tambahkan riwayat kuliah atau sekolah Anda.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah Pendidikan -->
<div id="addEduModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-lg p-6 shadow-2xl overflow-y-auto max-h-[90vh]">
        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4 text-cyan-400"></i>
                <span>Tambah Pendidikan Baru</span>
            </h3>
            <button onclick="closeModal('addEduModal')" class="text-slate-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="{{ route('admin.educations.store') }}" method="POST" class="mt-5 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Nama Universitas / Institusi *</label>
                <input type="text" name="institution" required placeholder="Contoh: Universitas Nusa Mandiri"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Jenjang / Gelar *</label>
                    <input type="text" name="degree" required placeholder="Contoh: Sarjana Komputer (S.Kom)"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Jurusan / Program Studi *</label>
                    <input type="text" name="major" required placeholder="Contoh: Sistem Informasi"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div class="col-span-2">
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Periode Tahun *</label>
                    <input type="text" name="period" required placeholder="Contoh: 2022 - 2024"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">IPK (GPA)</label>
                    <input type="text" name="gpa" placeholder="IPK: 3.65 / 4.00"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Urutan Tampil</label>
                <input type="number" name="order" value="1"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Fokus Bidang / Keterangan Studi</label>
                <textarea name="description" rows="3" placeholder="Fokus pada Analisis Sistem Informasi, Basis Data, Rekayasa Perangkat Lunak..."
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500 leading-relaxed"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-800">
                <button type="button" onclick="closeModal('addEduModal')" class="px-4 py-2 rounded-xl bg-slate-800 text-xs text-slate-300">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-cyan-600 hover:bg-cyan-500 text-xs font-semibold text-white">Simpan Pendidikan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Pendidikan -->
<div id="editEduModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-lg p-6 shadow-2xl overflow-y-auto max-h-[90vh]">
        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4 text-cyan-400"></i>
                <span>Edit Data Pendidikan</span>
            </h3>
            <button onclick="closeModal('editEduModal')" class="text-slate-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="editEduForm" method="POST" class="mt-5 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Nama Universitas / Institusi *</label>
                <input type="text" name="institution" id="edit_edu_institution" required
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Jenjang / Gelar *</label>
                    <input type="text" name="degree" id="edit_edu_degree" required
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Jurusan / Program Studi *</label>
                    <input type="text" name="major" id="edit_edu_major" required
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div class="col-span-2">
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Periode Tahun *</label>
                    <input type="text" name="period" id="edit_edu_period" required
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">IPK (GPA)</label>
                    <input type="text" name="gpa" id="edit_edu_gpa"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Urutan Tampil</label>
                <input type="number" name="order" id="edit_edu_order"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Fokus Bidang / Keterangan Studi</label>
                <textarea name="description" id="edit_edu_description" rows="3"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500 leading-relaxed"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-800">
                <button type="button" onclick="closeModal('editEduModal')" class="px-4 py-2 rounded-xl bg-slate-800 text-xs text-slate-300">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-cyan-600 hover:bg-cyan-500 text-xs font-semibold text-white">Simpan Perubahan</button>
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

    function editEdu(edu) {
        document.getElementById('edit_edu_institution').value = edu.institution || '';
        document.getElementById('edit_edu_degree').value = edu.degree || '';
        document.getElementById('edit_edu_major').value = edu.major || '';
        document.getElementById('edit_edu_period').value = edu.period || '';
        document.getElementById('edit_edu_gpa').value = edu.gpa || '';
        document.getElementById('edit_edu_order').value = edu.order || 0;
        document.getElementById('edit_edu_description').value = edu.description || '';
        
        document.getElementById('editEduForm').action = "/admin/educations/" + edu.id;
        openModal('editEduModal');
    }
</script>
@endsection
