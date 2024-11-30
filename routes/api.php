<?php

use App\Http\Controllers\Api\Internal\V1\SeatingPlanController as InternalSeatingPlanController;
use App\Http\Controllers\Api\V1\SeatingPlanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Internal routes are ones used by the control frontend
Route::prefix('internal')->name('api.internal.')->middleware('auth:sanctum')->group(function () {
    Route::prefix('v1')->name('v1.')->group(function () {
        Route::resource('events.seatingplans', InternalSeatingPlanController::class)
            ->only(['index', 'show'])
            ->middleware('can:see,event')
            ->scoped();
    });
});

Route::prefix('v1')->name('api.v1.')->middleware(['auth:sanctum', 'can:admin'])->group(function () {
    Route::resource('events.seatingplans', SeatingPlanController::class)
        ->only(['index', 'show'])
        ->middleware('can:see,event')
        ->scoped();
});
