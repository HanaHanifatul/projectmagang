<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/viewer/home');
});

Route::get('/laporan/lap', function () {
    return view('/laporan/lap');
});

Route::get('/ketuatim', function () {
    return view('/ketuatim/homeketua');
});

Route::get('/ketuatim/laporan', function () {
    return view('/ketuatim/laporan');
});

Route::get('/login', function () {
    return view('/auth/login');
});