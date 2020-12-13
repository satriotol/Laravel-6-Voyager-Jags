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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
