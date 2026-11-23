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
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * Dashboard Overview
     */
    public function dashboard()
    {
        $stats = [
            'messages_count' => ContactMessage::count(),
            'certificates_count' => Certificate::count(),
            'projects_count' => Project::count(),
            'skills_count' => Skill::count(),
            'experiences_count' => Experience::count(),
            'educations_count' => Education::count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $profile = Profile::first();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'profile'));
    }

    /**
     * Kelola Profil & Teks Utama Portofolio
     */
    public function profile()
    {
        $profile = Profile::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Muhammad Syahrul Rajabi',
                'degree' => 'S.Kom',
                'title' => 'Information Systems Specialist & Web Developer',
            ]
        );

        return view('admin.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'degree' => 'nullable|string|max:50',
            'title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'about_summary' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'wa_link' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'github_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $profile = Profile::firstOrCreate(['id' => 1]);

        // Upload Avatar Baru
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = 'avatar_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $validated['avatar_path'] = 'uploads/' . $fileName;
        }

        $profile->update($validated);

        return back()->with('success', 'Profil dan teks portofolio berhasil diperbarui!');
    }

    /**
     * Kelola Sertifikat & Lisensi
     */
    public function certificates()
    {
        $certificates = Certificate::orderBy('order')->latest()->get();
        return view('admin.certificates', compact('certificates'));
    }

    public function storeCertificate(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'credential_id' => 'nullable|string|max:255',
            'valid_until' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,pdf|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'cert_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $validated['image_path'] = 'uploads/' . $fileName;
        }

        Certificate::create($validated);

        return back()->with('success', 'Sertifikat baru berhasil ditambahkan!');
    }

    public function updateCertificate(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'credential_id' => 'nullable|string|max:255',
            'valid_until' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,pdf|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'cert_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $validated['image_path'] = 'uploads/' . $fileName;
        }

        $certificate->update($validated);

        return back()->with('success', 'Data sertifikat berhasil diperbarui!');
    }

    public function destroyCertificate($id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();

        return back()->with('success', 'Sertifikat berhasil dihapus.');
    }

    /**
     * Kelola Proyek Portofolio
     */
    public function projects()
    {
        $projects = Project::orderBy('order')->latest()->get();
        return view('admin.projects', compact('projects'));
    }

    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'tech_stack' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'demo_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'proj_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $validated['image_path'] = 'uploads/' . $fileName;
        }

        Project::create($validated);

        return back()->with('success', 'Proyek portofolio baru berhasil ditambahkan!');
    }

    public function updateProject(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'tech_stack' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'demo_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'proj_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $validated['image_path'] = 'uploads/' . $fileName;
        }

        $project->update($validated);

        return back()->with('success', 'Data proyek berhasil diperbarui!');
    }

    public function destroyProject($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return back()->with('success', 'Proyek berhasil dihapus.');
    }

    /**
     * Kelola Pengalaman Kerja
     */
    public function experiences()
    {
        $experiences = Experience::orderBy('order')->latest()->get();
        return view('admin.experiences', compact('experiences'));
    }

    public function storeExperience(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'period' => 'required|string|max:100',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        Experience::create($validated);

        return back()->with('success', 'Pengalaman kerja baru berhasil ditambahkan!');
    }

    public function updateExperience(Request $request, $id)
    {
        $experience = Experience::findOrFail($id);

        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'period' => 'required|string|max:100',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $experience->update($validated);

        return back()->with('success', 'Data pengalaman kerja berhasil diperbarui!');
    }

    public function destroyExperience($id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return back()->with('success', 'Pengalaman kerja berhasil dihapus.');
    }

    /**
     * Kelola Riwayat Pendidikan
     */
    public function educations()
    {
        $educations = Education::orderBy('order')->latest()->get();
        return view('admin.educations', compact('educations'));
    }

    public function storeEducation(Request $request)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'period' => 'required|string|max:100',
            'gpa' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        Education::create($validated);

        return back()->with('success', 'Riwayat pendidikan berhasil ditambahkan!');
    }

    public function updateEducation(Request $request, $id)
    {
        $education = Education::findOrFail($id);

        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'period' => 'required|string|max:100',
            'gpa' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $education->update($validated);

        return back()->with('success', 'Riwayat pendidikan berhasil diperbarui!');
    }

    public function destroyEducation($id)
    {
        $education = Education::findOrFail($id);
        $education->delete();

        return back()->with('success', 'Riwayat pendidikan berhasil dihapus.');
    }

    /**
     * Kelola Keahlian (Skills)
     */
    public function skills()
    {
        $skills = Skill::orderBy('order')->get();
        return view('admin.skills', compact('skills'));
    }

    public function storeSkill(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'level_percent' => 'required|integer|min:10|max:100',
            'order' => 'nullable|integer',
        ]);

        Skill::create($validated);

        return back()->with('success', 'Keahlian baru berhasil ditambahkan!');
    }

    public function updateSkill(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'level_percent' => 'required|integer|min:10|max:100',
            'order' => 'nullable|integer',
        ]);

        $skill->update($validated);

        return back()->with('success', 'Data keahlian berhasil diperbarui!');
    }

    public function destroySkill($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return back()->with('success', 'Keahlian berhasil dihapus.');
    }

    /**
     * Kelola Pesan Masuk (Inbox)
     */
    public function messages()
    {
        $messages = ContactMessage::latest()->get();
        return view('admin.messages', compact('messages'));
    }

    public function destroyMessage($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return back()->with('success', 'Pesan kontak berhasil dihapus dari database.');
    }
}
