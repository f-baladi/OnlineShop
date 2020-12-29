<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('panel', [AdminController::class, 'index'])->name('panel');
