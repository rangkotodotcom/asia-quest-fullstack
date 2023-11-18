<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ToDoListController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::put('/todolist/{todolist}/status', [ToDoListController::class, 'updateStatus']);
    Route::apiResource('/todolist', ToDoListController::class);


    Route::post('/logout', [AuthController::class, 'logout']);
});
