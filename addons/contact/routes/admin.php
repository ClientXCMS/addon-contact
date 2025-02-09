<?php

use Illuminate\Support\Facades\Route;
use App\Addons\Contact\Controllers\Admin\ContactController;


// Route::get('/contact', [ContactController::class, 'index'])->name('index');
// Route::get('/contact/{id}', [ContactController::class, 'show'])->name('show');
// Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('destroy');


Route::resource('contact', ContactController::class)->only(['index', 'show', 'destroy', 'update']);
