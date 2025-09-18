<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Route::get('/detail', function () {
    return view('/tampilan/detail');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // tampilkan form
Route::post('/login', [AuthController::class, 'login'])->name('login.post');   // proses login
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');     // logout

// Group route dengan middleware auth
Route::middleware(['auth'])->group(function () {
    // CRUD resource untuk publications
    Route::resource('publications', PublicationController::class)
        ->except(['.store', 'create','edit', 'show']);

    // Route tambahan untuk export
    Route::get('publications/export', [PublicationController::class, 'export'])
        ->name('publications.export');
});
