<?php

use App\Http\Controllers\FileController;
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
    Route::prefix('task/{task}')->group(function () {
        Route::apiResource('file', FileController::class)->only(['store']);
    });
    Route::apiResource('file', FileController::class)->only(['update','destroy']);
    Route::apiResource('task', TaskController::class)->only(['update','destroy']);
    Route::put('task/{task}/mark', [TaskController::class, 'markAsDoneUndone'])->name('task.mark');
});

