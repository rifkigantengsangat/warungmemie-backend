<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\MenuController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\TestimoniController;
use App\Http\Controllers\api\PesananController;


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
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser'])->name('login');
Route::post('/menu',[MenuController::class, 'store']);
Route::get('/menu',[MenuController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\api\AuthController::class, 'logout']);
});
Route::post('/menu/{id}/testimoni', [TestimoniController::class, 'store'])->middleware('auth:sanctum')->name('testimoni');
Route::get('/menu/{id}/testimoni', [TestimoniController::class, 'menuComment']);

Route::post('category',[CategoryController::class, 'store']);
Route::get('category',[CategoryController::class, 'index']);
Route::get('category/{slug}',[CategoryController::class, 'detailDataCategory']);
Route::post('/pesanan',[PesananController::class, 'store'])->middleware('auth:sanctum');

