<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\packageController;
use App\Http\Controllers\Admin\notificationController;
use App\Http\Controllers\Import\ViettelPostImportController;


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
            Route::post('/export', [ViettelPostImportController::class, 'downloadExport'])->name('accounting.invoiceprocessing.viettelpost.export');
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
 Route::get('roles', [RoleController::class, 'index']);
    Route::post('roles', [RoleController::class, 'store']);
    Route::put('roles/{role}', [RoleController::class, 'update']);
    Route::delete('roles/{role}', [RoleController::class, 'destroy']);
    Route::get('permissions', [RoleController::class, 'permissions']);

// check login 1 thiet bi
// Route::middleware(['auth:api', 'check.user.token'])->group(function () {
//     Route::get('/packages', [PackageController::class, 'index']);
//     Route::post('/packages', [PackageController::class, 'store']);
//     // các route cần bảo vệ
// });
