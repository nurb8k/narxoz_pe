<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\TeacherController;
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

Route::get('/migrate',function (){
   Artisan::call('migrate');
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/lessons/subscribe/{lesson}', [LessonController::class, 'subscribe']);
    Route::post('/lessons/unsubscribe/{lesson}', [LessonController::class, 'unsubscribe']);

    Route::get('/lessons', [LessonController::class, 'index']);
    Route::get('/lessons/by-date', [LessonController::class, 'getByDate']);
    Route::get('/lesson/{lesson}', [LessonController::class, 'show']);

    Route::get('/sections', [SectionController::class, 'index']);
    Route::get('/section/{section}', [SectionController::class, 'show']);

    Route::get('/teachers', [TeacherController::class, 'index']);
    Route::get('/teacher/{teacher}', [TeacherController::class, 'show']);

    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{news}', [NewsController::class, 'show']);

    Route::get('/events', [SectionController::class, 'index']);

    Route::get("/my_lessons", [LessonController::class, 'my_lessons']);

    //only teachers
    Route::post('/lesson/attendance/{lesson}', [TeacherController::class, 'attendance']);

});
// start
