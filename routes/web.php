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

Route::view('/', 'welcome');

Auth::routes();

// Registration Wizard
// 1.
Route::view('/register/robot', 'layouts.wizard.robot')->middleware('auth')->name('view.register.robot');
Route::post('/register/robot', 'UserController@tryBeingHuman')->name('post.register.robot');
// 2.
Route::view('/register/photo', 'layouts.wizard.photo')->middleware('auth')->name('view.register.photo');
Route::post('/register/photo', 'UserController@wizardPhoto')->name('post.register.photo');
// 3.
Route::view('/register/profile', 'layouts.wizard.profile')->middleware('auth')->name('view.register.profile');
Route::post('/register/profile', 'UserController@wizardProfile')->name('post.register.profile');
Route::post('/language/add', 'LanguagesController@store')->middleware('auth')->name('languages.add');
Route::post('/language/{languages}/update', 'LanguagesController@update')->middleware('auth')->name('languages.update');
Route::delete('/language/{languages}/destroy', 'LanguagesController@destroy')->middleware('auth')->name('languages.delete');
// Confirm
Route::get('register/confirm', 'Auth\RegisterConfirmController@index')->name('register.confirm');

// Dashboard
Route::get('/dashboard', 'DashboardController@view')->name('view.dashboard');

// Profile
Route::post('/api/{user}/avatar', 'UserController@storeAvatar')->middleware('auth')->name('avatar');

Route::get('/{user}', 'ProfileController@show')->name('view.profile');

// Languages
Route::get('/{user}/languages/{type}', 'UserController@languages')->name('languages.user.get');
