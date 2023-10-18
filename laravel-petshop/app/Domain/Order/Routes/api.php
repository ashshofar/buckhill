<?php

use App\Domain\Order\Controllers\Order\OrderCreateController;
use App\Domain\Order\Controllers\Payment\PaymentCreateController;
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

Route::prefix('v1')
    ->middleware('jwt.verify')
    ->group(function () {
        Route::prefix('payment')->group(function () {
            Route::post('/create', PaymentCreateController::class);
        });

        Route::prefix('order')->group(function () {
            Route::post('/create', OrderCreateController::class);
        });
});
