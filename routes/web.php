<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    // Mengambil data profil
    Route::get('/profile', [ProfileController::class, 'getProfile']);
    
    // Mengupdate data profil
    Route::put('/profile', [ProfileController::class, 'updateProfile']);
});

Route::get('/', function () {
    return view('welcome');
});
