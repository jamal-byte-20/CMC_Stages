<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserCmcController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\PartenaireController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('UserCmc', UserCmcController::class);

Route::get('/register/cmc', [UserCmcController::class, 'showCmcForm'])->name('register.cmc');
Route::post('/register/cmc', [UserCmcController::class, 'registerCmc']);

Route::get('/register/partner', [PartenaireController::class, 'showPartnerForm'])->name('register.partner');
Route::post('/register/partner', [PartenaireController::class, 'registerPartner']);

// Opportunity Resource
Route::resource('opportunities', OpportunityController::class);
