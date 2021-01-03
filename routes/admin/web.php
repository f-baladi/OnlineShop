<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('panel', [AdminController::class, 'index'])->name('panel');

//Category
Route::resource('categories','CategoryController');
Route::get('categories/{category}/restore','CategoryActionController@restore')->name('categories.restore');
Route::delete('categories/{category}/terminate','CategoryActionContorller@terminate')->name('categories.terminate');

//Brand
Route::resource('brands','BrandController');
Route::get('brands/{brand}/restore','BrandActionController@restore')->name('brands.restore');
Route::delete('brands/{brand}/terminate','BrandActionController@terminate')->name('brands.terminate');
