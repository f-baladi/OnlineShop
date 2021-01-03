<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('panel', [AdminController::class, 'index'])->name('panel');

//Category
Route::resource('categories','CategoryController');
Route::get('categories/{category}/restore','CategoryController@restore')->name('categories.restore');
Route::delete('categories/{category}/terminate','CategoryController@terminate')->name('categories.terminate');

//Brand
Route::resource('brands','BrandController');
Route::get('brands/{brand}/restore','BrandController@restore')->name('brands.restore');
Route::delete('brands/{brand}/terminate','BrandController@terminate')->name('brands.terminate');


