<?php

/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */
// addons/contact/routes/web.php
use App\Addons\Contact\Controllers\Front\CustomerContactController;
use Illuminate\Support\Facades\Route;

Route::get('/contact', [CustomerContactController::class, 'index'])->name('.index');

Route::post('/contact', [CustomerContactController::class, 'store'])->name('.store');
