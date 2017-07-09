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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/user', 'UserController');
    Route::resource('/account', 'AccountController');
    Route::resource('/contacts', 'ContactsController');
    Route::resource('/vendors', 'VendorController');
    Route::resource('/parts', 'PartsController');
    Route::get('/user/{id}/delete', 'UserController@delete');
    Route::get('/account/{id}/delete', 'AccountController@delete');
    Route::get('/contacts/{id}/delete', 'ContactsController@delete');
    Route::get('/vendors/{id}/delete', 'VendorController@delete');
    Route::get('/parts/{id}/delete', 'PartsController@delete');
});
Auth::routes();