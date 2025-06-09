<?php

use App\Http\Controllers\Import\ViettelPostImportController;
use App\Http\Controllers\Admin\notificationController;
use App\Http\Controllers\Admin\packageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('accounting')->group(function () {
    Route::prefix('invoice-processing')->group(function () {
        Route::prefix('viettel-post')->group(function () {
            Route::post('/data', [ViettelPostImportController::class, 'importData'])->name('accounting.invoiceprocessing.viettelpost.data');
        });
    });
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('profile', [AuthController::class, 'userProfile']);
Route::post('logout', [AuthController::class, 'logout']);
Route::resource('packages', packageController::class);
Route::resource('notification', notificationController::class);
Route::get('user', [UserController::class, 'index']);
Route::post('user', [UserController::class, 'store']);
Route::get('user/{id}', [UserController::class, 'edit']);
Route::put('user/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'destroy']);
