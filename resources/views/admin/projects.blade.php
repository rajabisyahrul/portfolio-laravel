@extends('layouts.admin')

@section('title', 'Kelola Portofolio')
@section('page-title', 'Kelola Proyek Portofolio')
@section('page-subtitle', 'Kelola karya proyek, sistem informasi, teknologi yang digunakan, serta tautan demo')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-sm font-bold text-white flex items-center gap-2">
            <i data-lucide="folder-kanban" class="w-4 h-4 text-purple-400"></i>
            <span>Daftar Proyek Unggulan ({{ $projects->count() }})</span>
        </h2>
        <button onclick="openModal('addProjectModal')" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold flex items-center gap-2 transition-all shadow-md shadow-blue-500/20">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Tambah Proyek Baru</span>
        </button>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($projects as $proj)
            <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-xl flex flex-col justify-between">
                <div>
                    <div class="h-40 bg-slate-950 relative overflow-hidden group border-b border-slate-800 flex items-center justify-center">
                        @if($proj->image_path)
                            <img src="{{ asset($proj->image_path) }}" alt="{{ $proj->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="text-center p-4">
                                <div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-400 flex items-center justify-center mx-auto mb-1.5">
                                    <i data-lucide="layout" class="w-5 h-5"></i>
                                </div>
                                <span class="text-[11px] text-slate-500">{{ $proj->category ?? 'Software Project' }}</span>
                            </div>
                        @endif
                        <span class="absolute top-3 right-3 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-900/90 text-purple-400 border border-purple-500/30 backdrop-blur-md">
                            #{{ $proj->order }}
                        </span>
                    </div>

                    <div class="p-5 space-y-2">
                        <span class="text-[10px] uppercase font-bold tracking-wider text-purple-400">{{ $proj->category ?? 'Web Application' }}</span>
                        <h3 class="text-sm font-bold text-white leading-snug">{{ $proj->title }}</h3>
                        
                        @if($proj->tech_stack)
                            <div class="flex flex-wrap gap-1 pt-1">
                                @foreach(explode(',', $proj->tech_stack) as $tech)
                                    <span class="text-[10px] bg-slate-800 text-slate-300 px-2 py-0.5 rounded">{{ trim($tech) }}</span>
                                @endforeach
                            </div>
                        @endif

                        <p class="text-xs text-slate-400 pt-2 line-clamp-3 leading-relaxed">{{ $proj->description }}</p>
                    </div>
                </div>

                <div class="p-4 bg-slate-950/60 border-t border-slate-800/80 flex items-center justify-between">
                    <button onclick='editProject(@json($proj))' class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-medium flex items-center gap-1.5 transition-colors">
                        <i data-lucide="edit-2" class="w-3.5 h-3.5 text-blue-400"></i>
                        <span>Edit</span>
                    </button>

                    <form action="{{ route('admin.projects.destroy', $proj->id) }}" method="POST" onsubmit="return confirm('Hapus proyek ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 text-xs font-medium flex items-center gap-1.5 transition-colors border border-rose-500/20">
                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            <span>Hapus</span>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-slate-900 border border-slate-800 rounded-3xl">
                <i data-lucide="folder-plus" class="w-12 h-12 text-slate-600 mx-auto mb-3"></i>
                <h3 class="text-sm font-semibold text-white">Belum Ada Proyek</h3>
                <p class="text-xs text-slate-400 mt-1">Tambahkan proyek sistem informasi atau aplikasi web yang pernah Anda kembangkan.</p>
                <button onclick="openModal('addProjectModal')" class="mt-4 px-4 py-2 rounded-xl bg-blue-600 text-white text-xs font-semibold">
                    Tambah Sekarang
                </button>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah Proyek -->
<div id="addProjectModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-lg p-6 shadow-2xl overflow-y-auto max-h-[90vh]">
        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4 text-purple-400"></i>
                <span>Tambah Proyek Baru</span>
            </h3>
            <button onclick="closeModal('addProjectModal')" class="text-slate-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Judul Proyek *</label>
                <input type="text" name="title" required placeholder="Contoh: Sistem Informasi Rekrutmen PT Sucofindo"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Kategori</label>
                    <input type="text" name="category" placeholder="Web Application, ERP, UI/UX"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Urutan Tampil</label>
                    <input type="number" name="order" value="1"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Tech Stack (Pisahkan dengan koma)</label>
                <input type="text" name="tech_stack" placeholder="Laravel, MySQL, Tailwind CSS, JavaScript"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Tautan Demo / Live Web</label>
                    <input type="url" name="demo_url" placeholder="https://..."
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Tautan Repository GitHub</label>
                    <input type="url" name="github_url" placeholder="https://github.com/..."
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Unggah Gambar / Thumbnail Proyek</label>
                <input type="file" name="image" accept="image/*"
                    class="block w-full text-xs text-slate-400 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-purple-600 file:text-white cursor-pointer">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Deskripsi Proyek</label>
                <textarea name="description" rows="3" placeholder="Jelaskan peran, fitur sistem, dan dampak dari proyek ini..."
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500 leading-relaxed"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-800">
                <button type="button" onclick="closeModal('addProjectModal')" class="px-4 py-2 rounded-xl bg-slate-800 text-xs text-slate-300">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-purple-600 hover:bg-purple-500 text-xs font-semibold text-white">Simpan Proyek</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Proyek -->
<div id="editProjectModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-lg p-6 shadow-2xl overflow-y-auto max-h-[90vh]">
        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4 text-purple-400"></i>
                <span>Edit Data Proyek</span>
            </h3>
            <button onclick="closeModal('editProjectModal')" class="text-slate-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="editProjForm" method="POST" enctype="multipart/form-data" class="mt-5 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Judul Proyek *</label>
                <input type="text" name="title" id="edit_proj_title" required
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Kategori</label>
                    <input type="text" name="category" id="edit_proj_category"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Urutan</label>
                    <input type="number" name="order" id="edit_proj_order"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Tech Stack</label>
                <input type="text" name="tech_stack" id="edit_proj_tech_stack"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Tautan Demo</label>
                    <input type="url" name="demo_url" id="edit_proj_demo_url"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Tautan GitHub</label>
                    <input type="url" name="github_url" id="edit_proj_github_url"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Ganti Thumbnail (Opsional)</label>
                <input type="file" name="image" accept="image/*"
                    class="block w-full text-xs text-slate-400 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-purple-600 file:text-white cursor-pointer">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Deskripsi Proyek</label>
                <textarea name="description" id="edit_proj_description" rows="3"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500 leading-relaxed"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-800">
                <button type="button" onclick="closeModal('editProjectModal')" class="px-4 py-2 rounded-xl bg-slate-800 text-xs text-slate-300">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-purple-600 hover:bg-purple-500 text-xs font-semibold text-white">Simpan Perubahan</button>
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

    function editProject(proj) {
        document.getElementById('edit_proj_title').value = proj.title || '';
        document.getElementById('edit_proj_category').value = proj.category || '';
        document.getElementById('edit_proj_tech_stack').value = proj.tech_stack || '';
        document.getElementById('edit_proj_demo_url').value = proj.demo_url || '';
        document.getElementById('edit_proj_github_url').value = proj.github_url || '';
        document.getElementById('edit_proj_order').value = proj.order || 0;
        document.getElementById('edit_proj_description').value = proj.description || '';
        
        document.getElementById('editProjForm').action = "/admin/projects/" + proj.id;
        openModal('editProjectModal');
    }
</script>
@endsection
