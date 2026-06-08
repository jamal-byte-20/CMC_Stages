<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// hhhhh
Route::get('/home', function () {
    return view('home');
});