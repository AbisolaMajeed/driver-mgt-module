<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;



// Route::group(['prefix' => 'driver'], function () {
//     Route::get('/', [DriverController::class, 'index']);
//     Route::post('/', [DriverController::class, 'addDriver']);
//     Route::post('/{driver_id}', [DriverController::class, 'updateDriver']);
//     Route::delete('/{driver_id}', [DriverController::class, 'deleteDriver']);
// });
Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/roles/{user_id}', [RoleController::class, 'assignRoleToUser'])->middleware('can:manage-user-roles');
    Route::get('/roles', [RoleController::class, 'index'])->middleware('can:manage-user-roles');

    Route::middleware(['can:manage-drivers'])->prefix('driver')->group(function () {
        Route::get('/', [DriverController::class, 'index']);
        Route::post('/', [DriverController::class, 'addDriver']);
        Route::post('/{driver_id}', [DriverController::class, 'updateDriver']);
        Route::delete('/{driver_id}', [DriverController::class, 'deleteDriver']);
    });

    Route::get('/profile', [DashboardController::class, 'index'])->middleware('can:view-data');
    Route::post('/logout', [LoginController::class, 'logout']);
});
