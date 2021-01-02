<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('panel', [AdminController::class, 'index'])->name('panel');
Route::resource('categories','CategoryController');
Route::get('categories/{category}/restore','CategoryActionController@restore')->name('categories.restore');
Route::delete('categories/{category}/terminate','CategoryActionContorller@terminate')->name('categories.terminate');
