<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use App\Models\User;
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
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('list', TaskListController::class)->except(['show']);
    Route::prefix('list/{list}')->group(function () {
        Route::apiResource('task', TaskController::class)->only(['index','store']);
    });
    Route::apiResource('task', TaskController::class)->except(['index','store','show']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
