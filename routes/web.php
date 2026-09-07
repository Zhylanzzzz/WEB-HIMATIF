<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\DocumentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama & Multi-Page Navigation
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profile'])->name('profile');
Route::get('/pengurus', [HomeController::class, 'officers'])->name('officers');
Route::get('/event', [HomeController::class, 'events'])->name('events');
Route::get('/galeri', [HomeController::class, 'galleries'])->name('galleries');

// Download Center & Dokumen
Route::get('/dokumen', [HomeController::class, 'documents'])->name('documents');
Route::get('/dokumen/download/{id}', [DocumentController::class, 'download'])->name('documents.download');

// Aspirasi & Progress Tracking
Route::get('/aspirasi', [HomeController::class, 'aspiration'])->name('aspiration');
Route::post('/aspirasi', [AspirationController::class, 'store'])->middleware('throttle:3,5')->name('aspiration.store');
Route::get('/aspirasi/check', [AspirationController::class, 'check'])->name('aspiration.check');
