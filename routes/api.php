<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\AppointmentsController as PublicAppointmentsController;
use App\Http\Controllers\Public\PriceController;
use App\Http\Controllers\Public\SlotsController;
use App\Http\Controllers\Admin\AppointmentsController as AdminAppointmentsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\WorkingIntervalsController;

Route::get('/health', function (Request $request) {
    return response()->json([
        'status' => 'ok',
    ]);
});

Route::prefix('public')->group(function () {
    Route::get('/price', PriceController::class);
    Route::get('/slots', SlotsController::class);
    Route::post('/appointments', [PublicAppointmentsController::class, 'store']);
});

Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('/working-intervals', [WorkingIntervalsController::class, 'index']);
        Route::post('/working-intervals', [WorkingIntervalsController::class, 'store']);
        Route::put('/working-intervals/{workingInterval}', [WorkingIntervalsController::class, 'update']);
        Route::delete('/working-intervals/{workingInterval}', [WorkingIntervalsController::class, 'destroy']);

        Route::get('/appointments', [AdminAppointmentsController::class, 'index']);
        Route::patch('/appointments/{appointment}', [AdminAppointmentsController::class, 'update']);
    });
});
