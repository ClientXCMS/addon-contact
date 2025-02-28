<?php

use Illuminate\Support\Facades\Route;
use App\Addons\Contact\Controllers\Admin\ContactController;

Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy', 'update']);

Route::get('/contact/settings', [ContactController::class, 'settings'])->name('contacts.settings');
Route::post('/contact/settings', [ContactController::class, 'storeSettings'])->name('contacts.settings.store');
Route::get('/contact/download/{contact}/{attachment}', [ContactController::class, 'downloadAttachment'])->name('contacts.download');

