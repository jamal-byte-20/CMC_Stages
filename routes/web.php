<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserCmcController;
use App\Http\Controllers\Auth\MultiRegisterController;
use App\Http\Controllers\Auth\PartenairesController;

Route::get('/', function () {
    return view('welcome');
});
// hhhhh
Route::get('/home', function () {
    return view('home');
});

Route::resource('UserCmc', UserCmcController::class);
Route::resource('UserPartenaires', PartenaireController::class);

Route::get('/register/cmc', [MultiRegisterController::class, 'showCmcForm'])->name('register.cmc');
Route::post('/register/cmc', [MultiRegisterController::class, 'registerCmc']);

Route::get('/register/partner', [MultiRegisterController::class, 'showPartnerForm'])->name('register.partner');
Route::post('/register/partner', [MultiRegisterController::class, 'registerPartner']);



