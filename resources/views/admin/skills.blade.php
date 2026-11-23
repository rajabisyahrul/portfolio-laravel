@extends('layouts.admin')

@section('title', 'Kelola Keahlian')
@section('page-title', 'Kelola Keahlian & Tools')
@section('page-subtitle', 'Kelola daftar kemampuan teknis, perangkat lunak, dan keahlian sistem informasi')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-sm font-bold text-white flex items-center gap-2">
            <i data-lucide="sparkles" class="w-4 h-4 text-pink-400"></i>
            <span>Daftar Keahlian ({{ $skills->count() }})</span>
        </h2>
        <button onclick="openModal('addSkillModal')" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold flex items-center gap-2 transition-all shadow-md shadow-blue-500/20">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Tambah Keahlian Baru</span>
        </button>
    </div>

    <!-- Grouped Skills by Category -->
    @php
        $groupedSkills = $skills->groupBy('category');
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($groupedSkills as $category => $items)
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-5 shadow-xl flex flex-col justify-between">
                <div>
                    <div class="pb-3 mb-4 border-b border-slate-800 flex items-center justify-between">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-blue-400">{{ $category }}</h3>
                        <span class="text-[10px] text-slate-500">{{ $items->count() }} skill</span>
                    </div>

                    <div class="space-y-3">
                        @foreach($items as $s)
                            <div class="p-3 rounded-2xl bg-slate-950/70 border border-slate-800/80 space-y-1.5">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-semibold text-white">{{ $s->name }}</span>
                                    <span class="font-mono text-emerald-400 text-[11px] font-bold">{{ $s->level_percent }}%</span>
                                </div>
                                
                                <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-full rounded-full" style="width: {{ $s->level_percent }}%"></div>
                                </div>

                                <div class="flex items-center justify-between pt-1 text-[10px]">
                                    <span class="text-slate-500">Urutan: #{{ $s->order }}</span>
                                    <div class="flex items-center gap-2">
                                        <button onclick='editSkill(@json($s))' class="text-blue-400 hover:underline">Edit</button>
                                        <span class="text-slate-600">•</span>
                                        <form action="{{ route('admin.skills.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus keahlian {{ $s->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-400 hover:underline">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-slate-900 border border-slate-800 rounded-3xl">
                <i data-lucide="sparkles" class="w-12 h-12 text-slate-600 mx-auto mb-3"></i>
                <h3 class="text-sm font-semibold text-white">Belum Ada Keahlian</h3>
                <p class="text-xs text-slate-400 mt-1">Tambahkan keahlian teknis Anda.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah Skill -->
<div id="addSkillModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-md p-6 shadow-2xl">
        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4 text-pink-400"></i>
                <span>Tambah Keahlian Baru</span>
            </h3>
            <button onclick="closeModal('addSkillModal')" class="text-slate-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="{{ route('admin.skills.store') }}" method="POST" class="mt-5 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Nama Keahlian / Tool *</label>
                <input type="text" name="name" required placeholder="Contoh: Laravel Framework"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Kategori *</label>
                <select name="category" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                    <option value="Web & Database">Web & Database</option>
                    <option value="Technical & Hardware">Technical & Hardware</option>
                    <option value="Design & Tools">Design & Tools</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Tingkat Penguasaan (%) *</label>
                    <input type="number" name="level_percent" min="10" max="100" value="85" required
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Urutan</label>
                    <input type="number" name="order" value="1"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-800">
                <button type="button" onclick="closeModal('addSkillModal')" class="px-4 py-2 rounded-xl bg-slate-800 text-xs text-slate-300">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-pink-600 hover:bg-pink-500 text-xs font-semibold text-white">Simpan Keahlian</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Skill -->
<div id="editSkillModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-md p-6 shadow-2xl">
        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4 text-pink-400"></i>
                <span>Edit Data Keahlian</span>
            </h3>
            <button onclick="closeModal('editSkillModal')" class="text-slate-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="editSkillForm" method="POST" class="mt-5 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Nama Keahlian / Tool *</label>
                <input type="text" name="name" id="edit_skill_name" required
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Kategori *</label>
                <select name="category" id="edit_skill_category" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                    <option value="Web & Database">Web & Database</option>
                    <option value="Technical & Hardware">Technical & Hardware</option>
                    <option value="Design & Tools">Design & Tools</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Tingkat Penguasaan (%) *</label>
                    <input type="number" name="level_percent" id="edit_skill_percent" min="10" max="100" required
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Urutan</label>
                    <input type="number" name="order" id="edit_skill_order"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-800">
                <button type="button" onclick="closeModal('editSkillModal')" class="px-4 py-2 rounded-xl bg-slate-800 text-xs text-slate-300">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-pink-600 hover:bg-pink-500 text-xs font-semibold text-white">Simpan Perubahan</button>
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

    function editSkill(skill) {
        document.getElementById('edit_skill_name').value = skill.name || '';
        document.getElementById('edit_skill_category').value = skill.category || 'Web & Database';
        document.getElementById('edit_skill_percent').value = skill.level_percent || 80;
        document.getElementById('edit_skill_order').value = skill.order || 0;
        
        document.getElementById('editSkillForm').action = "/admin/skills/" + skill.id;
        openModal('editSkillModal');
    }
</script>
@endsection
