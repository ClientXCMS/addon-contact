<?php
// addons/contact/routes/web.php
use Illuminate\Support\Facades\Route;
use App\Addons\Contact\Controllers\Admin\ContactController;

Route::get('/contact', [ContactController::class, 'customerindex'])->name('customer.index');
Route::post('/contact', [ContactController::class, 'customerstore'])->name('customer.store');
