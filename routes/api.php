<?php

use App\Http\Controllers\Api\LogintController;
use App\Http\Controllers\Api\ProductController;
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
Route::controller(LogintController::class)->group(function(){
    Route::post('login', 'login');
});

        
Route::middleware('auth:sanctum')->group( function () {
    Route::get('/products', [ProductController::class,"index"]);
    Route::get('/products/{product}', [ProductController::class,"show"]);
    Route::post('/products', [ProductController::class,"store"]);
    Route::put('/products/{product}', [ProductController::class,"update"]);
    Route::delete('/products/{product}', [ProductController::class,"destroy"]);

});