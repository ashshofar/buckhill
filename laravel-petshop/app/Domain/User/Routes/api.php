<?php

use App\Domain\User\Controllers\Admin\AdminCreateController;
use App\Domain\User\Controllers\Auth\AdminLoginController;
use App\Domain\User\Controllers\User\UserCreateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('/login', AdminLoginController::class);
        Route::post('/create', AdminCreateController::class);
    });

    Route::prefix('user')->group(function () {
        Route::post('/create', UserCreateController::class);
    });
});

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('/test', function () {
        return 'test';
    });
});
