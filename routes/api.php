<?php

use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\LokasiController;
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

Route::group(['middleware' => ['json.response', 'auth']], function () {
    Route::apiResource('keluarga', KeluargaController::class);
    Route::apiResource('lokasi', LokasiController::class);
});
