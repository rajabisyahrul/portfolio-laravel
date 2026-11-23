<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Portofolio Muhammad Syahrul Rajabi
|--------------------------------------------------------------------------
*/

// 1. Halaman Publik Portofolio
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::post('/contact', [PortfolioController::class, 'sendMessage'])->name('contact.send');

// 2. Autentikasi Admin
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Shortcut /messages diarahkan ke admin pesan (atau login jika belum masuk)
Route::get('/messages', function () {
    return redirect()->route('admin.messages');
})->name('messages.index');

// 3. Panel Admin (Dilindungi Auth Middleware)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Utama
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Kelola Profil & Teks Utama (About, Hero, Kontak, Foto)
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');

    // Kelola Sertifikat & Lisensi (Media scan, No Kredensial, Keterangan)
    Route::get('/certificates', [AdminController::class, 'certificates'])->name('certificates');
    Route::post('/certificates', [AdminController::class, 'storeCertificate'])->name('certificates.store');
    Route::post('/certificates/{id}', [AdminController::class, 'updateCertificate'])->name('certificates.update');
    Route::delete('/certificates/{id}', [AdminController::class, 'destroyCertificate'])->name('certificates.destroy');

    // Kelola Proyek Portofolio
    Route::get('/projects', [AdminController::class, 'projects'])->name('projects');
    Route::post('/projects', [AdminController::class, 'storeProject'])->name('projects.store');
    Route::post('/projects/{id}', [AdminController::class, 'updateProject'])->name('projects.update');
    Route::delete('/projects/{id}', [AdminController::class, 'destroyProject'])->name('projects.destroy');

    // Kelola Pengalaman Kerja
    Route::get('/experiences', [AdminController::class, 'experiences'])->name('experiences');
    Route::post('/experiences', [AdminController::class, 'storeExperience'])->name('experiences.store');
    Route::post('/experiences/{id}', [AdminController::class, 'updateExperience'])->name('experiences.update');
    Route::delete('/experiences/{id}', [AdminController::class, 'destroyExperience'])->name('experiences.destroy');

    // Kelola Riwayat Pendidikan
    Route::get('/educations', [AdminController::class, 'educations'])->name('educations');
    Route::post('/educations', [AdminController::class, 'storeEducation'])->name('educations.store');
    Route::post('/educations/{id}', [AdminController::class, 'updateEducation'])->name('educations.update');
    Route::delete('/educations/{id}', [AdminController::class, 'destroyEducation'])->name('educations.destroy');

    // Kelola Keahlian (Skills)
    Route::get('/skills', [AdminController::class, 'skills'])->name('skills');
    Route::post('/skills', [AdminController::class, 'storeSkill'])->name('skills.store');
    Route::post('/skills/{id}', [AdminController::class, 'updateSkill'])->name('skills.update');
    Route::delete('/skills/{id}', [AdminController::class, 'destroySkill'])->name('skills.destroy');

    // Kelola Pesan Masuk (Inbox)
    Route::get('/messages', [AdminController::class, 'messages'])->name('messages');
    Route::delete('/messages/{id}', [AdminController::class, 'destroyMessage'])->name('messages.destroy');
});
