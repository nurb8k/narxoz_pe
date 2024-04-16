<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\SectionController;
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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/test', function (){

    dd('ok');
    (new \Database\Seeders\DatabaseSeeder())->run();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/lessons',[LessonController::class , 'list']);
    Route::get('/sections',[SectionController::class , 'list']);

});
// start
