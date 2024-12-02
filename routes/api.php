<?php

use App\Http\Controllers\layananController;
use App\Http\Controllers\bookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // Mengambil data profil
    Route::get('/profile', [ProfileController::class, 'getProfile']);
    
    // Mengupdate data profil
    Route::put('/profile', [ProfileController::class, 'updateProfile']);

    
    Route::get('/layanan', [layananController::class, 'index']); // Menampilkan semua layanan
    Route::get('/layanan/{id}', [layananController::class, 'show']); // Menampilkan layanan berdasarkan ID
    Route::get('layanan/date/{date}', [layananController::class, 'getLayananByDate']); // Menampilkan layanan berdasarkan tanggal
    Route::post('/layanan', [layananController::class, 'store']); // Menambah layanan baru
    Route::put('/layanan/{id}', [layananController::class, 'update']); // Mengupdate layanan
    Route::delete('/layanan/{id}', [layananController::class, 'destroy']); // Menghapus layanan
    
    Route::post('/booking', [bookingController::class, 'bookClass']); // Membuat booking baru
    Route::put('/booking/{bookingId}/reminder', [bookingController::class, 'updateReminderTime']); // Memperbarui waktu reminder
    Route::put('/booking/{bookingId}/pay', [bookingController::class, 'payAndBook']); // Membayar dan mengubah status menjadi 'booked'
    Route::delete('/booking/{bookingId}/cancel', [bookingController::class, 'cancelBooking']); // Membatalkan booking
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
