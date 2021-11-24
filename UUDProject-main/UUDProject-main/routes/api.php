<?php

use App\Http\Controllers\AyatController;
use App\Http\Controllers\PasalController;
use App\Http\Controllers\AuthController;
use App\Models\Pasals;
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

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/uud', [PasalController::class, 'store']);
    Route::put('/uud/{pasal}', [PasalController::class, 'update']);
    Route::delete('/uud/{pasal}', [PasalController::class, 'delete']);
    Route::post('/ayat', [AyatController::class, 'store']);
    Route::put('/ayat/{ayat}', [AyatController::class, 'update']);
    Route::delete('/ayat/{ayat}', [AyatController::class, 'destroy']);
});

Route::get('/uud', [PasalController::class, 'index']);
Route::get('/uud/{pasal}', [PasalController::class, 'show']);
Route::get('/uud/judulbab/{judul_bab}', [PasalController::class, 'searchJudulBab']);

Route::get('/ayat', [AyatController::class, 'index']);
Route::get('/ayat/{ayat}', [AyatController::class, 'show']);
Route::get('/ayat/bunyi/{bunyi}', [AyatController::class, 'search']);

// auth
Route::post('/registrasi', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
