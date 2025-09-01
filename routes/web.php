<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/laporan/lap', function () {
    return view('/laporan/lap');
});