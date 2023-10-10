<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReplyController;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    // Route::resource('news', NewsController::class)->only([
    //     'index', 'show', 'create', 'store'
    // ]);

    Route::get('/image/{fileName}', [ApplicationController::class, 'image']);

    Route::get('/application', [ApplicationController::class, 'index']);
    Route::post('/application', [ApplicationController::class, 'store']);

    Route::get('/application/{id}', [ApplicationController::class, 'show'])->middleware('checkApplicationOwnership');
    Route::post('/reply', [ReplyController::class, 'store'])->middleware('checkManager');
});
