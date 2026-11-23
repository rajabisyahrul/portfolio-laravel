@extends('layouts.admin')

@section('title', 'Kelola Sertifikat')
@section('page-title', 'Kelola Sertifikat & Lisensi')
@section('page-subtitle', 'Tambah, edit, unggah scan media, atau hapus kredensial sertifikasi kompetensi')

@section('content')
<div class="space-y-8">
    <!-- Header Action -->
    <div class="flex items-center justify-between">
        <h2 class="text-sm font-bold text-white flex items-center gap-2">
            <i data-lucide="award" class="w-4 h-4 text-emerald-400"></i>
            <span>Daftar Sertifikat Terdaftar ({{ $certificates->count() }})</span>
        </h2>
        <button onclick="openModal('addModal')" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold flex items-center gap-2 transition-all shadow-md shadow-blue-500/20">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Tambah Sertifikat Baru</span>
        </button>
    </div>

    <!-- Certificates Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($certificates as $cert)
            <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-xl flex flex-col justify-between">
                <div>
                    <!-- Image Preview Area -->
                    <div class="h-44 bg-slate-950 relative overflow-hidden group border-b border-slate-800">
                        @if($cert->image_path)
                            <img src="{{ asset($cert->image_path) }}" alt="{{ $cert->title }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-600">
                                <i data-lucide="image-off" class="w-8 h-8 mb-1"></i>
                                <span class="text-[11px]">Belum ada gambar scan</span>
                            </div>
                        @endif
                        <span class="absolute top-3 right-3 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-900/90 text-emerald-400 border border-emerald-500/30 backdrop-blur-md">
                            Urutan: #{{ $cert->order }}
                        </span>
                    </div>

                    <!-- Content Details -->
                    <div class="p-5 space-y-2">
                        <h3 class="text-sm font-bold text-white leading-snug">{{ $cert->title }}</h3>
                        <p class="text-xs text-blue-400 font-medium">{{ $cert->issuer }}</p>
                        
                        <div class="text-[11px] text-slate-400 space-y-1 pt-2 border-t border-slate-800">
                            @if($cert->credential_id)
                                <div class="flex items-center gap-1.5">
                                    <i data-lucide="hash" class="w-3.5 h-3.5 text-slate-500"></i>
                                    <span class="font-mono text-slate-300">{{ $cert->credential_id }}</span>
                                </div>
                            @endif
                            @if($cert->valid_until)
                                <div class="flex items-center gap-1.5">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-500"></i>
                                    <span>{{ $cert->valid_until }}</span>
                                </div>
                            @endif
                        </div>

                        @if($cert->description)
                            <p class="text-xs text-slate-400 pt-2 line-clamp-3 leading-relaxed">{{ $cert->description }}</p>
                        @endif
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="p-4 bg-slate-950/60 border-t border-slate-800/80 flex items-center justify-between">
                    <button onclick='editCert(@json($cert))' class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-medium flex items-center gap-1.5 transition-colors">
                        <i data-lucide="edit-2" class="w-3.5 h-3.5 text-blue-400"></i>
                        <span>Edit</span>
                    </button>

                    <form action="{{ route('admin.certificates.destroy', $cert->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sertifikat ini?')">
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
                <i data-lucide="award" class="w-12 h-12 text-slate-600 mx-auto mb-3"></i>
                <h3 class="text-sm font-semibold text-white">Belum Ada Sertifikat</h3>
                <p class="text-xs text-slate-400 mt-1">Tambahkan sertifikat kompetensi atau lisensi Anda untuk ditampilkan di portofolio.</p>
                <button onclick="openModal('addModal')" class="mt-4 px-4 py-2 rounded-xl bg-blue-600 text-white text-xs font-semibold">
                    Tambah Sekarang
                </button>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah Sertifikat -->
<div id="addModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-lg p-6 shadow-2xl overflow-y-auto max-h-[90vh]">
        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4 text-blue-400"></i>
                <span>Tambah Sertifikat Baru</span>
            </h3>
            <button onclick="closeModal('addModal')" class="text-slate-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Nama Sertifikasi / Kompetensi *</label>
                <input type="text" name="title" required placeholder="Contoh: Analis Program (Program Analyst)"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Lembaga / Penerbit *</label>
                <input type="text" name="issuer" required placeholder="Contoh: Badan Nasional Sertifikasi Profesi (BNSP)"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">No. Kredensial / Registrasi</label>
                    <input type="text" name="credential_id" placeholder="No: 62010 2512..."
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Masa Berlaku</label>
                    <input type="text" name="valid_until" placeholder="Contoh: September 2025"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div class="col-span-2">
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Unggah Scan Sertifikat (Gambar)</label>
                    <input type="file" name="image" accept="image/*"
                        class="block w-full text-xs text-slate-400 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white cursor-pointer">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Urutan</label>
                    <input type="number" name="order" value="1"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Keterangan / Deskripsi Kompetensi</label>
                <textarea name="description" rows="3" placeholder="Jelaskan ruang lingkup keahlian yang diuji pada sertifikat ini..."
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500 leading-relaxed"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-800">
                <button type="button" onclick="closeModal('addModal')" class="px-4 py-2 rounded-xl bg-slate-800 text-xs text-slate-300">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-xs font-semibold text-white">Simpan Sertifikat</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Sertifikat -->
<div id="editModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-lg p-6 shadow-2xl overflow-y-auto max-h-[90vh]">
        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4 text-blue-400"></i>
                <span>Edit Data Sertifikat</span>
            </h3>
            <button onclick="closeModal('editModal')" class="text-slate-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="editForm" method="POST" enctype="multipart/form-data" class="mt-5 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Nama Sertifikasi / Kompetensi *</label>
                <input type="text" name="title" id="edit_title" required
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Lembaga / Penerbit *</label>
                <input type="text" name="issuer" id="edit_issuer" required
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">No. Kredensial / Registrasi</label>
                    <input type="text" name="credential_id" id="edit_credential_id"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Masa Berlaku</label>
                    <input type="text" name="valid_until" id="edit_valid_until"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div class="col-span-2">
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Ganti Scan Sertifikat (Opsional)</label>
                    <input type="file" name="image" accept="image/*"
                        class="block w-full text-xs text-slate-400 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white cursor-pointer">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Urutan</label>
                    <input type="number" name="order" id="edit_order"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Keterangan / Deskripsi</label>
                <textarea name="description" id="edit_description" rows="3"
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 outline-none focus:border-blue-500 leading-relaxed"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-800">
                <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 rounded-xl bg-slate-800 text-xs text-slate-300">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-xs font-semibold text-white">Simpan Perubahan</button>
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

    function editCert(cert) {
        document.getElementById('edit_title').value = cert.title || '';
        document.getElementById('edit_issuer').value = cert.issuer || '';
        document.getElementById('edit_credential_id').value = cert.credential_id || '';
        document.getElementById('edit_valid_until').value = cert.valid_until || '';
        document.getElementById('edit_order').value = cert.order || 0;
        document.getElementById('edit_description').value = cert.description || '';
        
        document.getElementById('editForm').action = "/admin/certificates/" + cert.id;
        openModal('editModal');
    }
</script>
@endsection
