<?php
// addons/contact/routes/web.php
use Illuminate\Support\Facades\Route;
use App\Addons\Contact\Controllers\default\CustomerContactController;

Route::get('/contact', [CustomerContactController::class, 'customerindex'])->name('customer.index');


Route::post('/contact', [CustomerContactController::class, 'customerstore'])->name('customer.store');
