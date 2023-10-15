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

Route::prefix('file')
    //->middleware('auth')
    ->group(function () {

        Route::get('/', 'FileController@index')->name('file.index');
        Route::get('/create', 'FileController@create')->name('file.create');
        Route::post('/', 'FileController@store')->name('file.store');
        Route::get('/{file}', 'FileController@show')->name('file.show');
        Route::get('/{file}/edit', 'FileController@edit')->name('file.edit');
        Route::put('/{file}', 'FileController@update')->name('file.update');
        Route::delete('{file}', 'FileController@destroy')->name('file.destroy');
    });
