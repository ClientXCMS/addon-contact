<?php

/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */
use App\Addons\Contact\Controllers\Admin\ContactController;
use Illuminate\Support\Facades\Route;

Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy', 'update']);

Route::get('/contact/settings', [ContactController::class, 'settings'])->name('contacts.settings');
Route::post('/contact/settings', [ContactController::class, 'storeSettings'])->name('contacts.settings.store');
Route::get('/contact/download/{contact}/{attachment}', [ContactController::class, 'downloadAttachment'])->name('contacts.download');
