<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasalController;
use App\Http\Controllers\WebAyatController;
use App\Http\Controllers\WebPasalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
    // crud route pasal
    Route::post('/storePasal', [WebPasalController::class, 'store']);
    Route::put('/editPasal/{id}', [WebPasalController::class, 'update']);
    Route::delete('/deletePasal/{id}', [WebPasalController::class, 'destroy']);

    // crud route ayat
    Route::post('/storeAyat', [WebAyatController::class, 'store']);
    Route::put('/editAyat/{id}', [WebAyatController::class, 'update']);
    Route::delete('/deleteAyat/{id}', [WebAyatController::class, 'destroy']);
});

// read pasal
Route::get('/', [WebPasalController::class, 'index']);
Route::get('/addpasalPage', [WebPasalController::class, 'addPage']);
Route::get('/editPasal/{id}', [WebPasalController::class, 'editPage']);
Route::get('/detailPasal/{id}', [WebPasalController::class, 'detailPasal']);


// read ayat
Route::get('/ayat', [WebAyatController::class, 'index']);
Route::get('/addayatPage', [WebAyatController::class, 'addPage']);
Route::get('/editAyat/{id}', [WebAyatController::class, 'editPage']);
Route::get('/detailAyat/{id}', [WebAyatController::class, 'detailAyat']);


/* Auth */
Route::get('/login', [AuthController::class, 'indexLogin']);
Route::get('/register', [AuthController::class, 'indexRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
