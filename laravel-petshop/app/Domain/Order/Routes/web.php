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

Route::prefix('order')
    //->middleware('auth')
    ->group(function () {

        Route::get('/', 'OrderController@index')->name('order.index');
        Route::get('/create', 'OrderController@create')->name('order.create');
        Route::post('/', 'OrderController@store')->name('order.store');
        Route::get('/{order}', 'OrderController@show')->name('order.show');
        Route::get('/{order}/edit', 'OrderController@edit')->name('order.edit');
        Route::put('/{order}', 'OrderController@update')->name('order.update');
        Route::delete('{order}', 'OrderController@destroy')->name('order.destroy');
    });
