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

//Color
Route::resource('colors','ColorController');
Route::get('colors/{color}/restore','ColorController@restore')->name('colors.restore');
Route::delete('colors/{color}/terminate','ColorController@terminate')->name('colors.terminate');

//product
Route::resource('products','productController');
Route::get('products/{product}/restore','productController@restore')->name('products.restore');
Route::delete('products/{product}/terminate','productController@terminate')->name('products.terminate');

//warranty
Route::resource('warranties','warrantyController');
Route::get('warranties/{warranty}/restore','warrantyController@restore')->name('warranties.restore');
Route::delete('warranties/{warranty}/terminate','warrantyController@terminate')->name('warranties.terminate');
