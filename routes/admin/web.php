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

//Product
Route::resource('products','ProductController');
Route::get('products/{product}/restore','ProductController@restore')->name('products.restore');
Route::delete('products/{product}/terminate','ProductController@terminate')->name('products.terminate');

//Warranty
Route::resource('warranties','WarrantyController');
Route::get('warranties/{warranty}/restore','WarrantyController@restore')->name('warranties.restore');
Route::delete('warranties/{warranty}/terminate','WarrantyController@terminate')->name('warranties.terminate');

//Price
Route::resource('prices','PriceController');
Route::get('prices/{price}/restore','PriceController@restore')->name('prices.restore');
Route::delete('prices/{price}/terminate','PriceController@terminate')->name('prices.terminate');

//Slider
Route::resource('sliders','SliderController');
Route::get('sliders/{slider}/restore','SliderController@restore')->name('sliders.restore');
Route::delete('sliders/{slider}/terminate','SliderController@terminate')->name('sliders.terminate');

//Offer
Route::get('amazingOffers', [AdminController::class, 'amazingOffers'])->name('amazingOffers');
Route::get('ajax/getProduct',[AdminController::class, 'getProduct'])->name('ajaxGetProduct');
Route::post('add_amazingOffers/{product_id}', [AdminController::class, 'add_amazingOffers'])->name('add_amazingOffers');
Route::post('remove_amazingOffers/{warranty_id}',[AdminController::class, 'remove_amazingOffers'])->name('remove_amazingOffers');

