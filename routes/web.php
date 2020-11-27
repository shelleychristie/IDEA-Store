<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/home', 'ProductTypesController@index')->name('productType.index');
Route::get('/', 'ProductTypesController@index')->name('productType.index');
Route::post('/productType', 'ProductTypesController@store')->name('productType.store');
Route::get('/productType/create', 'ProductTypesController@create')->name('productType.create')->middleware('adminmid');
Route::get('/productType/{productType}/edit', 'ProductTypesController@edit')->name('productType.edit')->middleware('adminmid');
Route::patch('/productType/{productType}/update', 'ProductTypesController@update')->name('productType.update')->middleware('adminmid');
Route::get('/productType/{productType}', 'ProductsController@index')->name('productType.index');
Route::get('/product/create', 'ProductsController@create')->name('product.create')->middleware('adminmid');
Route::post('/product', 'ProductsController@store')->name('product.store')->middleware('adminmid');
Route::get('/product/{product}', 'ProductsController@show')->name('product.show');
Route::get('/product/{product}/edit', 'ProductsController@edit')->name('product.edit')->middleware('adminmid');
Route::patch('/product/{product}/update', 'ProductsController@update')->name('product.update')->middleware('adminmid');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit')->middleware('membermid');
Route::patch('/profile/update', 'ProfileController@update')->name('profile.update')->middleware('membermid');