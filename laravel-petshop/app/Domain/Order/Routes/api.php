<?php

use App\Domain\Order\Controllers\Order\OrderCreateController;
use App\Domain\Order\Controllers\Order\OrderFindController;
use App\Domain\Order\Controllers\Order\OrderListController;
use App\Domain\Order\Controllers\OrderStatus\OrderStatusListController;
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
    ->group(function () {
        Route::prefix('payment')
            ->middleware('jwt.verify')
            ->group(function () {
            Route::post('/create', PaymentCreateController::class);
        });

        Route::prefix('order')
            ->middleware('jwt.verify')
            ->group(function () {
            Route::post('/create', OrderCreateController::class);
            Route::get('/{uuid}', OrderFindController::class);
        });

        Route::get('/orders', OrderListController::class)
            ->middleware('jwt.verify');

        Route::get('/order-statuses', OrderStatusListController::class);
});
