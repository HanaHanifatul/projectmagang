<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/viewer/home');
});

Route::get('/ketuatim', function () {
    return view('/ketuatim/homeketua');
});

Route::get('/laporan/lap', function () {
    return view('/laporan/lap');
});