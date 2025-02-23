<?php

use Illuminate\Support\Facades\Route;
use App\Addons\Contact\Controllers\Admin\ContactController;


// Route::get('/contact', [ContactController::class, 'index'])->name('index');
// Route::get('/contact/{id}', [ContactController::class, 'show'])->name('show');
// Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('destroy');


Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy', 'update']);

Route::get('/contact/settings', [ContactController::class, 'settings'])->name('contacts.settings');
Route::post('/contact/settings', [ContactController::class, 'storeSettings'])->name('contacts.settings.store');
Route::delete('/contact/settings', [ContactController::class, 'deleteIMGSettings'])->name('contacts.settings.deleteImage');

