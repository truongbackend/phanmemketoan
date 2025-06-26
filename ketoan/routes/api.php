<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\packageController;
use App\Http\Controllers\Admin\notificationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Import\ImportHistoryController;
use App\Http\Controllers\Import\ViettelPostImportController;
use App\Http\Controllers\Shopee\AuthShopeeController;

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

Route::middleware(['auth:api'])->prefix('accounting')->group(function () {
    Route::prefix('invoice-processing')->group(function () {
        Route::prefix('viettel-post')->group(function () {
            Route::post('/column-submit-reason', [ViettelPostImportController::class, 'columnSubmitReason'])->name('accounting.invoiceprocessing.viettelpost.colsubmitreason');
            Route::post('/data', [ViettelPostImportController::class, 'importData'])->name('accounting.invoiceprocessing.viettelpost.data');
            Route::post('/export', [ViettelPostImportController::class, 'downloadExport'])->name('accounting.invoiceprocessing.viettelpost.export');
        });
    });
     Route::prefix('receipt-history')->group(function () {
            Route::post('/import', [ImportHistoryController::class, 'importHistorReceipt'])->name('accounting.receipthistory.import');
            Route::get('/list', [ImportHistoryController::class, 'getList'])->name('accounting.receipthistory.list');
            Route::post('/delete/bulk', [ImportHistoryController::class, 'destroy'])->name('accounting.receipthistory.destroy');
    });
});

Route::post('/auth-shopee', [AuthShopeeController::class, 'getAuthShopUrl'])->name('shopee.authshop');
Route::post('/shopee/token-shop-level', [AuthShopeeController::class, 'getTokenShopLevel'])->name('shopee.tokenShopLevel');
Route::post('/shopee/token-account-level', [AuthShopeeController::class, 'getTokenAccountLevel'])->name('shopee.tokenAccountLevel');
Route::post('/shopee/access-token-shop-level', [AuthShopeeController::class, 'getAccessTokenShopLevel'])->name('shopee.accessTokenShopLevel');
Route::post('/shopee/access-token-merchant-level', [AuthShopeeController::class, 'getAccessTokenMerchantLevel'])->name('shopee.accessTokenMerchantLevel');

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('profile', [AuthController::class, 'userProfile']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('resetPassword', [AuthController::class, 'resetPassword']);
Route::resource('packages', packageController::class);
Route::resource('product', ProductController::class);
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
Route::get('notifications', [NotificationController::class, 'index']);
Route::post('notifications', [NotificationController::class, 'store']);
Route::post('notifications/broadcast', [NotificationController::class, 'broadcast']);
Route::post('notifications/mark-read-all', [NotificationController::class, 'markAllRead']);
Route::post('notifications/{id}/mark-read', [NotificationController::class, 'markRead']);
