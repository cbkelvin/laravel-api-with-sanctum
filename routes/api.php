<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WorkerController;
use App\Http\Controllers\Api\TaskController;

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

Route::post("register", [WorkerController::class, "register"]);
Route::post("login", [WorkerController::class, "login"]);

Route::group(["middleware" => ["auth:sanctum"]], function(){

    Route::get("profile", [WorkerController::class, "profile"]);
    Route::get("logout", [WorkerController::class, "logout"]);

    Route::post("create-task", [TaskController::class, "createTask"]);
    Route::get("list-task", [TaskController::Class, "listTask"]);
    Route::get("single-task/{id}", [TaskController::class, "singleTask"]);
    Route::delete("delete-task/{id}", [TaskController::class, "deleteTask"]);

});







Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
