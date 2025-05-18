<?php

use App\Http\Controllers\Api\ANNController;
use App\Http\Controllers\Api\HistoriesController;
use App\Http\Controllers\Api\MasterController;
use App\Http\Controllers\Api\TimeControllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/histories', HistoriesController::class);
Route::get('/ann', [ANNController::class, 'index']);
Route::post('/ann', [ANNController::class, 'store']);
Route::get('/ann/{id}', [ANNController::class, 'show']);
Route::put('/ann/{id}', [ANNController::class, 'update']);
Route::delete('/ann/{id}', [ANNController::class, 'destroy']);
Route::apiResource('/master', MasterController::class);
Route::apiResource('/time', TimeControllers::class);
