<?php

use Illuminate\Support\Facades\Route;

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