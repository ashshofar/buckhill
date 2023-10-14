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

Route::prefix('user')
    //->middleware('auth')
    ->group(function () {

        Route::get('/', 'UserController@index')->name('user.index');
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::post('/', 'UserController@store')->name('user.store');
        Route::get('/{user}', 'UserController@show')->name('user.show');
        Route::get('/{user}/edit', 'UserController@edit')->name('user.edit');
        Route::put('/{user}', 'UserController@update')->name('user.update');
        Route::delete('{user}', 'UserController@destroy')->name('user.destroy');
    });
