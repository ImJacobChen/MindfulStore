<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Index routes...
Route::get('/', 'HomeController@index');

//Products routes...
Route::get('products', 'ProductsController@index');
Route::get('products/refine', 'ProductsController@refine');

//Product routes...
Route::get('product/{id}', 'ProductController@show');
Route::post('product/add-to-basket', 'ProductController@addToBasket');

//Contact routes...
Route::get('contact', 'ContactController@index');

//Basket routes...
Route::get('basket', 'BasketController@index');
Route::post('basket/remove', 'BasketController@remove');
Route::post('basket/update', 'BasketController@update');

//Search routes...
Route::get('search', 'SearchController@index');
Route::get('search', 'SearchController@search');

//Account routes...
Route::get('account', 'AccountController@index');

//Checkout routes...
Route::get('checkout/details', 'CheckoutController@index');
Route::post('checkout/review', 'CheckoutController@review');
Route::get('checkout/paypalReview', 'CheckoutController@paypalReview');
Route::get('checkout/confirmation', 'CheckoutController@confirmation');

Route::post('checkout/paypal-checkout', 'CheckoutController@setExpressCheckout');
Route::post('checkout/place-order', 'CheckoutController@placeOrder');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Braintree
Route::get('braintree/token', 'BraintreeController@token')->name('braintree.token');