<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StepsPlanController;
use App\Http\Controllers\StepsFinalController;
use App\Http\Controllers\StepsController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\PublicationExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
// Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/', [PublicationController::class, 'index'])->name('daftarpublikasi');

// Laporan
Route::get('/laporan', function () {
    return view('/tampilan/laporan');
})->name('laporan');

// ==================== Publications ====================
Route::resource('publications', PublicationController::class);

// Search publications
Route::get('/publications/search', [PublicationController::class, 'search'])->name('publications.search');

// Export
Route::get('/publications/exportTable', [PublicationExportController::class, 'exportTable'])->name('publications.exportTable');
Route::get('/export/publication/{id}', [PublicationExportController::class, 'export'])->name('publication.export');

// ==================== Steps / Tahapan ====================
// Tampilkan tahapan untuk 1 publikasi
Route::get('/publications/{publication}/steps', [StepsPlanController::class, 'index'])->name('steps.index');

// Tambah tahapan
Route::post('/publications/{publication}/steps', [StepsPlanController::class, 'store'])->name('steps.store');

// Update tahapan (rencana & realisasi)
Route::put('/plans/{plan}', [StepsPlanController::class, 'update'])->name('plans.update');
Route::put('/plans/{plan}/edit-stage', [StepsPlanController::class, 'updateStage'])->name('plans.update_stage');
Route::put('/finals/{plan}', [StepsFinalController::class, 'update'])->name('finals.update');

// Hapus tahapan
Route::delete('/plans/{plan}', [StepsPlanController::class, 'destroy'])->name('plans.destroy');

// ==================== Auth ====================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ubah password
Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
Route::post('/change-password', [AuthController::class, 'updatePassword'])->name('password.update');

// ==================== Admin ====================
Route::get('/admin', [AdminController::class, 'index'])->name('adminpage');
Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');