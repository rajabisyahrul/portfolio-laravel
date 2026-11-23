@extends('layouts.admin')

@section('title', 'Kelola Profil & Teks')
@section('page-title', 'Kelola Profil & Teks Portofolio')
@section('page-subtitle', 'Ubah data diri, ringkasan bio, teks tentang saya, informasi kontak, dan foto profil')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Foto Profil Card -->
        <div class="p-6 rounded-3xl bg-slate-900 border border-slate-800 shadow-xl">
            <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                <i data-lucide="image" class="w-4 h-4 text-blue-400"></i>
                <span>Foto Profil Utama</span>
            </h3>

            <div class="flex flex-col sm:flex-row items-center gap-6">
                <div class="w-24 h-24 rounded-full p-1 bg-gradient-to-tr from-blue-500 to-indigo-600 shadow-xl flex-shrink-0">
                    <img id="avatarPreview" src="{{ asset($profile->avatar_path ?? 'foto-syahrul.jpg') }}" 
                        alt="Foto Profil" 
                        class="w-full h-full object-cover object-top rounded-full bg-slate-800">
                </div>

                <div class="flex-1 w-full text-center sm:text-left">
                    <label class="block text-xs font-semibold text-slate-300 mb-1">
                        Unggah Foto Profil Baru
                    </label>
                    <input type="file" name="avatar" id="avatarInput" accept="image/*"
                        class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500 cursor-pointer">
                    <p class="text-[11px] text-slate-500 mt-1.5">Mendukung format JPG, PNG, WEBP. Maksimal 5 MB.</p>
                </div>
            </div>
        </div>

        <!-- Data Pribadi & Judul -->
        <div class="p-6 rounded-3xl bg-slate-900 border border-slate-800 shadow-xl space-y-4">
            <h3 class="text-sm font-bold text-white mb-2 flex items-center gap-2">
                <i data-lucide="user" class="w-4 h-4 text-blue-400"></i>
                <span>Informasi Diri & Jabatan</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Nama Lengkap
                    </label>
                    <input type="text" name="name" value="{{ old('name', $profile->name) }}" required
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-950/70 border border-slate-700/80 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 text-xs outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Gelar Akademik
                    </label>
                    <input type="text" name="degree" value="{{ old('degree', $profile->degree) }}" placeholder="S.Kom"
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-950/70 border border-slate-700/80 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 text-xs outline-none transition-all">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                    Judul Pekerjaan / Keahlian Utama (Headline)
                </label>
                <input type="text" name="title" value="{{ old('title', $profile->title) }}" required
                    class="w-full px-4 py-2.5 rounded-xl bg-slate-950/70 border border-slate-700/80 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 text-xs outline-none transition-all">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                    Teks Subtitle Hero (Halaman Utama)
                </label>
                <textarea name="hero_subtitle" rows="3"
                    class="w-full px-4 py-2.5 rounded-xl bg-slate-950/70 border border-slate-700/80 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 text-xs outline-none transition-all leading-relaxed">{{ old('hero_subtitle', $profile->hero_subtitle) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                    Teks Ringkasan Profil (Bagian Tentang Saya / About)
                </label>
                <textarea name="about_summary" rows="5"
                    class="w-full px-4 py-2.5 rounded-xl bg-slate-950/70 border border-slate-700/80 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 text-xs outline-none transition-all leading-relaxed">{{ old('about_summary', $profile->about_summary) }}</textarea>
            </div>
        </div>

        <!-- Kontak & Tautan -->
        <div class="p-6 rounded-3xl bg-slate-900 border border-slate-800 shadow-xl space-y-4">
            <h3 class="text-sm font-bold text-white mb-2 flex items-center gap-2">
                <i data-lucide="phone-call" class="w-4 h-4 text-emerald-400"></i>
                <span>Kontak & Media Sosial</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Alamat Email
                    </label>
                    <input type="email" name="email" value="{{ old('email', $profile->email) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-950/70 border border-slate-700/80 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 text-xs outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Nomor Telepon / WhatsApp
                    </label>
                    <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-950/70 border border-slate-700/80 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 text-xs outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Tautan Chat WhatsApp (wa.me)
                    </label>
                    <input type="text" name="wa_link" value="{{ old('wa_link', $profile->wa_link) }}" placeholder="https://wa.me/6281211905361"
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-950/70 border border-slate-700/80 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 text-xs outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Lokasi Domisili
                    </label>
                    <input type="text" name="location" value="{{ old('location', $profile->location) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-950/70 border border-slate-700/80 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 text-xs outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        URL Profil GitHub
                    </label>
                    <input type="url" name="github_url" value="{{ old('github_url', $profile->github_url) }}" placeholder="https://github.com/..."
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-950/70 border border-slate-700/80 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 text-xs outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        URL Profil LinkedIn
                    </label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $profile->linkedin_url) }}" placeholder="https://linkedin.com/in/..."
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-950/70 border border-slate-700/80 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 text-xs outline-none transition-all">
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-medium transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white text-xs font-semibold transition-all shadow-lg shadow-blue-500/25 flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                <span>Simpan Perubahan Profil</span>
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Preview gambar sebelum upload
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');

    if (avatarInput && avatarPreview) {
        avatarInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
