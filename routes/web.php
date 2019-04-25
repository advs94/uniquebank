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

// Route::get('/pages', 'PagesController@home');
// Route::get('/pages/contact', 'PagesController@contact');
// Route::get('/pages/about', 'PagesController@about');
// Route::resource('projects', 'ProjectsController');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('banks', 'BanksController');
Route::get('/users/profile', 'UsersController@edit')->name('profile');
Route::patch('/users/{user}', 'UsersController@update');
Route::delete('/users/{user}', 'UsersController@destroy');
Route::get('/users/password', 'UsersController@editPassword');
Route::patch('/users/password/{user}', 'UsersController@updatePassword');
