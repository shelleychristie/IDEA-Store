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

Route::get('/home', 'ProductTypesController@index')->name('home');
Route::get('/', 'ProductTypesController@index')->name('productType.index');
Route::post('/productType', 'ProductTypesController@store')->name('productType.store');
Route::get('/productType/create', 'ProductTypesController@create')->name('productType.create');
Route::get('/productType/{productType}/edit', 'ProductTypesController@edit')->name('productType.edit');
Route::get('/productType/{productType}', 'ProductsController@index')->name('productType.index');
Route::get('/product/create', 'ProductsController@create')->name('product.create');
Route::post('/product', 'ProductsController@store')->name('product.store');
Route::get('/product/{product}', 'ProductsController@show')->name('product.show');
Route::get('/product/{product}/edit', 'ProductsController@edit')->name('product.edit');
Route::post('/product/{product}/edit', 'ProductsController@update')->name('product.update');

// Route::get('/addType', function () {
//     return view('addType');
// });