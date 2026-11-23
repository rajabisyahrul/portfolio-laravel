# Portofolio Muhammad Syahrul Rajabi, S.Kom (Laravel Edition + Admin CMS)

Aplikasi Web Portofolio Profesional berbasis **Laravel 10**, dibangun dengan arsitektur MVC modern, Tailwind CSS, Lucide Icons, SQLite/MySQL database, Panel Admin CMS lengkap untuk mengelola teks & gambar, serta sinkronisasi otomatis ke Google Sheets & WhatsApp.

---

## 🔐 Kredensial Akses Admin CMS

Untuk mengelola teks, bio, foto profil, scan sertifikat, proyek, pengalaman, pendidikan, keahlian, dan pesan masuk:

- **Halaman Login**: `http://127.0.0.1:8000/login` atau `http://portfolio-laravel.test/login`
- **Dashboard Admin**: `http://127.0.0.1:8000/admin` atau `http://portfolio-laravel.test/admin`
- **Email Administrator**: `admin@syahrul.com` *(atau `rajabisyahrul@gmail.com`)*
- **Password Default**: `admin123`

---

## 🚀 Fitur Unggulan Panel Admin CMS

1. **Kelola Profil & Teks Utama (`/admin/profile`)**:
   - Ubah Nama, Gelar (`S.Kom`), Jabatan (*Headline*), Lokasi, dan Kontak (Email, No. HP, Tautan WhatsApp).
   - Edit Teks Subtitle Beranda (*Hero*) dan Uraian Lengkap Tentang Saya (*About Me*).
   - Unggah & ganti **Foto Profil Utama** dengan fitur pratinjau (*image preview*) langsung.

2. **Kelola Sertifikat & Lisensi (`/admin/certificates`)**:
   - Tambah, edit, dan hapus sertifikat kompetensi (BNSP Analis Program, TOEFL, Programmer, dll).
   - Unggah scan gambar sertifikat beresolusi tinggi yang terintegrasi dengan **Lightbox Modal** di halaman utama portofolio.
   - Atur nomor registrasi/kredensial, penerbit resmi, dan masa berlaku.

3. **Kelola Portofolio Proyek (`/admin/projects`)**:
   - Tambah dan kelola karya sistem informasi & aplikasi web.
   - Unggah thumbnail proyek, isi tech stack, kategori, deskripsi, tautan Live Demo, dan link GitHub.

4. **Kelola Pengalaman Kerja & Pendidikan (`/admin/experiences` & `/admin/educations`)**:
   - Atur riwayat karir (PT SAP TBK, BPS, PT Sucofindo) lengkap dengan deskripsi tugas.
   - Atur riwayat akademik (S1 Sistem Informasi Nusa Mandiri, D3 UBSI, nilai IPK, dan fokus bidang studi).

5. **Kelola Keahlian Teknis (`/admin/skills`)**:
   - Kelola keahlian berdasarkan kategori (*Web & Database*, *Technical & Hardware*, *Design & Tools*).
   - Sesuaikan persentase penguasaan (10% - 100%) dan urutan tampil.

6. **Kelola Pesan Masuk / Inbox (`/admin/messages`)**:
   - Pantau semua pesan dari pengunjung website lengkap dengan nama, email pengirim, waktu, subjek, isi pesan, IP address, dan status sinkronisasi ke Google Sheets.
   - Tombol hapus pesan untuk membersihkan inbox dari pesan yang sudah ditanggapi atau spam.

---

## 🛠️ Cara Menjalankan Website

### Opsi 1: Menjalankan via Terminal / CMD (Artisan Serve)
Buka terminal (PowerShell / Command Prompt) di direktori ini:
```powershell
cd C:\Users\rajab\.gemini\antigravity\scratch\portfolio-laravel
& "C:\xampp\php\php.exe" artisan serve
```
Buka browser di:
- **Portofolio Utama**: `http://127.0.0.1:8000`
- **Login Admin**: `http://127.0.0.1:8000/login`
- **Panel Admin CMS**: `http://127.0.0.1:8000/admin`
- **Inbox Pesan**: `http://127.0.0.1:8000/messages`

---

### Opsi 2: Menjalankan via Laragon (Virtual Host)
Project ini sudah terhubung ke direktori Laragon Anda (`C:\laragon\www\portfolio-laravel`):
1. Buka aplikasi **Laragon**.
2. Klik tombol **Start All** (Apache & MySQL).
3. Buka browser:
   - `http://portfolio-laravel.test`
   - `http://portfolio-laravel.test/admin`

---

## 📁 Struktur Berkas Utama

```text
portfolio-laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php                     # Login, Session & Logout Admin
│   │   ├── AdminController.php                    # CMS Profil, Teks, Gambar & Pesan
│   │   └── PortfolioController.php                # Kontroler Halaman Portofolio Publik
│   └── Models/
│       ├── User.php                               # Model Autentikasi Admin
│       ├── Profile.php                            # Model Profil & Teks Utama
│       ├── Certificate.php                        # Model Sertifikat & Scan Media
│       ├── Project.php                            # Model Proyek Portofolio
│       ├── Experience.php                         # Model Pengalaman Kerja
│       ├── Education.php                          # Model Riwayat Pendidikan
│       ├── Skill.php                              # Model Keahlian & Tools
│       └── ContactMessage.php                     # Model Pesan Masuk Formulir
├── database/
│   ├── database.sqlite                            # Database Lokal SQLite
│   ├── migrations/                                # 6 Tabel Skema Database
│   └── seeders/PortfolioSeeder.php                # Seeder Data Awal Portofolio & Admin
├── public/
│   ├── uploads/                                   # Direktori Upload Gambar & Scan Media
│   ├── foto-syahrul.jpg                           # Asset Foto Profil Awal
│   ├── sertifikat-*.jpg                           # Asset Media Scan Sertifikat
│   └── style.css                                  # Custom Styling & Efek Glow
├── resources/views/
│   ├── auth/login.blade.php                       # Tampilan Halaman Login Admin
│   ├── layouts/
│   │   ├── app.blade.php                          # Master Layout Portofolio Publik
│   │   └── admin.blade.php                        # Master Layout Panel Admin CMS
│   ├── admin/
│   │   ├── dashboard.blade.php                    # Ringkasan Statistik & Pesan Terbaru
│   │   ├── profile.blade.php                      # Formulir Edit Teks, Bio & Foto Profil
│   │   ├── certificates.blade.php                 # Kelola Sertifikat & Unggah Scan
│   │   ├── projects.blade.php                     # Kelola Proyek Portofolio
│   │   ├── experiences.blade.php                  # Kelola Pengalaman Kerja
│   │   ├── educations.blade.php                   # Kelola Riwayat Pendidikan
│   │   ├── skills.blade.php                       # Kelola Keahlian & Persentase
│   │   └── messages.blade.php                     # Kelola & Hapus Pesan Masuk
│   └── portfolio/
│       └── index.blade.php                        # Halaman Utama Portofolio Dinamis
└── routes/web.php                                 # 36 Rute Publik & Terproteksi Auth
```
