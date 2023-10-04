<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SaleController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post(
    '/login',
    [App\Http\Controllers\AuthController::class, 'getToken']
);

Route::middleware('auth:sanctum')->post('/seller', [SellerController::class, 'create']);
Route::middleware('auth:sanctum')->get('/seller', [SellerController::class, 'index']);

Route::middleware('auth:sanctum')->post('/sale', [SaleController::class, 'create']);
Route::middleware('auth:sanctum')->get('/sale', [SaleController::class, 'index']);
