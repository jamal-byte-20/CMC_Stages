<?php

use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouteListController;
use App\Http\Controllers\UserCmcController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::middleware(['auth', 'cmc'])->group(function () {
    Route::resource('partenaires', PartenaireController::class)->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy',
    ]);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('user-cmcs', UserCmcController::class)->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy',
    ]);
    Route::get('/routes', [RouteListController::class, 'index'])->name('routes.index');
});

Route::middleware(['auth', 'partenaire'])->group(function () {
    Route::resource('opportunities', OpportunityController::class)->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy',
    ]);
});

require __DIR__.'/auth.php';
