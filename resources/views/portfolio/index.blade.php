@extends('layouts.app')

@section('title', $profile['name'] . ' | Web Developer & Information Systems')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="min-h-[88vh] pt-28 sm:pt-36 pb-16 flex items-center relative overflow-hidden">
        <!-- Glow background accents -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -right-32 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Bio Column -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold tracking-wide uppercase">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Terbuka untuk Peluang Kerja & Kolaborasi
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                        Halo, Saya <br class="hidden sm:inline">
                        <span class="bg-gradient-to-r from-blue-400 via-indigo-300 to-purple-400 bg-clip-text text-transparent">
                            {{ $profile['name'] }}
                        </span>
                    </h1>

                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 text-slate-300 text-lg font-medium">
                        <span class="text-blue-400 font-semibold">S1 Sistem Informasi</span>
                        <span class="text-slate-600">•</span>
                        <span>Web Development</span>
                        <span class="text-slate-600">•</span>
                        <span>Laravel & UI/UX</span>
                    </div>

                    <p class="text-slate-400 text-base sm:text-lg max-w-2xl leading-relaxed mx-auto lg:mx-0">
                        {{ $profile['summary'] }}
                    </p>

                    <!-- Location & Contact Info Badges -->
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 text-xs text-slate-400 pt-1">
                        <span class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-800/80 border border-slate-700/60">
                            <i data-lucide="map-pin" class="w-4 h-4 text-emerald-400"></i>
                            {{ $profile['location'] }}
                        </span>
                        <a href="mailto:{{ $profile['email'] }}" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-800/80 border border-slate-700/60 hover:text-blue-400 hover:border-blue-500/40 transition-colors">
                            <i data-lucide="mail" class="w-4 h-4 text-blue-400"></i>
                            {{ $profile['email'] }}
                        </a>
                        <a href="{{ $profile['wa_link'] }}" target="_blank" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-800/80 border border-slate-700/60 hover:text-emerald-400 hover:border-emerald-500/40 transition-colors">
                            <i data-lucide="phone" class="w-4 h-4 text-emerald-400"></i>
                            {{ $profile['phone'] }}
                        </a>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start pt-2">
                        <a href="#contact" class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold text-sm transition-all shadow-lg shadow-blue-500/30 flex items-center gap-2 hover:scale-105 active:scale-95">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                            Kirim Pesan
                        </a>
                        <a href="#projects" class="px-6 py-3.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 font-semibold text-sm transition-all flex items-center gap-2 hover:scale-105 active:scale-95">
                            <i data-lucide="folder-kanban" class="w-4 h-4 text-blue-400"></i>
                            Lihat Karya & Proyek
                        </a>
                    </div>
                </div>

                <!-- Right Profile Photo Card -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative w-72 h-80 sm:w-80 sm:h-96 group">
                        <div class="absolute inset-0 bg-gradient-to-tr from-blue-600 via-indigo-600 to-purple-600 rounded-3xl rotate-6 blur-lg opacity-40 group-hover:opacity-70 transition-all duration-500"></div>
                        <div class="relative w-full h-full rounded-3xl overflow-hidden bg-slate-800 border-2 border-slate-700 shadow-2xl flex flex-col items-center justify-center p-6 text-center">
                            
                            <!-- Avatar / Foto Profil -->
                            <div class="w-36 h-36 sm:w-44 sm:h-44 rounded-2xl overflow-hidden bg-gradient-to-br from-red-700 to-rose-900 border-2 border-red-500/50 shadow-xl flex items-center justify-center relative mb-4 group-hover:scale-105 transition-transform">
                                <img src="{{ asset($profile['avatar_path'] ?? 'foto-syahrul.jpg') }}" alt="{{ $profile['name'] }}" 
                                    class="w-full h-full object-cover object-top"
                                    onerror="this.style.display='none'; document.getElementById('photo-fallback').classList.remove('hidden');">
                                <div id="photo-fallback" class="hidden flex flex-col items-center justify-center text-white">
                                    <span class="text-4xl font-extrabold tracking-wider">MSR</span>
                                    <span class="text-[10px] text-red-200 mt-1 uppercase tracking-widest">{{ $profile['degree'] }}</span>
                                </div>
                            </div>

                            <h3 class="text-lg font-bold text-white">{{ $profile['name'] }}</h3>
                            <p class="text-xs text-blue-400 font-medium">Bachelor of Information Systems</p>
                            
                            <div class="mt-4 flex items-center gap-2 text-xs text-slate-400 bg-slate-900/60 px-3 py-1.5 rounded-full border border-slate-700/60">
                                <i data-lucide="award" class="w-3.5 h-3.5 text-amber-400"></i>
                                <span>Certified Program Analyst</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- About Me Section -->
    <section id="about" class="py-20 bg-slate-900/60 border-t border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-semibold text-blue-400 uppercase tracking-widest mb-2">Tentang Saya</h2>
                <h3 class="text-3xl font-extrabold text-white">Profil & Latar Belakang</h3>
                <div class="w-16 h-1 bg-blue-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Info Card 1 -->
                <div class="p-6 rounded-2xl bg-slate-800/50 border border-slate-700/60 hover:border-blue-500/40 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <i data-lucide="code-2" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-2">Web Development & Laravel</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Menguasai PHP Laravel, HTML, CSS, MySQL, serta perancangan antarmuka visual (Figma & Adobe Photoshop CS6). Terbiasa menyusun alur bisnis (*flowchart*) dan membangun aplikasi web MVC terstruktur.
                    </p>
                </div>

                <!-- Info Card 2 -->
                <div class="p-6 rounded-2xl bg-slate-800/50 border border-slate-700/60 hover:border-indigo-500/40 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <i data-lucide="database" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-2">Manajemen & Verifikasi Data</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Pengalaman teruji mengelola & menganalisis lebih dari 5.000 data kuesioner BPS, 3.000+ dokumen Sucofindo, dan operasional logistik SAP TBK menggunakan database relasional & Google Sheets.
                    </p>
                </div>

                <!-- Info Card 3 -->
                <div class="p-6 rounded-2xl bg-slate-800/50 border border-slate-700/60 hover:border-purple-500/40 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-400 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <i data-lucide="check-check" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-2">Detail-Oriented & Analitis</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Memiliki sertifikasi resmi *Program Analyst* dan *Programmer*, skor TOEFL ITP 517, berorientasi pada ketelitian detail, manajemen waktu prima, dan pemecahan masalah secara terstruktur.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Work Experience Section -->
    <section id="experience" class="py-20 border-t border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-semibold text-blue-400 uppercase tracking-widest mb-2">Pengalaman Kerja</h2>
                <h3 class="text-3xl font-extrabold text-white">Riwayat Karier Profesional</h3>
                <div class="w-16 h-1 bg-blue-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="max-w-4xl mx-auto space-y-8 relative before:absolute before:inset-0 before:left-5 md:before:left-1/2 before:w-0.5 before:bg-slate-700/60">
                
                <!-- Experience 1: PT Satria Antaran Prima TBK -->
                <div class="relative flex flex-col md:flex-row items-start md:items-center group">
                    <div class="flex items-center md:w-1/2 md:justify-end md:pr-10 pl-12 md:pl-0">
                        <div class="p-6 rounded-2xl bg-slate-800/70 border border-slate-700/70 shadow-lg text-left md:text-right w-full hover:border-blue-500/40 transition-all">
                            <span class="text-xs font-semibold text-blue-400 bg-blue-500/10 px-3 py-1 rounded-full">Mei 2023 - Jun 2024</span>
                            <h4 class="text-lg font-bold text-white mt-2">Inbound Operasional Staff</h4>
                            <p class="text-sm font-semibold text-slate-300">PT Satria Antaran Prima TBK — Jakarta Timur</p>
                            <ul class="text-xs text-slate-400 mt-3 space-y-1.5 list-disc list-inside md:list-none">
                                <li>Validasi & verifikasi fisik barang masuk dengan dokumen pengiriman.</li>
                                <li>Transfer barang terverifikasi ke bagian EDP untuk pemrosesan resi pengiriman.</li>
                                <li>Pencatatan seluruh penerimaan barang ke dalam Sistem dan Google Sheets.</li>
                                <li>Sortir paket sesuai wilayah/TLC berdasarkan data AWB.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="absolute left-3.5 md:left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-blue-500 ring-4 ring-slate-900"></div>
                    <div class="hidden md:block md:w-1/2"></div>
                </div>

                <!-- Experience 2: Badan Pusat Statistik -->
                <div class="relative flex flex-col md:flex-row items-start md:items-center group">
                    <div class="hidden md:block md:w-1/2"></div>
                    <div class="absolute left-3.5 md:left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-indigo-500 ring-4 ring-slate-900"></div>
                    <div class="flex items-center md:w-1/2 pl-12 md:pl-10">
                        <div class="p-6 rounded-2xl bg-slate-800/70 border border-slate-700/70 shadow-lg text-left w-full hover:border-indigo-500/40 transition-all">
                            <span class="text-xs font-semibold text-indigo-400 bg-indigo-500/10 px-3 py-1 rounded-full">Des 2022 - Mar 2023</span>
                            <h4 class="text-lg font-bold text-white mt-2">Data Entry Regsosek</h4>
                            <p class="text-sm font-semibold text-slate-300">Badan Pusat Statistik (BPS) — Jakarta Pusat</p>
                            <ul class="text-xs text-slate-400 mt-3 space-y-1.5 list-disc list-inside">
                                <li>Analisis dan pengelolaan lebih dari 5.000 data kuesioner Regsosek komprehensif.</li>
                                <li>Input data kuesioner secara cepat, akurat, dan efisien ke sistem aplikasi.</li>
                                <li>Verifikasi dan validasi data untuk menjamin integritas dan akurasi informasi.</li>
                                <li>Penyusunan laporan data kuesioner berdasarkan wilayah kecamatan.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Experience 3: PT Sucofindo -->
                <div class="relative flex flex-col md:flex-row items-start md:items-center group">
                    <div class="flex items-center md:w-1/2 md:justify-end md:pr-10 pl-12 md:pl-0">
                        <div class="p-6 rounded-2xl bg-slate-800/70 border border-slate-700/70 shadow-lg text-left md:text-right w-full hover:border-purple-500/40 transition-all">
                            <span class="text-xs font-semibold text-purple-400 bg-purple-500/10 px-3 py-1 rounded-full">Des 2019 - Mar 2020</span>
                            <h4 class="text-lg font-bold text-white mt-2">Internship Administrator</h4>
                            <p class="text-sm font-semibold text-slate-300">PT Sucofindo — Jakarta Selatan</p>
                            <ul class="text-xs text-slate-400 mt-3 space-y-1.5 list-disc list-inside md:list-none">
                                <li>Mengelola dan mengarsipkan lebih dari 3.000 dokumen perusahaan.</li>
                                <li>Entry data dan verifikasi dokumen pegawai (NPP) melalui aplikasi internal.</li>
                                <li>Pembuatan laporan komprehensif data pegawai menggunakan Microsoft Excel.</li>
                                <li>Pembaruan data karyawan pada sistem ERP & merancang flowchart alur bisnis website.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="absolute left-3.5 md:left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-purple-500 ring-4 ring-slate-900"></div>
                    <div class="hidden md:block md:w-1/2"></div>
                </div>

            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section id="education" class="py-20 bg-slate-900/60 border-t border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-semibold text-blue-400 uppercase tracking-widest mb-2">Akademik</h2>
                <h3 class="text-3xl font-extrabold text-white">Pendidikan & Sertifikasi</h3>
                <div class="w-16 h-1 bg-blue-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- Education 1: Universitas Nusa Mandiri -->
                <div class="p-6 rounded-2xl bg-slate-800/60 border border-slate-700/70 hover:border-blue-500/40 transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold text-blue-400 bg-blue-500/10 px-3 py-1 rounded-full">Mar 2022 - Jan 2023</span>
                        <span class="text-sm font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-lg">IPK: 3.31 / 4.00</span>
                    </div>
                    <h4 class="text-xl font-bold text-white">S1 Sistem Informasi</h4>
                    <p class="text-sm font-semibold text-slate-300 mt-1">Universitas Nusa Mandiri — Jakarta</p>
                    
                    <div class="mt-4 p-3.5 rounded-xl bg-slate-900/80 border border-slate-700/60 text-xs space-y-2">
                        <p class="text-slate-200 font-medium">
                            <span class="text-blue-400 font-semibold">Skripsi:</span> "Perancangan Sistem Informasi Absensi Karyawan Berbasis Website"
                        </p>
                        <div class="flex flex-wrap gap-2 pt-1 border-t border-slate-700/50">
                            <span class="px-2.5 py-1 rounded-md bg-blue-500/10 text-blue-300 font-medium flex items-center gap-1">
                                <i data-lucide="award" class="w-3.5 h-3.5"></i> Sertifikasi Kompetensi Program Analyst
                            </span>
                            <span class="px-2.5 py-1 rounded-md bg-emerald-500/10 text-emerald-300 font-medium flex items-center gap-1">
                                <i data-lucide="check" class="w-3.5 h-3.5"></i> TOEFL ITP Score: 517
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Education 2: Universitas Bina Sarana Informatika -->
                <div class="p-6 rounded-2xl bg-slate-800/60 border border-slate-700/70 hover:border-indigo-500/40 transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold text-indigo-400 bg-indigo-500/10 px-3 py-1 rounded-full">Sep 2017 - Sep 2020</span>
                        <span class="text-sm font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-lg">IPK: 3.20 / 4.00</span>
                    </div>
                    <h4 class="text-xl font-bold text-white">D3 Sistem Informasi</h4>
                    <p class="text-sm font-semibold text-slate-300 mt-1">Universitas Bina Sarana Informatika — Jakarta</p>
                    
                    <div class="mt-4 p-3.5 rounded-xl bg-slate-900/80 border border-slate-700/60 text-xs space-y-2">
                        <p class="text-slate-200 font-medium">
                            <span class="text-indigo-400 font-semibold">Tugas Akhir:</span> "Pengembangan Sistem Informasi Rekrutmen Karyawan Berbasis Website Pada PT Sucofindo"
                        </p>
                        <div class="flex flex-wrap gap-2 pt-1 border-t border-slate-700/50">
                            <span class="px-2.5 py-1 rounded-md bg-indigo-500/10 text-indigo-300 font-medium flex items-center gap-1">
                                <i data-lucide="award" class="w-3.5 h-3.5"></i> Sertifikasi Kompetensi Programmer
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Certificates & Media Section -->
    <section id="certificates" class="py-20 border-t border-slate-800/80 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider mb-2">
                    <i data-lucide="award" class="w-3.5 h-3.5 text-amber-400"></i>
                    <span>Kredensial & Validasi Resmi</span>
                </div>
                <h3 class="text-3xl font-extrabold text-white">Sertifikasi & Lisensi</h3>
                <p class="text-slate-400 text-sm sm:text-base mt-2">
                    Bukti kompetensi resmi dalam bidang pemrograman, analisis sistem, dan kemampuan bahasa Inggris dengan media sertifikat terverifikasi.
                </p>
                <div class="w-16 h-1 bg-blue-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($certificates as $cert)
                    <div class="rounded-2xl bg-slate-800/50 border border-slate-700/70 overflow-hidden hover:border-blue-500/50 transition-all duration-300 group flex flex-col justify-between shadow-xl">
                        <div>
                            <div class="relative h-56 bg-slate-950 flex items-center justify-center overflow-hidden border-b border-slate-700/60 cursor-pointer group"
                                onclick="openLightbox('{{ asset($cert->image_path ?? 'sertifikat-program-analyst.jpg') }}', '{{ addslashes($cert->title) }}', '{{ addslashes($cert->issuer) }} • {{ addslashes($cert->credential_id ?? '') }}')">
                                
                                @if($cert->image_path)
                                    <img src="{{ asset($cert->image_path) }}" alt="{{ $cert->title }}"
                                        class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300"
                                        onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                @endif
                                
                                <div class="@if($cert->image_path) hidden @endif absolute inset-0 bg-gradient-to-br from-slate-900 via-blue-950/60 to-slate-900 p-5 flex flex-col justify-between border-4 border-double border-blue-500/20">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[9px] font-bold text-amber-400 border border-amber-500/40 bg-amber-500/10 px-2 py-0.5 rounded">KOMPETENSI RESMI</span>
                                        <i data-lucide="badge-check" class="w-5 h-5 text-blue-400"></i>
                                    </div>
                                    <div class="text-center my-auto">
                                        <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center border border-blue-400/30">
                                            <i data-lucide="award" class="w-5 h-5"></i>
                                        </div>
                                        <h5 class="text-sm font-bold text-white tracking-wide">{{ $cert->title }}</h5>
                                        <p class="text-[11px] text-slate-400 mt-0.5">{{ $cert->issuer }}</p>
                                    </div>
                                    <div class="flex items-center justify-between text-[10px] text-slate-500 border-t border-slate-800 pt-1.5">
                                        <span class="truncate max-w-[150px]">{{ $cert->credential_id ?? 'Kredensial Resmi' }}</span>
                                        <span class="text-emerald-400 flex items-center gap-0.5"><i data-lucide="check-circle" class="w-3 h-3"></i> Terverifikasi</span>
                                    </div>
                                </div>

                                <div class="absolute inset-0 bg-blue-950/60 backdrop-blur-[1px] opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2 text-white text-xs font-semibold">
                                    <i data-lucide="zoom-in" class="w-4 h-4"></i>
                                    <span>Perbesar Sertifikat</span>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-semibold text-blue-400 truncate max-w-[200px]">{{ $cert->issuer }}</span>
                                    @if($cert->credential_id)
                                        <span class="text-[11px] bg-blue-500/10 text-blue-300 px-2 py-0.5 rounded-full border border-blue-500/20 font-medium truncate max-w-[150px]">{{ $cert->credential_id }}</span>
                                    @endif
                                </div>
                                <h4 class="text-lg font-bold text-white mb-2">{{ $cert->title }}</h4>
                                @if($cert->description)
                                    <p class="text-xs text-slate-400 leading-relaxed mb-3 line-clamp-3">
                                        {{ $cert->description }}
                                    </p>
                                @endif
                                <div class="text-[11px] text-slate-400 border-t border-slate-700/50 pt-2 flex items-center justify-between">
                                    <span class="truncate max-w-[160px]">{{ $cert->credential_id ?? 'Kredensial Resmi' }}</span>
                                    <span class="text-emerald-400 font-medium">{{ $cert->valid_until ?? 'Terverifikasi' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 pt-0">
                            <button onclick="openLightbox('{{ asset($cert->image_path ?? 'sertifikat-program-analyst.jpg') }}', '{{ addslashes($cert->title) }}', '{{ addslashes($cert->issuer) }} • {{ addslashes($cert->credential_id ?? '') }}')"
                                class="w-full py-2.5 px-4 rounded-xl bg-slate-800 hover:bg-slate-700/90 text-blue-400 hover:text-white border border-slate-700/80 font-medium text-xs transition-all flex items-center justify-center gap-2">
                                <i data-lucide="image" class="w-3.5 h-3.5"></i>
                                <span>Buka Media Sertifikat</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 bg-slate-900/60 border-t border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-semibold text-blue-400 uppercase tracking-widest mb-2">Kompetensi</h2>
                <h3 class="text-3xl font-extrabold text-white">Keahlian & Kemampuan Teknis</h3>
                <div class="w-16 h-1 bg-blue-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Category 1: Programming & Web -->
                <div class="p-6 rounded-2xl bg-slate-800/40 border border-slate-700/60 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center mb-4">
                            <i data-lucide="code" class="w-5 h-5"></i>
                        </div>
                        <h4 class="text-base font-bold text-white mb-3">Programming & Web</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 rounded-lg bg-blue-500/20 text-blue-300 text-xs font-semibold">PHP / Laravel</span>
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">HTML5 & CSS3</span>
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">MySQL</span>
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">VS Code</span>
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">GitHub</span>
                        </div>
                    </div>
                </div>

                <!-- Category 2: Design Graphic & UI/UX -->
                <div class="p-6 rounded-2xl bg-slate-800/40 border border-slate-700/60 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center mb-4">
                            <i data-lucide="palette" class="w-5 h-5"></i>
                        </div>
                        <h4 class="text-base font-bold text-white mb-3">Design & UI/UX</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">Figma</span>
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">Photoshop CS6</span>
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">Canva Design</span>
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">Wireframing</span>
                        </div>
                    </div>
                </div>

                <!-- Category 3: Office & Data Systems -->
                <div class="p-6 rounded-2xl bg-slate-800/40 border border-slate-700/60 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-4">
                            <i data-lucide="table" class="w-5 h-5"></i>
                        </div>
                        <h4 class="text-base font-bold text-white mb-3">Data & Systems</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">Microsoft Excel</span>
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">Google Sheets</span>
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">Sistem ERP</span>
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">Hardware & OS</span>
                        </div>
                    </div>
                </div>

                <!-- Category 4: Soft Skills -->
                <div class="p-6 rounded-2xl bg-slate-800/40 border border-slate-700/60 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center mb-4">
                            <i data-lucide="users" class="w-5 h-5"></i>
                        </div>
                        <h4 class="text-base font-bold text-white mb-3">Karakter & Soft Skills</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">Detail Oriented</span>
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">System Analyst</span>
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">Time Management</span>
                            <span class="px-3 py-1 rounded-lg bg-slate-700/60 text-slate-200 text-xs font-medium">Problem Solving</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 border-t border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-semibold text-blue-400 uppercase tracking-widest mb-2">Hasil Karya</h2>
                <h3 class="text-3xl font-extrabold text-white">Portofolio & Proyek Unggulan</h3>
                <div class="w-16 h-1 bg-blue-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $proj)
                    <div class="rounded-2xl bg-slate-800/50 border border-slate-700/60 overflow-hidden hover:border-blue-500/50 transition-all group flex flex-col justify-between shadow-xl">
                        <div>
                            <div class="h-44 bg-gradient-to-br from-blue-900/50 via-slate-800 to-slate-900 flex items-center justify-center border-b border-slate-700/50 relative overflow-hidden">
                                @if($proj->image_path)
                                    <img src="{{ asset($proj->image_path) }}" alt="{{ $proj->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <i data-lucide="folder-kanban" class="w-14 h-14 text-blue-400/70 group-hover:scale-110 transition-transform"></i>
                                @endif
                            </div>
                            <div class="p-6">
                                <span class="text-xs font-semibold text-blue-400 uppercase tracking-wider">{{ $proj->category ?? 'Web Application' }}</span>
                                <h4 class="text-xl font-bold text-white mt-1 mb-2">{{ $proj->title }}</h4>
                                <p class="text-slate-400 text-sm leading-relaxed mb-4">
                                    {{ $proj->description }}
                                </p>
                            </div>
                        </div>
                        <div class="p-6 pt-0">
                            @if($proj->tech_stack)
                                <div class="flex flex-wrap gap-2 pt-3 border-t border-slate-700/40">
                                    @foreach(explode(',', $proj->tech_stack) as $t)
                                        <span class="text-xs bg-slate-700/60 text-slate-300 px-2.5 py-1 rounded-md">{{ trim($t) }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @if($proj->demo_url || $proj->github_url)
                                <div class="flex items-center gap-3 pt-3 mt-3 border-t border-slate-700/30">
                                    @if($proj->demo_url)
                                        <a href="{{ $proj->demo_url }}" target="_blank" class="text-xs text-blue-400 hover:underline flex items-center gap-1 font-medium">
                                            <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                            <span>Live Demo</span>
                                        </a>
                                    @endif
                                    @if($proj->github_url)
                                        <a href="{{ $proj->github_url }}" target="_blank" class="text-xs text-slate-400 hover:text-white flex items-center gap-1">
                                            <i data-lucide="github" class="w-3.5 h-3.5"></i>
                                            <span>Repository</span>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Contact CTA Banner in Projects -->
            <div class="mt-12 text-center">
                <a href="#contact" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full bg-slate-800 hover:bg-slate-700 border border-slate-700 text-blue-400 hover:text-blue-300 font-semibold text-sm transition-all shadow-lg hover:scale-105">
                    <i data-lucide="sparkles" class="w-4 h-4 text-amber-400"></i>
                    <span>Tertarik berkolaborasi atau merekrut? Kirimkan pesan Anda di bawah ini</span>
                    <i data-lucide="arrow-down" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-slate-900/60 border-t border-slate-800/80 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-semibold text-blue-400 uppercase tracking-widest mb-2">Kontak</h2>
                <h3 class="text-3xl font-extrabold text-white">Hubungi {{ $profile['name'] }}</h3>
                <p class="text-slate-400 text-sm sm:text-base mt-2">
                    Silakan tinggalkan pesan melalui formulir di bawah ini untuk tawaran kerja, proyek, atau kolaborasi.
                </p>
                <div class="w-16 h-1 bg-blue-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 max-w-5xl mx-auto">
                <!-- Contact Information Column -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="p-6 rounded-2xl bg-slate-800/50 border border-slate-700/60 space-y-6">
                        <h4 class="text-xl font-bold text-white">Informasi Kontak</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">
                            Terbuka untuk peluang kerja penuh waktu, paruh waktu, proyek lepas (*freelance*), maupun diskusi kolaborasi pengembangan web:
                        </p>

                        <div class="space-y-4 pt-2">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="mail" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400">Email</p>
                                    <a href="mailto:{{ $profile['email'] }}" class="text-sm font-semibold text-slate-200 hover:text-blue-400 transition-colors">
                                        {{ $profile['email'] }}
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="phone" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400">WhatsApp / Telepon</p>
                                    <a href="{{ $profile['wa_link'] }}" target="_blank" class="text-sm font-semibold text-slate-200 hover:text-emerald-400 transition-colors">
                                        {{ $profile['phone'] }}
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="map-pin" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400">Lokasi / Domisili</p>
                                    <p class="text-sm font-semibold text-slate-200">
                                        {{ $profile['location'] }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="briefcase" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400">Status Ketersediaan</p>
                                    <p class="text-sm font-semibold text-slate-200">
                                        Siap Bergabung Segera (Full-Time / Project)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Professional Note -->
                        <div class="p-4 rounded-xl bg-slate-900/60 border border-slate-700/60 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-blue-500/10 text-blue-400 flex items-center justify-center shrink-0">
                                <i data-lucide="sparkles" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-200">Respon Cepat</p>
                                <p class="text-[11px] text-slate-400">Pesan langsung tersimpan di database & diteruskan ke WhatsApp</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="lg:col-span-7">
                    <div class="p-8 rounded-2xl bg-slate-800/60 border border-slate-700/60 shadow-xl backdrop-blur-sm relative">
                        
                        <!-- Notification Banners -->
                        <div id="form-alert-success" class="hidden mb-6 p-4 rounded-xl bg-emerald-500/15 border border-emerald-500/40 text-emerald-300 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400 shrink-0"></i>
                                <div>
                                    <p class="text-sm font-semibold">Pesan Berhasil Terkirim!</p>
                                    <p class="text-xs text-emerald-200/80" id="success-message-text">Pesan Anda telah tersimpan di database dan akan segera ditanggapi.</p>
                                </div>
                            </div>
                            <a href="{{ $profile['wa_link'] }}" target="_blank" class="shrink-0 px-3.5 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs flex items-center justify-center gap-1.5 transition-all shadow-md shadow-emerald-600/30">
                                <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                <span>Chat WA Langsung</span>
                            </a>
                        </div>

                        <div id="form-alert-error" class="hidden mb-6 p-4 rounded-xl bg-rose-500/15 border border-rose-500/40 text-rose-300 flex items-center gap-3">
                            <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-400 shrink-0"></i>
                            <div>
                                <p class="text-sm font-semibold">Gagal Mengirim Pesan</p>
                                <p class="text-xs text-rose-200/80" id="error-message-text">Terjadi kendala teknis.</p>
                            </div>
                        </div>

                        <form id="contact-form" action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                                    Nama Lengkap <span class="text-rose-400">*</span>
                                </label>
                                <input type="text" id="name" name="name" required placeholder="Contoh: Budi Santoso"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-900/80 border border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 placeholder-slate-500 text-sm outline-none transition-all">
                            </div>

                            <div>
                                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                                    Alamat Email <span class="text-rose-400">*</span>
                                </label>
                                <input type="email" id="email" name="email" required placeholder="nama@email.com"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-900/80 border border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 placeholder-slate-500 text-sm outline-none transition-all">
                            </div>

                            <div>
                                <label for="subject" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                                    Subjek / Keperluan
                                </label>
                                <input type="text" id="subject" name="subject" placeholder="Tawaran Kerjasama / Rekrutmen / Diskusi Proyek"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-900/80 border border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 placeholder-slate-500 text-sm outline-none transition-all">
                            </div>

                            <div>
                                <label for="message" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                                    Isi Pesan <span class="text-rose-400">*</span>
                                </label>
                                <textarea id="message" name="message" rows="5" required placeholder="Tuliskan pesan atau penawaran kerja Anda di sini..."
                                    class="w-full px-4 py-3 rounded-xl bg-slate-900/80 border border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-slate-100 placeholder-slate-500 text-sm outline-none transition-all resize-none"></textarea>
                            </div>

                            <button type="submit" id="submit-btn"
                                class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-semibold shadow-lg shadow-blue-500/25 transition-all flex items-center justify-center gap-2 group">
                                <span id="btn-text">Kirim Pesan Sekarang</span>
                                <i data-lucide="send" id="btn-icon" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                                <span id="btn-spinner" class="hidden animate-spin rounded-full h-5 w-5 border-2 border-white border-t-transparent"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Certificate Lightbox Modal -->
    <div id="certificate-lightbox" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/90 backdrop-blur-md transition-all">
        <div class="relative w-full max-w-4xl max-h-[92vh] bg-slate-900 border border-slate-700/80 rounded-2xl overflow-hidden shadow-2xl flex flex-col">
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-800 bg-slate-900/90">
                <div>
                    <h4 id="lightbox-title" class="text-base sm:text-lg font-bold text-white">Sertifikat</h4>
                    <p id="lightbox-desc" class="text-xs text-slate-400 mt-0.5">Kredensial Resmi</p>
                </div>
                <button onclick="closeLightbox()" class="p-2 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 transition-colors" title="Tutup (Esc)">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Modal Body (Media View) -->
            <div class="flex-1 overflow-auto p-4 sm:p-6 flex items-center justify-center bg-slate-950/70 min-h-[320px]">
                <img id="lightbox-img" src="" alt="Pratinjau Sertifikat" class="max-w-full max-h-[68vh] object-contain rounded-xl shadow-2xl border border-slate-800">
                
                <div id="lightbox-fallback" class="hidden p-8 text-center max-w-md">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-blue-500/10 border border-blue-500/30 text-blue-400 flex items-center justify-center">
                        <i data-lucide="file-image" class="w-8 h-8"></i>
                    </div>
                    <h5 class="text-base font-bold text-white">Berkas Media Belum Ditempatkan</h5>
                    <p class="text-xs text-slate-400 mt-2 leading-relaxed">
                        Foto scan sertifikat otomatis dimuat dari direktori <code class="text-blue-400 font-mono bg-slate-800 px-1.5 py-0.5 rounded">public/</code>.
                    </p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-3 border-t border-slate-800 bg-slate-900/90 flex justify-between items-center text-xs text-slate-400">
                <span class="flex items-center gap-1.5 text-emerald-400 font-medium">
                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                    Kredensial Tervalidasi
                </span>
                <button onclick="closeLightbox()" class="px-4 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 font-medium transition-colors">
                    Tutup (Esc)
                </button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    // Penanganan Formulir Kontak Laravel via AJAX / Fetch
    const contactForm = document.getElementById('contact-form');
    const submitBtn = document.getElementById('submit-btn');
    const btnText = document.getElementById('btn-text');
    const btnIcon = document.getElementById('btn-icon');
    const btnSpinner = document.getElementById('btn-spinner');
    const alertSuccess = document.getElementById('form-alert-success');
    const alertError = document.getElementById('form-alert-error');
    const successMsg = document.getElementById('success-message-text');
    const errorMsg = document.getElementById('error-message-text');

    if (contactForm) {
        contactForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            setLoading(true);
            hideAlerts();

            const formData = new FormData(contactForm);
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch(contactForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showSuccess(data.message || 'Pesan Anda berhasil dikirim dan tersimpan di database!');
                    contactForm.reset();
                } else {
                    let errMsg = data.message || 'Terjadi kesalahan pengisian form.';
                    if (data.errors) {
                        errMsg = Object.values(data.errors).flat().join('<br>');
                    }
                    showError(errMsg);
                }
            } catch (err) {
                console.error('Submit error:', err);
                showError('Terjadi kendala koneksi saat mengirim pesan. Silakan coba kembali.');
            } finally {
                setLoading(false);
            }
        });
    }

    function setLoading(isLoading) {
        if (isLoading) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            btnText.textContent = "Menyimpan ke Database...";
            btnIcon.classList.add('hidden');
            btnSpinner.classList.remove('hidden');
        } else {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            btnText.textContent = "Kirim Pesan Sekarang";
            btnIcon.classList.remove('hidden');
            btnSpinner.classList.add('hidden');
        }
    }

    function showSuccess(msg) {
        if (successMsg) successMsg.innerHTML = msg;
        alertSuccess.classList.remove('hidden');
        alertError.classList.add('hidden');
        alertSuccess.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function showError(msg) {
        if (errorMsg) errorMsg.innerHTML = msg;
        alertError.classList.remove('hidden');
        alertSuccess.classList.add('hidden');
        alertError.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function hideAlerts() {
        alertSuccess.classList.add('hidden');
        alertError.classList.add('hidden');
    }

    // Lightbox Modal Interaktif untuk Sertifikat
    function openLightbox(imgSrc, title, desc) {
        const modal = document.getElementById('certificate-lightbox');
        const img = document.getElementById('lightbox-img');
        const titleEl = document.getElementById('lightbox-title');
        const descEl = document.getElementById('lightbox-desc');
        const fallbackEl = document.getElementById('lightbox-fallback');

        if (modal && img && titleEl && descEl) {
            titleEl.textContent = title;
            descEl.textContent = desc;

            img.src = imgSrc;
            img.classList.remove('hidden');
            if (fallbackEl) fallbackEl.classList.add('hidden');

            img.onerror = function() {
                img.classList.add('hidden');
                if (fallbackEl) fallbackEl.classList.remove('hidden');
            };

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeLightbox() {
        const modal = document.getElementById('certificate-lightbox');
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });

    const certModal = document.getElementById('certificate-lightbox');
    if (certModal) {
        certModal.addEventListener('click', (e) => {
            if (e.target === certModal) closeLightbox();
        });
    }
</script>
@endsection
