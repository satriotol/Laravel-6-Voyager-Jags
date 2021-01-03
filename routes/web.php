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

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index')->name('home');
Route::get('products','HomeController@products')->name('products');
Route::get('products/{product}','HomeController@productshow')->name('product.show');
Route::get('contact','HomeController@contact')->name('contact');
Route::post('cart', 'CartController@addToCart')->name('front.cart');
Route::get('/cart', 'CartController@listCart')->name('front.list_cart');
Route::post('/cart/update', 'CartController@updateCart')->name('front.update_cart');
Route::get('/checkout','CartController@checkout')->name('front.checkout');
Route::post('/checkout', 'CartController@processCheckout')->name('front.store_checkout');
Route::get('/checkout/{invoice}', 'CartController@checkoutFinish')->name('front.finish_checkout');
Route::post('/api/cost', 'CartController@getCourier');
Route::get('/api/city', 'CartController@getCity');
Route::get('/api/district', 'CartController@getDistrict');
Route::get('/kirimemail','HomeController@SendEmail');
Route::post('/sendemail/send', 'HomeController@send')->name('email.send');
Route::get('/print_pdf', 'CartController@invoicepdf')->name('front.pdf');
// Route::get('/coba','MidtransController@payment');
Route::get('/coba/test','MidtransController@checkout-process')->name('checkout-process');
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
