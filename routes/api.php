<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\JeepController;
use App\Http\Controllers\KostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MakananController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/posts', controller: PostController::class);
Route::apiResource('/kosts', KostController::class);


Route::apiResource('/foods', MakananController::class);
Route::apiResource('/jeeps', JeepController::class);
