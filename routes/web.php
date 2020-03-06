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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['register' => false]);

Route::get('/lang/{locale}', 'HomeController@lang');

Route::group(['middleware' => ['auth', 'web']], function () {
    Route::resource('users', '\App\Http\Controllers\UserController');

    Route::post('/users/{id}/edit', '\App\Http\Controllers\UserController@update');

    Route::get('/users/{id}/delete', '\App\Http\Controllers\UserController@destroy');

    Route::resource('sections', '\App\Http\Controllers\SectionController');

    Route::post('/sections/{id}/edit', '\App\Http\Controllers\SectionController@update');

    Route::get('/sections/{id}/delete', '\App\Http\Controllers\SectionController@destroy');
});
