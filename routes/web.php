<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StepsPlanController;
use App\Http\Controllers\StepsFinalController;

Route::get('/', function () {
    return view('/tampilan/homeketua');
});

Route::get('/laporan', function () {
    return view('/tampilan/laporan');
});

Route::get('/detail', function () {
    return view('/tampilan/detail');
});

Route::get('/login', function () {
    return view('/auth/login');
});

Route::prefix('plans.')->name('plans.')->group(function () {
    Route::get('/', [StepsPlanController::class, 'index'])->name('index');
    Route::post('/', [StepsPlanController::class, 'store'])->name('store');
    Route::get('/{id}', [StepsPlanController::class, 'show'])->name('show');
    Route::put('/{id}', [StepsPlanController::class, 'update'])->name('update');
    Route::delete('/{id}', [StepsPlanController::class, 'destroy'])->name('destroy');
});

Route::prefix('finals.')->name('finals.')->group(function () {
    Route::get('/', [StepsFinalController::class, 'index'])->name('index');
    Route::post('/', [StepsFinalController::class, 'store'])->name('store');
    Route::get('/{id}', [StepsFinalController::class, 'show'])->name('show');
    Route::put('/{id}', [StepsFinalController::class, 'update'])->name('update');
    Route::delete('/{id}', [StepsFinalController::class, 'destroy'])->name('destroy');
});

use App\Http\Controllers\PublicationController;

Route::prefix('publications')->name('publications.')->group(function () {
    Route::get('/', [PublicationController::class, 'index'])->name('index');
    Route::get('/create', [PublicationController::class, 'create'])->name('create');
    Route::post('/', [PublicationController::class, 'store'])->name('store');
    Route::get('/{id}', [PublicationController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [PublicationController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PublicationController::class, 'update'])->name('update');
    Route::delete('/{id}', [PublicationController::class, 'destroy'])->name('destroy');
});
