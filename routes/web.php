<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StepsFinalController;
use App\Http\Controllers\StepsPlanController;
use App\Http\Controllers\PublicationController;

// Route::get('/', function () {
//     return view('/tampilan/homeketua');
// })->middleware('auth');

Route::get('/', 
    [HomeController::class, 'index']
)->name('home');


Route::get('/laporan', function () {
    return view('/tampilan/laporan');
});

// Route::get('/detail', function () {
//     return view('/tampilan/detail');
// });

// Tampilkan halaman detail
Route::get('/detail', [
    StepsPlanController::class, 'index'])
->name('plans.index');

// Simpan Tahapan Baru (dari modal "Tambah Tahapan")
Route::post('/tahapan/store', [
    StepsPlanController::class, 'store'])
->name('tahapan.store');

// Perbarui Rencana yang sudah ada (dari formulir "Edit Rencana")
Route::put('/plans/{plan}', [
    StepsPlanController::class, 'update'
])->name('plans.update');

// Perbarui Rencana yang sudah ada (dari formulir "Edit Realisasi")
Route::put('/finals/{plan}', [
    StepsFinalController::class, 'update'
])->name('finals.update');

// Hapus tahapan
Route::delete('/plans/{plan}', [
    StepsPlanController::class, 'destroy'
])->name('plans.destroy');

// Route::get('/login', function () {
//     return view('/auth/login');
// });

Route::get('/login', [
    AuthController::class, 'showLoginForm'])
->name('login'); // tampilkan form

Route::post('/login', [
    AuthController::class, 'login'])
->name('login.post');   // proses login

Route::post('/logout', [
    AuthController::class, 'logout'])
->name('logout');     // logout

Route::resource('publications', PublicationController::class);

// route contoh buat ngambil id di detail
// detail publikasi + semua steps-nya
Route::get('/publications/{publication}/steps', [StepsPlanController::class, 'index'])
    ->name('steps.index');

// simpan step baru
Route::post('/publications/{publication}/steps', [StepsPlanController::class, 'store'])->name('steps.store');
