<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\packageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\notificationController;
use App\Http\Controllers\Import\ImportHistoryController;
use App\Http\Controllers\Import\ProductImportController;
use App\Http\Controllers\Import\ViettelPostImportController;
use App\Http\Controllers\Lazada\LazopController;
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

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('resetPassword', [AuthController::class, 'resetPassword'])->name('resetPassword');


Route::middleware(['auth:api', 'check.user.token'])->group(function () {
    Route::get('profile', [AuthController::class, 'userProfile']);
    Route::resource('packages', packageController::class);
    Route::resource('products', ProductController::class);
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::get('user/{id}', [UserController::class, 'edit']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
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
    Route::get('notifications',                    [NotificationController::class, 'index']);
    Route::post('notifications',                    [NotificationController::class, 'store']);
    Route::put('notifications/{id}',               [NotificationController::class, 'update']);
    Route::delete('notifications/{id}',               [NotificationController::class, 'destroy']);
    Route::post('notifications/{id}/broadcast',     [NotificationController::class, 'broadcast']);
    Route::post('notifications/{id}/mark-read',     [NotificationController::class, 'markRead']);
    Route::post('notifications/{id}/mark-unread',   [NotificationController::class, 'markUnread']);
    Route::post('notifications/mark-read-all',      [NotificationController::class, 'markAllRead']);
    Route::get('complaints',          [ComplaintController::class, 'index']);
    Route::post('complaints',          [ComplaintController::class, 'store']);
    Route::get('complaints/{complaint}', [ComplaintController::class, 'show']);
    Route::patch('complaints/{complaint}', [ComplaintController::class, 'update']);
    Route::delete('complaints/{complaint}', [ComplaintController::class, 'destroy']);
});

Route::post('/auth-shopee', [AuthShopeeController::class, 'getAuthShopUrl'])->name('shopee.authshop');
Route::post('/shopee/token-shop-level', [AuthShopeeController::class, 'getTokenShopLevel'])->name('shopee.tokenShopLevel');
Route::post('/shopee/token-account-level', [AuthShopeeController::class, 'getTokenAccountLevel'])->name('shopee.tokenAccountLevel');
Route::post('/shopee/access-token-shop-level', [AuthShopeeController::class, 'getAccessTokenShopLevel'])->name('shopee.accessTokenShopLevel');
Route::post('/shopee/access-token-merchant-level', [AuthShopeeController::class, 'getAccessTokenMerchantLevel'])->name('shopee.accessTokenMerchantLevel');

Route::prefix('lazada')->group(function () {
    Route::post('/auth-shop', [LazopController::class, 'getAuthShopUrl'])->name('lazada.auth-shop');
    Route::post('/shop-access-token', [LazopController::class, 'getShopAccessToken'])->name('lazada.shop-access-token');
    Route::post('/shop-refresh-token', [LazopController::class, 'getShopRefreshtoken'])->name('lazada.shop-refresh-token');
});

Route::post('products/import', [ProductImportController::class, 'import']);
