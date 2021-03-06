<?php

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

// Auth::routes();
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/products', 'ProductsController@list')->name('home');
Route::get('/products/{product}', 'ProductsController@product')->name('product');
Route::post('/products/{product}', 'ProductsController@store')->name('store.product.trip');

Route::get('/checkout', 'CheckoutController@checkout')->name('checkout');
Route::post('/checkout', 'CheckoutController@confirm')->name('checkout.confirm');