<?php

use Illuminate\Support\Facades\Route;
use Modules\RH\Api\v1\MarinController;
/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
//     Route::view('toto', 'toto');
    Route::get('marins', [MarinController::class, 'index']);
    Route::post('marin', [MarinController::class, 'store']);

    Route::get('get_marin_uuid', [MarinController::class, 'get_marin_uuid']);
});
