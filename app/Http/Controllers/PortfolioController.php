<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PortfolioController extends Controller
{
    /**
     * Tampilkan Halaman Portofolio Muhammad Syahrul Rajabi
     * (Mengambil data dinamis dari database CMS dengan fallback default)
     */
    public function index()
    {
        $profile = Profile::first();

        // Fallback jika belum di-seed
        if (!$profile) {
            $profile = (object)[
                'name' => 'Muhammad Syahrul Rajabi',
                'degree' => 'S.Kom',
                'title' => 'Information Systems Specialist & Web Developer',
                'location' => 'Tebet, Jakarta Selatan, DKI Jakarta',
                'email' => 'rajabisyahrul@gmail.com',
                'phone' => '+62 812-1190-5361',
                'wa_link' => 'https://wa.me/6281211905361',
                'avatar_path' => 'foto-syahrul.jpg',
                'hero_subtitle' => 'Lulusan S1 Sistem Informasi Universitas Nusa Mandiri dengan keahlian pengembangan aplikasi web, analisis sistem informasi, dan manajemen data operasional terstruktur.',
                'about_summary' => 'Lulusan S1 Sistem Informasi Universitas Nusa Mandiri (IPK 3.65) dan D3 Sistem Informasi UBSI (IPK 3.32) dengan minat kuat pada pengembangan web, analisis kebutuhan software, dan manajemen basis data. Terampil dalam HTML, CSS, MySQL, instalasi hardware/software/OS, serta desain UI/UX dengan Figma dan Adobe Photoshop. Berpengalaman dalam pengelolaan ribuan data operasional dengan integritas dan akurasi tinggi di instansi pemerintah dan BUMN.',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
            ];
        }

        $experiences = Experience::orderBy('order')->latest()->get();
        $educations = Education::orderBy('order')->latest()->get();
        $certificates = Certificate::orderBy('order')->latest()->get();
        $projects = Project::orderBy('order')->latest()->get();
        $skills = Skill::orderBy('order')->get()->groupBy('category');

        return view('portfolio.index', compact(
            'profile',
            'experiences',
            'educations',
            'certificates',
            'projects',
            'skills'
        ));
    }

    /**
     * Simpan Pesan Kontak ke Database & Sinkronisasi ke Google Sheets
     */
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'message.required' => 'Isi pesan wajib diisi.',
        ]);

        // 1. Simpan ke Database Lokal (SQLite / MySQL)
        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? 'Pesan dari Website Portofolio',
            'message' => $validated['message'],
            'ip_address' => $request->ip(),
            'synced_to_sheets' => false,
        ]);

        // 2. Sinkronkan ke Google Sheets Webhook (jika URL dikonfigurasi)
        $googleSheetUrl = env('GOOGLE_SHEET_WEBHOOK_URL');
        $sheetSynced = false;

        if ($googleSheetUrl && filter_var($googleSheetUrl, FILTER_VALIDATE_URL)) {
            try {
                $response = Http::asForm()->timeout(8)->post($googleSheetUrl, [
                    'name' => $contactMessage->name,
                    'email' => $contactMessage->email,
                    'subject' => $contactMessage->subject,
                    'message' => $contactMessage->message,
                ]);

                if ($response->successful()) {
                    $contactMessage->update(['synced_to_sheets' => true]);
                    $sheetSynced = true;
                }
            } catch (\Exception $e) {
                Log::warning('Gagal sinkronisasi ke Google Sheets: ' . $e->getMessage());
            }
        }

        // Response JSON untuk AJAX / Fetch (sesuai frontend website)
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan Anda berhasil terkirim dan tersimpan di database!',
                'synced_sheets' => $sheetSynced,
            ]);
        }

        return back()->with('success', 'Pesan Anda berhasil terkirim dan tersimpan di database!');
    }
}
