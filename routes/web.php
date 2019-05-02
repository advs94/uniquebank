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

Route::get('/', function () {
    return view('home');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/profile', 'UsersController@edit')->name('profile');
Route::patch('/users/{user}', 'UsersController@update');
Route::delete('/users/{user}', 'UsersController@destroy');
Route::get('/users/password', 'UsersController@editPassword');
Route::patch('/users/password/{user}', 'UsersController@updatePassword');
Route::get('/accounts', 'AccountsController@index');
Route::patch('/accounts/{user}', 'AccountsController@update');
Route::delete('/accounts/{account}', 'AccountsController@destroy');
Route::get('/accounts/create', 'AccountsController@create');
Route::post('/accounts/{user}', 'AccountsController@store');
Route::get('/accounts/balance', 'AccountsController@balance');
Route::get('/accounts/nibiban', 'AccountsController@nibiban');
Route::get('/transfers/national', 'TransfersController@nationals');
Route::post('/transfers/national/{user}', 'TransfersController@storeNationals');
Route::get('/transfers/international', 'TransfersController@internationals');
Route::post('/transfers/international/{user}', 'TransfersController@storeInternationals');
