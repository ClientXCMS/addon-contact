<?php
// addons/contact/routes/web.php
use Illuminate\Support\Facades\Route;
use App\Addons\Contact\Controllers\Front\CustomerContactController;

Route::get('/contact', [CustomerContactController::class, 'index'])->name('.index');


Route::post('/contact', [CustomerContactController::class, 'store'])->name('.store');
