<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

// Route::get('/login', function () {
//     return view('/auth/login');
// });


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // tampilkan form
Route::post('/login', [AuthController::class, 'login'])->name('login.post');   // proses login
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');     // logout