<?php

use App\Http\Controllers\Import\ViettelPostImportController;
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

