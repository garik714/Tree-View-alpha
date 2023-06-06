<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Content\ContentController;
use App\Http\Controllers\Content\RootContentController;
use App\Http\Controllers\Icon\IconController;
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

Route::prefix('content')
    ->middleware(['auth:api'])
    ->group(function () {
    Route::get('/{id}', [ContentController::class, 'show']);
    Route::get('/', [RootContentController::class, 'index']);
    Route::post('/', [ContentController::class, 'create']);
    Route::post('/{id}', [ContentController::class, 'update']);
    Route::patch('/drag-and-drop/{id}', [ContentController::class, 'dragDrop']);
    Route::delete('/{id}', [ContentController::class, 'delete']);
    Route::delete('/root/{id}', [RootContentController::class, 'delete']);
});

Route::prefix('icon')
    ->middleware(['auth:api'])
    ->group(function () {
    Route::get('/', [IconController::class, 'index']);
    Route::post('/', [IconController::class, 'create']);
    Route::patch('/{id}', [IconController::class, 'update']);
    Route::delete('/{id}', [IconController::class, 'delete']);
});

Route::post('/register', [AuthController::class, 'register'])
    ->name('register');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware(['auth:api'])
    ->name('logout');

Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
