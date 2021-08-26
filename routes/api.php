<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KudoboardController;
use App\Http\Controllers\KudoController;
use App\Http\Controllers\SharedKudoboardController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['throttle:login'])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/kudoboard', [KudoboardController::class, 'create']);
    Route::get('/kudoboard', [KudoboardController::class, 'getKudoboards']);
    Route::put('/kudoboard/{id}', [KudoboardController::class, 'editKudoboard']);
    Route::get('/kudoboard/{id}', [KudoboardController::class, 'getKudoboard']);
    Route::delete('/kudoboard/{id}', [KudoboardController::class, 'deleteKudoboard']);
    
    Route::get('/kudoboard/{id}/kudo', [KudoController::class, 'getKudos']);
    Route::post('/kudoboard/{id}/kudo', [KudoController::class, 'createKudo']);
    Route::delete('/kudo/{kudo_id}', [KudoController::class, 'deleteKudo']);
    Route::put('/kudo/{kudo_id}', [KudoController::class, 'editarKudo']);

    Route::get('/shared-kudoboard', [SharedKudoboardController::class, 'getSharedKudoboards']);
    Route::get('/shared-kudoboard/{id}', [SharedKudoboardController::class, 'getSharedKudoboard']);
});