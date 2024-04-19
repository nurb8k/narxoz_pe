<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LessonController;
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
Route::post('/test', function () {
    dd(\App\Models\Lesson::with('teacher')->get());
//    (new \Database\Seeders\DatabaseSeeder())->run();


//    dd(\App\Models\Lesson::all());
    dd('ok');
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/lessons', [LessonController::class, 'index']);
    Route::get('/lesson/{lesson}', [LessonController::class, 'show']);


    Route::get('/sections', [SectionController::class, 'index']);
    Route::get('/section/{section}', [SectionController::class, 'show']);


    Route::get('/teachers', [TeacherController::class, 'index']);
    Route::get('/teacher/{teacher}', [TeacherController::class, 'show']);

    Route::get('/news', [SectionController::class, 'index']);
    Route::get('/news/{news}', [SectionController::class, 'show']);

    Route::get('/events', [SectionController::class, 'index']);


//    Route::get('/profile',[ProfileController::class,'index']);
//    Route::get('my_lessons',[LessonController::class,'my_lessons']);

});
// start
